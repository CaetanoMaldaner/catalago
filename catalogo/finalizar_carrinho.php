<?php
include "config/functions.php";
session_start();

//deleta os produtos do carrinho do usuario 

//deleta o carrinho
$id_usuario = $_SESSION['id_usuario'];
$deleteCarrinho = "DELETE FROM carrinho WHERE id_usuario = $id_usuario";
delete($deleteCarrinho);

//deleta os produtos do carrinho
$id_carrinho = $_SESSION['carrinho']['id_carrinho'];
$deleteProdutoCarrinho = "DELETE FROM produto_carrinho WHERE id_carrinho = $id_carrinho";
delete($deleteProdutoCarrinho);

unset($_SESSION['carrinho']); // Remove a variável carrinho da sessão

header('Location: catalogo.php?finalizado=1');
exit;
?>