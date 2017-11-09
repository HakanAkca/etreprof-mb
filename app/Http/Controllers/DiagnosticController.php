<?php

namespace App\Http\Controllers;

use App\Services\Diagnostic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Profil;
use Auth;

use DB;

use Date;
use Exception;

class DiagnosticController extends Controller
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

    public function resultat()
    {
        //$user = Auth::user()->email;

        $survey_id = env('LIMESURVEY_SURVEY_ID');
        $colonne = env('LIMESURVEY_COLONNE');
        $email = 'bidar_306@hotmail.com';

        $reponses = Diagnostic::resultatsUser($survey_id, $colonne, $email);
        $questions = Diagnostic::questions($survey_id, $reponses);
        $htmlMessage = Diagnostic::htmlMessage($survey_id, $questions);

        return view('profil.diagnostic', ['htmlMessage' => $htmlMessage, 'id' => $reponses->id]);
    }

    public function htmlPourPdf($id, $hash)
    {
        //$user = Auth::user()->email;

        if (!Diagnostic::checkHash($id, $hash))
        {
            //print rawurlencode(Diagnostic::hash($id));
            throw new Exception('Url invalide');
            return;
        }

        $survey_id = env('LIMESURVEY_SURVEY_ID');
        $colonne = env('LIMESURVEY_COLONNE');
        $email = 'bidar_306@hotmail.com';

        $reponses = Diagnostic::resultatsUser($survey_id, 'id', $id);
        $questions = Diagnostic::questions($survey_id, $reponses);
        $htmlMessage = Diagnostic::htmlMessage($survey_id, $questions);

        return view('profil.html-pour-pdf', ['htmlMessage' => $htmlMessage]);
    }

    public function pdf($id)
    {

       $fichier =  Diagnostic::createPdf($id);
       $fichier = str_replace('storage/', '', $fichier);


       if (Storage::exists($fichier)) {
            $headers = [
                'X-Command' => Diagnostic::shellCommand(Diagnostic::publicUrl($id))
            ];
           return response()->download(storage_path($fichier), 'Diagnostic Etre-Prof.pdf', $headers);
       }

       return 'impossible de trouver le fichier' . $fichier;
    }
}
