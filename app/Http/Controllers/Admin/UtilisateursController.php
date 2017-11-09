<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use App\Droit;
use App\DroitRole;
use App\Profil;
use Auth;

use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

use App\Events\UtilisateurPromuTeteChercheuseEvent;


class UtilisateursController extends Controller {

	function index()
	{
		if (!empty($_GET['old']))
		{
			return view('admin.utilisateurs.index', ['onglet' => 'a_qualifier']);
		}

		return view('admin.utilisateurs.liste', ['onglet' => 'a_qualifier']);


	}

    public function listeJson()
    {
		$users = User::whereRaw(1);

		$users = $users->with('role')->get()->map(function($i) {
			$i->date_derniere_action = ($i->date_derniere_action) ? $i->date_derniere_action : '1970-01-01' ; //'1970-01-01 00:00:00';
			$i->roleNom = ($i->role) ? $i->role->nom : '-';
			return $i;
		});
		return response()->json([
			'nb' => count($users),
			'users' => $users
		]);
	}

	function modifier($id)
	{
		$user = User::find($id);
		$historique = $user->historiques()->with('contenu')->get();
		$roles = Role::all()->pluck('nom','id');
		$profils = $user->profils()->orderBy('score', 'desc')->get();
		$scoresProfils = Profil::scoresUser($user);
		$termes = $user->related()->with('term')->get();
		//dump($termes);		
		$dominante = Profil::dominanteUser($user);
		$user->bonus_admin = Profil::where('user_id', $user->id)
								   ->where('question', 'bonus_admin')
								   ->get()
								   ->pluck('score', 'reponse')
								   ;

		//dd($dominantes);
		$dominanteTermes = ($dominante) ? Term::whereIn('id', explode(',', $dominante->reponse))->get() : [];
		return view('admin.utilisateurs.modifier', [
			'user' => $user,
			'roles' => $roles,
			'profils' => $profils,
			'scoresProfils' => $scoresProfils,
			'termes' => $termes,
			'dominante' => $dominante,
			'dominanteTermes' => $dominanteTermes,
			'historique' => $historique
		]);
	}

	function postModifier(Request $request, $id)
	{
		$user = User::find($id);
		$ancien_role = $user->role_id;

		$user->fill($request->only('name','email', 'role_id', 'public', 'image'));
		$user->save();

		if ($request->input('bonus_admin')) 
		{			
			Profil::updateAdmin($request->input('bonus_admin'), $user->id);
		}


		if ($user->role_id == 4 AND $ancien_role != 4)
		{
			event(new UtilisateurPromuTeteChercheuseEvent($user));
			$request->session()->flash('alert-success', 'Un e-mail de confirmation d\'activation a été envoyé à ' . $user->email);
		}

		return redirect('/admin/utilisateurs');
	}

	function droits()
	{

		return view('admin.utilisateurs.droits', [
			'groupes_droits' => Droit::orderBy('groupe')->orderBy('code')->get()->groupBy('groupe'),
			'roles' => Role::get(),
			'droits_roles' => DroitRole::get()->keyBy(function($i) {
				return $i->role_id . '-' . $i->droit_id;
			})->map(function() {
				return 1;
			})
		]);
	}


	function postDroits(Request $request)
	{
		$id = explode('-', $request->input('id'));
		$val = $request->input('val');
		$droit = DroitRole::where('role_id', $id[0])->where('droit_id', $id[1])->first();
		if ($val == 'false' && $droit)
		{
			$droit->delete();
		}
		elseif ($val == 'true')
		{
			if (!$droit)
			{
				DroitRole::insert([
					'role_id' => $id[0],
					'droit_id' =>  $id[1]
				]);
			}
		}
		return response()->json($request);
	}

}