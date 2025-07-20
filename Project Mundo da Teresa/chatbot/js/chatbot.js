
const responses = {
  "Obrigado":"ok, não tem de quer volte sempre",
  "olá": "Sim Oi! Tudo certinho por aí? Como posso te ajudar hoje? 😄",
  "horário de funcionamento": "Nosso horário de funcionamento é das 8h até 18h, de segunda a sábado.",
  "formas de pagamento": "Aceitamos cartões de crédito, débito e Pix.",
  "prazo de entrega": "O prazo de entrega varia entre 3 a 7 dias úteis, dependendo da sua localização.",
  "trocas e devoluções": "Você pode solicitar trocas e devoluções em até 7 dias após o recebimento do produto.",
  "ano criado da loja": "A loja foi criada em 2023 no Capalanga na rua do Hospital.",
};

function normalizar(texto) {
  return texto
    .toLowerCase()
    .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
    .replace(/[^a-z0-9\s]/g, "")
    .replace(/\s+/g, " ")
    .trim();
}

function sendMessage() {
  const inputField = document.getElementById("user-input");
  const userInput = inputField.value;
  const chatBox = document.getElementById("chat-box");

  if (!userInput.trim()) return;

  chatBox.innerHTML += `
    <div style="background:hotpink; padding:15px; margin-left:50%; color:white; border-radius:15px;">
      ${userInput}
    </div>
  `;

  setTimeout(() => {
    const inputNormalizado = normalizar(userInput);
    let resposta = "Desculpe, não entendi. Você pode reformular a pergunta?";

    for (let chave in responses) {
      if (inputNormalizado.includes(normalizar(chave))) {
        resposta = responses[chave];
        break;
      }
    }

    chatBox.innerHTML += `
      <div style="background: rgba(169, 169, 169, 1.400); padding:10px; margin-top: 10px; margin-bottom: 10px; margin-rigth: 75%; color:white; border-radius:15px;">
        ${resposta}
      </div>
    `;
    chatBox.scrollTop = chatBox.scrollHeight;
  }, 500);

  inputField.value = "";
}

function openChat() {
  const chatModal = document.getElementById("chat-modal");
  chatModal.classList.add("show");
  chatModal.style.display = "block"; // garante visibilidade
}

function closeChat() {
  const chatModal = document.getElementById("chat-modal");
  chatModal.classList.remove("show");
  chatModal.style.display = "none";
}


