<?php

//Script que conecta o BANCO DE DADOS com outros scripts atraves de um include "db.php"

// Variável do tipo Constante
define("HOST", 'localhost');
define("USER", 'root');
define("PASSWORD", '');
define("NAME_DATABASE", 'catalogo');

// CONFIGURAÇÕES DE CONEXÃO COM O BANCO DE DADOS MYSQL
$connection = mysqli_connect(HOST, USER, PASSWORD, NAME_DATABASE);


?>