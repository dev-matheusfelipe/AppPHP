<?php
// Obter os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Salvar os dados no banco de dados (neste exemplo, não incluí a conexão com o banco de dados)

// Redirecionar para a página de login
header('Location: login.php');
exit;
?>
