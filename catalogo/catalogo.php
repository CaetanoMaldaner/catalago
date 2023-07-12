<?php
//Pagina principal DA LOJA
session_start();
include "config/functions.php";


//inclue o arquivo que tem todo o código da pagina 
include "catalogo_functions/functions.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de Produtos</title>
    <link rel="stylesheet" href="./assets/style_catalogo.css">
</head>

<body>

    <div class="catalogo">
        <h1>Catálogo de Produtos</h1>
        <?php //MOSTRA na classe 'nome-usuario' o NOME do usuario LOGADO na SESSÃO ?>
        <div class="nome-usuario"><?php echo $_SESSION['nome_usuario']; ?></div>
        <a href="logout.php" class="logout-button">Logout</a>

        <div class="produtos">
            <?php

            //realiza uma pesquisa no banco para pegar todos os dados da tabela PRODUTO
            $query = "SELECT * FROM produto";

            //guarda os resultados da pesquisa na variavel $result  
            $result = lista($query);

            //Verifica se o resultado da pesquisa retornou alguma coluna
            if ($result->num_rows > 0) {


                //Cria uma "listagem" para cada um dos produtos que estiverem no $result, por exemplo
                //Pega o produto 1 e adiciona ele, mostrando os dados abaixo, depois segue para o prox produto e faz o mesmo

                while ($produto = $result->fetch_assoc()) {

                    //cria um div chamada PRODUTO onde haverá os dados dos produtos, individualmente 
            ?>
                    <div class="produto">
                        <img src="imgs/<?php echo $produto['imagem']; ?>" alt="Imagem do Produto">
                        <div class="nome"><b><?php echo $produto['nome']; ?></b></div>
                        <div class="descricao"><?php echo $produto['descricao']; ?></div>
                        <div class="preco">R$ <?php echo $produto['preco']; ?></div>
                        <a href="?adicionar=<?php echo $produto['id']; ?>&nome=<?php echo urlencode($produto['nome']); ?>&preco=<?php echo $produto['preco']; ?>&imagem=<?php echo $produto['imagem']; ?>" class="btn-adicionar">Adicionar ao Carrinho</a>
                        <?php if ($_SESSION['adm'] == 1): ?>
                        <a href="delete_produto.php?id_produto=<?php echo $produto['id']; ?>" class="delete-button">Excluir</a>
                        <a href="edit_produto.php?id_produto=<?php echo $produto['id']; ?>" class="edit-button">Alterar</a>
                        <?php endif; ?>
                    </div>
            <?php
                }
            } else {
                echo "<p>Nenhum produto encontrado.</p>";
            }
            ?>
        </div>


        <?php //VERIFICA se o USUARIO da SESSÃO é ADM ou não, SE FOR mostra o BOTÃO de EDIÇÃO DE USUÁRIOS ?>
        <?php if ($_SESSION['adm'] == 1): ?>
        <a href="alt_usuario.php" class="edit-button">Alteração de Usuários</a>
        <?php endif; ?>


    </div>
    <div class="container-carrinho">

        <div class="carrinho">
            <h2>Carrinho de Compras</h2>

            <?php //SE o carrinho FOR VAZIO e o $_GET estiver setado como FINALIZADO, mostra que a compra foi FINALIZADA ?>
            <?php if (empty($_SESSION['carrinho']['produto_carrinho'])) : ?>
                <?php if (isset($_GET['finalizado']) && $_GET['finalizado'] == 1) : ?>
                    <p class="compra-sucesso">Compra Realizada com sucesso</p>

                    <?php //SE NÃO, Mostra que o carrinho está VAZIO ?>
                <?php else : ?>
                    <p>O carrinho está vazio.</p>
                <?php endif; ?>

                <?php //SE o CARRINHO NÃO estiver VAZIO mostra os PRODUTOS dentro dele ?>
            <?php else : ?>
                <?php foreach ($_SESSION['carrinho']['produto_carrinho'] as $produtoID => $produto) : ?>
                    <div class="produto-carrinho">
                        <div class="info-produto">
                            <div class="nome">Nome: <?php echo $produto['nome']; ?></div>
                            <div class="preco">Valor: R$ <?php echo $produto['preco']; ?></div>
                            <div class="quantidade">Quantidade: <?php echo $produto['quantidade']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>


                <div>

                <?php //Mostra o TOTAL do carrinho ?>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['carrinho']['produto_carrinho'] as $produtoID => $produto) {
                        $subtotal = $produto['preco'] * $produto['quantidade'];
                        $total += $subtotal;
                    }
                    echo '<h3>Total: R$ ' . $total . '</h3>';
                    ?>
                </div>


            <?php endif; ?>

        </div>

        <?php //BOTÃO para LIMPAR O CARRINHO ?>
        <div class="limpar-carrinho">
            <h3><a href="?limpar_carrinho=true">Limpar Carrinho</a></h3>
        </div>

        <div><?php echo '<br>'; ?></div>

        <?php //BOTÃO para ACESSAR O CARRINHO ?>
        <div class="acessar-carrinho">
            <a href="carrinho.php" class="btn-acessar-carrinho">Acessar Carrinho</a>
        </div>

        <?php //Verifica se o usuario é ADM, se for mostra o botão para INSERIR um novo produto ?>
        <?php if ($_SESSION['adm'] == 1): ?>
            <a href="inserir_produto.php" class="btn-inserir">Inserir Novo Produto</a>
        <?php endif; ?>
    </div>

</body>


</html>