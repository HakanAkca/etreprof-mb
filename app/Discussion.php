<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Discutable;

class Discussion extends Model {

	use Discutable;

	protected $guarded = ['id'];

	public function messages()
	{
		return $this->hasMany('App\DiscussionMessage');
	}

	public function lastMessage()
	{
		return $this->belongsTo('App\DiscussionMessage','last_message_id');
	}

	public function unread($user)
	{
		return ($user->id == $this->to_user_id) ? $this->to_unread : $this->from_unread;
	}

	public function notified($user)
	{
		return ($user->id == $this->to_user_id) ? $this->to_notified : $this->from_notified;
	}

	public function isRead($user)
	{
		$this->setUnread($user, 0);
		$this->setNotified($user, 0);
		
	}

	public function isNotified($user)
	{
		$this->setNotified($user, 1);
	}

	public function setUnread($user, $nb = 0)
	{
		$who = ($user->id == $this->to_user_id) ? 'to' : 'from';
		$unread = $who . '_unread';
		$this->$unread = $nb;
	}

	public function setNotified($user, $nb = 0)
	{
		//print 'isNotified->' . $user->id;
		$who = ($user->id == $this->to_user_id) ? 'to' : 'from';
		$notified = $who . '_notified';
		$this->$notified = $nb;
	}


}