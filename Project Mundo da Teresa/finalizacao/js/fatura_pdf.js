
function gerarFaturaCompleta() {
    try {
        if (!window.jspdf) {
            throw new Error('A biblioteca jsPDF não foi carregada corretamente.');
        }

        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length === 0) {
            Swal.fire("Seu carrinho está vazio");
            return;
        }

        const metodoSelecionado = document.getElementById('metodoPagamento').value;
        if (!metodoSelecionado) {
            Swal.fire("Por favor, selecione um método de pagamento.");
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('p', 'pt', 'a4');
        const formatCurrency = value => parseFloat(value).toFixed(2).replace('.', ',');

        const empresa = {
            nome: "Mundo da Teresa",
            endereco: "Capalanga - Rua do Hospital, Luanda, Angola",
            telefone: "+244 123 456 789 ",
            email: "mundodateresa@gmail.com",
            nif: "5000 123 456"
        };

        const cliente = {
            nome: document.getElementById('nome-cliente')?.value || "Cliente Final",
            nif: document.getElementById('nif-cliente')?.value || "Não fornecido",
            data: new Date().toLocaleDateString('pt-AO'),
            metodoPagamento: metodoSelecionado
        };

        const faturaId = "FAT-" + Math.floor(Math.random() * 1000000);
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        // Cabeçalho
        doc.setFillColor(255, 105, 180);
        doc.rect(0, 0, doc.internal.pageSize.getWidth(), 50, 'F');
        doc.setTextColor(255).setFontSize(20).setFont('helvetica', 'bold');
        doc.text("Mundo da Teresa - Factura", 120, 40);

        doc.setTextColor(0).setFontSize(12).setFont('helvetica', 'normal');
        doc.text(`FATURA Nº: ${faturaId}`, 50, 70);
        doc.text(`Data: ${cliente.data}`, 400, 70, { align: 'right' });

        doc.setFontSize(10).setTextColor(80);
        doc.text(`${empresa.nome}`, 50, 90);
        doc.text(empresa.endereco, 50, 105);
        doc.text(`Tel: ${empresa.telefone} | Email: ${empresa.email}`, 50, 120);
        doc.text(`NIF: ${empresa.nif}`, 50, 135);

        doc.text(`Cliente: ${cliente.nome}`, 350, 90);
        doc.text(`NIF: ${cliente.nif}`, 350, 105);
        doc.text(`Método: ${cliente.metodoPagamento}`, 350, 120);

        doc.autoTable({
            startY: 160,
            head: [['#', 'Descrição', 'Qtd', 'Preço (KZ)', 'Total (KZ)']],
            body: cart.map((item, i) => [
                { content: i + 1 },
                { content: item.name, styles: { textColor: [255, 105, 180] } },
                { content: item.quantity },
                { content: formatCurrency(item.price) },
                { content: formatCurrency(item.price * item.quantity) }
            ]),
            margin: { left: 50, right: 50 },
            styles: { fontSize: 10, cellPadding: 6 },
            headStyles: {
                fillColor: [255, 105, 180],
                textColor: 255,
                fontSize: 11
            }
        });

             // Total e mensagem final
        const finalY = doc.lastAutoTable.finalY + 30;
        doc.setFontSize(12).setFont('helvetica', 'bold');
        doc.text(`Total: ${formatCurrency(total)} KZ`, 400, finalY, { align: 'right' });

        // ✅ Mensagem personalizada no final da fatura
        doc.text("Obrigado pela sua compra!", 50, finalY + 30);
        doc.text("Volte sempre ao Mundo da Teresa!", 50, finalY + 45);
        doc.text("Site: mundodateresa.com | Tel: +244 123 456 789", 50, finalY + 60);


        // Salvar fatura
        doc.save(`fatura-${faturaId}.pdf`);

        // Preenche dados ocultos do formulário
        document.getElementById('dataPagamento').value = new Date().toISOString();
        document.getElementById('valor').value = total.toFixed(2);

        // Envia o formulário
        document.getElementById('pagamentoForm').submit();

        // Limpeza após envio
        setTimeout(() => {
            localStorage.removeItem('cart');
            localStorage.removeItem('valorTotalCarrinho');
            document.getElementById('pagamentoForm').reset();
            document.getElementById('totalProdutos').textContent = '0';
            document.getElementById('modalPagamento').style.display = 'none';
            window.location.href = '../index.html';
        }, 2000);

    } catch (error) {
        console.error('Erro ao finalizar compra:', error);
        Swal.fire("Erro ao finalizar compra: " + error.message);
    }
}
