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

//l'utilisateur finalise l'envoie 
$router->map('GET', '/folder/[h:key]/', function($key){
	$index = true;
	require_once "inc/controler/CTRLPageShare.php";
	$arrayTpl = CTRLPageShare($key);
	mustacheLoad('folder', $arrayTpl);
}, 'folder');

//on affiche la liste des dossiers
$router->map('GET', '/share/[h:keyFold]/[h:keyUser]/', function($keyFold, $keyUser){
	$index = true;
	
	require_once "inc/controler/CTRLShare.php";
	$arrayTpl = CTRL_LoadShare($keyUser, $keyFold, __dir__);
	
	mustacheLoad('share', $arrayTpl);
}, 'share');

//on affiche la liste des dossiers
$router->map('GET', '/share/[h:keyFold]/', function($keyFold){
	$index = true;
	
	require_once "inc/controler/CTRLShare.php";
	$arrayTpl = CTRL_LoadShare(null, $keyFold, __dir__);
	
	mustacheLoad('share', $arrayTpl);
}, 'shareSolo');

$router->map('POST', '/uploadAjax/', function(){
	$index = true;
	require_once "inc/controler/CTRLInfosaved.php";

	CTRL_InfoSaved();
	
}, 'uploadAjax');

$router->map('POST', '/deleteFileAjax/', function(){
	$index = true;
	require_once "inc/controler/CTRLDeleteFile.php";

	CTRL_deleteFile();
}, 'deleteFileAjax');

$router->map('POST', '/UPLfiles/', function(){
	$index = true;
	require_once "inc/controler/CTRLFiles.php";

	CTRL_FilesSaved();

}, 'UPLfiles');


$match = $router->match();

// call closure or throw 404 status
if( $match && is_callable( $match['target'] ) ) {			
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	// header("Location: ".URL_."404/");
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}