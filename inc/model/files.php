<?php

class files extends SQLpdo{

  public function __construct(){
    $this->connexion();

  }

    function saveFiles($nameFile=null, $nameOrigin=null, $date=null, $nameFolder=null){
		$sql = "INSERT INTO `".PREFIX_DB."File` (Name, OriginName, Date, NameFold) VALUES (:nameFile, :OriginName, :date, :nameFolder)";
		$execute =  array(
			":nameFile" => $nameFile,
			":OriginName" => $nameOrigin,
			":date" => $date,
			":nameFolder" => $nameFolder
		  );


		return $file = $this->insert($sql, $execute);
    }
	
	function updateStatutFoldByID($id, $val = 1){
		$sql = "UPDATE ".PREFIX_DB."Fold SET statut = :val WHERE ID = :id";
		$execute =  array(
			":id" => $id,
			":val" => $val,
		  );
		  return $file = $this->update($sql, $execute);
	}
	

    function getFold($key){
      $sql = "SELECT *, UNIX_TIMESTAMP(Date) AS timestamp FROM ".PREFIX_DB."Fold WHERE Name = :name";
      $execute =  array(
          ":name" => $key,
        );


      return $file = $this->fetch($sql, $execute);
    }
	
	function findReceverSelectByIDfolder($key){
      $sql = "SELECT * FROM ".PREFIX_DB."Receiver WHERE NameFold = :name";
      $execute =  array(
          ":name" => $key,
        );


      return $file = $this->fetchAll($sql, $execute);
    }	
	
	
	function findListFileByFold($fold){
		return $this->fetchAll("SELECT * FROM ".PREFIX_DB."File WHERE NameFold = :IDfold", array(':IDfold' => $fold));
	}




}
