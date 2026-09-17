<?php
require "app/Models/TarefasModel.php";

class TarefasController {

    public function home($conexao, $id = null) {
        $model = new TarefasModel($conexao);
        $tarefas = $model->buscarporusuario($id ?? 1);
        $tarefaEditando = null;
        require "app/Views/tarefas.php";
    }
    public function criar($conexao) {
        $model = new TarefasModel($conexao);
        $model->criar($_POST);
        header("Location: index.php?url=tarefas");
        exit;
    }
    public function deletar($conexao, $id) {
        $model = new TarefasModel($conexao);
        $model->excluir($id);
        header("Location: index.php?url=tarefas");
        exit;
    }
    public function atualizar($conexao, $id) {
        $model = new TarefasModel($conexao);
        $model->atualizar($id, $_POST);
        header("Location: index.php?url=tarefas");
        exit;
    }
}
?>