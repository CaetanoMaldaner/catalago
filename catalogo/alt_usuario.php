<?php
session_start();
// Incluir o arquivo de configuração do banco de dados
include "config/functions.php";

// Verificar se o usuário logado é adm ou não
if ($_SESSION['adm'] == 1) {
    // Consulta SQL para obter todos os usuários
    $query = "SELECT * FROM usuario";
    $usuarios = select($query);
?>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($usuarios as $usuario) { ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo $usuario['CPF']; ?></td>
            <td><?php echo $usuario['telefone']; ?></td>
            <td><?php echo $usuario['endereco']; ?></td>
            <td>
                <a href="excluir_usuario.php?id_usuario=<?php echo $usuario['id']; ?>">Excluir</a>
                <a href="edit_usuario.php?id_usuario=<?php echo $usuario['id']; ?>">Editar</a>

            </td>
        </tr>
    <?php } ?>
    <a href="inserir_usuario.php" class="create-user-button">Criar Usuário</a>
</table>

<?php
} else {
    echo "Acesso restrito. Você não possui permissão para visualizar esta página.";
}
?>
