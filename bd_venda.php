<?php

    $dbHost = 'containers-us-west-21.railway.app';
    $dbUsername = 'root';
    $dbPassword = 'ZFBxm586SJGtYJESRlxO';
    $dbName = 'railway';
    $dbPort = 6994;
    
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $dbPort);

    // Verifica se a conexão foi estabelecida corretamente
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    } else {
        echo "Conexão bem-sucedida!";
    }

?>
