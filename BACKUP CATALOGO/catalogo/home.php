<?php
//Script da pagina inicial

//inclue o script que contem todas as funções e que contem também a conexão com o banco
include "functions.php";

// Verificar se a conexão com o banco foi estabelecida com sucesso
if (!$connection) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}


//Verifica se o método de requisição usado para acessar a pagina é POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Através do POST pega os dados que o usuario digitar na pagina de login e guarda-os em suas variaveis respectivas

    $username = $_POST["username"];
    $password = $_POST["password"];

    //Através do query verifica se os dados digitados pelo usuario estão no banco de dados 
    $query = "SELECT * FROM usuario WHERE nome='$username' AND senha='$password'";
    //SELECINE todos os dados DA TABELA usuario ONDE coluna nome = $username (variavel que guarda o usuario que foi digitado) 

    //Conecta no banco através da variavel $connection e executa uma pesquisa através da variavel $query 
    //Em seguida guarda esses resultados na variavel $result
    $result = mysqli_query($connection, $query);




    // Verificar se a query recebeu algum resultado
    if (mysqli_num_rows($result) == 1) {
        // Se os dados recebidos estiverem no banco o login é efetuado corretamente
        echo "Login efetuado corretamente!";

        //header para direcionar o usuario para a loja (catalogo.php)
        header("Location: catalogo.php");

        //Finaliza o script home.php após redirecionar o usuario ao catalogo.php
        exit(); 

    } else {
        // Login falhou
        echo "Nome de usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container label,
        .container input[type="text"],
        .container input[type="password"],
        .container input[type="submit"] {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        .container input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>

