<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	protected $guarded = ['id'];

	public $timestamps = false;

	public function children()
	{
		return $this->hasMany('App\Menu','parent_id')
					->orderBy('ordre');
	}
}