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

?>

<!DOCTYPE html>
<html>

<head>
    <title>Configuração</title>
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
            <a class="navbar-brand" href="https://github.com/dev-matheusfelipe/" target="_blank" data-toggle="tooltip"
                data-placement="top" title='Acesse o meu GitHub'>
                <i class="fa-brands fa-github"></i> Dev Matheus Felipe
            </a>
            <div class="d-flex">
                <li class="nav-item" style="list-style: none;">
                    <a class='btn btn-dark text-white' href='config.php' data-toggle="tooltip" data-placement="bottom"
                        title='Configuração'>
                        <i class="fa-solid fa-gear"></i>
                    </a>
                </li>
                <li class="nav-item" style="list-style: none; margin-left: 10px;">
                    <a href="logout.php" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                        title='Sair'>
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                </li>

            </div>
        </div>
    </nav>
    <div class="container text-center mb-5 mt-5">
        <h1>Configuração</h1>
        <p class="text-info">Escolha a ação desejada</p>
        <table class="table">
            <tr>
                <th>COD</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <tr>
                <td>
                    <?php echo $usuario['id']; ?>
                </td>
                <td>
                    <?php echo $usuario['nome']; ?>
                </td>
                <td>
                    <?php echo $usuario['email']; ?>
                </td>
                <td>
                    <a class='btn btn-sm btn-warning text-white'
                        href='editar_usuario.php?id=<?php echo $usuario['id']; ?>' data-toggle="tooltip"
                        data-placement="top" title='Editar'>
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <a class='btn btn-sm btn-danger' href='excluir_usuario.php?id=<?php echo $usuario['id']; ?>'
                        data-toggle="tooltip" data-placement="top" title='Deletar'>
                        <i class="fa-solid fa-trash"></i>
                    </a>

                </td>
            </tr>
        </table>
        <p class="text-danger text-center mt-5"><b>*</b>Cuidado ao apertar o botão excluir, você pode deletar o seu
            usuario.</p>
        <a class='btn btn-info text-white' href='produtos.php' data-toggle="tooltip" data-placement="top"
            title='Voltar'>
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted fixed-bottom">
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://github.com/dev-matheusfelipe/">Dev Matheus Felipe</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>

</html>