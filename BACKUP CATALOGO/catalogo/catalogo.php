<?php
//Pagina principal DA LOJA
include "functions.php";

//realiza uma pesquisa no banco para pegar todos os dados da tabela PRODUTO
$query = "SELECT * FROM produto";

//guarda os resultados da pesquisa na variavel $result e em formato de LISTA 
$result = lista($query);


//guarda o id do usuario da $_SESSION atual na variavel $usuario_id
$usuario_id = $_SESSION["usuario_id"]; 

//Guarda no banco de dados o $usuario_id no campo usuario_id da tabela CARRINHO
$query = "INSERT INTO carrinho (usuario_id) VALUES ('$usuario_id')";
insert($query);

//depois de criar um carrinho para o usuario logado
//pega novamente o carrinho para então usa-lo

//A função mysqli_insert_id($connection) pega esse carrinho
$carrinho_id = mysqli_insert_id($connection);





$produto_id = $_POST["produto_id"]; // ID do produto selecionado
$quantidade = $_POST["quantidade"]; // Quantidade a ser adicionada ao carrinho

//Adiciona na tabela produto_carrinho o ID do produto comprado, a quantidade e em qual carrinho ele foi adicionado 
$query = "INSERT INTO produto_carrinho (produto_id, quantidade, carrinho_id) VALUES ('$produto_id', '$quantidade', '$carrinho_id')";
insert($query);
?>
