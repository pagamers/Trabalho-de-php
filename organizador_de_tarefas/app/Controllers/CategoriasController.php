<?php
require "app/Models/CategoriasModel.php";

class CategoriasController {

    public function home($conexao, $id = null) {
        $model = new CategoriasModel($conexao);
        $categorias = $model->buscarporusuario($id ?? 1);
        $categoriaEditando = null;
        require "app/Views/categorias.php";
    }
    public function criar($conexao) {
        $model = new CategoriasModel($conexao);
        $model->criar($_POST);
        header("Location: index.php?url=categorias");
        exit;
    }
    public function deletar($conexao, $id) {
        $model = new CategoriasModel($conexao);
        $model->deletar($id);
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