<?php

class sharePDO extends SQLpdo{
		
	public function __construct(){
		$this->connexion();
	}
	
	function SQL_Receiver($keyUser, $keyFold){
		return $user = $this->fetch("SELECT NbrVisit, Name FROM ".PREFIX_DB."Receiver r LEFT JOIN ".PREFIX_DB."Fold f ON r.NameFold = f.ID WHERE UserKey = :userKey AND f.Name = :NameFold", array(':userKey' => $keyUser, ':NameFold' => $keyFold));
	}
	
	function SQL_ReceiverUpdate($visit, $key){
		$this->update("UPDATE ".PREFIX_DB."Receiver SET NbrVisit = :nbvisit WHERE UserKey = :userKey", 
								array(
									':nbvisit' => ($visit + 1),
									':userKey' => $key));
	}
	
	function SQL_ListFile($fold){
		return $this->fetchAll("SELECT * FROM ".PREFIX_DB."File file LEFT JOIN ".PREFIX_DB."Folder folder ON file.NameFold = folder.ID WHERE folder.ID = :IDfold AND ", array(':IDfold' => $fold));;
	}
	
}