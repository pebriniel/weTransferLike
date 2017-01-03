<?php

if($_SERVER['REMOTE_ADDR'] == "127.0.0.1"){
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_DATA', 'accueil');
	
	define('URL_', 'http://127.0.0.1:8080/share/');
	define('FOLD_EMAIL', 'template/email/');
	define('PREFIX_DB', 'POP_');
	define('TPL_EMP', 'template/themeA');
}
else{
    define('DB_HOST', 'localhost');
    define('DB_USER', 'boussads');
    define('DB_PASS', 'JqsWM87PwX');
    define('DB_DATA', 'boussads');
	
	define('URL_', 'http://boussads.student.codeur.online/share/');
	define('FOLD_EMAIL', 'template/email/');
	define('PREFIX_DB', 'POP_');
	define('TPL_EMP', 'template/themeA');
}

	define('EXT_MU_TPL', '.html');
