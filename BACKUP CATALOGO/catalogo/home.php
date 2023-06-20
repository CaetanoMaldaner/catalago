<?php
//Script da pagina inicial

include "db.php";

// Verificar se a conexão foi estabelecida com sucesso
if (!$connection) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}    

include "functions.php";

// Verificar se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os valores do formulário
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta para verificar as credenciais do usuário no banco de dados
    $query = "SELECT * FROM usuario WHERE nome='$username' AND senha='$password'";
    $result = mysqli_query($connection, $query);

    // Verificar se a consulta retornou algum resultado
    if (mysqli_num_rows($result) == 1) {
        // Login bem-sucedido
        echo "Login realizado com sucesso!";
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

