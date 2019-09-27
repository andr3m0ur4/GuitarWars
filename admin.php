<?php
    require_once ( 'config/authorize.php' );
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Guitar Wars - Administração das Maiores Pontuações</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicação WEB para armazenar pontuações de jogadores" />
        <meta name="keywords" content="php mysql guitar warrior">
        <meta name="autor" content="André Moura">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Administração das Maiores Pontuações</h2>
        <p>
            Abaixo está uma lista de todas as maiores pontuações de Guitar Wars. Utilize esta página para remover
            pontuações, caso necessário.
        </p>
        <hr />

        <?php
            require_once ( 'config/appvars.php' );
            require_once ( 'config/connectvars.php' );

            // Conecta-se ao banco de dados
            $dbc = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

            // Recupera os dados de pontuação do MySQL
            $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
            $data = mysqli_query ( $dbc, $query );

            // Percorre o array de dados de pontuação, formatando-os como HTML 
            echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Pontuação</th>
                        <th>Ação</th>
                    </tr>";
            while ( $row = mysqli_fetch_assoc ( $data ) ) { 
                // Exibe os dados de pontuação
                echo "<tr class='scorerow'>
                        <td><strong>{$row['name']}</strong></td>
                        <td>{$row['date']}</td>
                        <td>{$row['score']}</td>
                        <td>
                            <a href='removescore.php?id={$row['id']}&amp;date={$row['date']}&amp;name=" .
                                "{$row['name']}&amp;score={$row['score']}&amp;screenshot={$row['screenshot']}'>
                                    Remover</a>";
                if ( $row['approved'] == '0' ) {
                    echo " / <a href='approvescore.php?id={$row['id']}&amp;date={$row['date']}&amp;name=" .
                        "{$row['name']}&amp;score={$row['score']}&amp;screenshot={$row['screenshot']}'>
                            Aprovar</a>";
                }
                echo '</td></tr>';
            }
            echo '</table>';

            mysqli_close ( $dbc );
        ?>

    </body> 
</html>