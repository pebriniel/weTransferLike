<?php

	
	function SQL_Fold($fold){
		$pdo = new SQLpdo();
		return $pdo->fetch("SELECT ID, Name FROM ".PREFIX_DB."Fold f WHERE Name = :name", array(':name' => $fold));
	}
	
	function SQL_ListFile($fold){
		$pdo = new SQLpdo();
		return $pdo->fetchAll("SELECT * FROM ".PREFIX_DB."File WHERE NameFold = :IDfold ", array(':IDfold' => $fold));;
	}