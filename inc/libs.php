<?php

	session_start();

	require_once("Mustache/Autoloader.php");
	require_once("AltoRouter.php");
	
	require_once(".init.php");
	require_once("pdo.class.php");
	
	Mustache_Autoloader::register();

	$router = new AltoRouter();
	
	if($_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
		$router->setBasePath('/share'); 
	}
	else{
		$router->setBasePath('/share');
	}
	
	$mustache_options =  array('extension' => EXT_MU_TPL);
    $m = new Mustache_Engine(array(
        'loader' => new Mustache_Loader_FilesystemLoader(TPL_EMP, $mustache_options),
    ));
	
	function mustacheLoad($html, $array = null){
		$mustache_options =  array('extension' => EXT_MU_TPL);
		$m = new Mustache_Engine(array(
			'loader' => new Mustache_Loader_FilesystemLoader(TPL_EMP, $mustache_options),
		));
		
		$_array = array('URL_' => URL_);
		if(is_array($array)){
			$_array = array_merge($_array, $array);
		}
		
		echo $m->render($html, $_array);	
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function rmdir_recursive($dir) {
		foreach(scandir($dir) as $file) {
			if ('.' === $file || '..' === $file) continue;
			if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
			else unlink("$dir/$file");
		}
		rmdir($dir);
	}