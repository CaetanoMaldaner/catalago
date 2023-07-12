<?php
//Script que possui todas as FUNÇÕES que serão usadas para outros códigos

function insert($query){
    include "config/db.php";
    if ($connection->query($query)){
        return mysqli_insert_id($connection);
        $connection->close();
    } else {
        return false;
        $connection->close();
    }
}


function update($query){
    include "config/db.php";
    if ($connection->query($query)){
        return true;
        $connection->close();
    } else {
        return false;
        $connection->close();
    }
}

function delete($query){
    include "config/db.php";
    if ($connection->query($query)){
        return true;
        $connection->close();
    } else {
        return false;
        $connection->close();
    }
}

function lista($query){
    include "config/db.php";
    return $connection->query($query);
    $connection->close();
}



function getUsuario($query){
    include "config/db.php";
    return $connection->query($query)->fetch_assoc();
    $connection->close();
}


function getCarrinho($query){
    include "config/db.php";
    return $connection->query($query)->fetch_assoc();
    $connection->close();
}

function existCarrinho($query){
    include "config/db.php";
    return $connection->query($query);
    $connection->close();
}

function select($query) {
    include "config/db.php";
    $result = $connection->query($query);
    $rows = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    $connection->close();
    return $rows;
}


?>