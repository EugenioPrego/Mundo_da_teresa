
<?php
// salvar_email.php
require_once 'conexao.php';

// Permite requisições de qualquer origem (para testes; em produção configure corretamente o CORS)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Apenas aceita POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê os dados enviados em JSON
    $dados = json_decode(file_get_contents("php://input"), true);

    // Pega o e-mail
    $email = $dados['email'];

    // Aqui você poderia salvar o e-mail em um banco de dados
    // Exemplo simples: salvar em um arquivo txt
    file_put_contents('mundodateresa', $email . "\n", FILE_APPEND);

    echo json_encode(['status' => 'sucesso', 'mensagem' => 'E-mail salvo com sucesso']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Método não permitido']);
}
?>
