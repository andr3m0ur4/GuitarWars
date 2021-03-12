<?php

    require_once __DIR__ . './../config/authorize.php';
    
    $guitar = new GuitarWar;

    $error = false;
    $error_remove = false;
    $success = false;
    $form_remove = false;

    if ( isset ( $_GET['id'] ) AND isset ( $_GET['date'] ) AND isset ( $_GET['name'] ) 
        AND isset ( $_GET['score'] ) AND isset ( $_GET['screenshot'] ) ) {
            
        // Obtém os dados de pontuação do GET
        $guitar -> id = ( int ) $_GET['id'];
        $guitar -> date = $_GET['date'];
        $guitar -> name = $_GET['name'];
        $guitar -> score = $_GET['score'];
        $guitar -> screenshot = $_GET['screenshot'];

    } else if ( isset ( $_POST['id'] ) AND isset ( $_POST['name'] ) AND isset ( $_POST['score'] ) ) {
        // Obtém os dados de pontuação do POST
        $guitar -> id = ( int ) $_POST['id'];
        $guitar -> name = $_POST['name'];
        $guitar -> score = $_POST['score'];
        $guitar -> date = $_POST['date'];
    } else {
        $error = true;
    }

    $id = $guitar -> id;
    $name = $guitar -> name;
    $date = $guitar -> date;
    $score = $guitar -> score;

    if ( isset ( $_POST['submit'] ) ) {
        if ( $_POST['confirm'] == 'Yes' ) {
            // Excluir o arquivo de imagem de captura de tela do servidor
            @unlink ( GW_UPLOADPATH . $guitar -> screenshot );
                    
            // Excluir os dados de pontuação do banco de dados
            $success = $dal -> delete ( $guitar -> id );
                    
        } else {
            $error_remove = true;
        }
    } else if ( isset ( $id ) AND isset ( $name ) AND isset ( $date ) AND isset ( $score ) ) {
        $form_remove = true;
    }

    require __DIR__ . '/../views/template-removescore.php';
