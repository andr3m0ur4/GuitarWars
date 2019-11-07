<?php
    // Nome de usuário e senha para autenticação
    $username = 'rock';
    $password = 'roll';

    if ( !isset ( $_SERVER['PHP_AUTH_USER']) || !isset ( $_SERVER['PHP_AUTH_PW'] ) ||
        ( $_SERVER['PHP_AUTH_USER'] != $username ) || ( $_SERVER['PHP_AUTH_PW'] != $password ) ) {
    
        // O nome/senha do usuário estão incorretos, portanto, enviar os cabeçalhos de autenticação
        header ( 'HTTP/1.1 401 Unauthorized' );
        header ( 'WWW-Authenticate: Basic realm="Guitar Wars"' );
        exit ( '<h2>Guitar Wars</h2>Desculpa, você deve digitar um nome de usuário e senha válidos para acessar
            esta página.' );
    }
