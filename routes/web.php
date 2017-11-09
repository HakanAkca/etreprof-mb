<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
Route::post('/pusher/auth', '\Illuminate\Broadcasting\BroadcastController@authenticate');
        
Route::get('quitter', 'Auth\LoginController@logout');
Route::get('inscription', 'Auth\RegisterController@showRegistrationForm');
Route::get('restreint', 'IndexController@restreint');


Route::get('prehome', 'Auth\PrehomeController@index');

Route::group(['prefix' => 'storage'], function () {
	//Route::get('/', 'ImageController@get');
	Route::get('{folder}/{w}x{h}-{filename}', 'ImageController@get');
	Route::post('/save', 'ImageController@save');
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('/profil', 'ProfilController@modifier');
	Route::post('/profil', 'ProfilController@postModifier');
});

Route::post('/feedback', 'FeedbackController@postFeedback');


Route::group(['middleware' => ['auth', 'profil-complet']], function () {

	// BACK
	Route::group(['prefix' => 'admin', 'middleware' => 'droit:acces_admin'], function() {

		Route::group(['prefix' => 'contenus'], function() {
			Route::get('/', 'Admin\ContenusController@index');
			Route::get('/liste', 'Admin\ContenusController@liste');
			Route::get('/liste.json', 'Admin\ContenusController@listeJson');
			Route::get('/liste-par-terme/{terme_id}.json', 'Admin\ContenusController@listeParTermeJson');
			Route::get('/lien/{id?}', 'Admin\ContenusController@lien');
			Route::post('/lien/{id?}', 'Admin\ContenusController@postLien');
			Route::post('/fetch-url', 'Admin\ContenusController@fetchUrl');
			Route::get('/identite/{id?}', 'Admin\ContenusController@identite');
			Route::post('/identite/{id?}', 'Admin\ContenusController@postIdentite');
			Route::get('/avis/{id?}/{avis_id?}', 'Admin\ContenusController@avis');
			Route::post('/avis/{id?}/{avis_id?}', 'Admin\ContenusController@postAvis');
			//Route::get('/modifier-avis/{avis_id}', 'Admin\ContenusController@modifierAvis');
			Route::get('/publier/{id?}', 'Admin\ContenusController@publier')->middleware('droit:publier_contenu');
			Route::post('/publier/{id?}', 'Admin\ContenusController@postPublier')->middleware('droit:publier_contenu');
			Route::get('/publie/{id?}', 'Admin\ContenusController@publie')->middleware('droit:publier_contenu');
			Route::post('/publie/{id?}', 'Admin\ContenusController@postDepublier')->middleware('droit:publier_contenu');
			Route::get('/termine/{id?}', 'Admin\ContenusController@termine');
			Route::post('/supprimer', 'Admin\ContenusController@postSupprimer');
			Route::get('/historique/{id}', 'Admin\ContenusController@historique')->middleware('droit:voir_historique_contenu');
			Route::get('/historique-global/{date?}', 'Admin\ContenusController@historiqueGlobal')->middleware('droit:voir_historique_contenu');
        });

		Route::group(['prefix' => 'commentaires'], function () {
            Route::post('/supprimer', 'Admin\CommentairesController@postSupprimer')->middleware('droit:moderer_commentaires');
            Route::get('/', 'Admin\CommentairesController@index');
            Route::get('/liste.json', 'Admin\CommentairesController@listeJson');
            Route::get('/modifier/{id}', 'Admin\CommentairesController@modifier');
            Route::post('/modifier/{id}', 'Admin\CommentairesController@postModifier')->middleware('droit:modifier_commentaires');
		});

		Route::group(['prefix' => 'utilisateurs'], function() {
			Route::get('/', 'Admin\UtilisateursController@index');
			Route::get('/liste.json', 'Admin\UtilisateursController@listeJson');
			Route::get('/modifier/{id}', 'Admin\UtilisateursController@modifier');
			Route::post('/modifier/{id}', 'Admin\UtilisateursController@postModifier');
			Route::get('/droits', 'Admin\UtilisateursController@droits');
			Route::post('/droits', 'Admin\UtilisateursController@postDroits');
		});

		Route::group(['prefix' => 'recherche'], function() {
			Route::get('/indexer/{contenu_id}', 'Admin\RechercheController@indexer');
			Route::get('/q/{query}', 'Admin\RechercheController@q');
		});

		Route::group(['prefix' => 'menus'], function() {
			Route::get('/', 'Admin\MenusController@index');
			Route::post('/enregistrer', 'Admin\MenusController@postEnregistrer');
			Route::post('/supprimer', 'Admin\MenusController@postSupprimer');
		});

		Route::group([], function() {
			Route::get('/articles/{type}s', 'Admin\ArticlesController@index');
			Route::get('/articles/liste-{type}.json', 'Admin\ArticlesController@listeJson');
			Route::get('/articles/{type}/{id?}', 'Admin\ArticlesController@modifier');
			Route::post('/articles/{type}/{id?}', 'Admin\ArticlesController@postModifier');


		});

		Route::group(['prefix' => 'categories'], function() {
			Route::get('/', 'Admin\CategoriesController@index');
			Route::get('/modifier/{id?}', 'Admin\CategoriesController@modifier');
			Route::post('/modifier/{id?}', 'Admin\CategoriesController@postModifier');
			Route::get('/termes/{id}', 'Admin\CategoriesController@termes');
			Route::get('/terme/{vocabulary_id}/{term_id?}', 'Admin\CategoriesController@terme');
			Route::post('/terme/{vocabulary_id}/{term_id?}', 'Admin\CategoriesController@postTerme');
			Route::post('/supprimer-terme', 'Admin\CategoriesController@postSupprimerTerme');

		});

		Route::group(['prefix' => 'evenements', 'middleware' => ['droit:rediger_evenements']] , function () {
            Route::get('/', 'Admin\EvenementsController@index');
            Route::get('/liste.json', 'Admin\EvenementsController@listeJson');
            Route::get('/modifier/{id?}', 'Admin\EvenementsController@modifier');
            Route::post('/modifier/{id?}', 'Admin\EvenementsController@postModifier');
        });

	});

	// FRONT
	Route::group(['middleware' => ['droit:acces_front']], function() {
		Route::get('/dossiers', 'ArticlesController@dossiers');
		Route::get('/article/{url}', 'ArticlesController@voir');
		Route::get('/dossier/{url}', 'ArticlesController@voir');
		Route::get('/page/{url}', 'ArticlesController@voir');


		Route::get('/', 'IndexController@index');
		Route::get('/categorie/{id}/{nom?}', 'IndexController@categorie');

		Route::group(['prefix' => 'recherche'], function() {
			Route::get('/', 'RechercheController@requete');
			Route::post('/', 'RechercheController@postRequete');
			Route::post('/demande', 'RechercheController@postDemande');
		});

		Route::group(['prefix' => 'discussions'], function() {
			Route::post('/demarrer', 'DiscussionsController@postDemarrer');
			Route::get('/{id}.json', 'DiscussionsController@discussionJson');
			Route::get('/{id?}', 'DiscussionsController@index');
			Route::post('/{id}', 'DiscussionsController@postEcrire');
		});

		Route::get('/{id}/{nom?}', 'ContenusController@voir')->where(['id' => '[0-9]+']);

		Route::post('contenus/voter', 'ContenusController@voter');
        Route::post('contenus/noter', 'ContenusController@noter');
		Route::post('contenus/post-commentaire', 'ContenusController@postCommentaire');

		Route::get('/profil/historique', 'ProfilController@historique');

        Route::post('/favori', 'ContenusController@postFavori');
        Route::post('/supprimer-favori', 'ContenusController@postSupprimerFavori');

        Route::get('/favoris', 'ContenusController@favoris');

		Route::group(['prefix' => 'membres'], function() {
			Route::get('/', 'MembresController@index');
			Route::get('/{id}/{nom?}', 'MembresController@voir')->where(['id' => '[0-9]+']);
            Route::post('/ajouter-contact', 'MembresController@ajouterContact');
            Route::post('/supprimer-contact', 'MembresController@supprimerContact');
            Route::get('/liste-contacts.json', 'MembresController@listeContactsJson');
		});
		Route::get('/contact', 'ContactController@contact');
		Route::post('/contact', 'ContactController@postEnvoyer');
		Route::get('/contact/merci', 'ContactController@merci');
        Route::get('/sos', 'ContactController@sos');
        Route::post('/sos', 'ContactController@postSos');
        Route::get('/sos/merci', 'ContactController@merci');

        Route::post('/upload/envoyer', 'UploadController@envoyer');
        Route::post('/profil/maj-image', 'ProfilController@postMajImage');

        Route::get('/diagnostic/resultat', 'DiagnosticController@resultat');
        Route::get('/diagnostic/pdf/{id}', 'DiagnosticController@pdf');

        Route::get('/evenements', 'EvenementsController@index');
        Route::get('/evenements/{id}/titre', 'EvenementsController@voir');

        Route::post('/evenements/interesse/{id}', 'EvenementsController@postInteresse');
        Route::post('/evenements/plus-interesse/{id}', 'EvenementsController@postPlusInteresse');
    });


	Route::get('/home', function() {
		if (Auth::user() AND Auth::user()->possedeDroit('acces_admin'))
		{
			return redirect('/admin/contenus');
		}
		return redirect('/');
	});
});

Route::get('/diagnostic/html-pour-pdf/{id}/{hash}', 'DiagnosticController@htmlPourPdf');
