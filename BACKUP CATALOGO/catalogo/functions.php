<?php
//Script que possui todas as FUNÇÕES que serão usadas para outros códigos 
include 'db.php';



function insert($query){
    global $connection;
    if ($connection->query($query)){
        echo "Inserido com sucesso!";
    } else {
        echo "Erro ao tentar inserir o usuário!";
    }
}



function update($query){
    global $connection;
    if ($connection->query($query)){
        return true;
    } else {
        return false;
    }
}



function delete($query){
    global $connection;
    if ($connection->query($query)){
        echo "Deletado com sucesso!";
    } else {
        echo "Erro ao tentar deletar o usuário!";
    }
}



function lista($query){
    global $connection;
    return $connection->query($query);
}



function getUsuario($query){
    global $connection;
    return $connection->query($query)->fetch_assoc();
}

?>