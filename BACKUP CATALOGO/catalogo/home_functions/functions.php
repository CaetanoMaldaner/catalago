<?php 

//Verifica se o método de requisição usado para acessar a pagina é POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Através do POST pega os dados que o usuario digitar na pagina de login e guarda-os em suas variaveis respectivas

    $email = $_POST["email"];
    $password = sha1($_POST["password"]);

    //Através do query verifica se os dados digitados pelo usuario estão no banco de dados 
    $query = "SELECT * FROM usuario WHERE email='$email' AND senha='$password'";
    //SELECIONE todos os dados DA TABELA usuario ONDE coluna email = $email (variavel que guarda o usuario que foi digitado) 

    //Conecta no banco através da variavel $connection e executa uma pesquisa através da variavel $query 
    //Em seguida guarda esses resultados na variavel $result
    $result = mysqli_query($connection, $query);

    // Verificar se a query recebeu algum resultado
    if (mysqli_num_rows($result) == 1) {
        // Se os dados recebidos estiverem no banco o login é efetuado corretamente
        echo "Login efetuado corretamente!";


    //guarda os dados da pesquisa como um array associativo (MYSQLI_ASSOC) na variavel $result_usuario
       $result_usuario = $result->fetch_array(MYSQLI_ASSOC);

        //inicia uma sessão com os dados do usuario que efetuou o login, guardando na sessão seu ID, NOME e EMAIL
        session_start();
        $_SESSION['id_usuario'] = $result_usuario['id'];
        $_SESSION['nome_usuario'] = $result_usuario['nome'];
        $_SESSION['email_usuario'] = $result_usuario['email'];
        $_SESSION['adm'] = $result_usuario['adm'];



        //manda o usuario para a pagina catalogo.php 
        header("Location: catalogo.php");
 
    } else {
        // Login falhou
        echo "Nome de usuário ou senha incorretos!";
    }
}
