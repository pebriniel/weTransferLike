<?php

/*
	@TODO : /createArchive/ à revoir
*/

	require_once("inc/libs.php");

	$router->map('GET', '/', function(){
		$load = true;
		mustacheLoad('body');
	}, 'home');
	
	$router->map('GET', '/404/', function(){
		echo "la page n'existe pas";
	}, '404');
	
	//ajax création d'archive custom
	$router->map('POST', '/downloadCustomArchive/', function(){
		$index = true;
		require_once "inc/controler/CTRLCustomArchive.php";
		echo customCreateArchive();
		
	}, 'downloadCustomArchive');
	
	//ajax création d'archive custom
	$router->map('GET', '/cron/', function(){
		$index = true;
		require_once "inc/controler/CTRLCron.php";
		cronDeleteFile();
		 
	}, 'cron');
	
	
	
	//@TODO
	//on crée l'archive après avoir appuyer sur le boutton terminé
	$router->map('POST', '/createArchive/', function(){
		$index = true;
		require_once "inc/controler/CTRLArchive.php";
		CTRL_CreateArchive("586b7588c414f");
		
	}, 'uploadAjax');
	
	//on affiche la liste des dossiers
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