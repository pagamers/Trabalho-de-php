<?php
session_start();
require_once __DIR__ . "/../config/conexao.php";
require_once __DIR__ . "/../app/Controllers/AuthController.php";

$url = $_GET['url'] ?? 'home';
$acao = $_GET['acao'] ?? null;
$id = $_GET['id'] ?? null;

// Logout
if ($url === 'logout') {
    (new AuthController())->logout();
}

// Rutas que no necesitan login
$rutasPublicas = ['login', 'usuarios'];

if (!isset($_SESSION['usuario_id']) && !in_array($url, $rutasPublicas)) {
    header("Location: index.php?url=login");
    exit;
}

if( $acao === 'excluir' && $id !== null) {
    switch ($url) {
        case 'tareas':
            require_once __DIR__ . "/../app/Controllers/TarefasController.php";
            (new TarefasController())->excluir($conexao, $id);
            break;
        case 'categorias':
            require_once __DIR__ . "/../app/Controllers/CategoriasController.php";
            (new CategoriasController())->excluir($conexao, $id);
            break;
        case 'subtarefas':
            require_once __DIR__ . "/../app/Controllers/SubtarefasController.php";
            (new SubtarefasController())->excluir($conexao, $id);
            break;
        case 'usuarios':
            require_once __DIR__ . "/../app/Controllers/UsuarioController.php";
            (new UsuarioController())->excluir($conexao, $id);
            break;
        default:
            echo "Ação de exclusão não suportada para esta URL.";
    }
    exit;
}

switch ($url) {
    case 'login':
        require __DIR__ . "/../views/login.php";
        break;
    case 'home':
        require __DIR__ . "/../views/home.php";
        break;
    case 'usuarios':
        require __DIR__ . "/../views/usuario.php";
        break;
    case 'categorias':
        require __DIR__ . "/../views/categorias.php";
        break;
    case 'tareas':
        require __DIR__ . "/../views/tareas.php";
        break;
    case 'subtarefas':
        require __DIR__ . "/../views/subtarefas.php";
        break;
    default:
        echo "Página não encontrada";
}