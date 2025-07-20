

<!-- 
<!-- <?php
$carrinho_json = $_POST['carrinho_json'];
$carrinho = json_decode($carrinho_json, true);
?>

<h2>Resumo da Compra</h2>

<?php foreach ($carrinho as $item): ?>
  <div class="card">
    <img src="<?= $item['imagem'] ?>" alt="<?= $item['nome'] ?>" width="100">
    <h3><?= $item['nome'] ?></h3>
    <p>Preço: R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>
    <p>Quantidade: <?= $item['quantidade'] ?></p>
  </div>
<?php endforeach; ?>
 --> -->
