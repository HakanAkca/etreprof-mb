<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Lien extends Model {

	protected $guarded = ['id'];

	function contenu()
	{
		return $this->belongsTo('App\Contenu');
	}

	function player($w = null, $h = null)
	{
		switch ($this->decoder)
		{
			case 'youtube' :
				return view('players.youtube', [
					'url' => $this->embed_url,
					'w' => $w,
					'h' => $h
				])->render();

			default :
				return ;
		}
	}
}