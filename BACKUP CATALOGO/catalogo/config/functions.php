<?php
//Script que possui todas as FUNÇÕES que serão usadas para outros códigos

function insert($query){
    include "config/db.php";
    if ($connection->query($query)){
        echo "Inserido com sucesso!";
    } else {
        echo "Erro ao tentar inserir!";
    }
}


function update($query){
    include "config/db.php";
    if ($connection->query($query)){
        return true;
    } else {
        return false;
    }
}

function delete($query){
    include "config/db.php";
    if ($connection->query($query)){
        echo "Deletado com sucesso!";
    } else {
        echo "Erro ao tentar deletar o usuário!";
    }
}

function lista($query){
    include "config/db.php";
    return $connection->query($query);
}



function getUsuario($query){
    include "config/db.php";
    return $connection->query($query)->fetch_assoc();
}

?>