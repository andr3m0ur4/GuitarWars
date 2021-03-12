<?php
	// Define as constantes da conexão com o banco de dados
	define ( 'DB_HOST', 'localhost' );
	//define ( 'DB_USER', 'admin' );
	define ( 'DB_USER', 'root' );
	//define ( 'DB_PASSWORD', 'rockit' );
	define ( 'DB_PASSWORD', '' );
	define ( 'DB_NAME', 'gwdb' );

	// Define as constantes da aplicação
	define ( 'GW_UPLOADPATH', 'images/' );
	define ( 'GW_MAXFILESIZE', 32768 );      // 32 KB

	session_start ( );
