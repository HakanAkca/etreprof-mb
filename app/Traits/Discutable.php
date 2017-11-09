<?php

namespace App\Traits;

/**
* @desc Discussion -> définit les interlocuteurs
*/
trait Discutable {

	public function from()
	{
		return $this->belongsTo('App\User', 'from_user_id');
	}

	public function to()
	{
		return $this->belongsTo('App\User', 'to_user_id');
	}

	public function other($user)
	{
		return ($this->from->id == $user->id) ? $this->to : $this->from; 
	}
	
}