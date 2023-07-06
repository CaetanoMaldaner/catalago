<?php
include 'config/functions.php';

// Guarda os dados recebidos nas labels nomeadas entre [" "] nas suas respectivas variáveis
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = sha1($_POST["senha"]);
$cpf = $_POST["CPF"];
$telefone = $_POST["telefone"];
$endereco = $_POST["endereço"];


// Cria o insert do usuário
$query = "INSERT INTO usuario (nome, email, senha, CPF, telefone, endereco) VALUES ('$nome', '$email', '$senha', '$cpf', '$telefone', '$endereco')";


//INSERE a $QUERY no banco, e faz o INSERT, se for bem sucedido mostra que funcionou, se não, mostra que não :)
if (insert($query)) {
    echo "Registro realizado com sucesso!";
} else {
    echo "Não foi possível realizar o registro do usuário!";
}

?>