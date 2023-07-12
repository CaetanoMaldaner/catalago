<?php

if (!defined('HOST')) {
    define('HOST', 'localhost');
}

if (!defined('USER')) {
    define('USER', 'root');
}

if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}

if (!defined('NAME_DATABASE')) {
    define('NAME_DATABASE', 'catalogo');
}

// Verificar se a conexão já foi estabelecida anteriormente
if (!isset($connection)) {
    // CONFIGURAÇÕES DE CONEXÃO COM O BANCO DE DADOS MYSQL
    $connection = mysqli_connect(HOST, USER, PASSWORD, NAME_DATABASE);
}

?>