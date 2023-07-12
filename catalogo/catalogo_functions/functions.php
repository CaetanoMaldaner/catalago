<?php


//CÓDIGOS DO MÉTODO $_GET , PARA VERIFICAR SE A COMPRA FOI REALIZADA COM SUCESSO OU SE O PRODUTO FOI EDITADO COM SUCESSO


//quando finalizar a compra no carrinho.php retorna para o catalogo mostrando a mensagem de compra finalizada
if (isset($_GET['finalizado']) && $_GET['finalizado'] == 1) {
    $_SESSION['carrinho'] = array();
}

// Verificar se há uma mensagem de sucesso na URL
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<p>Produto editado com sucesso!</p>";
}



//CÓDIGO PARA VERIFICAÇÃO DO CARRINHO


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

       //resultado da query q foi guardada no $id_carrinho é adicionado em um array 'id_carrinho' que é adicionado no array 'carrinho' da SESSÃO
        $_SESSION['carrinho'] = array('id_carrinho' => $id_carrinho);

    //SE NÃO
    }else{
        //guarda na variavel $id_carrinho um insert que insere o id_usuario
        $id_carrinho = insert("INSERT INTO carrinho (id_usuario) VALUES ($id_usuario)");
       
        //resultado da query q foi guardada no $id_carrinho é adicionado em um array 'id_carrinho' que é adicionado no array 'carrinho' da SESSÃO
        $_SESSION['carrinho'] = array('id_carrinho' => $id_carrinho);
    }

    //SE NÃO SE tiver setado o CARRINHO na sessão e o ID_CARRINHO não estiver vazio
}elseif(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho']['id_carrinho'])){
    
        //guarda o ID_CARRINHO na variavel $id_carrinho_existente
        $id_carrinho_existente = $_SESSION['carrinho']['id_carrinho'];

        //guarda o ID_USUARIO da SESSÃO na variavel $id_usuario
        $id_usuario = $_SESSION['id_usuario'];

        //executa uma QUERY(insert) que insere o id do CARRINHO e do USUARIO no banco
        insert("INSERT INTO carrinho (id, id_usuario) VALUES ($id_carrinho_existente, $id_usuario)");    


    //SE NÃO SE tiver setado o CARRINHO na sessão e o ID_CARRINHO ESTIVER vazio     
}elseif(isset($_SESSION['carrinho']) && empty($_SESSION['carrinho']['id_carrinho'])){

    //guarda o ID_USUARIO da SESSÃO na variavel $id_usuario
    $id_usuario = $_SESSION['id_usuario'];  

    //guarda o RESULTADO da QUERY na variavel $id_carrinho
    //a query INSERT insere o ID_USUARIO da SESSÃO, que foi guardado na variavel $id_usuario, no tabela carrinho na coluna 'id_usuario'
    $id_carrinho = insert("INSERT INTO carrinho (id_usuario) VALUES ($id_usuario)");

    //o ARRAY 'carrinho' recebe o ARRAY 'id_carrinho' que recebe o valor da variavel $id_carrinho 
    $_SESSION['carrinho'] = array('id_carrinho' => $id_carrinho);

}


//CÓDIGO PARA ADICIONAR OS PRODUTOS AO CARRINHO


//Verifica se o produto foi adicionado ao carrinho pelo metodo $_GET
if (isset($_GET['adicionar'])) {
    //O id do produto adicionado pelo metodo $_GET fica guardado na variavel $produtoID
    $produtoID = $_GET['adicionar'];

    //SE o produto já existe no carrinho quando for adicionado
    if (isset($_SESSION['carrinho']['produto_carrinho'][$produtoID])) {
       
        // Se o produto já existe, acrescenta + 1 a ele 
        $quantidade_carrinho = intval($_SESSION['carrinho']['produto_carrinho'][$produtoID]['quantidade']);
        $quantidade_carrinho += 1;
        $_SESSION['carrinho']['produto_carrinho'][$produtoID]['quantidade'] = $quantidade_carrinho++;
       
        //pega o id do carrinho e a quantidade, guarda nas variaveis para dps fzr o update
        $id_carrinho = $_SESSION['carrinho']['id_carrinho'];
        $quantidade_atual = $_SESSION['carrinho']['produto_carrinho'][$produtoID]['quantidade'];

        // UPDATE da QUANTIDADE de um produto já existente  (NO BANCO)
        update("UPDATE produto_carrinho SET quantidade_produto = $quantidade_atual WHERE id_carrinho = $id_carrinho AND id_produto = $produtoID ");

    //SE NÃO 
    } else {
        // Se o produto não existe, adiciona-o ao carrinho com quantidade 1 
        $_SESSION['carrinho']['produto_carrinho'][$produtoID] = array(

            //guarda no carrinho o nome, preço, sua quantidade e a imagem do produto (a imagem não é mostrada no CARRINHO)
            'nome' => $_GET['nome'],
            'preco' => $_GET['preco'],
            'quantidade' => 1,
            'imagem' => $_GET['imagem']
        );

        //guarda o ID_CARRINHO da SESSÃO na variavel $id_carrinho
        $id_carrinho = $_SESSION['carrinho']['id_carrinho'];

        //INSERE o PRODUTO novo na TABELA produto_carrinho, com seus respectivos dados 
        insert("INSERT INTO produto_carrinho (quantidade_produto,id_produto,id_carrinho) VALUES (1, $produtoID, $id_carrinho)");
    }
}


//CÓDIGO PARA LIMPAR ITENS DO CARRINHO


//SE limpar_carrinho E limpar_carrinho = verdadeiro 
if (isset($_GET['limpar_carrinho']) && $_GET['limpar_carrinho'] === 'true') {

    //Guarda o id_carrinho da sessão na variavel
    $id_carrinho = $_SESSION['carrinho']['id_carrinho'];

    //esvazia o ARRAY carrinho da SESSÃO criando um array novo VAZIO
    $_SESSION['carrinho'] = array();


    //Faz uma QUERY que delete DO BANCO os PRODUTOS que estavam no carrinho 
    $delete = "DELETE FROM produto_carrinho WHERE id_carrinho = $id_carrinho";
    delete($delete);

    //direciona o usuario para ?carrinho_limpo=1
    header('Location: catalogo.php?carrinho_limpo=1');
    exit();
}
