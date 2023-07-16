<?php
session_start();

// Encerrar a sessão
session_destroy();

// Redirecionar para a página de login
header('Location: index.php');
exit;
?>
