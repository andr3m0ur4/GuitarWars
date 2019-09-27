<?php
    require_once ( 'config/authorize.php' );
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Guitar Wars - Remover uma Maior Pontuação</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicação WEB para armazenar pontuações de jogadores" />
        <meta name="keywords" content="php mysql guitar warrior">
        <meta name="autor" content="André Moura">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Remover uma Maior Pontuação</h2>

        <?php
            require_once ( 'config/appvars.php' );
            require_once ( 'config/connectvars.php' );

            if ( isset ( $_GET['id'] ) && isset ( $_GET['date'] ) && isset ( $_GET['name'] ) && 
                isset ( $_GET['score'] ) && isset ( $_GET['screenshot'] ) ) {
            
                // Obtém os dados de pontuação do GET
                $id = $_GET['id'];
                $date = $_GET['date'];
                $name = $_GET['name'];
                $score = $_GET['score'];
                $screenshot = $_GET['screenshot'];
            } else if ( isset ( $_POST['id'] ) && isset ( $_POST['name'] ) && isset ( $_POST['score'] ) ) {
                // Obtém os dados de pontuação do POST
                $id = $_POST['id'];
                $name = $_POST['name'];
                $score = $_POST['score'];
            } else {
                echo '<p class="error">Desculpa, nenhum recorde foi especificado para remoção.</p>';
            }

            if ( isset ( $_POST['submit'] ) ) {
                if ( $_POST['confirm'] == 'Yes' ) {
                    // Excluir o arquivo de imagem de captura de tela do servidor
                    @unlink ( GW_UPLOADPATH . $screenshot );

                    // Conecta-se ao banco de dados
                    $dbc = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 

                    // Excluir os dados de pontuação do banco de dados
                    $query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";
                    mysqli_query ( $dbc, $query );
                    mysqli_close ( $dbc );

                    // Confirmar sucesso com o usuário
                    echo '<p>O recorde de ' . $score . ' para ' . $name . ' foi removido com sucesso.</p>';
                } else {
                    echo '<p class="error">O recorde não foi removido.</p>';
                }
            } else if ( isset ( $id ) && isset ( $name ) && isset ( $date ) && isset ( $score ) ) {
                echo "<p>Você está certo de que deseja excluir o seguinte recorde?</p>
                    <p>
                        <strong>Nome: </strong>$name<br /><strong>Data: </strong>$date<br />
                        <strong>Pontuação: </strong>$score
                    </p>
                    <form method='post' action='removescore.php'>
                        <input type='radio' name='confirm' value='Yes' /> Sim 
                        <input type='radio' name='confirm' value='No' checked='checked' /> Não <br />
                        <button name='submit'>Enviar</button>
                        <input type='hidden' name='id' value='{$id}' />
                        <input type='hidden' name='name' value='{$name}' />
                        <input type='hidden' name='score' value='{$score}' />
                    </form>";
            }

            echo '<p><a href="admin.php">&lt;&lt; Voltar para a página de administração</a></p>';
        ?>

    </body> 
</html>