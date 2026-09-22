<?php
require_once "../app/Controllers/CategoriasController.php";

$controller = new CategoriasController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
    if (!empty($_POST['id'])) {
        $controller->atualizar($conexao, $_POST['id']);
    } else {
        $controller->criar($conexao);
    }
}

$data = $controller->home($conexao, 1, $_GET['id'] ?? null);
$categorias = $data['categorias'];
$categoriaEditando = $data['categoriaEditando'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Categorias</title>
</head>
<body>
    <h1>Categorias</h1>
    <p>
        <a href="index.php?url=home">Home</a> |
        <a href="index.php?url=usuarios">Usuarios</a> |
        <a href="index.php?url=tareas">Tarefas</a> |
        <a href="index.php?url=subtarefas">Subtarefas</a>
    </p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($categoriaEditando['id'] ?? '') ?>">
        <input type="text" name="nombre" placeholder="Nome" value="<?= htmlspecialchars($categoriaEditando['nombre'] ?? '') ?>" required>        
        <input type="text" name="color" placeholder="Cor" value="<?= htmlspecialchars($categoriaEditando['color'] ?? '') ?>">
        <input type="number" name="usuario_id" value="1" hidden>
        <button type="submit">Criar</button>
    </form>

    <table>
        <tr><th>ID</th><th>Nome</th><th>Cor</th></tr>
        <?php foreach ($categorias ?? [] as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['nombre']) ?></td>
                <td><?= htmlspecialchars($c['color']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
<link rel="stylesheet" href="CSS/style.css">
</html>