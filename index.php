<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Guitar Wars - Maiores Ponstuações</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicação WEB para armazenar pontuações de jogadores" />
        <meta name="keywords" content="php mysql guitar warrior">
        <meta name="autor" content="André Moura">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Maiores Ponstuações</h2>
        <p>
            Bem vindo, Guitar Warrior, você tem o que é preciso para quebrar a lista de records? Se sim, então 
                <a href="addscore.php">adicione sua própria pontuação</a>.
        </p>
        <hr />

        <?php
            require_once ( 'config/appvars.php' );
            require_once ( 'config/connectvars.php' );

            // Conecta-se ao banco de dados
            $dbc = mysqli_connect ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

            // Recupera os dados de pontuação do MySQL
            $query = "SELECT * FROM guitarwars WHERE approved = 1 ORDER BY score DESC, date ASC";
            $data = mysqli_query ( $dbc, $query );

            // Percorre o array dos dados de pontuação, formatando-os como HTML
            echo '<table>';
            $i = 0;
            while ( $row = mysqli_fetch_assoc ( $data ) ) { 
                // Exibe os dados de pontuação
                if ( $i == 0 ) {
                    echo "<tr>
                            <td colspan='2' class='topscoreheader'>Melhor Pontuação: {$row['score']}</td>
                        </tr>";
                }
                echo "<tr>
                        <td class='scoreinfo'>
                            <span class='score'>{$row['score']}</span><br />
                            <strong>Nome:</strong> {$row['name']}<br />
                            <strong>Data:</strong> {$row['date']}
                        </td>";
                if ( is_file ( GW_UPLOADPATH . $row['screenshot'] ) && 
                        filesize ( GW_UPLOADPATH . $row['screenshot'] ) > 0 ) {
                    echo "<td>
                            <img src='" . GW_UPLOADPATH . $row['screenshot'] . "' alt='Score image' />
                        </td></tr>";
                } else {
                    echo "<td>
                            <img src='" . GW_UPLOADPATH . "unverified.gif' alt='Unverified score' />
                        </td></tr>";
                }
                $i++;
            }
            echo '</table>';

            mysqli_close ( $dbc );
        ?>

    </body>
</html>