<?php
require_once __DIR__ . "/../Models/UsuarioModel.php";

class AuthController {

    public function login($conexao) {
        $model = new UsuarioModel($conexao);
        $usuario = $model->buscarPorEmail($_POST['email'] ?? '');

        if ($usuario && $usuario['contrasena'] === ($_POST['contrasena'] ?? '')) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: index.php?url=home");
            exit;
        }

        header("Location: index.php?url=login&erro=1");
        exit;
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?url=login");
        exit;
    }
}
?>