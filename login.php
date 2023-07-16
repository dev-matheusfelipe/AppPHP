<?php
session_start();

// Verificar se o usuário já está logado
if (isset($_SESSION['usuario'])) {
    header('Location: produtos.php');
    exit;
}

// Incluir o arquivo bd_venda.php para obter a conexão com o banco de dados
require_once 'bd_venda.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter as credenciais do formulário de login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar o usuário com o email e senha fornecidos
    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if ($result->num_rows == 1) {
        // Autenticação bem-sucedida, armazenar as informações do usuário na sessão
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $row;

        // Redirecionar para a página de produtos
        header('Location: produtos.php');
        exit;
    } else {
        $erro = 'Credenciais inválidas.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f2c527850f.js" crossorigin="anonymous"></script>
</head>
<style>
    .centralizado {
	    position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<body>
    <div class="container centralizado">
        <h1 class="text-center">Login</h1>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>
        <!-- Formulário de login -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <br>
        <p class="text-center">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
