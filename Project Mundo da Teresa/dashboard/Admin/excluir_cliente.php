<?php
session_start();
require_once '../conexao.php';

// // Verifica se é admin
// if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
//     header("Location: ../../entrar.php");
//     exit();
// }

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do cliente não fornecido.";
    exit();
}

$id = intval($_GET['id']);

try {
    $connect->beginTransaction();

    // 1. Busca todos os pedidos do cliente
    $stmtPedidos = $connect->prepare("SELECT idpedido FROM pedido WHERE idcliente = :id");
    $stmtPedidos->execute([':id' => $id]);
    $pedidos = $stmtPedidos->fetchAll(PDO::FETCH_ASSOC);

    // 2. Exclui os pagamentos dos pedidos
    foreach ($pedidos as $pedido) {
        $idpedido = $pedido['idpedido'];
        $stmtPg = $connect->prepare("DELETE FROM pagamento WHERE idpedido = :idpedido");
        $stmtPg->execute([':idpedido' => $idpedido]);
    }

       // 4. Apaga funcionário, caso o cliente esteja por engano lá
    $stmt = $connect->prepare("DELETE FROM funcionario WHERE idusuario = :id");
    $stmt->execute([':id' => $id]);

    // 3. Exclui os pedidos do cliente
    $stmt = $connect->prepare("DELETE FROM pedido WHERE idcliente = :id");
    $stmt->execute([':id' => $id]);

    // 4. Exclui o cliente
    $stmt = $connect->prepare("DELETE FROM usuario WHERE idusuario = :id");
    $stmt->execute([':id' => $id]);

    $connect->commit();

    header("Location: clientes.php?msg=excluido");
    exit();

} catch (PDOException $e) {
    $connect->rollBack();
    echo "Erro ao excluir cliente: " . $e->getMessage();
}
?>
