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
        <link rel="stylesheet" type="text/css" href="assets/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Administração das Maiores Pontuações</h2>
        <p>
            Abaixo está uma lista de todas as maiores pontuações de Guitar Wars. Utilize esta página para remover pontuações, caso necessário.
        </p>
        <hr />

        <!-- Percorre o array de dados de pontuação, formatando-os como HTML -->
        <table>
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Pontuação</th>
                <th>Ação</th>
            </tr>
            <?php foreach ( $data as $row ) : ?>
                <!-- Exibe os dados de pontuação -->
                <tr class='scorerow'>
                    <td><strong><?= $row -> name ?></strong></td>
                    <td><?= $row -> date ?></td>
                    <td><?= $row -> score ?></td>
                    <td>
                        <a href="admin.php?rota=removescore&amp;id=<?= $row -> id ?>">
                            Remover
                        </a>
                        <?php if ( $row -> approved == '0' ) : ?>
                            / <a href="admin.php?rota=approvescore&amp;id=<?= $row -> id ?>">
                                Aprovar
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body> 
</html>