

<?php
session_start();
require_once 'conexao.php';

$nome = $_POST['nome'] ?? '';
$dataNascimento = $_POST['dataNascimento'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
$rol = 'cliente';

try {
    $sql = "INSERT INTO usuario (nome, dataNascimento, telefone, email, senha, rol)
            VALUES (:nome, :dataNascimento, :telefone, :email, :senha, :rol)";
    $cadastrar = $connect->prepare($sql);

    $cadastrar->execute([
        ':nome' => $nome,
        ':dataNascimento' => $dataNascimento,
        ':telefone' => $telefone,
        ':email' => $email,
        ':senha' => $senhaCriptografada,
        ':rol' => $rol
    ]);

    $_SESSION['nome'] = $nome;

    // Redireciona para o dashboard
    header("Location: ../../.././dashboard/meus_pedidos.php");
    exit();

} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        $_SESSION['erro_cadastro'] = "❌ Este e-mail já está cadastrado! ❌";
    } else {
        $_SESSION['erro_cadastro'] = "❌ Ocorreu um erro ao cadastrar. Tente novamente. ❌";
    }

    // Redireciona de volta para a página de cadastro
    header("Location: ../../../registrar.php");
    exit();
}
?>
