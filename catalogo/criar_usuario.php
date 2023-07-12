<?php

//inclue as funções 
include "config/functions.php";

// Verificar se o formulário foi enviado pelo metodo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // OBTEM os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = sha1($_POST['senha']);
    $cpf = $_POST['CPF'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereço'];

    //verifica se o usuario é ADM , se não for, seta automaticamente como 0 (FALSE)
    //SETA como 0 pois o BANCO não possui campo do tipo BOOLEAN , apenas TINYINT (0 - 1)

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


    //INSERE no BANCO o novo USUARIO
    if (insert($query)) {
        echo "Usuário criado com sucesso!";
    } else {
        echo "Não foi possível criar o usuário. Por favor, tente novamente.";
    }
    }

}

?>

