
<?php
session_start();

require_once '../conexao.php';

// // 1. Verificar se é admin logado
// if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
//     header("Location: ../../../../entrar.php");
//     exit();
// }

// 2. Verifica se veio ID do cliente via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do cliente não fornecido.";
    exit();
}

$id = intval($_GET['id']);

// 3. Se for POST, atualiza os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email    = $_POST['email'];

    // Atualiza no banco
    $sqlUpdate = "UPDATE usuario SET nome = :nome, telefone = :telefone, email = :email WHERE idusuario = :id";
    $stmt = $connect->prepare($sqlUpdate);
    $stmt->execute([
        ':nome'     => $nome,
        ':telefone' => $telefone,
        ':email'    => $email,
        ':id'       => $id
    ]);

    // Redireciona de volta para clientes.php
    header("Location: clientes.php");
    exit();
}

// 4. Se for GET, busca os dados do cliente
$sql = "SELECT * FROM usuario WHERE idusuario = :id";
$stmt = $connect->prepare($sql);
$stmt->execute([':id' => $id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

// Se cliente não existir
if (!$cliente) {
    echo "Cliente não encontrado.";
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
<html lang="pt">
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
<body class="container mt-5">

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

      
    <div class="container" style="max-width: 600px; margin-top: 6rem;">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-body p-5">
      <h2 class="mb-4 text-center text-primary fw-bold">
        <i class="bi bi-pencil-square me-2"></i>Editar Cliente
      </h2>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label">👤 Nome completo:</label>
          <input type="text" name="nome" class="form-control form-control-lg rounded-3"
                 value="<?= htmlspecialchars($cliente['nome']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">📧 Email:</label>
          <input type="email" name="email" class="form-control form-control-lg rounded-3"
                 value="<?= htmlspecialchars($cliente['email']) ?>" required>
        </div>

        <div class="mb-4">
          <label class="form-label">📞 Telefone:</label>
          <input type="text" name="telefone" class="form-control form-control-lg rounded-3"
                 value="<?= htmlspecialchars($cliente['telefone'] ?? '') ?>">
        </div>

        <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary btn-lg px-4 rounded-3 shadow-sm">
          💾 Salvar
        </button>
          <a href="clientes.php" class="btn btn-outline-secondary btn-lg px-4 rounded-3">
            ❌ Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
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
