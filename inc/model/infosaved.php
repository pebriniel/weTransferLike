<?php

class infoSaved extends SQLpdo{

	public function __construct(){
		$this->connexion();

	}

    function saveFolder($nameFolder=null, $date, $valEmailExp=null, $time=null, $object=null, $message=null){

    $sql = "INSERT INTO `".PREFIX_DB."Fold` (Name, Date, emailExp, Time, Object, Message) VALUES (:nameFolder, :date, :emailExp, :time, :object, :message)";
    $execute =  array(
        ":nameFolder" => $nameFolder,
        ":date" => $date,
        ":emailExp" => $valEmailExp,
        ":time" => $time,
        ":object" => $object,
        ":message" => $message
      );


    return $folder = $this->insert($sql, $execute);

    }



    function saveReceiver($valEmailRec=null, $date, $nameFold=null, $userkey=null, $nbrVisit = 0) {

    $sql = "INSERT INTO `".PREFIX_DB."Receiver` (EmailReceiver, Date, UserKey, NbrVisit, NameFold) VALUES (:EmailReceiver, :date, :userKey, :nbrVisit, :nameFold)";
    $execute = array(
      ":EmailReceiver" => $valEmailRec,
      ":date" => $date,
      ":userKey" => $userkey,
      ":nbrVisit" => ($nbrVisit + 1),
      ":nameFold" => $nameFold
    );

    return $receiver = $this->insert($sql, $execute);

    }





}
