<?php
//INICIO DA PAGINA CARRINHO (onde mostra os produtos que o cliente adicionou no carrinho e onde ele pode finalizar a compra)
include "config/functions.php";
session_start();

//guarda os dados do carrinho que estão na $_SESSION na variavel $carrinho_produtos

$carrinho_produtos = $_SESSION['carrinho']['produto_carrinho'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrinho de Produtos</title>

    <style>
        /* COMEÇO DOS STYLES */
        body {
            background: linear-gradient(to right, #c0c0c0, #000000);
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: left; 
            font-family: Arial, sans-serif;
        }

        .produto img {
            width: 100px;
            height: 100px;
        }
    </style>

</head>
<body>
    <div class="produto">
        <?php
        // VERIFICA se o CARRINHO tem coisa, se tiver, mostra elas, se não mostra que não tem nada
        if (!empty($carrinho_produtos)) {
            $total = 0; // variável para armazenar o total dos valores dos produtos
            foreach ($carrinho_produtos as $produto) {
                echo "Nome: " . $produto['nome'] . "<br>";
                echo "Preço: R$ " . $produto['preco'] . "<br>";
                echo "Quantidade: " . $produto['quantidade'] . "<br>";
                echo "<br>" . '<img src="imgs/' . $produto['imagem'] . '" alt="Imagem do Produto"><br>';
                echo "<br>" . "<br>";
                $total += $produto['preco'] * $produto['quantidade']; // atualiza o total com o valor do produto atual
            }
            echo "<b>Total: R$ </b>" . $total . "<br><br>";
            echo '<form action="finalizar_carrinho.php" method="post">';
            echo '<label for="numero_cartao">Número do Cartão:</label><br>';
            echo '<input type="text" id="numero_cartao" name="numero_cartao" required><br><br>';
            echo '<label for="nome_titular">Nome do Titular:</label><br>';
            echo '<input type="text" id="nome_titular" name="nome_titular" required><br><br>';
            echo '<label for="validade_cartao">Validade do Cartão:</label><br>';
            echo '<input type="text" id="validade_cartao" name="validade_cartao" required><br><br>';
            echo '<label for="cvv_cartao">CVV do Cartão:</label><br>';
            echo '<input type="text" id="cvv_cartao" name="cvv_cartao" required><br><br>';
            echo '<input type="submit" value="Finalizar Compra">';
            echo '</form>';
        } else {
            echo "O carrinho está vazio.";
        }
        ?>
    </div>
</body>
</html>