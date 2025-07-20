
<?php
session_start();

require_once '../conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $descricao = $_POST['descricao'] ?? '';
    $estoque = $_POST['estoque'] ?? 0;
    $categoria = $_POST['categoria'] ?? '';

    // Verificar se a imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['imagem']['tmp_name'];

        // Sanitizar o nome do arquivo
        $imagemNome = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', basename($_FILES['imagem']['name']));

        // Caminho absoluto para salvar no servidor
        $caminhoPasta = __DIR__ . '/../../../../images/produtos/';
        $caminhoFinal = $caminhoPasta . $imagemNome;

        // Caminho salvo no banco (relativo)
        $caminhoRelativoBanco = 'images/produtos/' . $imagemNome;

        // Criar pasta se não existir
        if (!is_dir($caminhoPasta)) {
            mkdir($caminhoPasta, 0777, true);
        }

        // Mover a imagem
        if (move_uploaded_file($imagemTmp, $caminhoFinal)) {
            try {
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $connect->prepare("INSERT INTO produto (nome, preco, descricao, estoque, categoria, imagem, idfornecedor)
                                       VALUES (:nome, :preco, :descricao, :estoque, :categoria, :imagem, :idfornecedor)");

                $stmt->execute([
                    ':nome' => $nome,
                    ':preco' => $preco,
                    ':descricao' => $descricao,
                    ':estoque' => $estoque,
                    ':categoria' => $categoria,
                    ':imagem' => $caminhoRelativoBanco,
                    ':idfornecedor' => 1 // Substitua se você tiver fornecedor
                ]);

                echo "✅ Produto cadastrado com sucesso!";
            } catch (PDOException $e) {
                echo "❌ Erro ao cadastrar produto: " . $e->getMessage();
            }
        } else {
            echo "❌ Erro ao mover a imagem para o destino.";
        }
    } else {
        echo "❌ Imagem não foi enviada corretamente.";
    }
} else {
    echo "❌ Requisição inválida.";
}
?>
