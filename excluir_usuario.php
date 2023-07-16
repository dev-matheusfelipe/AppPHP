<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Incluir o arquivo bd_venda.php para obter a conexão com o banco de dados
require_once 'bd_venda.php';

// Obter o ID do usuário logado
$idUsuarioLogado = $_SESSION['usuario']['id'];

// Consultar os dados do usuário logado
$sql = "SELECT * FROM usuario WHERE id = $idUsuarioLogado";
$result = $conexao->query($sql);

// Verificar se o usuário existe
if ($result->num_rows == 1) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    header('Location: cadastro.php');
    exit;
}

// Verificar se o parâmetro ID foi fornecido na URL
if (!empty($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Verificar se o ID do usuário a ser excluído é diferente do ID do usuário logado
    // if ($idUsuario == $idUsuarioLogado) {
    //     $_SESSION['error_message'] = "Você não pode excluir o seu próprio usuário.";
    //     header('Location: config.php');
    //     exit;
    // }

    // Excluir o usuário do banco de dados
    $sql = "DELETE FROM usuario WHERE id = $idUsuario";

    if ($conexao->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Usuário excluído com sucesso.";
        session_destroy();
        header('Location: cadastro.php');
        exit;
    } else {
        echo "Erro ao excluir o usuário: ";
        exit;
    }
} else {
    echo "ID do usuário não fornecido.";
    exit;
}
