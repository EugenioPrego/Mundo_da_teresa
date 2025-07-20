
<?php
require_once 'conexao.php';
verificarClienteLogado();

$id = $_SESSION['id_cliente'];
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';

try {
    $sql = "UPDATE usuario SET nome = :nome, telefone = :telefone, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':email' => $email,
        ':id' => $id
    ]);

    echo "✅ Dados atualizados com sucesso!";
} catch (PDOException $e) {
    echo "❌ Erro ao atualizar: " . $e->getMessage();
}
