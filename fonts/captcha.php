<?php
    session_start ( );

    // Configura algumas constantes importantes do CAPTCHA
    define ( 'CAPTCHA_NUMCHARS', 6 );  // número de caracteres na frase-secreta
    define ( 'CAPTCHA_WIDTH', 100 );   // largura da imagem
    define ( 'CAPTCHA_HEIGHT', 25 );   // altura da imagem

    // Gera a frase-secreta aleatória
    $pass_phrase = "";
    for ( $i = 0; $i < CAPTCHA_NUMCHARS; $i++ ) {
        $pass_phrase .= chr ( rand ( 97, 122 ) );
    }

    // Armazena a frase-secreta criptografada em uma variável de sessão
    $_SESSION['pass_phrase'] = SHA1 ( $pass_phrase );

    // Cria a imagem
    $img = imagecreatetruecolor ( CAPTCHA_WIDTH, CAPTCHA_HEIGHT );

    // Define um fundo branco com texto preto e gráficos em cinza
    $bg_color = imagecolorallocate ( $img, 255, 255, 255 );     // branco
    $text_color = imagecolorallocate ( $img, 0, 0, 0 );         // preto
    $graphic_color = imagecolorallocate ( $img, 64, 64, 64 );   // cinza escuro

    // Preenche o fundo
    imagefilledrectangle ( $img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color );
    // Desenha algumas linhas aleatórias
    for ( $i = 0; $i < 5; $i++ ) {
        imageline ( $img, 0, rand ( ) % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand ( ) % CAPTCHA_HEIGHT, $graphic_color );
    }

    // Asperge alguns pontos aleatórios
    for ( $i = 0; $i < 50; $i++ ) {
        imagesetpixel ( $img, rand ( ) % CAPTCHA_WIDTH, rand ( ) % CAPTCHA_HEIGHT, $graphic_color );
    }

    // Desenha a string da frase-secreta
    $font = getcwd ( ) . DIRECTORY_SEPARATOR . 'Courier New Bold.ttf';
    $font = mb_convert_encoding ( $font, 'big5', 'utf-8');
    
    imagettftext ( $img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, $font, $pass_phrase );

    // Saída da imagem como um PNG utilizando um header
    header ( "Content-type: image/png" );
    imagepng ( $img );

    // Limpar
    imagedestroy ( $img );
