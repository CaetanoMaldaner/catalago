<?php
include "config/functions.php";
session_start();

$carrinho_produtos = $_SESSION['carrinho'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrinho de Produtos</title>
    <style>
        body {
    background: linear-gradient(to right, #c0c0c0, #000000);
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: left; /* Alterado para centralizar os produtos horizontalmente */
    font-family: Arial, sans-serif;
}
    .produto img {
        width: 100px;
        height: 100px;
    }
</style>

</style>

    </style>
</head>
<body>
    <div class="produto">
        <?php
        // VERIFICA se o CARRINHO tem coisa, se tiver, mostra elas, se não mostra que n tem
        if (!empty($carrinho_produtos)) {
            foreach ($carrinho_produtos as $produto) {
                echo "Nome: " . $produto['nome'] . "<br>";
                echo "Preço: R$ " . $produto['preco'] . "<br>";
                echo "Quantidade: " . $produto['quantidade'] . "<br>";
                echo "<br>" .'<img src="imgs/' . $produto['imagem'] . '" alt="Imagem do Produto"><br>';
                echo "<br>" . "<br>";
            }
        } else {
            echo "O carrinho está vazio.";
        }
        ?>
    </div>
</body>
</html>