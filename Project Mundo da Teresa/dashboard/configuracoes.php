
<?php

session_start();

require_once 'conexao.php';


$idCliente = $_SESSION['email'];

$stmt = $connect->prepare("SELECT nome, email, telefone, endereco FROM cliente WHERE id = :id");
$stmt->execute([':id' => $idCliente]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Cliente não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- basic -->
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
     <!-- mobile metas -->
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="viewport" content="initial-scale=1, maximum-scale=1">
     
     <!--css-->
    <link rel="stylesheet" href="../dashboard/css/styleprodutos.css">
    <link rel="stylesheet" href="../chatbot/css/styleChatbot.css">
    <link rel="stylesheet" href="../css/stylemodal_carrinho.css">
 
     <!--bootstrap icon-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 
     <!-- javascript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!-- javaScript -->
    <script defer src="../js/capturadosdados.js"></script>
    <script defer src="../js/procurarProdutos.js"></script>
    <script defer src="../chatbot/js/chatbot.js"></script>
    <script defer src="../finalizacao/js/finalizarcompra.js"></script>
    <script defer src="../finalizacao/js/adicionarProduto.js"></script>
    <script defer src="../js/modal_do_produto.js"></script>
    <script defer src="../js/eliminar_produto.js"></script>
    <script defer src="../dashboard/js/finalizar_compra_dashboard.js"></script>
    
     <!--bootstrap css-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
         <!--title-->
     <title>Mundo da Teresa</title>
      <!-- logotipo do sistema -->
      <link rel="shortcut icon" type="image/icon" href="../images/logotipos/logo mt.png"/>
</head>
<body>
          
      <!-- loader  -->
      <div class="loader_bg">
        <div class="loader"><img src="../images/loader/loading.gif" alt="#" /></div>
     </div>
     <!-- end loader -->

      <!-- dashboard -->
    <div class="dashboard">

        <div class="barra-lateral">
            <header>
                <h2 class="store-title">MT</h2>
                <h3 style="margin-left: 2%;">Mundo <br> da Teresa</h3>
            </header>
            <ul>
                <div class="visão">
                    <li><i class="bi bi-truck"></i><a href="../dashboard/meus_pedidos.php"> Meus Pedidos</a></li>
                </div>
                <li><a href=""><i class="bi bi-people"></i> Pagamentos</a></li>
                <li><a href="../dashboard/produtos.php"><i class="bi bi-layout-text-window-reverse"></i> Visualizar Produtos</a></li>
                <li><a href=""><i class="bi bi-cash"></i> Navegação Rápida</a></li> <!-- onde terá as categorias dos produtos -->
                <li><a href=""><i class="bi bi-cash"></i> Bonús</a></li> 
                <li><a href=""><i class="bi bi-cash"></i> Reclamações</a></li> 
               
            </ul>

            <ol>
                <li><a href="../dashboard/configuracoes.php"><i class="bi bi-gear-fill"></i> Configurações</a></li>
                <li><a href="../entrar.php"><i class="bi bi-box-arrow-left"></i> Sair</a></li>
            </ol>
        </div>

        <div class="sub-dashboard">

<div class="usuario">
  <nav class="navbar-usuario">

    <!-- Campo de busca -->
    <div class="barra-pesquisa">
      <input list="opcoes" class="input" type="search" id="search" placeholder="🔍 Procurar produtos">
      <button class="searchButton" type="submit" onclick="filtrarProdutos()">
        <i class="bi bi-search"></i>
      </button>
    </div>

    <!-- Carrinho -->
    <div class="cart-area">
      <a id="cart-icon" href="#">
        <i id="icon3" class="bi bi-cart3"></i>
        <span id="cart-count">0</span>
      </a>
      <ul id="cart-items"></ul>
      <aside id="total">0.00 KZ</aside>
    </div>

    <!-- Saudação e ícones -->
    <div class="acoes-usuario">
      <h5 class="saudacao">Olá, <?php echo htmlspecialchars($nomeUsuario); ?>!</h5>
      <a class="icone-notificacao" href="#">
        <i class="bi bi-bell" id="notificacao"></i>
      </a>
      <figure class="icone-usuario">
        <i class="bi bi-person-circle" id="usuario1"></i>
      </figure>
    </div>

  </nav>
</div>

<!-- estilo do header do usuário -->
<style>
  .usuario {
  width: 100%;
  padding: 10px 20px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.navbar-usuario {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
}

.barra-pesquisa {
  display: flex;
  align-items: center;
  gap: 5px;
}

.barra-pesquisa input.input {
  padding: 8px 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  width: 250px;
  outline: none;
}

.searchButton {
  padding: 8px 12px;
  border: none;
  background-color: #0d6efd;
  color: white;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.searchButton:hover {
  background-color: #0b5ed7;
}

.acoes-usuario {
  display: flex;
  align-items: center;
  gap: 15px;
}

.saudacao {
  margin: 0;
  font-weight: 500;
  font-size: 16px;
}

.icone-notificacao i,
.icone-usuario i {
  font-size: 24px;
  color: #333;
  cursor: pointer;
}

.icone-notificacao i:hover,
.icone-usuario i:hover {
  color: #0d6efd;
}
</style>
<!-- end estilo do header do usuário -->


<h2>Minhas Configurações</h2>
<form action="../salvar_configuracoes.php" method="POST">
  <label>Nome:</label>
  <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required><br>

  <label>Email:</label>
  <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required><br>

  <label>Telefone:</label>
  <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>"><br>

  <button type="submit">Salvar Alterações</button>
</form>

                 <!-- Javascript files-->
        <script src="../https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/jquery-3.0.0.min.js"></script>
        <!-- sidebar -->
        <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../js/custom.js"></script>
</body>
</html>