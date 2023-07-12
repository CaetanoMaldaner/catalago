<?php
// Incluir o arquivo de configuração do banco de dados
include "config/functions.php";

// Obter o ID do produto a ser excluído
$id_usuario = $_GET['id_usuario'];


// Montar a consulta SQL para a exclusão
$query = "DELETE FROM usuario WHERE id = '$id_usuario'";

// Executar a consulta SQL
if (insert($query)) {
    echo "Não foi possível excluír o usuário";
} else {
    echo "Usuário excluído com Sucesso";
}

?>