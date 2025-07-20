


function usuarioEstaLogado() {
    // Exemplo de verificação: token no localStorage ou sessão
    return localStorage.getItem('usuario_logado') === 'true';
}
function verificarLoginAntesDeComprar(preco) {
    if (usuarioEstaLogado()) {
        addToCart(preco); // função existente
    } else {
        alert('Você precisa estar logado para comprar!');
        window.location.href = './registrar.php'; // ou /login, conforme sua rota
    }
}

