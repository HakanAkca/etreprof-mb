<?php
namespace App\RemoteUrl;
use Cache;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Fetcher {

	public static function parseUrl($url)
	{
		//$url = 'http://www.commentreparer.com';
		//$url = 'http://test.etreprof.fr/test/youtube.html';
		$command = "node " . base_path('node/Parser.js' . ' ' . $url);
		$return = ['command' => $command];
		exec($command, $output);
  		//echo implode('//////////////////', $output);
  		$json = implode('', $output);
		//print $json;

		if (empty($json))
		{
			//print 'Error:' . $command;
		}

		try {
			$decoded = json_decode($json, true);
			if (!is_array($decoded))
			{
				$decoded = ['error' => 'unable to decode', 'return' => $json, 'url' => $url];
			}
			$return = $return + $decoded;
  			return $return;
		}
		catch (\Exception $exception)
		{
			print $json;
			print $exception->getMessage();
			return $return;
		}
  		/*return;
		$body = Cache::get($url);

		if (!$body)
		{
			$body = 'BLABLABLA' . $url;
		}
		$client = new Client();
		$res = $client->get('http://www.github.com');

		//if ($body = $res->getBody()) {
		return $res;*/

	}

	/*public static function getHtml($response)
	{
		if ($body = $response->getBody()) {
			return $body;
		}
	}*/

}

