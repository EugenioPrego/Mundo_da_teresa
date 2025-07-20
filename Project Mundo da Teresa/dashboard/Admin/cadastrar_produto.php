
<?php

 session_start();

 require_once '../conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: ../../../../entrar.php");
    exit();
}

$sql = "SELECT COUNT(*) as total FROM usuario";
$consulta = $connect->prepare($sql);
$consulta->execute();
$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
// Armazena o número total de usuários
$totalUsuarios = $resultado['total'] ?? 0;


// Consultar e contar todas as vendas
$sql = "SELECT COUNT(*) AS total FROM venda";
$stmt = $connect->prepare($sql);
$stmt->execute();
$linha = $stmt->fetch(PDO::FETCH_ASSOC); 

$totalVendas = $linha['total'];

$sql = "SELECT COUNT(*) AS total FROM pedido";
$stmt = $connect->prepare($sql);
$stmt->execute();
$linha = $stmt->fetch(PDO::FETCH_ASSOC); 

$totalPedidos = $linha['total'];

$sql = "SELECT COUNT(*) AS total FROM estoque";
$stmt = $connect->prepare($sql);
$stmt->execute();
$linha = $stmt->fetch(PDO::FETCH_ASSOC); 

$totalEstoque = $linha['total'];

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
    <link rel="stylesheet" href="../../dashboard/Admin/css/admin.css">
    <link rel="stylesheet" href="../../dashboard/Admin/css/formulario.css">

    <!--bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="../../js/capturadosdados.js"></script>
    <script defer src="../../js/procurarProdutos.js"></script>
    <script defer src="../../chatbot/js/chatbot.js"></script>
     
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!--title-->
    <title>Mundo da Teresa</title>
     <!-- logotipo do sistema -->
     <link rel="shortcut icon" type="image/icon" href="../../images/logotipos/logo mt.png"/>
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- loader  -->
      <div class="loader_bg">
        <div class="loader"><img src="../../images/loader/loading.gif" alt="#" /></div>
     </div>
<!-- end loader -->

    <div id="fixar" class="grid grid-4">
    <div class="card">
      <span class="material-icons icon">attach_money</span>
      <span class="label">Total de Vendas</span>
      <span class="value"><?php echo $totalVendas; ?></span>
    </div>
    <div class="card">
      <span class="material-icons icon">inventory_2</span>
      <span class="label">Pedidos</span>
      <span class="value"><?php echo $totalPedidos; ?></span>
    </div>
    <div class="card">
      <span class="material-icons icon">person_add</span>
      <span class="label">Novos Clientes</span>
      <span class="value"><?php echo $totalUsuarios; ?></span>
    </div>
    <div class="card">
      <span class="material-icons icon">warning</span>
      <span class="label">Estoque Baixo</span>
      <span class="value"><?php echo $totalEstoque ?></span>
    </div>
  </div> 

<div class="form-container">
    <a href="./admin_dashboard.php"><i style="font-size:5vh;" id="icone-voltar" class="bi bi-arrow-left-short"></i></a> <h2> 🛍️ Cadastrar Novo Produto</h2>
    <form action="./salvar_produto.php" method="POST" enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" required>

        <label>Estoque:</label>
        <input type="number" name="estoque" required>

        <label>Categoria:</label>
        <select name="categoria">
            <option value="Sapatos">Sapatos</option>
            <option value="Roupas Masculinas">Roupas Masculinas</option>
            <option value="Roupas Femininas">Roupas Femininas</option>
            <option value="Roupas Infantis">Roupas Infantis</option>
            <option value="Mochilas e Bolsas">Mochilas e Bolsas</option>
            <!-- Adicione mais conforme necessário -->
        </select>

        <label>Imagem:</label>
        <input type="file" name="imagem" accept="image/*" required>

        <label>Descrição:</label>
        <textarea name="descricao"></textarea>

        <button type="submit">Cadastrar Produto</button>
        </form>
</div>

               <!-- Javascript files-->
        <script src="../../https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>
        <script src="../../js/jquery-3.0.0.min.js"></script>
        <!-- sidebar -->
        <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../../js/custom.js"></script>
</body>
</html>