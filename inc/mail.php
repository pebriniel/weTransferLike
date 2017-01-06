<?php

function function_mail($mail, $sujet, $fichier, $var){

	if(preg_match("#^[a-z0-9._-]+@(gmail).[a-z]{2,4}$#", $mail))  // On filtre les serveurs qui présentent des bogues.
	{
		$passage_ligne = "\r\n";
		$_gmail = false;
	}
	else if(preg_match("#^[a-z0-9._-]+@(outlook).[a-z]{2,4}$#", $mail)){
		$passage_ligne = PHP_EOL;
		$_gmail = false;
	}
	else
	{
		$passage_ligne = "\r\n";
		$_gmail = false;
	}

	//=====Déclaration des messages au format texte et au format HTML.
	//$message_html = "<html><head></head><body>Bienvenue <b>$pseudo</b> :) <br/> <br/>Lien d'activation : <br/><a href=$url_activation>Lien d'activation</a></body></html>";
	$message_html = file_get_contents(FOLD_EMAIL.$fichier.".html");
	foreach($var AS $key => $v){
		$message_html = preg_replace("#".$key."#", $v, $message_html);
	}

	//==========

	//=====Création de la boundary.
	$boundary = "-----=".md5(rand());
	$boundary_alt = "-----=".md5(rand());
	//==========

	//=====Création du header de l'e-mail.
	$header = "From: \"no reply\"<noreply@popuptatoes.fr>".$passage_ligne;
	$header.= "Reply-to: \"Utilisateur\" <".$mail.">".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	if(!$_gmail){ $header.= 'Content-type: text/html; charset=utf-8'."".$passage_ligne; }
	if($_gmail){ $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne; }
	//==========
	 $message = "";
	//=====Ajout du message au format HTML.
	if($_gmail){ 	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
					$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
				}
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========

	//=====On ferme la boundary alternative.
	$message.= $passage_ligne;
	//==========

	//=====Envoi de l'e-mail.
	mail($mail,$sujet,$message,$header);

	//==========
}

?>
