<?php
session_start();

// Incluir o arquivo bd_venda.php para obter a conexão com o banco de dados
require_once 'bd_venda.php';

// Listar produtos
$sql = "SELECT * FROM produto";
$result = $conexao->query($sql);

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Obter o nome do usuário logado
$nomeUsuario = $_SESSION['usuario']['nome'];

// Verificar se o formulário de busca foi enviado
if (isset($_GET['termo_busca'])) {
    $termoBusca = $_GET['termo_busca'];
    // Listar produtos com base no termo de busca
    $sql = "SELECT * FROM produto WHERE nome LIKE '%$termoBusca%'";
} else {
    // Listar todos os produtos caso não haja busca
    $sql = "SELECT * FROM produto";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f2c527850f.js" crossorigin="anonymous"></script>
</head>

<style>
    .secund-nav {
        border-top: 1px solid #f1eeee;
        border-bottom: 1px solid #e7e5e5;
    }

    .mbt {
        border-bottom: 1px solid #e7e5e5;
    }
</style>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://github.com/dev-matheusfelipe/" target="_blank" data-toggle="tooltip"
                data-placement="top" title='Acesse o meu GitHub'>
                <i class="fa-brands fa-github"></i> Dev Matheus Felipe
            </a>
            <div class="d-flex input-group w-auto">
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light secund-nav">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Navbar brand -->
            <span class="navbar-brand mb-0 h1">Sistema PHP</span>

            <form class="form-inline justify-content-center" action="produtos.php" method="GET">
                <input type="text" class="form-control mb-2 mr-sm-2" name="termo_busca" placeholder="Buscar produto">
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
            </form>

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="d-flex align-items-end">
                <a class="btn btn-info px-3" href="criar_produto.php" role="button" data-toggle="tooltip"
                    data-placement="bottom" title='Criar produto'><i class="fab fa-plus"></i>
                </a>
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div class="container">
        <div class="container text-center mt-5 mb-5 mbt">
            <!-- Exibir o nome do usuário -->
            <h2>Bem-vindo,
                <?php echo '<span class="text-primary">' . $nomeUsuario . '</span>'; ?>!
            </h2>
        </div>

        <div class="container mt-5">
            <h1 class="text-center">Lista de Produtos</h1>
            <p class="text-info text-center">Todos os produtos em estoque</p>
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
            <?php
            // Verificando se a lista está vazia
            if ($result->num_rows === 0) {
                echo "<h3 class='text-center p-3 text-danger'> Ainda não existe produto aqui!</h3>";
            } else {
                // Caso a lista não esteja vazia, exibe os produtos
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo $row['id_produto']; ?>
                        </td>
                        <td>
                            <?php echo $row['nome']; ?>
                        </td>
                        <td>
                            <?php echo $row['descricao']; ?>
                        </td>
                        <td>
                            <?php echo $row['valor']; ?>
                        </td>
                        <td>
                            <?php echo $row['quantidade']; ?>
                        </td>
                        <td>
                            <a class='btn btn-sm btn-warning text-white'
                                href='editar_produto.php?id_produto=<?php echo $row['id_produto']; ?>' data-toggle='tooltip'
                                data-placement='top' title='Editar'>
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a class='btn btn-sm btn-danger'
                                href='excluir_produto.php?id_produto=<?php echo $row['id_produto']; ?>' data-toggle="tooltip"
                                data-placement="top" title='Deletar'>
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile;
            } ?>
        </table>

    </div>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted fixed-bottom">
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2023 Copyright:
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