<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('loader');
});

Route::get('/getStream/{page}', function ($page) {

	$videos = DB::select("SELECT url FROM videos LIMIT " . $page . ", 10");

	$data = array();

	foreach ($videos as $video) {
	
		//$data []= 'https://s3.amazonaws.com/recli/timelapse/1-1379636513.webm';
		$data []= $video->url;
	}

	return Response::json($data);
});



Route::get('/getRemotes', function () {

	$videos = DB::select("SELECT number FROM videos ORDER BY number DESC LIMIT 1");
	
	$videos = !empty($videos) ? $videos[0]->number + 1: 1;
	$qtde = $videos + 10;
	
	for ($n = $videos; $n < $qtde; $n++) {

		$video = file_get_contents("http://rec.li/" . $n);
		
		if (strpos($video, "The page you were looking for doesn't exist (404)")) {
			break;
		}
		
		$video = explode("<video src=\"", $video);
		$video = explode("\" width", $video[1]);
		$video = $video[0];
		
		DB::insert("INSERT INTO videos (number, url) VALUES (?, ?)", array($n, $video));
	}

	return Response::json(true);
});
