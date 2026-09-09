<?php
require_once "../config/conexao.php";
$url = $_GET['url'] ?? 'home';
echo "<h2>Organizador de Tarefas - Sistema Ativo</h2>";
echo "Você solicitou a página: <strong>$url</strong>";