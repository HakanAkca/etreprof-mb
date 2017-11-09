<?php
namespace App\Traits;

use \Devfactory\Taxonomy\TaxonomyTrait;
use \Devfactory\Taxonomy\Models\Vocabulary;

// Etend le trait Taxonomy trait de DevFactoryCH avec des méthodes plus pratiques
Trait TaxonomyExtendedTrait {
	use TaxonomyTrait;

	public function saveTermsByVocabularyId($vocabulary_id, $terms = [])
	{
		$this->deleteTermsByVocabularyId($vocabulary_id);

		if (is_array($terms))
		{
			$this->addTerms($terms);
		}
	}

	public function deleteTermsByVocabularyId($vocabulary_id)
	{
		foreach ($this->getTermsByVocabularyId($vocabulary_id) as $term)
		{
			$term->delete();
		}
	}

	public function getTermsByVocabularyId($id) {
	    return $this->related()->where('vocabulary_id', $id)->get();
	}

	public function getTerms($vocabulary_shortname) {

		$voc = Vocabulary::select('id')->where('shortname', $vocabulary_shortname)->first();
	    return $this->getTermsByVocabularyId($voc->id);
	}

	public function addTerms($terms = [])
	{
		foreach ($terms as $term)
		{
			$this->addTerm($term);
		}
	}

	public function terms()
	{
		return $this->related()->with('term')->get()->map(function($i) {
			return $i->term;
		});
	}
}