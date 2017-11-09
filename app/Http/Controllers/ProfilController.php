<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Profil;
use Auth;

use DB;
use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

use Date;

class ProfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function modifier(Request $request)
    {
        $niveaux = Vocabulary::find(13)->terms;
        $user = Auth::user();
        $questions = Profil::questions();
        $qc = collect($questions)->keyBy('code');
        //dd($questions);
        $user->niveau = $user->related->pluck('term_id')->toArray();
        $user->profil = $user->profils->reduce(function ($arr, $item) use ($qc) {
            $q = $item->question;

            if ($qc->get($q)['format'] == 'checkbox') {
                if (!isset($arr[$q])) $arr[$q] = [];
                $arr[$q][] = $item->reponse;
            } elseif ($qc->get($q)['format'] == 'rank') {
                if (!isset($arr[$q])) $arr[$q] = [];
                $arr[$q][$item->reponse] = $item->score;
            } else {
                $arr[$q] = $item->reponse;
            }
            return $arr;
        }, []);
        //dump($user->profil);
        return view('profil.modifier', [
            'user' => $user,
            'r' => $request->input('r'),
            'niveaux' => $niveaux,
            'questions' => $questions
        ]);
    }

    public function postModifier(Request $request)
    {
        $user = Auth::user();

        $user->fill($request->only(['nom', 'prenom', 'codepostal', 'pays']));
        $user->save();

        //dd($request->input('niveau'));
        $user->saveTermsByVocabularyId(13, $request->input('niveau'));

        if ($request->input('profil')) {
            Profil::updateUser($request->input('profil'), $user->id);
        }

        $request->session()->flash('info', 'Votre profil a été mis à jour.');
        //dd($request->all('profil'));

        if ($redirect = $request->input('r')) {
            return redirect($redirect);
        } else {
            return redirect(action('ProfilController@modifier'));
        }

    }

    public function historique()
    {
        $contenus = Auth::user()->contenusParcourus()
            ->select(['id', 'titre'])
            ->withPivot('date')
            ->orderBy('date', 'DESC')
            ->take(1000)
            ->get()
            ->map(function ($contenu) {
                $contenu->date = Date::parse($contenu->pivot->date)->format('j F à H:i');

                $diff = Date::parse(substr($contenu->pivot->date, 0, 10))->diffInDays();
                switch ($diff) {
                    case 0 :
                        $contenu->jour = "Aujourd'hui";
                        break;

                    case 1 :
                        $contenu->jour = "Hier";
                        break;

                    default :
                        $contenu->jour = Date::parse($contenu->pivot->date)->format('j F');
                }
                //$contenu->diff = $diff;
                $contenu->url = $contenu->url();
                unset($contenu->pivot);
                return $contenu;
            })
            ->groupBy('jour')
            ->map(function ($contenus) {
                foreach ($contenus as $contenu) {
                    unset($contenu->jour);
                }
                return $contenus;
            })
            ->all();

        //dump($contenus);

        return view('profil.historique', ['contenus' => $contenus]);
    }

    public function postMajImage(Request $request)
    {
        $user = Auth::user();
        $user->original_image = $request->input('image');
        $user->image = $request->input('image');
        $user->save();
    }

    public function diagnostic()
    {
        $user = Auth::user()->email;

        $contenu = '448326';

        $email = 'bidar_306@hotmail.com';

        $reponses = DB::table('lime_survey.lime_survey_' . $contenu)
            ->where('448326X20X1093', $email)
            ->orderby('id', 'desc')
            ->first();

        $questions = DB::table('lime_survey.lime_questions')
            ->where('sid', $contenu)
            ->get()
            ->reduce(function ($arr, $q) use ($reponses) {
                $cle = $q->sid . 'X' . $q->gid . 'X' . $q->qid;
                if (!empty($reponses->$cle)) {
                    $arr['"{' . $q->title . '}"'] = "'" . $reponses->$cle . "'";
                }
                return $arr;
            }, []);

        $htmlMessage = DB::table('lime_survey.lime_assessments')
            ->where('sid', $contenu)
            ->get()
            ->map(function ($html) use ($questions) {
                $html->message = str_replace(array_keys($questions), array_values($questions), $html->message);
                $html->message = str_replace(array_map(function ($k) {
                    return htmlentities($k);
                },
                    array_keys($questions)), array_values($questions), $html->message);
                return $html;
            });


        return view('profil.diagnostic', ['htmlMessage' => $htmlMessage]);
    }
}
