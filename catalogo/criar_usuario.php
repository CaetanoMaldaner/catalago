<?php
include "config/functions.php";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = sha1($_POST['senha']);
    $cpf = $_POST['CPF'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereço'];

    if(isset($_POST["adm"])) {
        $adm = $_POST["adm"];
    }else {
        $adm = 0;
    }
    

    // Verifica se o email já existe no banco de dados
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = select($query);

    if ($resultado && count($resultado) > 0) {
    echo "Email já cadastrado. Por favor, utilize outro email.";
    } else {
    // Realizar a inserção dos dados no banco de dados
    $query = "INSERT INTO usuario (nome, email, senha, cpf, telefone, endereco, adm) VALUES ('$nome', '$email', '$senha', '$cpf', '$telefone', '$endereco', '$adm')";

    if (insert($query)) {
        echo "Usuário criado com sucesso!";
    } else {
        echo "Não foi possível criar o usuário. Por favor, tente novamente.";
    }
    }

}

?>

