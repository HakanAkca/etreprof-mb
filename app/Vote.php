<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	protected $guarded = ['id'];

	public function contenu()
	{
		return $this->belongsTo('App\Contenu');
	}

	public static function voter($contenu_id, $vote, $user = null, $user_agent = null, $ip = null)
	{
		if ($user)
		{
			$existant = Vote::where('contenu_id', $contenu_id)
						    ->where('user_id', $user->id)
						    ->first();
		}
		else
		{
			$existant = Vote::where('contenu_id', $contenu_id)
						    ->where('ip', ip2long($ip))
						    ->where('user_hash', crc32($user_agent))
						    ->first();

			if ($existant AND $existant->user_agent != $user_agent)
			{
				$existant = null;
			}
		}
		if (!$existant)
		{
			$existant = new Vote([
				'contenu_id' => $contenu_id,
				'user_id' => ($user) ? $user->id : 0,
				'ip' => ip2long($ip),
				'user_hash' => crc32($user_agent),
				'user_agent' => $user_agent,
				'vote_up' => 0,
				'vote_down' => 0
			]);
		}

		$col = 'vote_' . $vote;
		$existant->$col = 1;
		$existant->save();
		//dump($existant);
		return $existant;

	}

    public static function noter($contenu_id, $note, $user = null, $user_agent = null, $ip = null)
    {
        if ($user)
        {
            $existant = Vote::where('contenu_id', $contenu_id)
                ->where('user_id', $user->id)
                ->first();
        }
        else
        {
            $existant = Vote::where('contenu_id', $contenu_id)
                ->where('ip', ip2long($ip))
                ->where('user_hash', crc32($user_agent))
                ->first();

            if ($existant AND $existant->user_agent != $user_agent)
            {
                $existant = null;
            }
        }
        if (!$existant)
        {
            $existant = new Vote([
                'contenu_id' => $contenu_id,
                'user_id' => ($user) ? $user->id : 0,
                'ip' => ip2long($ip),
                'user_hash' => crc32($user_agent),
                'user_agent' => $user_agent,
                'note' => 0
            ]);
        }
        $existant->note = $note;
        $existant->save();
        //dump($existant);
        return $existant;

    }
}