<?php
require_once "../config/conexao.php";

$url = $_GET['url'] ?? 'home';

switch ($url) {
    case 'home':
        require "../app/Views/home.php";
        break;
    case 'usuarios':
        require "../app/Views/usuarios.php";
        break;
    case 'categorias':
        require "../app/Views/categorias.php";
        break;
    case 'tareas':
        require "../app/Views/tareas.php";
        break;
    default:
        echo "Página não encontrada";
}