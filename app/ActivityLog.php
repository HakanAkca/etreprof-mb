<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Schema;
use DB;
use Auth;

class ActivityLog extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected static $_table_root = '_activity_log_';

    protected static $_partition_by_date_format = 'Ym';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    ///protected $fillable = ['name', 'email', 'password'];
    //protected $guarded = ['id'];

	public function __construct($params=array(),$date = null)
	{
		parent::__construct($params);
		$this->date = ($date) ? $date : null;
	    $this->table = self::tableName($date);
	}

    public function getTable()
    {
       	return self::tableName();
    }

    public static function tableName($date = null)
    {
    	$date = ($date) ? $date : date(self::$_partition_by_date_format);
        return self::$_table_root . $date;
	}

	public function __call($method, $args)
	{
		array_unshift($args, $method);

		return call_user_func_array(['self', 'add'], $args);
	}


	public static function add($category, $action, $data_in = null, $data_out = null)
	{
		//dd (Schema::hasTable(self::tableName()));
		//return;
		try {
			if (!Schema::hasTable(self::tableName()))
			{
				//dd('non');
				$ok = self::createDB();
				/*if ($ok)
				{
					return call_user_func_array(__METHOD__, func_get_args());
				}*/
			}
			self::db()->insert([
				'user_hash' => (!empty($_SERVER['REMOTE_ADDR']) AND !empty($_SERVER['HTTP_USER_AGENT'])) ? sha1($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']) : '',
				'user_id' => (Auth::user()) ? Auth::user()->id : null,
				'url' => substr(url()->full(),0,255),
				'category' => $category,
				'action' => substr($action,0,32),
				'data' => (!empty($data_in)) ? substr(json_encode($data_in),0,4096	) : '',
				//'data_out' => (!empty($data_out)) ? json_encode($data_out) : '',
			]);
		}
		catch (Exception $e)
		{

			return;
			return $e->getMessage();
		}
	}

    public static function createDB()
    {
		$table = Schema::create(self::tableName(), function (Blueprint $table) {
            //$table->engine = 'Archive';
            $table->increments('id');
            $table->timestamp('date')->index();
            $table->enum('category',['info', 'post', 'dossier', 'auth', 'api', 'event', 'email', 'error', 'warn'])->index();
            $table->string('action',32);

            $table->integer('user_id')->index()->nullable();
            $table->string('url',255);

            $table->text('data');
            //$table->text('data_out');

            $table->string('user_hash',40)->index();
		});
        return $table;
	}

	public static function db($date = null)
	{
		return DB::table(self::tableName($date));
	}



}