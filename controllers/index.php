<?php
            
    // Recupera os dados de pontuação do MySQL
    $data = $dal -> select ();
            
    $i = 0;
            
    require __DIR__ . '/../views/template-index.php';
    