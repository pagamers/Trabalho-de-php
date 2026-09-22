<?php
require_once __DIR__ . "/../Models/SubtareasModel.php";

class SubtarefasController {

    public function home($conexao, $tarea_id = null, $subtarefa_id = null) {
        $model = new SubtareasModel($conexao);
        $subtarefas = $tarea_id ? $model->buscarPorTareaId($tarea_id) : [];
        $subtarefaEditando = $subtarefa_id ? $model->buscarPorId($subtarefa_id) : null;
        return ['subtarefas' => $subtarefas, 'subtarefaEditando' => $subtarefaEditando];
    }

    private function normalizarDados($dados) {
        $dados['completada'] = $dados['completada'] ?? 0;
        return $dados;
    }

    public function criar($conexao) {
        $model = new SubtareasModel($conexao);
        $model->criar($this->normalizarDados($_POST));
        header("Location: index.php?url=subtarefas&tarea_id=" . $_POST['tarea_id']);
        exit;
    }
    public function excluir($conexao, $id) {
        $model = new SubtareasModel($conexao);
        $model->excluir($id);
        header("Location: index.php?url=subtarefas");
        exit;
    }
    public function atualizar($conexao, $id) {
        $model = new SubtareasModel($conexao);
        $model->atualizar($id, $this->normalizarDados($_POST));
        header("Location: index.php?url=subtarefas&tarea_id=" . $_POST['tarea_id']);
        exit;
    }
}
?>