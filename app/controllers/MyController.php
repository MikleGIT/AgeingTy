<?php



class MyController extends \BaseController {

public function index()
    {
		$url = Request::url();
        echo 'hel';
		echo $url;
        //
		
    }
}