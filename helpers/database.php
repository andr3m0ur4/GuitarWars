<?php 

// Conecta-se ao banco de dados
$con = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
mysqli_set_charset ( $con, 'utf8');

if ( mysqli_connect_errno ( $con ) ) {
	echo "Problemas para conectar no banco. Erro: ";
	echo mysqli_connect_error ( );
	die ( );
}
