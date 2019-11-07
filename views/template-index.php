<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Guitar Wars - Maiores Pontuações</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicação WEB para armazenar pontuações de jogadores" />
        <meta name="keywords" content="php mysql guitar warrior">
        <meta name="autor" content="André Moura">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="assets/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Maiores Pontuações</h2>
        <p>
            Bem vindo, Guitar Warrior, você tem o que é preciso para quebrar a lista de records? Se sim, então 
                <a href="?rota=addscore">adicione sua própria pontuação</a>.
        </p>
        <hr />

        <!-- Percorre o array dos dados de pontuação, formatando-os como HTML -->
        <table>
            <?php foreach ( $data as $row ) : ?>
                <!-- Exibe os dados de pontuação -->
                <?php if ( $i == 0 ) : ?>
                    <tr>
                        <td colspan='2' class='topscoreheader'>Melhor Pontuação: <?= $row -> score ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td class='scoreinfo'>
                        <span class='score'><?= $row -> score ?></span><br />
                        <strong>Nome:</strong> <?= $row -> name ?><br />
                        <strong>Data:</strong> <?= $row -> date ?>
                    </td>
                    <?php if ( is_file ( GW_UPLOADPATH . $row -> screenshot ) AND filesize ( GW_UPLOADPATH . $row -> screenshot ) > 0 ) : ?>
                        <td>
                            <img src="<?= GW_UPLOADPATH . $row -> screenshot ?>" alt='Score image' />
                        </td>
                    <?php else : ?>
                        <td>
                            <img src="<?= GW_UPLOADPATH . 'unverified.gif' ?>" alt="Unverified score" />
                        </td>
                    <?php endif; ?>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </body>
</html>