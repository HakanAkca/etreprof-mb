<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Discutable;

class DiscussionMessage extends Model {

	use Discutable;
	
	protected $guarded = ['id'];

	public function discussion()
	{
		return $this->belongsTo('App\Discussion');
	}

	public function from() {
		return $this->belongsTo('App\User', 'from_user_id');
	}

	public function to() {
		return $this->belongsTo('App\User', 'to_user_id');
	}

	public function fromName($user)
	{
		return ($this->from_user_id == $user->id) ? 'Moi' : $this->from->name;
	}


}