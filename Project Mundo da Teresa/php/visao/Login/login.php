

<?php

session_start();
require_once 'conexao.php';

$emailLogin = $_POST['email'];
$senhaLogin = $_POST['senha'];

// 1. Tenta fazer login como admin
$sqlAdmin = "SELECT * FROM admin WHERE email = :email";
$stmtAdmin = $connect->prepare($sqlAdmin);
$stmtAdmin->execute([':email' => $emailLogin]);

if ($stmtAdmin->rowCount() > 0) {
    $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

    if (password_verify($senhaLogin, $admin['senha'])) {
        $_SESSION['email'] = $admin['email'];
        $_SESSION['nome']  = $admin['nome'];
        $_SESSION['rol']   = $admin['rol']; // Pode ser admin, superadmin, etc.

        header("Location: ../../../dashboard/Admin/admin_dashboard.php");
        exit();
    }
}

// 2. Tenta fazer login como usuário
$sqlUsuario = "SELECT * FROM usuario WHERE email = :email";
$stmtUsuario = $connect->prepare($sqlUsuario);
$stmtUsuario->execute([':email' => $emailLogin]);

if ($stmtUsuario->rowCount() > 0) {
    $usuario = $stmtUsuario->fetch(PDO::FETCH_ASSOC);

    if (password_verify($senhaLogin, $usuario['senha'])) {
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['nome']  = $usuario['nome'];
        $_SESSION['rol']   = $usuario['rol']; // deve ser "cliente"

        header("Location: ../../.././dashboard/meus_pedidos.php");
        exit();
    }
}

// Se chegou aqui, login falhou
$_SESSION['erro_login'] = "❌ Email ou senha incorretas! ❌";
header("Location: ../../../entrar.php"); // substitua pelo caminho correto da sua tela de login
exit();


?>

