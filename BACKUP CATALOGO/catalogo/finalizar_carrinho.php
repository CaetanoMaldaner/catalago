<?php
include "config/functions.php";
session_start();

//deleta os produtos e o carrinho do banco

//deleta o carrinho
$id_carrinho = $_SESSION['carrinho']['id_carrinho'];
$id_usuario = $_SESSION['id_usuario'];

$delete = "DELETE FROM carrinho WHERE id_usuario = $id_usuario";
delete($delete);


//deleta os produtos do carrinho
$id_carrinho = $_SESSION['carrinho']['id_carrinho'];
$delete = "DELETE FROM produto_carrinho WHERE id_carrinho = $id_carrinho";
delete($delete);

unset($_SESSION['carrinho']); // Remove a variável carrinho da sessão

header('Location: catalogo.php?finalizado=1');
exit;
?>