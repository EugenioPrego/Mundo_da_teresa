
  document.addEventListener('DOMContentLoaded', function() {
                    const cart = JSON.parse(localStorage.getItem('cart')) || [];
                    const productsContainer = document.getElementById('checkout-products');
                    const totalElement = document.getElementById('checkout-total');

                    let total = 0;

                   cart.forEach(item => {
                      const subtotal = item.price * item.quantity;
                      total += subtotal;

                      const productElement = document.createElement('div');
                      productElement.className = 'product-item';

                      // Criar o elemento de imagem com a tentativa de ../
                      const image = document.createElement('img');
                      image.className = 'product-image';
                      image.src = `../${item.image}`;
                      image.alt = item.name;

                      // E se ../ falhar, tenta ./
                      image.onerror = function () {
                        this.src = `./${item.image}`;
                      };

                      // Para montar a parte textual
                      const info = document.createElement('div');
                      info.className = 'product-info';
                      info.innerHTML = `
                        <h3>${item.name}</h3>
                        <p>Preço unitário: ${formatCurrency(item.price)} KZ</p>
                        <p>Quantidade: ${item.quantity}</p>
                        <p>Subtotal: ${formatCurrency(subtotal)} KZ</p>
                        <p>Fornecedor: ${item.supplier || 'Mundo da Teresa'}</p>
                      `;

                      // Agora juntar tudo de uma vez
                      productElement.appendChild(image);
                      productElement.appendChild(info);
                      productsContainer.appendChild(productElement);
                    });


                    totalElement.textContent = `Total: ${formatCurrency(total)} KZ`;

                    // ⚠️ Armazena o total numérico no localStorage
                    localStorage.setItem('valorTotalCarrinho', total.toFixed(2));

                    function formatCurrency(value) {
                      return value.toFixed(2).replace('.', ',').replace(/\d(?=(\d{3})+,)/g, '$&.');
                    }
                  });

                  