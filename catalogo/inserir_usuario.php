<?php 
session_start();

?>

<?php
//Essa pagina cria tudo que pode ser visto na pagina inserir_usuario.php
//que são as caixas pra completar com informações (LABEL)
//Esses dados são guardados na database através da outra pagina insert.php (que também mostra se a criação de um novo produto funcionou ou não)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Produtos</title>
</head>
<body>
    <form method="POST" action="criar_usuario.php" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="nome" required/>
        <label>Email:</label>
        <input type="text" name="email" required/>
        <label>Senha:</label>
        <input type="text" name="senha" required/>
        <label>CPF:</label>
        <input type="text" name="CPF" required/>
        <label>Telefone:</label>
        <input type="text" name="telefone" required/>
        <label>Endereço:</label>
        <input type="text" name="endereço" required/>

        <?php //verifica se o usuario é ADM, SE FOR mostra o checkbox de ADM ?>
        <?php if ($_SESSION['adm'] == 1): ?>

        <label>ADM:</label>
        <input type="checkbox" name="adm" value="1"/>
        
        <?php endif; ?>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
