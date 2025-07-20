  
 // Função para adicionar ao carrinho
function addToCart(price) {
    const button = event.target;
    const card = button.closest('.card2, .card');
    
    const product = {
        id: card.getAttribute('data-id'),
        name: card.getAttribute('data-nome'),
        price: parseFloat(price),
        image: card.getAttribute('data-imagem'),
        supplier: card.getAttribute('data-fornecedor'),
        quantity: 1
    };
    
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const existingItem = cart.find(item => item.id === product.id);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push(product);
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartUI(); // Presumindo que esta função existe e atualiza o ícone do carrinho, por exemplo

    Swal.fire(name + '<br>' +'<br>' +  "O produto foi adicionado ao carrinho com sucesso!");

}

// Função para atualizar o modal do carrinho
function updateCartModal() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItems = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    
    cartItems.innerHTML = '';
    let total = 0;
    
    cart.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.innerHTML = `
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <img src="${item.image}" alt="${item.name}" width="50" style="margin-right: 10px;">
                <div>
                    <p style="margin: 0; font-weight: bold;">${item.name}</p>
                    <p style="margin: 0;">${item.quantity} × ${formatCurrency(item.price)} KZ</p>
                </div>
            </div>
        `;
        cartItems.appendChild(itemElement);
        total += item.price * item.quantity;
    });
    
    cartTotal.textContent = `Total: ${formatCurrency(total)} KZ`;
}

// Função auxiliar para formatar moeda
function formatCurrency(value) {
    return value.toFixed(2).replace('.', ',').replace(/\d(?=(\d{3})+,)/g, '$&.');
}

// Atualiza o carrinho quando a página carrega
document.addEventListener('DOMContentLoaded', function() {
    updateCartModal();

    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('cartModal').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('cartModal')) {
            document.getElementById('cartModal').style.display = 'none';
        }
    });
});

// Função para abrir o modal do carrinho
function openCartModal() {
    updateCartModal();
    document.getElementById('cartModal').style.display = 'block';
}
