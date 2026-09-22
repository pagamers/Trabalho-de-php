<?php
require_once __DIR__ . "/../Models/CategoriasModel.php";

class CategoriasController {

    public function home($conexao, $usuario_id = null, $categoria_id = null) {
    $model = new CategoriasModel($conexao);
    $categorias = $model->buscarporusuario($usuario_id ?? 1);
    $categoriaEditando = $categoria_id ? $model->buscarPorId($categoria_id) : null;
    return ['categorias' => $categorias, 'categoriaEditando' => $categoriaEditando];
    }
    public function criar($conexao) {
        $model = new CategoriasModel($conexao);
        $model->criar($_POST);
        header("Location: index.php?url=categorias");
        exit;
    }
    public function excluir($conexao, $id) {
        $model = new CategoriasModel($conexao);
        $model->excluir($id);
        header("Location: index.php?url=categorias");
        exit;
    }
    public function atualizar($conexao, $id) {
        $model = new CategoriasModel($conexao);
        $model->atualizar($id, $_POST);
        header("Location: index.php?url=categorias");
        exit;
    }
}
?>