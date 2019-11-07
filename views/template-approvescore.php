<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Guitar Wars - Aprovar uma Maior Pontuação</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Aplicação WEB para armazenar pontuações de jogadores" />
        <meta name="keywords" content="php mysql guitar warrior">
        <meta name="autor" content="André Moura">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Aprovar uma Maior Pontuação</h2>

        <?php if ( $error ) : ?>
            <p class="error">Desculpa, nenhuma pontuação foi especificada para aprovação.</p>
        <?php endif; ?>

        <?php if ( $success ) : ?>
            <!-- Confirma sucesso com o usuário -->
            <p>
                A pontuação de <?= $guitar -> score ?> para <?= $guitar -> name ?> foi aprovada com sucesso.
            </p>
        <?php endif; ?>

        <?php if ( $error_approve ) : ?>
            <p class="error">Desculpa, ocorreu um problema ao aprovar o recorde.</p>
        <?php endif; ?>

        <?php if ( $form_approve ) : ?>
            <p>Você está certo de que deseja aprovar o seguinte recorde?</p>
            <p>
                <strong>Nome: </strong><?= $guitar -> name ?><br /><strong>Data: </strong><?= $guitar -> date ?><br />
                <strong>Pontuação: </strong><?= $guitar -> score ?>
            </p>
            <form method='post' action="admin.php?rota=approvescore">
                <img src="<?= GW_UPLOADPATH . $guitar -> screenshot ?>" width='160' alt='Score image' /><br />
                <input type='radio' name='confirm' value='Yes' /> Sim
                <input type='radio' name='confirm' value='No' checked='checked' /> Não <br />
                <button name='submit'>Enviar</button>
                <input type='hidden' name='id' value="<?= $guitar -> id ?>" />
                <input type='hidden' name='name' value="<?= $guitar -> name ?>" />
                <input type='hidden' name='score' value="<?= $guitar -> score ?>" />
                <input type='hidden' name='date' value="<?= $guitar -> date ?>" />
            </form>
        <?php endif; ?>

        <p><a href="admin.php">&lt;&lt; Voltar para a página de administração</a></p>
    </body>
</html>