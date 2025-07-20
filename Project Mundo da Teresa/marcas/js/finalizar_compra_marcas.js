


document.addEventListener("DOMContentLoaded", function () {
    let cart = [];
  
    document.querySelectorAll("#btn").forEach(button => {
      button.addEventListener("click", function () {
        let id = this.getAttribute("data-id");
        let name = this.getAttribute("data-name");
        let price = parseFloat(this.getAttribute("data-price"));
        let image = this.getAttribute("data-image");
  
        let existingItem = cart.find(item => item.id === id);
  
        if (existingItem) {
          existingItem.quantity++;
        } else {
          cart.push({ id, name, price, quantity: 1, image });
        }
  
        updateCartModal();
        updateCartCount();
  
        // Alerta funcional: informar ao usuário que o produto foi adicionado
        // alert("O produto foi adicionado ao carrinho com sucesso!");
        // Swal.fire("O Produto " + name + " Foi Adicionado ao Carrinho com Sucesso!");

// 

      });
    });
  
    function updateCartModal() {
      let cartItemsContainer = document.getElementById("cartItems");
      cartItemsContainer.innerHTML = "";
  
      let total = 0;
  
      if (cart.length === 0) {
        cartItemsContainer.innerHTML = "<p>Seu carrinho está vazio.</p>";
      } else {
        cart.forEach(item => {
          let itemElement = document.createElement("div");
          itemElement.classList.add("cart-item");
  
          itemElement.innerHTML = `
            <div style="display: flex; align-items: center; gap: 10px; padding: 5px;">
              <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
              <span>${item.name}</span> 
              <span>${item.price.toFixed(2)} KZs</span> 
              <span>Qtd: ${item.quantity}</span>
            </div>
          `;
  
          cartItemsContainer.appendChild(itemElement);
          total += item.price * item.quantity;
        });
      }
  
      document.getElementById("cartTotal").textContent = `Total: ${total.toFixed(2)} KZs`;
      document.getElementById("total").textContent = `Total: ${total.toFixed(2)} KZs`;
    }
  
    function updateCartCount() {
      let cartCount = document.getElementById("cart-count");
      let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
      cartCount.textContent = totalItems;
    }
  
    document.getElementById("cart-icon").addEventListener("click", function (event) {
      event.preventDefault();
      document.getElementById("cartModal").style.display = "block";
    });
  
    document.querySelector(".close").addEventListener("click", function () {
      document.getElementById("cartModal").style.display = "none";
    });
  
    window.addEventListener("click", function (event) {
      let modal = document.getElementById("cartModal");
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  
    document.getElementById("checkoutButton").addEventListener("click", function () {

   Swal.fire({
  icon: "question",
  title: "Finalizar a Compra",
  text: "Tem certeza de que deseja finalizar sua compra?",
  showCancelButton: true,
  confirmButtonText: "Sim, finalizar",
  cancelButtonText: "Cancelar",
  customClass: {
    icon: 'custom-icon-blue'
  }
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "../finalizacao/finalizar.html";
  } else if (result.isDismissed) {
    // Opcional: alguma ação se cancelar
    console.log("Compra cancelada.");
  }
});


      cart = [];
      updateCartModal();
      updateCartCount();
    });
  });
  

