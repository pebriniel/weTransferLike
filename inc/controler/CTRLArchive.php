<?php

if(isset($index)){
	require_once "inc/model/archive.php";
		
	function CTRL_CreateArchive($key = null){
		// $key = "586b7588c414f";
		$dir = "public/upload/".$key."/";
		
		$fold = SQL_Fold($key);
		$file = SQL_ListFile($fold['ID']);
		
		$zip = new ZipArchive();
		$filename = "public/upload/".$fold['Name']."/".uniqid().".zip";
		
		if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
			exit("Impossible d'ouvrir le fichier <$filename>\n");
		}
		
		foreach($file AS $key => $val){
			$zip->addFile($dir.$val['OriginName'], $val['OriginName']);
		}
		
		//save ok
		
		$zip->close();
		
		//return $arrayTpl;
	}
	
}