<?php


//quando finalizar a compra no carrinho.php retorna para o catalogo mostrando a mensagem de compra finalizada
if (isset($_GET['finalizado']) && $_GET['finalizado'] == 1) {
    $_SESSION['carrinho'] = array();
}

// Verificar se há uma mensagem de sucesso na URL
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<p>Produto editado com sucesso!</p>";
}


//Código para verificação se existe um carrinho, no banco ou na sessão

//SE (!)NÃO estiver setado um CARRINHO na sessão OU o array ['carrinho'] na sessão estiver vazio 
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {

    //Pega o id do usuario da SESSÃO e guarda na $id_usuario
    $id_usuario = $_SESSION['id_usuario'];
 
    //executa uma pesquisa para verificar se o usuario logado possui um carrinho no banco
    $msql = 'SELECT * FROM carrinho WHERE id_usuario =' .  $id_usuario . ' LIMIT 1';

    //guarda a FUNÇÃO existCarrinho com o parametro $msql na variavel $carrinho
    $carrinho = existCarrinho($msql);
  

    //SE a variavel $carrinho ao executar a query $msql receber um resultado (numero de colunas = 1)
    if($carrinho->num_rows == 1){

        //guarda o ID recebido da pesquisa na variavel $id_carrinho
       $id_carrinho = $carrinho->fetch_assoc()['id'];

       //define o id_carrinho do array 'carrinho' da sessão, como o resultado recebido e guardado na variavel $id_carrinho
        $_SESSION['carrinho'] = array('id_carrinho' => $id_carrinho);

    //SE NÃO
    }else{
        //guarda na variavel $id_carrinho um insert que insere o id_usuario
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
