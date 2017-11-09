<?php
namespace App;

use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

use App\Search;

class SearchRewriter {

	protected $_rawQuery;
	public $query;
	public $filters = [];

	public function __construct($rawQuery, $user = null)
	{
		$this->_rawQuery = $rawQuery;
		$this->user = $user;
		$this->query = $this->_rawQuery;
		$this->_synonymes();
		$this->_extractFilters();
		//$this->_findQuery();
	}

	protected function _synonymes()
	{
		$mots = explode(' ', $this->query);
		$synonymes = [
			'maths' => 'Mathématiques',
			'langue française' => 'Français',
			'histoire' => 'Histoire et géographie',
			'géo' => 'Histoire et géographie',
			'EPS' => 'E.P.S.',

		];
		foreach ($mots as $mot)
		{
			if (!empty($synonymes[strtolower($mot)]))
			{
				$mots[] = $synonymes[strtolower($mot)];
			}
		}
		$this->query = join(' ', $mots);
	}

	protected function _extractFilters()
	{
		$words = explode(' ', $this->query);
		$terms = Term::whereIn('name', $words)->get();
		foreach ($terms as $term)
		{
			//print $term->name . ' est un filtre<br>';
			$this->filters[$term->vocabulary->shortname][] = $term->name;
			//print_r()
			//$this->_removeFromQuery($term->name);
		}
	}

	protected function _removeFromQuery($word)
	{
		//return $this->query;
		$this->query = trim(str_ireplace($word, '', $this->query));
	}



}