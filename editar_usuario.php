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

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
$nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualizar os dados do usuário no banco de dados
    $sql = "UPDATE usuario SET nome = '$nome', email = '$email' WHERE id = $idUsuarioLogado";

    if ($conexao->query($sql) === TRUE) {
        // Redirecionar para a página de configuração com mensagem de sucesso
        $_SESSION['success_message'] = "Dados do usuário atualizados com sucesso.";
        $_SESSION['usuario']['nome'] = $nome;
        $_SESSION['usuario']['email'] = $email;
        header('Location: config.php');
        exit;
    } else {
        echo "Erro ao atualizar os dados do usuário: ";
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Matheus Felipe</a>
            <div class="d-flex input-group w-auto">
            <li class="nav-item" style="list-style: none;">
                    <a class='btn btn-warning text-white' href='config.php' title='Configuração'>
                        <i class="fa-solid fa-gear"></i>
                    </a>
                </li>
                <li class="nav-item" style="list-style: none; margin-left: 10px;">
                    <a href="logout.php" class="btn btn-danger" title='Sair'>
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                </li>
            </div>
        </div>
    </nav>
    <div class="container mt-5 centralizado">
        <h1 class="text-center">Editar Usuário</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a class='btn btn-warning text-white' href='config.php' title='Cancelar'>
                Cancelar
            </a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm`bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
