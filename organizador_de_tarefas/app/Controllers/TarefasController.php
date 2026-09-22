<?php
require_once __DIR__ . "/../Models/TarefasModel.php";

class TarefasController {

    public function home($conexao, $usuario_id = null, $tarefa_id = null) {
        $model = new TarefasModel($conexao);
        $tarefas = $model->buscarporusuario($usuario_id ?? 1);
        $tarefaEditando = $tarefa_id ? $model->buscarPorId($tarefa_id) : null;
        return ['tarefas' => $tarefas, 'tarefaEditando' => $tarefaEditando];
    }

    private function normalizarDados($dados) {
        $dados['completada'] = $dados['completada'] ?? 0;
        $dados['es_recurrente'] = $dados['es_recurrente'] ?? 0;
        $dados['frecuencia'] = $dados['frecuencia'] ?? '';
        return $dados;
    }

    public function criar($conexao) {
        $model = new TarefasModel($conexao);
        $model->criar($this->normalizarDados($_POST));
        header("Location: index.php?url=tareas");
        exit;
    }
    public function excluir($conexao, $id) {
        $model = new TarefasModel($conexao);
        $model->excluir($id);
        header("Location: index.php?url=tareas");
        exit;
    }
    public function atualizar($conexao, $id) {
        $model = new TarefasModel($conexao);
        $model->atualizar($id, $this->normalizarDados($_POST));
        header("Location: index.php?url=tareas");
        exit;
    }
}
?>