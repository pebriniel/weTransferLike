<?php

if(isset($index)){
	require_once "inc/model/share.php";
	
	function CTRL_LoadShare($keyUser, $keyFold, $dir = __dir__){
		$model = new sharePDO();
		 
		if($user = $model->SQL_Receiver($keyUser, $keyFold)){
			
			$model->SQL_ReceiverUpdate($user['NbrVisit'], $keyUser);													
			
			$list = $model->SQL_ListFile($user['NameFold']);
			
			$arrayTpl = array('SHOW' => true, 'fold' => $user['Name'], 'keyUser' => $keyUser, 'LIST' => $list);
		}
		else{
			$arrayTpl = array('SHOW' => false);
		}
		
		return $arrayTpl;
	}
	
}