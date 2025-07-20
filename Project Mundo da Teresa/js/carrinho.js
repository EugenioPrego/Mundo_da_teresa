

const buttons = document.querySelectorAll('.add-to-cart');
const cartItems = document.getElementById('cart-items');
const totalDisplay = document.getElementById('total');
let total = 0;

// Função para atualizar o total
function updateTotal(amount) {
  total += amount;
  totalDisplay.textContent = `Total: KZ ${total.toFixed(2)}`;
}

// Função para salvar carrinho
function saveCart() {
  const cartData = [];
  cartItems.querySelectorAll('li').forEach(item => {
    const name = item.dataset.name;
    const price = parseFloat(item.dataset.price);
    const quantity = parseInt(item.querySelector('.quantity').textContent);
    cartData.push({ name, price, quantity });
  });
  localStorage.setItem('cart', JSON.stringify(cartData));
}

// Função para carregar carrinho
function loadCart() {
  const savedCart = JSON.parse(localStorage.getItem('cart')) || [];
  savedCart.forEach(product => {
    addProductToCart(product.name, product.price, product.quantity);
  });
}

// Função para adicionar produtos ao carrinho
function addProductToCart(name, price, quantity = 1) {
  const cartItem = document.createElement('li');
  cartItem.dataset.name = name;
  cartItem.dataset.price = price;

  cartItem.innerHTML = `
    ${name} - KZ ${price.toFixed(2)} 
    <button class="decrease">-</button>
    <span class="quantity">${quantity}</span>
    <button class="increase">+</button>
    <button class="remove">Remover</button>
  `;

  // Eventos dos botões
  cartItem.querySelector('.increase').addEventListener('click', () => {
    const quantitySpan = cartItem.querySelector('.quantity');
    quantitySpan.textContent = parseInt(quantitySpan.textContent) + 1;
    updateTotal(price);
    saveCart();
  });

  cartItem.querySelector('.decrease').addEventListener('click', () => {
    const quantitySpan = cartItem.querySelector('.quantity');
    const currentQuantity = parseInt(quantitySpan.textContent);
    if (currentQuantity > 1) {
      quantitySpan.textContent = currentQuantity - 1;
      updateTotal(-price);
      saveCart();
    }
  });

  cartItem.querySelector('.remove').addEventListener('click', () => {
    const quantitySpan = cartItem.querySelector('.quantity');
    const quantity = parseInt(quantitySpan.textContent);
    updateTotal(-price * quantity);
    cartItems.removeChild(cartItem);
    saveCart();
  });

  cartItems.appendChild(cartItem);
  saveCart();
}

// Evento de clique nos botões "Adicionar ao Carrinho"
buttons.forEach(button => {
  button.addEventListener('click', (e) => {
    const productCard = e.target.parentElement;
    const name = productCard.dataset.name;
    const price = parseFloat(productCard.dataset.price);
    const stock = parseInt(productCard.dataset.stock);

    // Verifica estoque
    const existingItem = [...cartItems.children].find(item => item.dataset.name === name);
    if (existingItem) {
      const quantitySpan = existingItem.querySelector('.quantity');
      const currentQuantity = parseInt(quantitySpan.textContent);
      if (currentQuantity < stock) {
        quantitySpan.textContent = currentQuantity + 1;
        updateTotal(price);
        saveCart();
      } else {
        alert('Estoque insuficiente!');
      }
    } else {
      addProductToCart(name, price);
    }
  });
});

// Carregar carrinho ao iniciar
loadCart();

// Finalizar compra
document.getElementById('checkout').addEventListener('click', () => {
  alert('Compra finalizada!');
  localStorage.removeItem('cart');
  cartItems.innerHTML = '';
  total = 0;
  updateTotal(0);
});

// Filtro de busca
document.getElementById('search').addEventListener('input', (e) => {
  const searchValue = e.target.value.toLowerCase();
  document.querySelectorAll('.product-card').forEach(card => {
    const name = card.dataset.name.toLowerCase();
    card.style.display = name.includes(searchValue) ? '' : 'none';
  });
});