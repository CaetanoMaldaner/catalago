<?php
//Pagina principal DA LOJA
include "config/functions.php";

//realiza uma pesquisa no banco para pegar todos os dados da tabela PRODUTO
$query = "SELECT * FROM produto";

//guarda os resultados da pesquisa na variavel $result e em formato de LISTA 
$result = lista($query);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Produtos</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            margin-top: 20px;
        }

        .produtos {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .produto {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            max-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .produto img {
            max-width: 200px;
        }

        .produto .descricao {
            margin-top: 10px;
            text-align: center;
        }

        .produto .preco {
            margin-top: 10px;
            font-weight: bold;
        }

        .produto .btn-adicionar {
            margin-top: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Catálogo de Produtos</h1>

    <div class="produtos">
        <?php
        // Verifica se há produtos no resultado da pesquisa
        if ($result->num_rows > 0) {
            // Itera sobre os produtos e exibe as informações
            while ($produto = $result->fetch_assoc()) {
                ?>
                <div class="produto">
                <img src="imgs/<?php echo $produto['imagem']; ?>" alt="Imagem do Produto">
                    <div class="descricao"><?php echo $produto['descricao']; ?></div>
                    <div class="preco">R$ <?php echo $produto['preco']; ?></div>
                    <a href="#" class="btn-adicionar">Adicionar ao Carrinho</a>
                </div>
                <?php
            }
        } else {
            echo "<p>Nenhum produto encontrado.</p>";
        }
        ?>
    </div>
</body>
</html>

