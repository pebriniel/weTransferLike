<?php

	require_once("inc/libs.php");

	$router->map('GET', '/', function(){
		$load = true;
		mustacheLoad('body');
	}, 'home');
	
	$router->map('GET', '/404/', function(){
		echo "la page n'existe pas";
	}, '404');
	
	$router->map('POST', '/uploadAjax/', function(){
		
		
		
	}, 'uploadAjax');
	
	$router->map('GET', '/share/[h:keyFold]/[h:keyUser]/', function($keyFold, $keyUser){
		$index = true;
		
		require_once "inc/controler/CTRLShare.php";
		$arrayTpl = CTRL_LoadShare($keyUser, $keyFold, __dir__);
		
		mustacheLoad('share', $arrayTpl);
	}, 'share');
	
	
	$match = $router->match();

	// call closure or throw 404 status
	if( $match && is_callable( $match['target'] ) ) {			
		call_user_func_array( $match['target'], $match['params'] );
	} else {
		// no route was matched
		// header("Location: ".URL_."404/");
		header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
	}