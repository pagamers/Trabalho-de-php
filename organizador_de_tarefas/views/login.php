<?php
require_once "../app/Controllers/AuthController.php";
$controller = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $controller->login($conexao);
}

$erro = isset($_GET['erro']);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../public/CSS/style.css">
</head>
<body>
    <h1>Login</h1>

    <?php if ($erro): ?>
        <p style="color:red;">Email ou senha incorretos.</p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="contrasena" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="index.php?url=usuarios">Cadastre-se</a></p>
</body>
</html>