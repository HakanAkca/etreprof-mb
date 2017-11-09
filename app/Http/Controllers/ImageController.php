<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller {

	function get($folder, $w, $h, $filename)
	{
		//return $filename;
	    $fullsize_path = 'storage/' . $folder . '/0x0-' . $filename;
	    $resized_path = 'storage/' . $folder . '/' . $w . 'x' . $h . '-' . $filename;

	    $cache_path = str_finish(public_path(), '/');
	    $fullsize_local_path = $cache_path . $fullsize_path;
	    $resized_local_path = $cache_path . $resized_path;

	    /*if (!file_exists($fullsize_local_path) OR filesize($fullsize_local_path) < 100)
	    {
	        $this->createDir($fullsize_local_path);
	        $content = file_get_contents('http://srv1.commentreparer.com/' . $fullsize_path);
	        if (strlen($content) < 100) die ($content);
	        file_put_contents($fullsize_local_path, $content);
	        header('X-Fullsize-File-Downloaded: ' . $fullsize_local_path);
	    }*/
	    if (!file_exists($fullsize_local_path))
	    {
	        die ('Impossible de télécharger la ressource distante : ' . '' . $fullsize_local_path);
	    }



	    //readfile($original_img);
	    // import the Intervention Image Manager Class
	    //use Intervention\Image\ImageManagerStatic as Image;

	    // configure with favored image driver (gd by default)
	    //phpinfo();
	    \Intervention\Image\ImageManagerStatic::configure(array('driver' => 'gd'));
	    //Image::configure(array('driver' => 'imagick'));

	    // and you are ready to go ...
	    //$image = Image::make($original_img)->resize(300, 200);
	    $image = \Intervention\Image\ImageManagerStatic::make($fullsize_local_path)->resize($w, $h, function ($constraint) {
	        $constraint->aspectRatio();
	    });

	    $this->createDir($resized_local_path);

	    $image->save($resized_local_path, 95);

	    //print_r($image->getCore());
	    //die();
	    //return;
	    header('X-PHP-Generated: ' . date('Y-m-d H:i:s'));
	    return $image->response('jpg');

	    print $original_img;

	    return;

	    //readfile($img);

	}


	function save(Request $request)
	{
		$url = $request->input('url');
		$folder = $request->input('folder');

		$res = $this->saveImage($url, $folder);
		return response()->json($res);
	}

	function saveImage($url, $folder)
	{
		$url_no_query = parse_url($url,PHP_URL_PATH);
		$info = new \SplFileInfo($url_no_query);
		$filename = $info->getFilename();
		$fullsize_path = 'storage/' . $folder . '/0x0-' . $filename;

	    $cache_path = str_finish(public_path(), '/');
	    $fullsize_local_path = $cache_path . $fullsize_path;

		if (!file_exists($fullsize_local_path) OR filesize($fullsize_local_path) < 100)
	    {
	        $this->createDir($fullsize_local_path);
	        try {
		        $content = file_get_contents($url);
		        if (strlen($content) < 50) die ($content);
		        file_put_contents($fullsize_local_path, $content);
			}
			catch (\Exception $e)
			{
				return [
				'error' => $e->getMessage(),
				'url' => $url,
	        ];
			}
	        //header('X-Fullsize-File-Downloaded: ' . $fullsize_local_path);
	    }
	    return [
				'local' => $fullsize_local_path,
				'url' => str_finish(env('APP_URL'),'/') . $fullsize_path,
	        ];
	}


	function createDir($path)
	{
	    if (!file_exists(dirname($path)))
	    {
	        mkdir(dirname($path),0755, true);
	    }

	    if (!file_exists(dirname($path)))
	    {
	        die('ERREUR : impossible de créer le chemin ' . $path);
	    }
	}
}