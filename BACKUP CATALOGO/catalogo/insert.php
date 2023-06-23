<?php 
include 'config/functions.php';
// criar o insert do produto
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$descricao = $_POST["descricao"];
$frete = $_POST["frete"];
$status = $_POST["status"];
$categoria = $_POST["categoria"];

if($image = insert_image($_FILES)){
    
    $query = "INSERT INTO produto (nome, preco, descricao, frete, `status`, categoria_id, imagem) VALUES ('$nome', '$preco', '$descricao', '$frete', '$status', '$categoria', '$image')";
    
    insert($query);
}else{
    echo "FUDEOO!!!";
}


function insert_image($image){
    // Verifica se o arquivo foi enviado corretamente
if ($image['imagem']['error'] === UPLOAD_ERR_OK) {
    // Define o diretório de destino
    $diretorioDestino = 'imgs/';

    // Gera um nome único para a imagem
    $nomeUnico = uniqid() . '.' . pathinfo($image['imagem']['name'], PATHINFO_EXTENSION);

    // Move o arquivo temporário para o diretório de destino com o novo nome
    if (move_uploaded_file($image['imagem']['tmp_name'], $diretorioDestino . $nomeUnico)) {
        // Armazene o nome único da imagem no banco de dados
        return $nomeUnico;
    } else {
        echo 'Ocorreu um erro ao mover o arquivo.';
    }
} else {
    echo 'Ocorreu um erro durante o upload do arquivo.';
}
}
?>
