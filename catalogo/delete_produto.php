<?php
// Incluir o arquivo de configuração do banco de dados
include "config/functions.php";

// Obter o ID do produto a ser excluído
$id_produto = $_GET['id_produto'];


// Montar a consulta SQL para a exclusão
$query = "DELETE FROM produto WHERE id = '$id_produto'";

// Executar a consulta SQL
if (insert($query)) {
    echo "Não foi possível excluír o produto";
} else {
    echo "Produto excluído com Sucesso";
}

?>