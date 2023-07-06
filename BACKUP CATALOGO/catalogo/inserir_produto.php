<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Produtos</title>
</head>
<body>
    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <input type="file" name="imagem">
        <label>Nome:</label>
        <input type="text" name="nome" required />
        <label>preco:</label>
        <input type="text" name="preco" required/>
        <label>descricao:</label>
        <input type="text" name="descricao" required/>
        <label>frete:</label>
        <input type="text" name="frete" required/>
        <label>status:</label>
        <input type="text" name="status" required/>
        <label>categoria:</label>
        <input type="text" name="categoria" required/>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>

<?php
//Essa pagina cria tudo que pode ser visto na pagina inserir_produto.php
//que são as caixas pra completar com informações (LABEL)
//Esses dados são guardados na database através da outra pagina insert.php (que também mostra se a criação de um novo produto funcionou ou não)
?>