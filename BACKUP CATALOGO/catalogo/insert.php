<?php 

include 'config/functions.php';

//Cria o insert do produto
//Guarda os dados recebidos nas labels nomeadas entre [" "] nas suas respectivas variaveis 
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$descricao = $_POST["descricao"];
$frete = $_POST["frete"];
$status = $_POST["status"];
$categoria = $_POST["categoria"];

//Guarda o resultado da função insert_image com o parametro $_FILES na variavel $image (para ser utilizado posteriormente)
if($image = insert_image($_FILES)){
    
    //Insere o novo produto no banco de dados completando os respectivos campos com os dados guardados nas variaveis 
    $query = "INSERT INTO produto (nome, preco, descricao, frete, `status`, categoria_id, imagem) VALUES ('$nome', '$preco', '$descricao', '$frete', '$status', '$categoria', '$image')";
    
    //A função insert, que está no arquivo functions.php , insere esses dados no banco , realizando o $query = INSERT acima 
    insert($query);
}else{
    echo "Deu errado!!!"; 
}

//Cria a função insert_image com o parametro $image 
function insert_image($image){
    //Verifica se o arquivo da imagem foi enviado e guardado corretamente 
if ($image['imagem']['error'] === UPLOAD_ERR_OK) {
    //Define onde será guardada essa imagem, no caso, na pasta "imgs"
    $diretorioDestino = 'imgs/';

    //Gera um nome unico para imagem enviada (sinceramente não entendi oq o cris fez, mas esse código muda o nome da img para um nome unico que nunca pode ser repitido)
    $nomeUnico = uniqid() . '.' . pathinfo($image['imagem']['name'], PATHINFO_EXTENSION);

    //Cria e move um arquivo "temporario" (a msm imagem com o nome novo) para a pasta de destino ("imgs")
    //O Código cria um arquivo temporario para não renomear a imagem original, criando assim uma cópia da mesma (com nome unico) e inserindo ela no local desejado
    if (move_uploaded_file($image['imagem']['tmp_name'], $diretorioDestino . $nomeUnico)) {
        //Retorna o nome unico da imagem para o banco e armazena na coluna imagem da tabela produto 
        return $nomeUnico;
    } else {
        echo 'Ocorreu um erro ao mover o arquivo.';
    }
} else {
    echo 'Ocorreu um erro durante o upload do arquivo.';
}
}
?>
