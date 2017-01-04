<?php

if (isset($index)){
  require_once "inc/model/infosaved.php";


	function CTRL_InfoSaved(){

		$model = new infosaved();

		$nameFolder = uniqid();
		$date = date("Y-m-d H:i:s");
		$emailExp = test_input($_REQUEST['emailExp']);
		$valEmailExp = filter_var($emailExp, FILTER_VALIDATE_EMAIL);
		$object = test_input($_REQUEST['object']);
		$message = test_input($_REQUEST['message']);
		$time = 0;

		$emailReceiver = test_input($_REQUEST['emailRec']);
		$valEmailRec =  filter_var($emailReceiver, FILTER_VALIDATE_EMAIL);
		$userkey = md5(uniqid());
		$nbrVisit = 0;

	if($valEmailExp){
		$id = $model->saveFolder($nameFolder, $date, $valEmailExp, $time, $object, $message);
		
		if($id){
			if($valEmailRec){

				$receiver = $model->saveReceiver($valEmailRec, $date, $id, $userkey, $nbrVisit);
			}

		}
		else{
			echo "erreur";
		}

	}
	}

}
