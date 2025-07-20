

// Função para abrir o modal com os dados do card
function openProductModal(button) {
  // Obtenha o card correspondente
  const card = button.closest('.card2');

  // Extraia os dados do card
  const nome = card.getAttribute('data-nome');
  const preco = card.getAttribute('data-preco');
  const fornecedor = card.getAttribute('data-fornecedor');
  const imagem = card.getAttribute('data-imagem');

  // Atualize os elementos do modal
  document.getElementById('modal-nome').textContent = nome;
  document.getElementById('modal-preco').textContent = preco;
  document.getElementById('modal-fornecedor').textContent = `Fornecedor: ${fornecedor}`;
  document.getElementById('modal-image').src = imagem;

  // Exiba o modal
  document.getElementById('overlay').style.display = 'block';
  document.getElementById('modal').style.display = 'block';
}

// Função para fechar o modal
function closeModal() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal').style.display = 'none';
}
