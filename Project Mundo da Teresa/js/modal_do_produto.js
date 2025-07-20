         
         
         function openProductModal(imgElement) {
                          const card = imgElement.closest('.card2, .card');

                          const nome = card.dataset.nome;
                          const preco = card.dataset.preco;
                          const fornecedor = card.dataset.fornecedor;
                          const imagem = card.dataset.imagem;
                          const tamanho = card.dataset.tamanho || 'Não informado';
                          const estoque = card.dataset.estoque || 'Indisponível';

                          document.getElementById('modal-image').src = imagem;
                          document.getElementById('modal-nome').textContent = nome;
                          document.getElementById('modal-preco').textContent = `${parseFloat(preco).toLocaleString('pt-AO')} kzs`;
                          document.getElementById('modal-fornecedor').textContent = `Fornecedor: ${fornecedor}`;
                          document.getElementById('tamanho-valor').textContent = tamanho;
                          document.getElementById('estoque-valor').textContent = estoque;

                          document.getElementById('overlay').style.display = 'block';
                          document.getElementById('modal').style.display = 'block';
    }
                      
