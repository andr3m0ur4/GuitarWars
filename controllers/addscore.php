<?php

    $guitar = new GuitarWar;

    $error_upload = false;
    $error_type = false;
    $error = false;
    $error_phrase = false;
    $success = false;

    if ( isset ( $_POST['submit'] ) ) {
                
        // Obtém os dados de pontuação do POST
        $guitar -> name = $con -> escape_string ( trim ( $_POST['name'] ) );
        $guitar -> score = ( int ) $con -> escape_string ( trim ( $_POST['score'] ) );
        $guitar -> screenshot = $con -> escape_string ( trim ( $_FILES['screenshot']['name'] ) );
        $screenshot_type = $_FILES['screenshot']['type'];
        $screenshot_size = $_FILES['screenshot']['size']; 

        // Verifica a frase-secreta do CAPTCHA para verificação
        $user_pass_phrase = SHA1 ( $_POST['verify'] );
        if ( $_SESSION['pass_phrase'] == $user_pass_phrase ) {
            if ( !empty ( $_POST['name'] ) AND is_numeric ( $_POST['score'] )
                AND !empty ( $_FILES['screenshot']['name'] ) ) {
                        
                if ( ( ( $screenshot_type == 'image/gif' ) || ( $screenshot_type == 'image/jpeg' ) 
                    || ( $screenshot_type == 'image/pjpeg' ) || ( $screenshot_type == 'image/png' ) ) 
                    && ( $screenshot_size > 0 ) && ( $screenshot_size <= GW_MAXFILESIZE ) ) {
                            
                    if ( $_FILES['screenshot']['error'] == 0 ) {
                        // Move o arquivo para a pasta de destino de upload
                        $target = GW_UPLOADPATH . $guitar -> screenshot;
                        if ( move_uploaded_file ( $_FILES['screenshot']['tmp_name'], $target ) ) {
                            // Escreve os dados no banco de dados
                            $success = $dal -> save ( $guitar );
                            
                        } else {
                            $error_upload = true;
                        }
                    }
                } else {
                    $error_type = true;
                }

                // Tentar excluir os arquivos de imagem de captura de tela temporários
                @unlink ( $_FILES['screenshot']['tmp_name'] );
            } else {
                $error = true;
            }
        } else {
            $error_phrase = true;
        }
    }

    require __DIR__ . '/../views/template-addscore.php';
