<?php

if(isset($index)){

	function CTRL_deleteFile(){
		$key = isset($_POST['fold']) ? $_POST['fold'] : null;
		$file = isset($_POST['file']) ? $_POST['file'] : null;
		
		if($key && $file){
			$pdo = new SQLpdo();
			if($f = $pdo->fetch("SELECT file.ID AS iFile, OriginName FROM ".PREFIX_DB."File file LEFT JOIN ".PREFIX_DB."Fold fold ON file.NameFold = fold.ID WHERE file.Name = :IDFile AND fold.Name = :IDFold ", array(':IDFile' => $file, ':IDFold' => $key))){			
				$pdo->del("DELETE FROM ".PREFIX_DB."File WHERE ID = :id", array(":id" => $f['iFile']));
				
				if(file_exists(FOLDER_UPL.$key."/".$f['OriginName'])){
					unlink(FOLDER_UPL.$key."/".$f['OriginName']);
					echo json_encode(array("STATUT" => 1, "FILE" => $key));
				}
				else{ 
					echo json_encode(array("STATUT" => 1, "FILE" => $key));
				}
			}
		}
	}
}