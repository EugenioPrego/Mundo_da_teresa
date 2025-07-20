<?php


require_once './conexao.php';

$valor = $_POST['valor'] ?? '';
$metodoPagamento = $_POST['metodoPagamento'] ?? '';
$dataPagamento = $_POST['dataPagamento'] ?? '';
$idpedido = 2;

if ($valor && $metodoPagamento && $dataPagamento) {
    $sql = "INSERT INTO pagamento (valor, metodoPagamento, dataPagamento, idpedido)
            VALUES (:valor, :metodoPagamento, :dataPagamento, :idpedido)";

    $stmt = $connect->prepare($sql);
    $sucesso = $stmt->execute([
        ':valor' => $valor,
        ':metodoPagamento' => $metodoPagamento,
        ':dataPagamento' => $dataPagamento,
        ':idpedido' => $idpedido
    ]);

    echo $sucesso ? "✅ Pagamento feito com sucesso." : "❌ Erro ao salvar o pagamento.";
} else {
    echo "⚠️ Dados incompletos.";
}
?>
