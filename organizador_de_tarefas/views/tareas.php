<?php
require_once "../app/Controllers/TarefasController.php";
require_once "../app/Controllers/CategoriasController.php";

$controller = new TarefasController();
$categoriaController = new CategoriasController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
    if (!empty($_POST['id'])) {
        $controller->atualizar($conexao, $_POST['id']);
    } else {
        $controller->criar($conexao);
    }
}

$data = $controller->home($conexao, 1, $_GET['id'] ?? null);
$tarefas = $data['tarefas'];
$tarefaEditando = $data['tarefaEditando'];
$categorias = $categoriaController->home($conexao, 1)['categorias'];
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Tarefas</title>
    <link rel="stylesheet" href="../public/CSS/style.css">
</head>
<body>
    <h1>Tarefas</h1>
    <p>
        <a href="index.php?url=home">Home</a> |
        <a href="index.php?url=usuarios">Usuarios</a> |
        <a href="index.php?url=categorias">Categorias</a> |
        <a href="index.php?url=subtarefas">Subtarefas</a> |
    </p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($tarefaEditando['id'] ?? '') ?>">
        <input type="text" name="titulo" placeholder="Título" value="<?= htmlspecialchars($tarefaEditando['titulo'] ?? '') ?>" required>
        <textarea name="descripcion" placeholder="Descrição"><?= htmlspecialchars($tarefaEditando['descripcion'] ?? '') ?></textarea>

        <select name="categoria_id" required>
            <option value="">Categoria</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= ($tarefaEditando['categoria_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="usuario_id" value="1">
        <input type="date" name="fecha" value="<?= htmlspecialchars($tarefaEditando['fecha'] ?? '') ?>">

        <select name="prioridad">
            <?php $prioridadAtual = $tarefaEditando['prioridad'] ?? 'media'; ?>
            <option value="baja" <?= $prioridadAtual === 'baja' ? 'selected' : '' ?>>Baja</option>
            <option value="media" <?= $prioridadAtual === 'media' ? 'selected' : '' ?>>Media</option>
            <option value="alta" <?= $prioridadAtual === 'alta' ? 'selected' : '' ?>>Alta</option>
        </select>

        <label>
            <input type="checkbox" name="completada" value="1" <?= !empty($tarefaEditando['completada']) ? 'checked' : '' ?>> Completada
        </label>

        <label>
            <input type="checkbox" name="es_recurrente" value="1" <?= !empty($tarefaEditando['es_recurrente']) ? 'checked' : '' ?>> Recorrente
        </label>

        <select name="frecuencia">
            <?php $frecuenciaAtual = $tarefaEditando['frecuencia'] ?? ''; ?>
            <option value="" <?= $frecuenciaAtual === '' ? 'selected' : '' ?>>Sem frequência</option>
            <option value="diaria" <?= $frecuenciaAtual === 'diaria' ? 'selected' : '' ?>>Diária</option>
            <option value="semanal" <?= $frecuenciaAtual === 'semanal' ? 'selected' : '' ?>>Semanal</option>
            <option value="mensal" <?= $frecuenciaAtual === 'mensal' ? 'selected' : '' ?>>Mensal</option>
        </select>

        <button type="submit"><?= $tarefaEditando ? 'Salvar' : 'Criar' ?></button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Fecha</th>
            <th>Completada</th>
            <th>Frecuencia</th>
            <th>Prioridad</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($tarefas as $t): ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= htmlspecialchars($t['titulo']) ?></td>
                <td><?= htmlspecialchars($t['fecha'] ?? '') ?></td>
                <td><?= htmlspecialchars($t['completada'] ?? '') ?></td>
                <td><?= htmlspecialchars($t['frecuencia'] ?? '') ?></td>
                <td><?= htmlspecialchars($t['prioridad'] ?? '') ?></td>
                <td>
                    <a href="index.php?url=tareas&id=<?= $t['id'] ?>">Editar</a> |
                    <a href="index.php?url=tareas&id=<?= $t['id'] ?>&acao=excluir" onclick="return confirm('Excluir esta tarea?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>