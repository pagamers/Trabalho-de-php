<?php
require_once "../app/Controllers/CategoriasController.php";

$controller = new CategoriasController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
    $controller->criar($conexao);
}

$categorias = $controller->home($conexao);
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
        <a href="index.php?url=tareas">Tarefas</a>
    </p>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nome" required>
        <input type="text" name="color" placeholder="Cor">
        <input type="number" name="usuario_id" value="1">
        <button type="submit">Criar</button>
    </form>

    <table border="1">
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
</html>