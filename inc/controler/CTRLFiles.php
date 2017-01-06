  <?php

if (isset($index)){
  require_once "inc/model/files.php";

	function CTRL_FilesSaved(){

		$model = new files();

		$nameOrigin = $_FILES["files"]["name"];
		$date = date("Y-m-d H:i:s");

		$nameFolder = isset($_POST['folder']) ? $_POST['folder'] : null;

		if($fold = $model->getFold($nameFolder)){
			if($fold['statut'] == 0){				
				$path = $_FILES["files"]["tmp_name"];
				$type = $_FILES["files"]["type"];
				
				if(is_array($nameOrigin)){
					$array_random = array();
					$array_name = array();
					$array_error = array();
					$array_error_mess = array();

					for($i=0; $i < sizeof($nameOrigin); $i++){
						
						$extension = strrchr($nameOrigin[$i], ".");
						if(!in_array($extension, array(".php", ".htaccess"))){	
							$array_error = array_merge($array_error, array(1));						
							$array_error_mess = array_merge($array_error_mess, array("ok"));						
							$nameFile = md5(uniqid());

							$result = move_uploaded_file($_FILES['files']['tmp_name'][$i], FOLDER_UPL.$nameFolder."/".$nameOrigin[$i]);

							if ($result){
								$res = $model->saveFiles($nameFile, $nameOrigin[$i], $date, $fold['ID']);
								$array_random = array_merge($array_random, array($nameFile));
							}
						}
						else{
							$array_error = array_merge($array_error, array(0));						
							$array_error_mess = array_merge($array_error_mess, array("l'extension $extension n'est pas pris en charge".disk_total_space(FOLDER_UPL."586e2606ce6fd/")));	
						}
							
						
					}
					
					
					echo json_encode(array("STATUT" => 1, "CONTENT" => "Upload Ok", "ERRORFILE" => $array_error, "ERRORMESS" => $array_error_mess, "NAMEFILERDG" => $array_random, "NAMEORIGIN" => $nameOrigin));
				}
			}
			else{
				echo json_encode(array("STATUT" => 0, "CONTENT" => "Il n'est plus possible d'envoyer des fichiers, le dossier est fermé"));
			}
		}
		else{
			echo json_encode(array("STATUT" => 0, "CONTENT" => "Le dossier n'existe pas"));
		}
	}

}
