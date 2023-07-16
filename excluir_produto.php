<?php
// Inclua o arquivo bd_venda.php para obter a conexão com o banco de dados
require_once 'bd_venda.php';

// Verificar se o parâmetro ID foi fornecido na URL
if (!empty($_GET["id_produto"])) {
    $id = $_GET["id_produto"];

    // Obter as informações do produto do banco de dados
    $sql = "SELECT * FROM produto WHERE id_produto = $id";
    $result = $conexao->query($sql);

    if ($result->num_rows == 1) {
        // Exibir a confirmação de exclusão do produto
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Confirmou a exclusão do produto, executar a exclusão
            $sql = "DELETE FROM produto WHERE id_produto = $id";
            if ($conexao->query($sql) === TRUE) {
                echo "Produto excluído com sucesso.";
                // Redirecionar para a página produtos.php após a exclusão
                header('Location: produtos.php');
                exit;
            } else {
                echo "Erro ao excluir o produto: ";
            }
        } else {
            // Exibir a confirmação de exclusão do produto
            $row = $result->fetch_assoc();
            $nome = $row["nome"];
            $descricao = $row["descricao"];
            $valor = $row["valor"];
            $quantidade = $row["quantidade"];
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Excluir Produto</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <script src="https://kit.fontawesome.com/f2c527850f.js" crossorigin="anonymous"></script>
            </head>
            <body>
                <div class="container mx-auto mb-5 mt-5" style="width: 400px;">
                    <h1>Excluir Produto</h1>
                    <p class="text-danger">Você tem certeza que deseja excluir o produto abaixo?</p>
                    <p><strong>Nome:</strong> <?php echo $nome; ?></p>
                    <p><strong>Descrição:</strong> <?php echo $descricao; ?></p>
                    <p><strong>Valor:</strong> <?php echo $valor; ?></p>
                    <p><strong>Quantidade:</strong> <?php echo $quantidade; ?></p>
                    <form action="<?php echo $_SERVER["PHP_SELF"] . "?id_produto=" . $id; ?>" method="POST">
                        <button type="submit" class="btn btn-danger">Excluir</button>
                        <a href="produtos.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            </body>
            </html>
            <?php
        }
    } else {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "ID do produto não fornecido.";
    exit;
}

// Fechar a conexão com o banco de dados
$conexao->close();
?>
