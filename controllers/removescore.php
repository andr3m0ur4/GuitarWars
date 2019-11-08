<?php

    $error = false;
    $error_remove = false;
    $success = false;
    $form_remove = false;

    if ( isset ( $_GET['id'] ) ) {
            
        // Obtém o ID de pontuação do GET
        $guitar = $dal -> select ( ( int ) $_GET['id'] );
        
    } else if ( isset ( $_POST['id'] ) ) {
        
        // Obtém o ID de pontuação do POST
        $guitar = $dal -> select ( ( int ) $_POST['id'] );
        
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
