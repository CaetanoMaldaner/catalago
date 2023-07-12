<?php

session_start();

//FINALIZA a SESSÃO
session_unset();

//redireciona para a pagina de LOGIN/REGISTRO
header('location: home.php');
