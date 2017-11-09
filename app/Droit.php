<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Droit extends Model {

	protected $guarded = ['id'];

	public function roles()
	{
		return $this->belongsToMany('App\Role', 'droits_roles');
	}
}