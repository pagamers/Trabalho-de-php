
<?php
// LOCAL: app/Controllers/UsuarioController.php

require "app/Models/UsuarioModel.php";

class UsuarioController {

    // Mostra a página única: form (vazio ou preenchido) + lista
    public function home($conexao, $id = null) {
        $model = new UsuarioModel($conexao);
        $usuarios = $model->buscarTodos();
        $usuarioEditando = $id ? $model->buscarPorId($id) : null;
        require "app/Views/usuarios.php";
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