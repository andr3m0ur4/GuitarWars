<?php

    $error = false;
    $error_approve = false;
    $form_approve = false;
    $success = false;

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
                    
            // Aprova a pontuação configurando a coluna approved no banco de dados
            $success = $dal -> update ( $guitar );
                    
        } else {
            $error_approve = true;
        }
    } else if ( isset ( $id ) AND isset ( $name ) AND isset ( $date ) AND isset ( $score ) ) {

        $form_approve = true;
                
    }

    require __DIR__ . '/../views/template-approvescore.php';
