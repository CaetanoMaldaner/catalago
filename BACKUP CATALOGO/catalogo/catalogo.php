<?php
//Pagina principal DA LOJA
session_start();
include "config/functions.php";



//quando finalizar a compra no carrinho.php retorna para o catalogo mostrando a mensagem de compra finalizada
if (isset($_GET['finalizado']) && $_GET['finalizado'] == 1) {
    $_SESSION['carrinho'] = array();
}


if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    $id_usuario = $_SESSION['id_usuario'];
 

    $msql = 'SELECT * FROM carrinho WHERE id_usuario =' .  $id_usuario . ' LIMIT 1';
    $carrinho = existCarrinho($msql);
  
    if($carrinho->num_rows == 1){
       $id_carrinho = $carrinho->fetch_assoc()['id'];
        $_SESSION['carrinho'] = array('id_carrinho' => $id_carrinho);
    }else{
        $id_carrinho = insert("INSERT INTO carrinho (id_usuario) VALUES ($id_usuario)");
       
        $_SESSION['carrinho'] = array('id_carrinho' => $id_carrinho);
    }

}elseif(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho']['id_carrinho'])){
    
        $id_carrinho_existente = $_SESSION['carrinho']['id_carrinho'];
        $id_usuario = $_SESSION['id_usuario'];
        insert("INSERT INTO carrinho (id, id_usuario) VALUES ($id_carrinho_existente, $id_usuario)");    

}elseif(isset($_SESSION['carrinho']) && empty($_SESSION['carrinho']['id_carrinho'])){

    $id_usuario = $_SESSION['id_usuario'];
    $id_carrinho = insert("INSERT INTO carrinho (id_usuario) VALUES ($id_usuario)");
    $_SESSION['carrinho'] = array('id_carrinho' => $id_carrinho);

}


// Verifica se o produto foi adicionado ao carrinho pelo metodo $_GET
if (isset($_GET['adicionar'])) {
    //O id do produto adicionado pelo metodo $_GET fica guardado na variavel $produtoID
    $produtoID = $_GET['adicionar'];

    // Verifica se o produto já existe no carrinho quando for adicionado
    if (isset($_SESSION['carrinho']['produto_carrinho'][$produtoID])) {
       
        // Se o produto já existe, acrescenta + 1 dele 
        $quantidade_carrinho = intval($_SESSION['carrinho']['produto_carrinho'][$produtoID]['quantidade']);
        $quantidade_carrinho += 1;
        $_SESSION['carrinho']['produto_carrinho'][$produtoID]['quantidade'] = $quantidade_carrinho++;
       
        //pega o id do carrinho e a quantidade, guarda nas variaveis para dps fzr o update
        $id_carrinho = $_SESSION['carrinho']['id_carrinho'];
        $quantidade_atual = $_SESSION['carrinho']['produto_carrinho'][$produtoID]['quantidade'];

        // UPDATE da QUANTIDADE de um produto já existente 
        update("UPDATE produto_carrinho SET quantidade_produto = $quantidade_atual WHERE id_carrinho = $id_carrinho AND id_produto = $produtoID ");
    } else {
        // Se o produto não existe, adiciona-o ao carrinho com quantidade 1 
        $_SESSION['carrinho']['produto_carrinho'][$produtoID] = array(

            //guarda no carrinho o nome, preço, sua quantidade e a imagem do produto (a imagem não é mostrada no CARRINHO)
            'nome' => $_GET['nome'],
            'preco' => $_GET['preco'],
            'quantidade' => 1,
            'imagem' => $_GET['imagem']
        );
        $id_carrinho = $_SESSION['carrinho']['id_carrinho'];
        insert("INSERT INTO produto_carrinho (quantidade_produto,id_produto,id_carrinho) VALUES (1, $produtoID, $id_carrinho)");
    }
}



//Códgio para limpar os itens do carrinho
if (isset($_GET['limpar_carrinho']) && $_GET['limpar_carrinho'] === 'true') {
    $id_carrinho = $_SESSION['carrinho']['id_carrinho'];
    $_SESSION['carrinho'] = array();

    $delete = "DELETE FROM produto_carrinho WHERE id_carrinho = $id_carrinho";
    delete($delete);
    header('Location: catalogo.php?carrinho_limpo=1');
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de Produtos</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>

    <div class="catalogo">
        <h1>Catálogo de Produtos</h1>

        <div class="produtos">
            <?php
            //realiza uma pesquisa no banco para pegar todos os dados da tabela PRODUTO
            $query = "SELECT * FROM produto";

            //guarda os resultados da pesquisa na variavel $result e em formato de LISTA 
            $result = lista($query);
            //Verifica se há produtos guardados na variavel $result, se tiver, mostra eles (foi guardado os produtos da DB no $result lá em cima ^)
            if ($result->num_rows > 0) {
                //Cria uma "listagem" para cada um dos produtos que estiverem no $result, por exemplo
                //Pega o produto 1 e adiciona ele, mostrando os dados abaixo, depois segue para o prox produto e faz o msm...
                while ($produto = $result->fetch_assoc()) {
                    //cria um div chamada PRODUTO onde haverá os dados dos produtos, individualmente 
            ?>
                    <div class="produto">
                        <img src="imgs/<?php echo $produto['imagem']; ?>" alt="Imagem do Produto">
                        <div class="nome"><b><?php echo $produto['nome']; ?></b></div>
                        <div class="descricao"><?php echo $produto['descricao']; ?></div>
                        <div class="preco">R$ <?php echo $produto['preco']; ?></div>
                        <a href="?adicionar=<?php echo $produto['id']; ?>&nome=<?php echo urlencode($produto['nome']); ?>&preco=<?php echo $produto['preco']; ?>&imagem=<?php echo $produto['imagem']; ?>" class="btn-adicionar">Adicionar ao Carrinho</a>
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

            <?php if (empty($_SESSION['carrinho']['produto_carrinho'])) : ?>
                <?php if (isset($_GET['finalizado']) && $_GET['finalizado'] == 1) : ?>
                    <p class="compra-sucesso">Compra Realizada com sucesso</p>
                <?php else : ?>
                    <p>O carrinho está vazio.</p>
                <?php endif; ?>
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
        <div class="limpar-carrinho">
            <h3><a href="?limpar_carrinho=true">Limpar Carrinho</a></h3>
        </div>
        <div><?php echo '<br>'; ?></div>
        <div class="acessar-carrinho">
            <a href="carrinho.php" class="btn-acessar-carrinho">Acessar Carrinho</a>
        </div>
    </div>

</body>


</html>