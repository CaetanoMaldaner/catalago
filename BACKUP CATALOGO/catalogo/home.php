<?php
//Script da pagina inicial

//inclue o script que contem todas as funções e também a conexão com o banco
include "config/functions.php";
include "config/db.php";

// Verificar se a conexão com o banco foi estabelecida com sucesso
if (!$connection) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

//inclue o arquivo que tem todo o código da pagina 
include "home_functions/functions.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Login</title>
    <link rel="stylesheet" href="./assets/style_home.css">
</head>
<body>
    <div class="container">

        <h2>Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Entrar">
        </form>
       
        <a href="inserir_usuario.php" class="btn-registro">Registro</a>

    </div>
</body>
</html>

