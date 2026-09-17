<?php
require "app/Models/SubtarefasModel.php";

class SubtarefasController {

    public function home($conexao, $id = null) {
        $model = new SubtareasModel($conexao);
        $subtarefas = $model->buscarporTareaID($id ?? 1);
        $subtarefaEditando = null;
        require "app/Views/subtarefas.php";
    }
    public function criar($conexao) {
        $model = new SubtareasModel($conexao);
        $model->criar($_POST);
        header("Location: index.php?url=subtarefas");
        exit;
    }
    public function deletar($conexao, $id) {
        $model = new SubtareasModel($conexao);
        $model->deletar($id);
        header("Location: index.php?url=subtarefas");
        exit;
    }
    public function atualizar($conexao, $id) {
        $model = new SubtareasModel($conexao);
        $model->atualizar($id, $_POST);
        header("Location: index.php?url=subtarefas");
        exit;
    }
}
?>