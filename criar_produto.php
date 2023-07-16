<?php
session_start();

// Incluir o arquivo bd_venda.php para obter a conexão com o banco de dados
require_once 'bd_venda.php';

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];

    // Inserir o novo produto no banco de dados
    $sql = "INSERT INTO produto (nome, descricao, valor, quantidade) VALUES ('$nome', '$descricao', '$valor', '$quantidade')";
    if ($conexao->query($sql) === TRUE) {
        // Redirecionar para a página de lista de produtos após a inserção bem-sucedida
        header('Location: produtos.php');
        exit;
    } else {
        echo "Erro ao criar o produto: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Criar Produto</title>
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
    <div class="container centralizado">
        <h1 class="text-center">Criar Produto</h1>
        <!-- Formulário para criar um novo produto -->
        <form action="criar_produto.php" method="post">
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="number" class="form-control" id="valor" name="valor" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar produto</button>
            <a class='btn btn-warning text-white' href='produtos.php' title='Cancelar'>
                Cancelar
            </a>
        </form>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
</body>

</html>