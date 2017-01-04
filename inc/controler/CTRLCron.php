<?php

if(isset($index)){
	require_once "inc/model/customArchive.php";
	 
	function cronDeleteFile(){
			//durée durant laquelles les fichiers sont stockés
			$duree[0] = (3600 * 24);
			$duree[1] = (3600 * 24) * 7;
			$duree[2] = (3600 * 24) * 15;
			$duree[3] = (3600 * 24) * 30;
		
		$pdo = new SQLpdo();
		
		$list = $pdo->fetchAll("SELECT *, UNIX_TIMESTAMP(Date) AS timestamp FROM ".PREFIX_DB."Fold");
		for($i = 0; $i < sizeof($list); $i ++){
			if(($list[$i]['timestamp'] + $duree[$list[$i]['Time']]) < time()){
				
				
				//ajouter la supprimer des fichiers et des BDD
				
				
			}
		}
	}
}