
<?php

require "app/Models/UsuarioModel.php";

class UsuarioController {

    private $usuarioModel;

    public function __construct($conexao) {

        $this->usuarioModel = new UsuarioModel($conexao);

    }

    public function cadastrar($dados) {

        $senha_hash = password_hash($dados['contrasena'], PASSWORD_DEFAULT);

        $dados['contrasena'] = $senha_hash;

        return $this->usuarioModel->criar($dados);
    }

    public function login($email, $senha) {

        $usuario = $this->usuarioModel->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['contrasena'])) {

            return $usuario;
        }
        return null;

    }
    public function deletar_conta($id) {

        return $this->usuarioModel->excluir($id);

    }
    public function buscar_usuario_por_id($id) {

        return $this->usuarioModel->buscarPorId($id);

    }
    public function buscar_todos_usuarios() {

        return $this->usuarioModel->buscarTodos();

    }
    public function actualizar_senha($id, $nova_senha) {

        $usuario = $this->usuarioModel->buscarPorId($id);

        if ($usuario) {

            $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

            $dados = ['contrasena' => $senha_hash];

            return $this->usuarioModel->atualizar($id, $dados);

        }

        return false;

    }
}