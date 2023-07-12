<?php
// Incluir o arquivo de configuração do banco de dados
include "config/functions.php";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $id_produto = $_POST['id_produto'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $frete = $_POST['frete'];
    $status = $_POST['status'];
    $categoria_id = $_POST['categoria_id'];

    // Montar a consulta SQL para a atualização
    $query = "UPDATE produto SET nome = '$nome', preco = '$preco', descricao = '$descricao', frete = '$frete', status = '$status', categoria_id = '$categoria_id' WHERE id = '$id_produto'";

    // Executar a consulta SQL
    if (update($query)) {
        // Redirecionar para catalogo.php com uma mensagem de sucesso
        header("Location: catalogo.php?success=1");
        exit();
    } else {
        echo "Não foi possível editar o produto";
    }
} else {
    // Obter o ID do produto a ser editado
    $id_produto = $_GET['id_produto'];

    // Montar a consulta SQL para obter os dados do produto
    $query = "SELECT * FROM produto WHERE id = '$id_produto'";

    // Executar a consulta SQL
    $resultado = select($query);

    // Verificar se o produto existe
    if ($resultado && count($resultado) > 0) {
        $produto = $resultado[0];
?>

<!-- Formulário HTML para editar o produto -->
<head>
    <title>Alteração de Produtos</title>
    <link rel="stylesheet" href="./assets/style_edit_produto.css">
</head>

<form method="POST" action="">
    <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?php echo $produto['nome']; ?>">

    <label for="preco">Preço:</label>
    <input type="text" name="preco" value="<?php echo $produto['preco']; ?>">

    <label for="descricao">Descrição:</label>
    <textarea name="descricao"><?php echo $produto['descricao']; ?></textarea>

    <label for="frete">Frete:</label>
    <input type="text" name="frete" value="<?php echo $produto['frete']; ?>">

    <label for="status">Status:</label>
    <input type="text" name="status" value="<?php echo $produto['status']; ?>">

    <label for="categoria_id">Categoria ID:</label>
    <input type="text" name="categoria_id" value="<?php echo $produto['categoria_id']; ?>">

    <input type="submit" value="Salvar">
</form>

<?php
    } else {
        echo "Produto não encontrado";
    }
}

?>
