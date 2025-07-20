
<?php
session_start();
$erro = '';

if (isset($_SESSION['erro_login'])) {
    $erro = $_SESSION['erro_login'];
    unset($_SESSION['erro_login']);
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
      <link rel="stylesheet" href="css/styleentrar.css">
      <link rel="stylesheet" href="./css/stylemodal_carrinho.css">
      <link rel="stylesheet" href="./chatbot/css/styleChatbot.css">
      <link rel="stylesheet" href="./css/styleexibir_erro.css">
   
       <!--bootstrap icon-->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   
       <!--bootstrap css-->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
       
   <!--title-->
       <title>Mundo da Teresa</title>
       <!-- logotipo do sistema -->
       <link rel="shortcut icon" type="image/icon" href="images/logotipos/logo mt.png"/>
</head>
<body>
     <!-- loader  -->
     <div class="loader_bg">
        <div class="loader"><img src="images/loader/loading.gif" alt="#" /></div>
     </div>
     <!-- end loader -->

 <!-- header -->
 <div class="meu-escopo">
    <div class="row">
        <div class="col6-mx-auto col3-mx-auto col-mx-auto">
            <div class="fixar">
              <div class="telas">
                <div id="atendimento">
                  <div>
                    <i id="icon1" class="bi bi-telephone-fill"></i>
                    <span>944590469</span>
                </div>

                <div class="location">
                  <i class="bi bi-geo-alt-fill"></i>
                  <span>Capalanga na Rua do Hospital</span>
                </div>
                </div>

                  <div>
                      <a href="./entrar.php">Entrar</a>
                  <a href="./registrar.php">Registrar</a>
                  </div>
              </div>
      
              <header>
                <div id="nome-loja">
                  <h2 class="store-title">MT</h2>
                  <h3 >Mundo <br> da Teresa</h3>
                </div>
                <div>
                  <input  class="input" type="search" id="search"   placeholder="  procurar produtos">
                  <button class="searchButton"  type="submit" value="search" onclick="filtrarProdutos()" ><i class="bi bi-search"></i></button>
              </div>
              <nav id="cart">
                <a style="display: flex;" href="#"> 
                    <i id="icon3" class="bi bi-cart3"></i> 
                    <span id="cart-count">0</span> 
                </a>
                <ul id="cart-items"></ul>
                <aside id="total">0.00 KZ</aside>
            </nav>
              </header>
            </div>
    
                <div class="menu">
                    <nav>
                        <div class="categoria">
                            <button class="btncompre"><i style="font-size: 3vh; margin-right: 5%;"  class="bi bi-list"></i> Compre por Categoria </button>
                            <div class="sub-menu">
                              <ul>
                                <li style="border-top: none;"><a href="./categoria/acessorios.html"><i class="fas fa-seedling"></i> Acessórios( Joias,Relógios e óculos)</a></li>
                                    <li><a href="./categoria/roupasmasculinas.html"><i class="fas fa-home"></i> Roupas Masculinas</a></li>
                                    <li><a href="./categoria/roupasfemininas.html"><i class="fas fa-blender"></i> Roupas Femininas</a></li>
                                    <li><a href="./categoria/sapatos.html"><i class="fas fa-couch"></i> Sapatos</a></li>
                                    <li><a href="./categoria/mochilasbolsas.html"><i class="fas fa-suitcase"></i> Mochilas e Bolsas</a></li>
                            </ul>
                            </div>                        
                        </div>

                         <div class="links">
                              <ul>
                                <li><a class="link" href="./index.html">Início</a></li>
                                <li><a  class="link" href="./produtos.html">Todos os Produtos</a></li>
                                <li><a class="link" href="./marcas.html">Marcas</a></li>
                                <li>        
                                  <div class="categoria">
                                    <a class="link" style="cursor: pointer;">Informações </a>
                                    <div style="top: 28px; width: 120%;" class="sub-menu">
                                      <ul style="display: block;">
                                        <li style="border-top: none;"><a href="./informacoes/sobreteresa.html"><i class="fas fa-seedling"></i> Sobre o Mundo da Teresa</a></li>
                                        <li><a href="./informacoes/locaisContatos.html"><i class="fas fa-home"></i> Locais e Contactos</a></li>
                                        <li><a href=""><i class="fas fa-blender"></i> Promoções Ativas</a></li>
                                        <li><a href=""><i class="fas fa-couch"></i> Dúvidas Frequentes</a></li>
                                    </ul>
                                  </div></li>
                              </ul>
                                
                            </div>
                    </nav>
                </div>
                <!-- end header -->


        <!-- mostrar o erro no canto superior da tela  -->
                <?php if (!empty($erro)): ?>
                    <div class="alert-erro">
                        <?= $erro ?>
                    </div>
                <?php endif; ?>
        <!-- end mostrar o erro no canto superior da tela  -->

                <!-- formulário -->
                <div class="formulario">
                        <div class="col6-mx-auto col3-mx-auto col-mx-auto">
                          <form action="./php/visao/Login/login.php" method="post">
                           <figure><i id="icon-person" class="bi bi-person"></i></figure>
                           <div class="sub-formulario">
                            <h2>Entrar</h2>
                            <label for="e-mail">📧 E-mail:</label>
                            <input type="email" placeholder="  digite seu e-mail" name="email" id="email" required>
                            <label for="senha">🔒 Senha:</label>
                            <input type="password" placeholder="  digite sua senha" name="senha" id="senha" required >
                            <button>Entrar</button>
                            <div class="entrar-conta">Não tem uma conta? <a style="color: blue;" href="registrar.php">registrar-se</a></div>
                           </div>
                        </form>
                        </div>
                </div>
                 <!-- end formulário -->
             

                 <script>
                    function toggleSenha() {
                      const inputSenha = document.getElementById('senha');
                      const icon = document.querySelector('.toggle-password');
                      if (inputSenha.type === 'password') {
                        inputSenha.type = 'text';
                        icon.textContent = '👁️'; // Ícone para senha visível
                      } else {
                        inputSenha.type = 'password';
                        icon.textContent = '🙈'; // Ícone para senha oculta
                      }
                    }
                  </script>
                  
                  
<!-- footer -->
<div class="rodapemaximum">

    <footer>

      <section>
        <h3>Mundo da Teresa <br> - Loja online</h3>
        <leg class="text">Encontre os melhores produtos <br> no "Mundo da Teresa" agora Online</leg>
        
        <div>
          <span>Linha direta 24/7 (+244) 953435021</span> 
          <span>Luanda, Angola</span> 
          <span> Seg - Sáb 07H -18H /
                Dom 07H -15H
            <span>
        </div>

      </section>
  
      <section class="links">
        <h3>Menu</h3>

        <span><a href="./index.html">Início</a></span>
        <span><a href="./produtos.html">Todos os produtos</a></span> 
        <span><a href="./marcas.html">Marcas</a></span>
        <span><a style="color: transparent;" >Informações</a></span>
        <span><a style="color: transparent;" >Informações</a></span>
        <span><a style="color: transparent;" >Informações</a></span>
        <span><a style="color: transparent;" >Informações</a></span>

      </section>
  
      <section>
        <h3>Outras Categorias</h3>
        <div class="outras-catrgorias">
          <span><a href="./categoria/roupasinfantis.html">Roupas Infantis</a></span>
          <span><a href="./categoria/botasfemininas.html">Botas Femininas</a></span>
          <span><a href="./categoria/perfumes.html">Perfumes</a></span>
          <span><a style="color: transparent;">Colar</a></span>
          <span><a style="color: transparent;">Chinelos</a></span> 
          <span><a style="color: transparent;">Calções</a></span> 
        </div>
   
      </section>
  
      <section>
        <h3>Boletim de Notícias</h3>

        <span>
          Registre-se agora para receber 
          atualizações sobre <br> promoções 
          e cupons. Não se preocupe! 
          Não enviamos spam
        </span>

        <div class="inscricao">
          
           <input type="text" placeholder="digite seu e-mail">
          <button> <i id="envelope" class="bi bi-envelope"></i> inscrever-se</button>
          
        </div>
      </section>
  
    </footer>
  
    <div class="sub-footer">
      
      <div class="sub2-footer2">
        <h6> &copy;2025 mundo da teresa Online Todos <br> 
          Direitos Reservados
        </h6>

      <figure><img src="images/logotipos/express.png" alt="error...">
        <img src="images/logotipos/multicaixa.jpeg" style="width: 30px;" alt="error...">
      </figure>
      <h4>Multicaixa</h4>
      <h5>fique conectado: 
       <a href="https://www.facebook.com/mundodateresa" target="_blank">
        <i id="icon-redes-sociais" class="bi bi-facebook"></i>
      </a>
       <a href="https://www.instagram.com/mundodateresa" target="_blank">
        <i id="icon-redes-sociais" class="bi bi-instagram"></i>
      </a>

       <a href="https://twitter.com/mundodateresa" target="_blank">
        <i id="icon-redes-sociais" class="bi bi-twitter"></i>
      </a>
      </h5>

      </div>

    </div>

  </div>
   <!-- end footer -->      

  
<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
    <script defer>
// Adicione um atraso para iniciar o carrossel automaticamente após um tempo maior
$('#carouselExampleAutoplaying').carousel({
  interval: 5000 // Atraso de 5 segundos entre os slides
});

// Mostrar o primeiro item de forma suave ao carregar
$('.carousel-item:first').addClass('active');

    </script>

</body>
</html>