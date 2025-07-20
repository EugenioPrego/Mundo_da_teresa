

<?php
require_once 'conexao.php';

// Consulta SQL para contar todas as vendas
$sql = "SELECT COUNT(*) AS total FROM venda";
$resultado = $conexao->query($sql);

// Pegando o número total de vendas
if ($resultado) {
    $linha = $resultado->fetch_assoc();
    echo $linha['total']; // Retorna apenas o número
} else {
    echo "0";
}

?>

