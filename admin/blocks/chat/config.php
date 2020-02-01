<?php 
	session_start();
	
	define('URL_BASE', 'http://localhost/canil/admin');
	define('SOCKET_FRONTEND', 'localhost:12345');
	define('SOCKET_BACKEND_IP', 'localhost');
	define('SOCKET_BACKEND_PORT', '12345');

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'canilrec');
	define('DB_CHARSET', 'utf8');
?>