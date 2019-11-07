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
        <link rel="stylesheet" type="text/css" href="assets/style.css" />
    </head>
    <body>
        <h2>Guitar Wars - Adicione Sua Maior Pontuação</h2>

        <?php if ( $success ) : ?>
            <!-- Confirma o sucesso com o usuário -->
            <p>
                Obrigado por adicionar seu novo recorde! Ele será revisado e adicionado à lista de recordes o mais rápido possível.
            </p>
            <p>
                <strong>Nome:</strong> <?= $guitar -> name ?><br />
                <strong>Pontuação:</strong> <?= $guitar -> score ?><br />
                <img src="<?= GW_UPLOADPATH . $guitar -> screenshot ?>" alt='Score image' />
            </p>
            <p>
                <a href='?rota=index'>&lt;&lt; Voltar às maiores pontuações</a>
            </p>
            <!-- Limpar os dados de pontuação para limpar o formulário -->
            <?php $guitar -> name = ''; ?>
            <?php $guitar -> score = ''; ?>
            <?php $guitar -> screenshot = ''; ?>
        <?php endif; ?>

        <?php if ( $error_upload ) : ?>
            <p class="error">
                Desculpa, ocorreu um problema ao realizar o upload de sua imagem de captura de tela.
            </p>
        <?php endif; ?>

        <?php if ( $error_type ) : ?>
            <p class='error'>
                A captura de tela deve ser um arquivo de imagem GIF, JPEG, ou PNG não maior que <?= ( GW_MAXFILESIZE / 1024 ) ?> KB de tamanho.
            </p>
        <?php endif; ?>

        <?php if ( $error ) : ?>
            <p class="error">
                Por favor digite todas as informações para adicionar a sua maior pontuação.
            </p>
        <?php endif; ?>

        <?php if ( $error_phrase ) : ?>
            <p class="error">
                Por favor digite a frase-secreta de verificação exatamente como mostrado.
            </p>
        <?php endif; ?>

        <hr />
        <form enctype="multipart/form-data" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?= GW_MAXFILESIZE ?>" />
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?= htmlentities ( $guitar -> name ) ?>" required/><br />
            <label for="score">Pontuação:</label>
            <input type="number" id="score" name="score" value="<?= htmlentities ( $guitar -> score ) ?>" required />
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