<?php
$host = "localhost";
$db   = "db_organizador";
$user = "root";
$pass = "";
try {
    $conexao = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao abrir a despensa: " . $e->getMessage());
}
?>