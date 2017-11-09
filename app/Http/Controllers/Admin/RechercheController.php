<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contenu;
use App\Search;

class RechercheController extends Controller {


	function indexer($contenu_id)
	{
		$contenu = Contenu::find($contenu_id);
		$search = new Search;
		$index = $search->indexerContenu($contenu);

		$data = $search->findContenu($contenu_id);
		print_r($data);
		return;

	}

	function q($query)
	{
		$search = new Search;
		$results = $search->queryContenu($query);


		print_r($results);
		return;

	}



}