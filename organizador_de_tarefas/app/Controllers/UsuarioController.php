<?php
require_once __DIR__ . "/../Models/UsuarioModel.php";
class UsuarioController {

   public function home($conexao, $id = null) {
    $model = new UsuarioModel($conexao);
    $usuarios = $model->buscarTodos();
    $usuarioEditando = $id ? $model->buscarPorId($id) : null;
    return ['usuarios' => $usuarios, 'usuarioEditando' => $usuarioEditando];
    }
    public function cadastrar($conexao) {
        $model = new UsuarioModel($conexao);
        $model->criar($_POST);
        header("Location: index.php");
        exit;
    }
    public function atualizar($conexao, $id) {
        $model = new UsuarioModel($conexao);
        $model->atualizar($id, $_POST);
        header("Location: index.php");
        exit;
    }
    public function excluir($conexao, $id) {
        $model = new UsuarioModel($conexao);
        $model->excluir($id);
        header("Location: index.php");
        exit;
    }
}
?>