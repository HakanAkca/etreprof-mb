<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model {

	protected $guarded = ['id'];

	public function contenu()
	{
		return $this->belongsTo('App\Contenu');
	}

	public function evaluateur()
	{
		return $this->belongsTo('App\User', 'evaluateur_id');
	}

}