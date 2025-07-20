
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

       <!-- gráficos -->
        <div class="grafico">
           <h2 style="margin:5%; text-align: center; "> Gráficos de Vendas - Últimos 7 Dias </h2>

         <div id="sub-grafico" style="display: flex; ">
          <script>
             

      
          </script>

<!-- gráfico 1 -->
              <canvas id="graficoVendas" style="max-width:420px;" > </canvas>

                <canvas id="myChart1" style="max-width:420px;">
                    <script> 
                        const cValues = [50,60,70,80,90,100,110,120,130,140,150];
                        const dValues = [7,8,8,9,9,9,10,11,14,14,15];
        
                        new Chart("myChart1", {
                        type: "line",
                        data: {
                            labels: cValues,
                            datasets: [{
                            fill: true,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: dValues
                            }]
                        },
                        options: {
                            legend: {display: false},
                            scales: {
                            yAxes: [{ticks: {min: 6, max:16}}],
                            }
                        }
                        });
                        </script>
                </canvas> 
                <!-- end gráfico 1 -->

                <!-- gráfico 2 -->
                <canvas id="myChart2" style="max-width:420px;">
                    <script>
                        var aValues = ["Viana", "Km-30", "Icolo-Bengo", "Luanda-Sul", "Caop"];
                        var bValues = [85, 59, 49, 35, 25];
                        var barColors = ["hotpink", "silver","blue","pink","black"];
                        
                        new Chart("myChart2", {
                        type: "bar",
                        data: {
                            labels: aValues,
                            datasets: [{
                            backgroundColor: barColors,
                            data: bValues
                            }]
                        },
                        options: {
                            legend: {display: false},
                            title: {
                            display: true,
                            text: "Locais de Vendas em Luanda"
                            }
                        }
                        });
                    </script>   
                </canvas> 
                <!-- end gráfico 2 -->
                          
                <!-- gráfico 3 -->
                            <script>
            const ctx = document.getElementById('graficoVendas').getContext('2d');
            const graficoVendas = new Chart(ctx, {
              type: 'line',
              data: {
                labels: ['16/05', '17/05', '18/05', '19/05', '20/05', '21/05', '22/05'],
                datasets: [{
                  label: 'Vendas (KZs)',
                  data: [850, 1250, 700, 1900, 2200, 1800, 1800],
                  borderColor: '#2196f3',
                  backgroundColor: 'rgba(33, 150, 243, 0.1)',
                  fill: true,
                  tension: 0.3
                }]
              },
              options: {
                responsive: true,
                plugins: {
                  legend: { display: true },
                  tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                  y: { beginAtZero: true }
                }
              }
            });
          </script>
                <!-- end gráfico 3 -->
               
            </div>
        </div>
         <!-- end gráficos --> 

      <!-- Pedidos -->
  <h2 style="margin:5%">Pedidos Recentes</h2>
  <table border="1">
    <thead>
      <tr>
        <th>Cliente</th>
        <th>Data</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
     <?php
// Obtém os dados da sessão
$nomeUsuario = $_SESSION['nome'] ?? 'Usuário';
$emailUsuario = $_SESSION['email'] ?? 'Não informado';

$sql = "SELECT u.nome, p.dataPedido, p.status 
        FROM pedido p 
        JOIN usuario u ON p.idcliente = u.idusuario 
        ORDER BY p.dataPedido DESC 
        LIMIT 10";

$result = $connect->query($sql);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $statusClass = strtolower($row["status"]);
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
        echo "<td>" . date("d/m/Y", strtotime($row["dataPedido"])) . "</td>";
        echo "<td><span class='status $statusClass'>" . htmlspecialchars($row["status"]) . "</span></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum pedido encontrado.</td></tr>";
}
?>
    </tbody>
  </table>
  <!-- end Pedidos -->

  <!-- Notificações -->
  <h2 style="margin:5%">Notificações</h2>
  <ul style="list-style: none; padding: 0;">
    <li style="background: #fff3cd; border-left: 5px solid #ffeb3b; padding: 10px 15px; margin-bottom: 10px; border-radius: 8px;">
      ⚠️ 3 pedidos estão aguardando pagamento
    </li>
    <li style="background: #f8d7da; border-left: 5px solid #f44336; padding: 10px 15px; margin-bottom: 10px; border-radius: 8px;">
      ❗ 5 produtos estão com estoque abaixo de 5 unidades
    </li>
    <li style="background: #d1ecf1; border-left: 5px solid #2196f3; padding: 10px 15px; margin-bottom: 10px; border-radius: 8px;">
      ✅ Novo cliente cadastrado: Maria Lima
    </li>
  </ul>
  <!-- end Notificações -->

  <h2 style="margin:2%">Atalhos Rápidos</h2>
  <div class="btns">
    <a class="btn" href="./cadastrar_produto.php"><span class="material-icons">add</span> Cadastrar Produto</a>
    <a class="btn" href="#"><span class="material-icons">assessment</span> Atualizar Status</a>
    <a class="btn" href="./clientes.php"><span class="material-icons">people</span> Clientes</a>
    <a class="btn" href="#"><span class="material-icons">people</span> Remover Produtos</a>
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

