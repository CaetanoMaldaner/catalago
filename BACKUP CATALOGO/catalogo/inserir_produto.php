<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <input type="file" name="imagem">
        <label>Nome:</label>
        <input type="text" name="nome" />
        <label>preco:</label>
        <input type="text" name="preco" />
        <label>descricao:</label>
        <input type="text" name="descricao" />
        <label>frete:</label>
        <input type="text" name="frete" />
        <label>status:</label>
        <input type="text" name="status" />
        <label>categoria:</label>
        <input type="text" name="categoria" />

        <button type="submit">Enviar</button>
    </form>
</body>
</html>