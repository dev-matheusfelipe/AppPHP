<?php
// Inclua o arquivo bd_venda.php para obter a conexão com o banco de dados
require_once 'bd_venda.php';

// Verifica se os dados de login estão corretos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar o usuário com o email e senha fornecidos
    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if ($result->num_rows == 1) {
        // Usuário autenticado, redirecionar para a página de produtos
        header('Location: produtos.php');
        exit;
    } else {
        // Redirecionar para a página de login com uma mensagem de erro
        header('Location: login.php?erro=1');
        exit;
    }
} else {
    // Redirecionar para a página de login
    header('Location: login.php');
    exit;
}

// Fechar a conexão com o banco de dados
//$conexao->close();
?>
