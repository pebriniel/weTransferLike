<?php

class SQLpdo {
	function __construct($db=false, $login=false, $pass = false, $adress=false){
		$this->connexion();
	}
	
	function connexion($db=false, $login=false, $pass = false, $adress=false){
		$config['login']=($login) ? $login :DB_USER;
		$config['mdp']= ($pass) ? $pass : DB_PASS;
		$config['adress']=($adress) ? $adress :DB_HOST;
		$config['db']=($db) ? $db :DB_DATA;
		

		try {
		    $this->db = new PDO('mysql:dbname='.$config['db'].';host='.$config['adress'].'', $config['login'], $config['mdp']);
		} catch (PDOException $e) {
		    echo 'Connexion échouée : ' . $e->getMessage();
		}
	}
	
	

	function fetchAll($sql,$execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requette sql
	    return $sth->fetchAll(PDO::FETCH_ASSOC);// recupère toutes les données
	}

	function insert($sql, $execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requette sql
	    return  $this->db->lastInsertId();// recupère toutes les données
	}
	
	function update($sql, $execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    return $sth->execute($execute);//execute la requette sql
	}
	
	function del($sql, $execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    return $sth->execute($execute);//execute la requette sql
	}
	
	

	function fetch($sql,$execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requette sql
	    return $sth->fetch(PDO::FETCH_ASSOC);// recupère toutes les données
	}
	
	
}