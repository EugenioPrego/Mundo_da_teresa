
      function abrirModalPagamento() {
  const carrinho = JSON.parse(localStorage.getItem('cart')) || [];
  const totalProdutos = carrinho.length;

  // Preenche o total de produtos
  document.getElementById('totalProdutos').innerText = totalProdutos;

  // Recupera o total do localStorage
  const valorTotal = parseFloat(localStorage.getItem('valorTotalCarrinho')) || 0;

  // Preenche o campo de valor no formulário
  document.getElementById('valor').value = valorTotal.toFixed(2);

  // Exibe o modal
  document.getElementById('modalPagamento').style.display = 'flex';
}

function fecharModalPagamento() {
  document.getElementById('modalPagamento').style.display = 'none';
}

function finalizarCompra() {
  const valor = document.getElementById('valor').value;
  const metodo = document.getElementById('metodoPagamento').value;

  if (!metodo) {
    alert("Por favor, selecione um método de pagamento.");
    return;
  }

  // Aqui você pode enviar os dados para o backend com AJAX ou redirecionar
  alert(`Pagamento de KZs ${valor} via ${metodo} efetuado com sucesso!`);

  fecharModalPagamento();
  localStorage.removeItem('cart');
  localStorage.removeItem('valorTotalCarrinho');

  window.location.href = '../index.html'; // Redireciona após pagamento
}
