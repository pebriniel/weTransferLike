<?php

if(isset($index)){
	
	require_once "inc/model/files.php";
	require_once "inc/mail.php"; 
	
	function CTRLPageShare($keyFolder){
		$duree[0] = (3600 * 15);
		$duree[1] = (3600 * 24) * 7;
		$duree[2] = (3600 * 24) * 15;
		$duree[3] = (3600 * 24) * 30;
		
		
		$sql = new files();
		
		if($fold = $sql->getFold($keyFolder)){
			$file = $sql->findListFileByFold($fold['ID']);
			$date = date('d-m-Y à H\hi\m', ($fold['timestamp'] + $duree[$fold['Time']]));
			
			if(sizeof($file) == 0){
				return array('ERREUR' => true, 'CONTENT' => "une erreur s'est produite, aucune fichier n'est disponible");
			}
			else{
				$upl = false;
				$url_download_zip = URL_."public/upload/".$fold['Name']."/".$fold['Name'].".zip";
				$url_download = URL_."share/".$fold['Name']."/";
				if($fold['statut'] == 0){
					CTRL_CreateArchive($fold['Name']);
					$sql->updateStatutFoldByID($fold['ID']);
					
					//function_mail($mail, $sujet, $fichier, $var)

					$rec = $sql->findReceverSelectByIDfolder($fold['ID']);
					for($i = 0; $i < sizeof($rec); $i ++){	
						//expediteur
						function_mail($fold['EmailExp'], $rec[$i]['EmailReceiver']." a reçu une invitation", "exp", array("[[URL]]" => URL_, "DWN" => $url_download, 'MAIL' => $rec[$i]['EmailReceiver'] ));
						
						//destinataire
						function_mail($rec[$i]['EmailReceiver'], $fold['EmailExp']." vous a envoyé des fichiers", "recv", array("[[URL]]" => URL_, "DWN" => $url_download.$rec[$i]['UserKey']."/", "MAIL" => $fold['EmailExp'], "SUJET" => $fold['Object'], "MESSAGE" => $fold['Message'], "DUREE" => $date));
					}
					
					$upl = true;
				}
				
				return array('ERREUR' => false, 'URL_ARCHIVE' => $url_download, 'UPL' => $upl, 'DATE' => $date);
			}
		}
		else{
			return array('ERREUR' => true, 'CONTENT' => "une erreur s'est produite, aucune fichier n'est disponible");
		}
	}
	
	
	function CTRL_CreateArchive($key = null){
		// $key = "586b7588c414f";
		$dir = "public/upload/".$key."/";
		
		$sql = new files();
		
		$fold = $sql->getFold($key);
		$file = $sql->findListFileByFold($fold['ID']);
		
		$zip = new ZipArchive();
		$filename = "public/upload/".$fold['Name']."/".$fold['Name'].".zip";
				
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