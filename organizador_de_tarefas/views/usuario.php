<?php
require_once "../app/Controllers/UsuarioController.php";

$controller = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['email'])) {
    if (!empty($_POST['id'])) {
        $controller->atualizar($conexao, $_POST['id']);
    } else {
        $controller->cadastrar($conexao);
    }
}

$data = $controller->home($conexao, $_GET['id'] ?? null);
$usuarios = $data['usuarios'];
$usuarioEditando = $data['usuarioEditando'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="../public/CSS/style.css">
</head>
<body>
    <h1>Usuários</h1>

    <p>
        <a href="index.php?url=home">Home</a> |
        <a href="index.php?url=categorias">Categorias</a> |
        <a href="index.php?url=tareas">Tarefas</a> |
        <a href="index.php?url=subtarefas">Subtarefas</a> |
    </p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuarioEditando['id'] ?? '') ?>">
        <input type="text" name="nombre" placeholder="Nome" value="<?= htmlspecialchars($usuarioEditando['nombre'] ?? '') ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($usuarioEditando['email'] ?? '') ?>" required>
        <input type="password" name="contrasena" placeholder="Senha" <?= $usuarioEditando ? '' : 'required' ?>>
        <button type="submit"><?= $usuarioEditando ? 'Salvar' : 'Cadastrar' ?></button>
    </form>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['nombre'] ?? '') ?></td>
                <td><?= htmlspecialchars($usuario['email'] ?? '') ?></td>
                <td>
                    <a href="index.php?url=usuarios&id=<?= $usuario['id'] ?>">Editar</a> |
                    <a href="index.php?url=usuarios&id=<?= $usuario['id'] ?>&acao=excluir" onclick="return confirm('Excluir este usuário?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>