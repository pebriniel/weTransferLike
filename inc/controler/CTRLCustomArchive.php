<?php

if(isset($index)){
	require_once "inc/model/customArchive.php";
		
	function customCreateArchive(){
		$fileCheckBox = isset($_POST['fileCheckBox']) ? $_POST['fileCheckBox'] : null;
		$key = isset($_POST['fold']) ? test_input($_POST['fold']) : null;
		$keyUser = isset($_POST['keyUser']) ? test_input($_POST['keyUser']) : null;
	
		$dir = "public/upload/".$key."/";
		
		$fold = SQL_Fold($key, $keyUser);
		
		if($file = SQl_ListFile($fileCheckBox, $fold['fID'])){
		
			$zip = new ZipArchive();
			$filename = "public/tmp/".uniqid().".zip";

			if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
				exit("Impossible d'ouvrir le fichier <$filename>\n");
			}
			
			foreach($file AS $key => $val){
				$zip->addFile($dir.$val['OriginName'], $val['OriginName']);
			}

			$zip->close();
			
			
			return URL_.$filename;
		}
		else{
			return false;
		}
	}
}