<?php
session_start();
//INCLUE as FUNÇÕES do arquivo functions.php
include "config/functions.php";

// Verificar se o usuário logado é adm ou não
if ($_SESSION['adm'] == 1) {
    // Consulta SQL para obter todos os usuários
    $query = "SELECT * FROM usuario";
    $usuarios = select($query);
?>

<?php //EXIBE os dados do usuario como uma TABELA  ?>
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

    <?php //"SEPARA" os dados do ARRAY $USUARIOS e define os dados separados como $USUARIO , então os mostra com um echo ?>
    <?php foreach ($usuarios as $usuario) { ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nome']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo $usuario['CPF']; ?></td>
            <td><?php echo $usuario['telefone']; ?></td>
            <td><?php echo $usuario['endereco']; ?></td>
            <td>

                 <?php //BOTÕES que REDIRECIONAM para as paginas de EDIÇÃO e EXCLUSÃO dos USUARIOS ?>
                <a href="excluir_usuario.php?id_usuario=<?php echo $usuario['id']; ?>">Excluir</a>
                <a href="edit_usuario.php?id_usuario=<?php echo $usuario['id']; ?>">Editar</a>

            </td>
        </tr>
    <?php } ?>
    <?php //BOTÃO para voltar para a página de REGISTRO do usuario ?>
    <a href="inserir_usuario.php" class="create-user-button">Criar Usuário</a>
</table>

<?php
} else {
    echo "Acesso restrito. Você não possui permissão para visualizar esta página.";
}
?>
