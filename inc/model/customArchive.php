<?php

	function SQL_Fold($fold, $keyUser){
		$pdo = new SQLpdo();
		return $pdo->fetch("SELECT f.ID AS fID, Name AS fName FROM ".PREFIX_DB."Fold f LEFT JOIN ".PREFIX_DB."Receiver r ON r.NameFold = f.ID WHERE f.Name = :name AND r.UserKey = :key", array(':name' => $fold, ':key' => $keyUser));
	}
	
	function getFold($key){
		$pdo = new SQLpdo();
		
		$sql = "SELECT *, ID as iFold FROM ".PREFIX_DB."Fold WHERE Name = :name";
		$execute =  array(
		  ":name" => $key,
		);


      return $file = $pdo->fetch($sql, $execute);
    }
		
	function SQl_ListFile($fileCheckBox, $id){
		$pdo = new SQLpdo();
		
		$listfile = "('".implode("','",$fileCheckBox)."')";
		return $pdo->fetchAll("SELECT * FROM ".PREFIX_DB."File WHERE NameFold = :IDfold AND Name IN ".$listfile."", array(':IDfold' => $id));
	}
	