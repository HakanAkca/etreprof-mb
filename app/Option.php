<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


class Option extends Model {

	protected $guarded = ['id'];

	static $_global = [];
	static $_user = [];

	public static function fetchGlobal()
	{
		$options = Option::where('type','global')->get()->pluck('value','key')->all();
		self::$_global = $options;
		//print 'global:' ;
		//print_r(self::$_global);
		return ;
	}

	public static function fetchUser($user_id)
	{
		$options = Option::where('type','user')->where('user_id', $user_id)->get()->pluck('value','key')->all();
		self::$_user[$user_id] = $options;
		//print 'user:' ;
		//print_r(self::$_user);
		return ;
	}

	public static function getUser($key, $user_id)
	{
		if (empty(self::$_user[$user_id]))
		{
			self::fetchUser($user_id);
		}

		if (isset(self::$_user[$user_id][$key]))
		{
			return self::$_user[$user_id][$key] ;
		}
		else
		{
			return self::getGlobal($key);
		}

	}

	public static function getGlobal($key)
	{
		if (empty(self::$_global))
		{
			self::fetchGlobal();
		}
		if (isset(self::$_global[$key]))
		{
			return self::$_global[$key] ;
		}
		return null;

	}

	public static function get($key, $user_id = null, $default = null, $desc = null, $format = null)
	{
		if (empty(self::$_global))
		{
			self::fetchGlobal();
		}
		if ($user_id)
		{
			return self::getUser($key, $user_id);
		}
		$ret = self::getGlobal($key);
		if ($ret === null && $default) 
		{
			return self::createDefault($key,$default,$desc,$format);
		}
		return $ret;
	}

	public static function createDefault($key,$default,$desc,$format) 
	{
		$option = self::create([
			'key' => $key,
			'type' => 'global',
			'value' => $default,
		]);
		//self::description($key,$desc,$format);
		return $default;
	}

	public static function description($key,$desc,$format) 
	{
		/*$options = self::get('options');
        $options = json_decode($options, true);
        $options[$key] = [
            'title' => 'Alertes Employeurs sans juriste', 
            'desc' => 'Liste d\'e-mails des administrateurs à notifier, séparés par des virgules', 
            'type' => 'global', 
            'input' => 'text'
        ];
        DB::table('options')->where('key', 'options')->update([
                'value' => json_encode($options),
            ]);*/
	}

}