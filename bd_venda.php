<?php

    $dbHost = 'containers-us-west-16.railway.app';
    $dbUsername = 'root';
    $dbPassword = 'RyKRpjWsyFcLLWyZthvS';
    $dbName = 'railway';
    $dbPort = 5914;
    
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $dbPort);

    // Verifica se a conexão foi estabelecida corretamente
    // if ($conexao->connect_error) {
    //     die("Falha na conexão: " . $conexao->connect_error);
    // } else {
    //     echo "Conexão bem-sucedida!";
    // }

?>
