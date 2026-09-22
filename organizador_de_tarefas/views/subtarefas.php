<?php
require_once "../app/Controllers/SubtarefasController.php";
require_once "../app/Controllers/TarefasController.php";

$controller = new SubtarefasController();
$tarefaController = new TarefasController();

$tarefas = $tarefaController->home($conexao, 1)['tarefas'];
$tarea_id = $_GET['tarea_id'] ?? ($tarefas[0]['id'] ?? null);
$subtarefa_id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
    if (!empty($_POST['id'])) {
        $controller->atualizar($conexao, $_POST['id']);
    } else {
        $controller->criar($conexao);
    }
}

$data = $controller->home($conexao, $tarea_id, $subtarefa_id);
$subtarefas = $data['subtarefas'];
$subtarefaEditando = $data['subtarefaEditando'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Subtarefas</title>
    <link rel="stylesheet" href="../public/CSS/style.css">
</head>
<body>
    <h1>Subtarefas</h1>
    <p>
        <a href="index.php?url=home">Home</a> |
        <a href="index.php?url=usuarios">Usuarios</a> |
        <a href="index.php?url=categorias">Categorias</a> |
        <a href="index.php?url=tareas">Tarefas</a>
    </p>

    <?php if (empty($tarefas)): ?>
        <p>Você ainda não tem nenhuma tarefa criada. <a href="index.php?url=tareas">Crie uma tarefa primeiro</a>
    <?php else: ?>
        <form method="GET" style="margin-bottom:20px;">
            <input type="hidden" name="url" value="subtarefas">
            <select name="tarea_id" onchange="this.form.submit()">
                <?php foreach ($tarefas as $t): ?>
                    <option value="<?= $t['id'] ?>" <?= $tarea_id == $t['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['titulo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($subtarefaEditando['id'] ?? '') ?>">
            <input type="hidden" name="tarea_id" value="<?= htmlspecialchars($tarea_id) ?>">
            <input type="text" name="titulo" placeholder="Título" value="<?= htmlspecialchars($subtarefaEditando['titulo'] ?? '') ?>" required>
            <label>
                <input type="checkbox" name="completada" value="1" <?= !empty($subtarefaEditando['completada']) ? 'checked' : '' ?>> Completada
            </label>
            <button type="submit"><?= $subtarefaEditando ? 'Salvar' : 'Criar' ?></button>
        </form>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Completada</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($subtarefas as $s): ?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><?= htmlspecialchars($s['titulo']) ?></td>
                    <td><?= $s['completada'] ? 'Sim' : 'Não' ?></td>
                    <td>
                        <a href="index.php?url=subtarefas&tarea_id=<?= $tarea_id ?>&id=<?= $s['id'] ?>">Editar</a> |
                        <a href="index.php?url=subtarefas&tarea_id=<?= $tarea_id ?>&id=<?= $s['id'] ?>&acao=excluir" onclick="return confirm('Excluir esta subtarefa?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>