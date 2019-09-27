<?php
    require_once 'config/appvars.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Guitar Wars - Adicione Sua Maior Pontuação</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicação WEB para armazenar pontuações de jogadores" />
        <meta name="keywords" content="php mysql guitar warrior">
        <meta name="autor" content="André Moura">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Adicione Sua Maior Pontuação</h2>

        <?php
      
            require_once ( 'config/connectvars.php' );

            if ( isset ( $_POST['submit'] ) ) {
                // Conecta-se ao banco de dados
                $dbc = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

                // Obtém os dados de pontuação do POST
                $name = mysqli_real_escape_string ( $dbc, trim ( $_POST['name'] ) );
                $score = mysqli_real_escape_string ( $dbc, trim ( $_POST['score'] ) );
                $screenshot = mysqli_real_escape_string ( $dbc, trim ( $_FILES['screenshot']['name'] ) );
                $screenshot_type = $_FILES['screenshot']['type'];
                $screenshot_size = $_FILES['screenshot']['size']; 

                // Verifica a frase-secreta do CAPTCHA para verificação
                $user_pass_phrase = SHA1 ( $_POST['verify'] );
                if ( $_SESSION['pass_phrase'] == $user_pass_phrase ) {
                    if ( !empty ( $name ) && is_numeric ( $score ) && !empty ( $screenshot ) ) {
                        if ( ( ( $screenshot_type == 'image/gif' ) || ( $screenshot_type == 'image/jpeg' ) || 
                            ( $screenshot_type == 'image/pjpeg' ) || ( $screenshot_type == 'image/png' ) ) &&
                            ( $screenshot_size > 0 ) && ( $screenshot_size <= GW_MAXFILESIZE ) ) {
                            
                            if ( $_FILES['screenshot']['error'] == 0 ) {
                                // Move o arquivo para a pasta de destino de upload
                                $target = GW_UPLOADPATH . $screenshot;
                                if ( move_uploaded_file ( $_FILES['screenshot']['tmp_name'], $target ) ) {
                                    // Escreve os dados no banco de dados
                                    $query = "INSERT INTO guitarwars (date, name, score, screenshot) 
                                                VALUES (NOW(), '$name', '$score', '$screenshot')";
                                    mysqli_query ( $dbc, $query );

                                    // Confirma o sucesso com o usuário
                                    echo "<p>
                                            Obrigado por adicionar seu novo recorde! Ele será revisado e
                                            adicionado à lista de recordes o mais rápido possível.
                                        </p>
                                        <p>
                                            <strong>Nome:</strong> {$name}<br />
                                            <strong>Pontuação:</strong> {$score}<br />
                                            <img src='" . GW_UPLOADPATH . "{$screenshot}' alt='Score image' />
                                        </p>
                                        <p>
                                            <a href='index.php'>&lt;&lt; Voltar à maiores pontuações</a>
                                        </p>";

                                    // Limpar os dados de pontuação para limpar o formulário
                                    $name = "";
                                    $score = "";
                                    $screenshot = "";

                                    mysqli_close ( $dbc );
                                } else {
                                    echo '<p class="error">
                                            Desculpa, ocorreu um problema ao realizar o upload de sua imagem de captura de tela.
                                        </p>';
                                }
                            }
                        } else {
                            echo "<p class='error'>
                                    A captura de tela deve ser um arquivo de imagem GIF, JPEG, ou PNG não maior
                                    que " . ( GW_MAXFILESIZE / 1024 ) . " KB de tamanho.
                                </p>";
                        }

                        // Tentar excluir os arquivos de imagem de captura de tela temporários
                        @unlink ( $_FILES['screenshot']['tmp_name'] );
                    } else {
                        echo '<p class="error">
                                Por favor digite todas as informações para adicionar a sua maior pontuação.
                            </p>';
                    }
                } else {
                    echo '<p class="error">
                            Por favor digite a frase-secreta de verificação exatamente como mostrado.
                        </p>';
                }
            }
        ?>

        <hr />
        <form enctype="multipart/form-data" method="post" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?=GW_MAXFILESIZE?>" />
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?php if ( !empty ( $name ) ) echo $name; ?>" 
                required/><br />
            <label for="score">Pontuação:</label>
            <input type="number" id="score" name="score" value="<?php if ( !empty ( $score ) ) echo $score; ?>" 
                required />
            <br />
            <label for="screenshot">Captura de tela:</label>
            <input type="file" id="screenshot" name="screenshot" /><br />
            <label for="verify">Verificação:</label>
            <input type="text" id="verify" name="verify" placeholder="Digite a frase-secreta." required /> 
            <img src="fonts/captcha.php" alt="Frase-Secreta de verificação" />
            <hr />
            <button name="submit">Adicionar</button>
        </form>
    </body> 
</html>