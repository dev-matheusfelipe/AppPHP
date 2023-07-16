<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Incluir o arquivo bd_venda.php para obter a conexão com o banco de dados
require_once 'bd_venda.php';

// Verificar se o ID do produto foi fornecido via GET
if (isset($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];

    // Verificar se o formulário foi enviado via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obter os dados atualizados do produto do formulário
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $quantidade = $_POST['quantidade'];

        // Atualizar os dados do produto no banco de dados
        $sql = "UPDATE produto SET nome = '$nome', descricao = '$descricao', valor = '$valor', quantidade = '$quantidade' WHERE id_produto = $id_produto";
        $conexao->query($sql);

        // Redirecionar para a página produtos.php após a atualização
        header('Location: produtos.php');
        exit;
    }

    // Obter os dados do produto a ser editado do banco de dados
    $sql = "SELECT * FROM produto WHERE id_produto = $id_produto";
    $result = $conexao->query($sql);

    if ($result->num_rows == 1) {
        $produto = $result->fetch_assoc();
    } else {
        // Redirecionar para a página de produtos se o produto não for encontrado
        header('Location: produtos.php');
        exit;
    }
} else {
    // Redirecionar para a página de produtos se o ID do produto não for fornecido
    header('Location: produtos.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto</title>
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
        <h1 class="text-center">Editar Produto</h1>
        <!-- Formulário de edição -->
        <form action="" method="POST">
            <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?php echo $produto['descricao']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" class="form-control" id="valor" name="valor" value="<?php echo $produto['valor']; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a class='btn btn-warning text-white' href='produtos.php' data-toggle="tooltip" data-placement="top" title='Voltar'>
            Cancelar
            </a>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
