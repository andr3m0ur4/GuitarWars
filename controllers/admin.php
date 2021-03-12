<?php

    require_once __DIR__ . './../config/authorize.php';
    
    // Recupera os dados de pontuação do MySQL
    $data = $dal -> selectAll ( );
    
    require __DIR__ . '/../views/template-admin.php';
            