<?php
require_once __DIR__ . "/../config/conexao.php";

$url = $_GET['url'] ?? 'home';
$acao = $_GET['acao'] ?? null;
$id = $_GET['id'] ?? null;

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