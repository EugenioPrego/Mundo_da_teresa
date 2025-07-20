<?php

require_once 'conexao.php';

$nome = 'Administrador';
$email = 'admin@site.com';
$senha = 'admin123';
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (nome, email, senha, rol) VALUES (?, ?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->execute([$nome, $email, $senhaHash, 'admin']);

echo "Admin cadastrado com sucesso!";

?>