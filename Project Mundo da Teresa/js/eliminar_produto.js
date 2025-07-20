

 function elimnar_produto(){

     localStorage.removeItem("cart");


     // Limpa a interface do carrinho
     document.querySelector("#cartItems").innerHTML = "";
     document.getElementById("cartTotal").innerText = "Total: 0.00 KZ";

        // Limpa o total do carrinho no cabeçalho
    const totalTopo = document.getElementById("total");
    if (totalTopo) totalTopo.innerText = "0.00 KZ";

    // Zera também o número de itens no ícone do carrinho
    const cartCount = document.getElementById("cart-count");
    if (cartCount) cartCount.innerText = "0";

 }
 

//  function renderizarCarrinho() {
//   const carrinho = JSON.parse(localStorage.getItem('cart')) || [];
//   const container = document.getElementById('cartItems');
//   container.innerHTML = "";

//   carrinho.forEach((item, index) => {
//     const itemDiv = document.createElement('div');
//     itemDiv.className = "cart-item";
//     itemDiv.innerHTML = `
//       <span>${item.name} - ${item.quantity}x - ${item.price.toFixed(2)} KZ</span>
//       <span class="remove-item" data-index="${index}" title="Remover produto">✖</span>
//     `;
//     container.appendChild(itemDiv);
//   });

//   atualizarTotalCarrinho(cart);
//   eliminar_cada_produto(); 
// }

//     function eliminar_cada_produto(){
//         const botoes = document.querySelectorAll(".remove-item");
//   botoes.forEach(btn => {
//     btn.addEventListener("click", function () {
//       const index = parseInt(this.getAttribute("data-index"));
//       let carrinho = JSON.parse(localStorage.getItem("cart")) || [];

//       carrinho.splice(index, 1); // Remove pelo índice
//       localStorage.setItem("cart", JSON.stringify(carrinho));
//       renderizarCarrinho(); // Atualiza a interface
//     });
//   });

//     }

//     function atualizarTotalCarrinho(cart) {
//   const total = carrinho.reduce((soma, item) => soma + item.price * item.quantity, 0);
//   document.getElementById("cartTotal").innerText = `Total: ${total.toFixed(2)} KZ`;

//   const totalTopo = document.getElementById("total");
//   if (totalTopo) totalTopo.innerText = `${total.toFixed(2)} KZ`;

//   const cartCount = document.getElementById("cart-count");
//   if (cartCount) cartCount.innerText = carrinho.length;
  
// }



