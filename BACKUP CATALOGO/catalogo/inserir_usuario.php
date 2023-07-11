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
        <label>Vendedor:</label>
        <input type="checkbox" name="adm" value="1"/>


        <button type="submit">Enviar</button>
    </form>
</body>
</html>

<?php
//msm código do  inserir_produto.php    :)
?>