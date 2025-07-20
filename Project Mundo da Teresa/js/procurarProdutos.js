

function filtrarProdutos() {
    let input = document.getElementById("search").value.toLowerCase();
    let cards = document.querySelectorAll(".card2");
    let encontrou = false; // Verificar se encontrou algum produto.

    cards.forEach(card => {
        let nomeProduto = card.getAttribute("data-nome").toLowerCase();
        
        if (nomeProduto.includes(input)) {
            card.style.display = "block"; // Exibir o card se corresponder.
            encontrou = true; 
        } else {
            card.style.display = "none"; // Oculta se não corresponder.
        } 
    });

    // Se não encontrou nenhum produto, exibe um swal.fire.
    if (!encontrou) {
        Swal.fire("Produto não encontrado.");
    }
}






