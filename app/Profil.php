<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Profil extends Model {

	public static $_questions;

	protected $guarded = ['id'];

	public static function questions()
	{
		if (empty(self::$_questions))
		{
			self::$_questions = include(app_path('profil-questions.php'));
		}
		return self::$_questions;
	}

	public static function question($key)
	{
		return collect(self::questions())->keyBy('code')->get($key);
	}

	public static function dominanteUser($user)
	{
		if ($user AND $user->id)
		{
			return self::scoresUser($user)
				  ->first()
				  ;
		}
	}

	public static function scoresUser($user)
	{
		if ($user AND $user->id)
		{
			$profil = Profil::where('user_id', $user->id)
					  ->select('reponse', DB::raw('sum(score) as score'))
					  ->where('reponse', '>', 0)
					  ->groupBy('reponse')
					  ->orderBy('score', 'desc')
					  ->get()
					  ->keyBy('reponse');
			return $profil;
		}
	}

	public static function updateUser($data, $user_id)
	{
		
		$delete = array_keys($data);
		
		Profil::where('user_id', $user_id)
				  ->whereIn('question', $delete)
				  ->delete();

		$questions = self::questions();
		$questions = collect($questions)->keyBy('code');
		//dump($questions);
		$insert = [];
		foreach ($data as $key => $values)
		{
			$question = $questions->get($key);
			
			if (!is_array($values)) 
			{
				$values = [$values];
			}
			if ($question['format'] == 'rank')
			{
				foreach ($values as $item_id => $score)
				{
					if (empty($value))	continue;

					$insert[] = [
					'user_id' => $user_id,
					'question' => $key,
					'reponse' => $item_id,
					'reponse_texte' => (!empty($question['reponses'][$item_id])) ? $question['reponses'][$item_id] : '',				
					'score' => $score,
					];
				}
			}
			else
			{
				foreach ($values as $value)
				{
					if (empty($value))	continue;

					$insert[] = [
					'user_id' => $user_id,
					'question' => $key,
					'reponse' => $value,
					'reponse_texte' => (!empty($question['reponses'][$value])) ? $question['reponses'][$value] : '',				
					'score' => (!empty($question['score'])) ? $question['score'] : 0,
					];
				}
			}
		}

		Profil::insert($insert);
		//dump($insert);
	}

	public static function updateAdmin($data, $user_id)
	{
		Profil::where('user_id', $user_id)
				  ->whereIn('question', ['bonus_admin'])
				  ->delete();
				  //dd($data);
		$insert = [];
		foreach ($data as $item_id => $score)
		{
				
			if (empty($score))	continue;

			$insert[] = [
				'user_id' => $user_id,
				'question' => 'bonus_admin',
				'reponse' => $item_id,
				'reponse_texte' => $item_id,				
				'score' => $score,
			];
				
		}
		Profil::insert($insert);

	}

}