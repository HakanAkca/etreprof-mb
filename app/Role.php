<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $guarded = ['id'];

	public function droits()
	{
		return $this->belongsToMany('App\Droit', 'droits_roles');
	}

	public function droitsRoles()
	{
		return $this->hasMany('App\DroitRole');
	}
}