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
        <link rel="stylesheet" type="text/css" href="assets/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Remover uma Maior Pontuação</h2>

        <?php if ( $error ) : ?>
            <p class="error">Desculpa, nenhum recorde foi especificado para remoção.</p>
        <?php endif; ?>

        <?php if ( $success ) : ?>
            <!-- Confirmar sucesso com o usuário -->
            <p>
                O recorde de <?= $guitar -> score ?> para <?= $guitar -> name ?> foi removido com sucesso.
            </p>
        <?php endif; ?>

        <?php if ( $error_remove ) : ?>
            <p class="error">O recorde não foi removido.</p>
        <?php endif; ?>

        <?php if ( $form_remove ) : ?>
            <p>Você está certo de que deseja excluir o seguinte recorde?</p>
            <p>
                <strong>Nome: </strong><?= $guitar -> name ?><br /><strong>Data: </strong><?= $guitar -> date ?><br />
                <strong>Pontuação: </strong><?= $guitar -> score ?>
            </p>
            <form method='post' action='admin.php?rota=removescore'>
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