<?php

if(isset($index)){
	require_once "inc/model/share.php";
	
	function CTRL_LoadShare($keyUser = null, $keyFold = null, $dir = __dir__){
		$model = new sharePDO();
		 
		$show = false;
		if(!is_null($keyUser) && $user = $model->SQL_Receiver($keyUser, $keyFold))
		{
			$model->SQL_ReceiverUpdate($user['NbrVisit'], $keyUser);													
			$show = true;
		}
		else if($user = $model->getFold($keyFold))
		{
			$show = true;
		}
		
		if($show){
			$list = $model->SQL_ListFile($user['iFold']);

			$arrayTpl = array('SHOW' => true, 'fold' => $user['Name'], 'LIST' => $list);
		}
		else{
			$arrayTpl = array('SHOW' => false);
		}
		
		return $arrayTpl;
	}
	
}