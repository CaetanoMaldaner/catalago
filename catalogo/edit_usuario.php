<?php
session_start();
// Incluir o arquivo de configuração do banco de dados
include "config/functions.php";


// Verificar se o ID do usuário foi fornecido por $_GET
if (isset($_GET['id_usuario'])) {
    // Obter o ID do usuário a ser editado
    $id_usuario = $_GET['id_usuario'];

    // Verificar se o usuário existe no banco de dados
    $query = "SELECT * FROM usuario WHERE id = '$id_usuario'";
    $resultado = select($query);

    if ($resultado && count($resultado) > 0) {
        // Usuário encontrado, retorna os dados do usuario do
        $usuario = $resultado[0];

        // Verificar se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obter os dados do formulário
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = sha1($_POST['senha']);
            $cpf = $_POST['CPF'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereço'];
            $adm = isset($_POST['adm']) ? $_POST['adm'] : 0;

            // Montar a consulta SQL para a atualização
            $query = "UPDATE usuario SET nome = '$nome', email = '$email', senha = '$senha', CPF = '$cpf', telefone = '$telefone', endereco = '$endereco', adm = '$adm' WHERE id = '$id_usuario'";

            // Executar a consulta SQL
            if (update($query)) {
                echo "Usuário editado com sucesso";
            } else {
                echo "Não foi possível editar o usuário";
            }
        }

        // Exibir o formulário para editar os dados do usuário
?>
<form method="POST" action="">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>">

    <label>Email:</label>
    <input type="text" name="email" value="<?php echo $usuario['email']; ?>">

    <label>Senha:</label>
    <input type="text" name="senha" value="<?php echo $usuario['senha']; ?>">

    <label>CPF:</label>
    <input type="text" name="CPF" value="<?php echo $usuario['CPF']; ?>">

    <label>Telefone:</label>
    <input type="text" name="telefone" value="<?php echo $usuario['telefone']; ?>">

    <label>Endereço:</label>
    <input type="text" name="endereço" value="<?php echo $usuario['endereco']; ?>">

    <?php if ($_SESSION['adm'] == 1) { ?>
    <label>ADM:</label>
    <input type="checkbox" name="adm" value="1" <?php if ($usuario['adm'] == 1) echo "checked"; ?>>
    <?php } ?>

    <input type="submit" value="Salvar">
</form>
<?php
    } else {
        echo "Usuário não encontrado";
    }
} else {
    echo "ID do usuário não fornecido";
}
?>
