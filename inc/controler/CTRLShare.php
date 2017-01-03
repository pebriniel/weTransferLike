<?php

if(isset($index)){
	require_once "inc/model/share.php";
	
	function CTRL_LoadShare($keyUser, $keyFold, $dir = __dir__){
		$model = new sharePDO();
		
		if($user = $model->SQL_Receiver($keyUser, $keyFold)){
			
			$model->SQL_ReceiverUpdate($user['NbrVisit'], $keyUser);													
			
			$list = array_diff(scandir($dir."/public/upload/".$user['Name']."/"), [".", ".."]);
		
			foreach($list AS $key => $val){
				$empty[]['name'] $val;
			}
			
			print_r($empty);
			
			$arrayTpl = array('SHOW' => true, 'LIST' => $empty);
		}
		else{
			$arrayTpl = array('SHOW' => false);
		}
		
		return $arrayTpl;
	}
	
}