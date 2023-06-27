<?php
//Pagina principal DA LOJA
include "config/functions.php";

//realiza uma pesquisa no banco para pegar todos os dados da tabela PRODUTO
$query = "SELECT * FROM produto";

//guarda os resultados da pesquisa na variavel $result e em formato de LISTA 
$result = lista($query);

session_start();


// Verifica se o carrinho já existe na sessão
if (!isset($_SESSION['carrinho'])) {
    // Se não existir, cria um carrinho vazio
    $_SESSION['carrinho'] = array();
}

// Verifica se o produto foi adicionado ao carrinho
if (isset($_GET['adicionar'])) {
    // Obtém o ID do produto a ser adicionado
    $produtoID = $_GET['adicionar'];

    // Verifica se o produto já existe no carrinho
    if (isset($_SESSION['carrinho'][$produtoID])) {
        // Se o produto já existe, incrementa a quantidade
        $_SESSION['carrinho'][$produtoID]['quantidade']++;
    } else {
        // Se o produto não existe, adiciona-o ao carrinho com quantidade 1
        $_SESSION['carrinho'][$produtoID] = array(
            'nome' => $_GET['nome'],
            'preco' => $_GET['preco'],
            'quantidade' => 1,
            'imagem' => $_GET['imagem']
        );
    }
   
}
//Códgio para limpar os itens do carrinho
if (isset($_GET['limpar_carrinho']) && $_GET['limpar_carrinho'] === 'true') {
    $_SESSION['carrinho'] = array();
    header('Location: catalogo.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Produtos</title>
    <style>
        
        body {
            background: linear-gradient(to right, #c0c0c0, #000000);
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
            font-family: Arial, sans-serif;
        }
        
        .catalogo {
            width: 70%;
            margin-right: 20px;
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
            background: #c0c0c0;
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
        .container-carrinho{
            width: 30%;
        }
        /*  --------------------------------------------------------------------------------  */
        .carrinho {
            border-radius: 10px;
            width: 100%;
            background-color: #c0c0c0;
            padding: 10px;
            height: 250px; 
            overflow-y: auto;
        }

        .produto-carrinho {
            margin-bottom: 10px;
        }

        .produto-carrinho .info-produto {
            margin-top: 15px;
        }

        .produto-carrinho .info-produto .nome {
            font-weight: bold;
        }

        .produto-carrinho .info-produto .preco {
            margin-top: 5px;
        }

        .produto-carrinho .info-produto .quantidade {
            margin-top: 5px;
        }

        .carrinho-total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }

        /*  --------------------------------------------------------------------------------  */

        .btn-acessar-carrinho {
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
        div.limpar-carrinho {
            margin-top: 20px;
        }
        div.limpar-carrinho h3 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }
        div.limpar-carrinho a {
            color: #fff;
            background-color: #f44336;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
        }
        div.limpar-carrinho a:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

    <div class="catalogo">
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
                        <div class="nome"><b><?php echo $produto['nome']; ?></b></div>
                        <div class="descricao"><?php echo $produto['descricao']; ?></div>
                        <div class="preco">R$ <?php echo $produto['preco']; ?></div>
                        <a href="?adicionar=<?php    echo $produto['id']; ?>&nome=<?php echo urlencode($produto['nome']); ?>&preco=<?php echo $produto['preco']; ?>&imagem=<?php echo $produto['imagem']; ?>" class="btn-adicionar">Adicionar ao Carrinho</a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Nenhum produto encontrado.</p>";
            }
            ?>
        </div>
    </div>
    <div class="container-carrinho">
        <div class="carrinho">
            <h2>Carrinho de Compras</h2>
                
            <?php if (empty($_SESSION['carrinho'])) : ?>
                <p>O carrinho está vazio.</p>
            <?php else : ?>
                <?php foreach ($_SESSION['carrinho'] as $produtoID => $produto) : ?>
                    <div class="produto-carrinho">
                        <div class="info-produto">
                            <div class="nome">Nome: <?php echo $produto['nome']; ?></div>
                            <div class="preco">Valor: R$ <?php echo $produto['preco']; ?></div>
                            <div class="quantidade">Quantidade: <?php echo $produto['quantidade']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['carrinho'] as $produtoID => $produto) {
                        $subtotal = $produto['preco'] * $produto['quantidade'];
                        $total += $subtotal;
                    }
                    echo '<h3>Total: R$ ' . $total . '</h3>';
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="limpar-carrinho">
            <h3><a href="?limpar_carrinho=true">Limpar Carrinho</a></h3>
        </div>
        <div><?php echo '<br>' ?>
        <div class="acessar-carrinho">
        <a href="carrinho.php" class="btn-acessar-carrinho">Acessar Carrinho</a>
    </div>
    </div>

   
    
</div>
</body>


</html>


