<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Historique extends Model {

	protected $table = 'historique';

	protected $guarded = ['id'];

	public function auteur()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function contenu()
	{
		return $this->belongsTo('App\Contenu');
	}

}