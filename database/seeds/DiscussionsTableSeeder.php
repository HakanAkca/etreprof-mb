<?php

use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('discussions')->truncate();
    	DB::table('discussion_messages')->truncate();
    	
    	$users = 10;
    	$discussions_par_user = 2;
    	$messages_par_discussion = 4;
		$chunk = 10;

    	for ($i = 1; $i <= $users; $i++)
    	{
    		$discussions = [];
    		$messages = [];
    		for ($j = 1; $j <= $discussions_par_user; $j++)
    		{
    			$int= mt_rand(strtotime('-1 year'),time());
    			$int2= mt_rand(strtotime('-1 year'),time());
    			$dest = [$i, rand(1,100)]; 
    			$discussions[] = [
    				'id' => $i*10000 + $j * 100,
    				'from_user_id' => $i,
    				'to_user_id' => $dest[array_rand($dest)],
    				'last_message_id' => $i*10000 + $j * 100 + $messages_par_discussion,
    				'created_at' => date("Y-m-d H:i:s",$int),
    				'updated_at' => date("Y-m-d H:i:s",$int2)
    			];
    			for ($k = 1; $k <= $messages_par_discussion; $k++)
    			{
    				$int3= mt_rand(strtotime('-1 year'),time());
    				$int4= mt_rand(strtotime('-1 year'),time());
    			
					$messages[] = [
						'id' =>  $i*10000 + $j * 100 + $k,
						'discussion_id' => $i*10000 + $j * 100,
						'message' => str_shuffle('                    ' . str_random(rand(4,400))),
						'from_user_id' => $dest[array_rand($dest)],
						'to_user_id' => $dest[array_rand($dest)],
    				'created_at' => date("Y-m-d H:i:s",$int3),
    				'updated_at' => date("Y-m-d H:i:s",$int4)

					];
    			}
    		}

    		DB::table('discussions')->insert($discussions);
    		DB::table('discussion_messages')->insert($messages);

    	}


    }
}
