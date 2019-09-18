<?php

require_once("class/conexao.php");
if(!isset($_SESSION))
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Boa Oferta</title>
    <meta charset="utf-8">
    <!-- os 3 scrips abaixo são necessários por conta do carousel da página index -->
    <script src="js/jquery_3_3_1.js"></script>
    <script src="js/popper_1_14_7.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <nav style="background: #fd7e14;">
        <div class="row" style="width: 100%;">
            <div class="col-1"></div>
            <div class="col-2">
                <img src="imagens/logo.png" id="logo" class="mt-4 mb-4">
            </div>
            <div class="col-1"></div>
            <div class="col-5 mt-4">
                <form>
                    <div class="input-group mb-4 mt-3" style="width: 90%;">
                        <input type="search" class="form-control" style="padding: 4%;"
                        placeholder="Busque por um alimento, produto, etc..." aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn-outline-secondary" id="buscar" type="button" id="button-addon2"
                            value="buscar">Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--toda essa div é para o Login -->
        
        <div class="col-3 mt-3">
          
            <?php
            if(isset($_SESSION['usuario'])) {  
                ?>     
                <div id="caixaLogin" style="width: 75%;">
                    <a href="class/logout.php">
                       <button id="botaoLogin">Logout</button>
                   </a>
                   <?php 
                   $usuario = $_SESSION['usuario'];
                   $sql = "select nome_completo from usuarios where email = '$usuario' ;";
                   $resultado = $conexao->query($sql) OR trigger_error($conexao->error, E_USER_ERROR);
                   while($consulta = $resultado->fetch_object()){
                    ?>
                    <p style="color: black; text-align: center;">
                        Olá 
                        <?php
                        echo utf8_encode($consulta->nome_completo);
                        ?>
                        
                    </p>
                    <?php
                }
                ?>
                <?php
            }else{
                ?>     
                <div id="caixaLogin">
                    <a href="telaLogin.php">
                        <button onclick="document.getElementById('id01').style.display='block'" id="botaoLogin">Login</button>    
                    </a>
                    
                    <div class="form-group">
                      <a href="cadastro.php" class="ForgetPwd" style="color: black; margin-left: 28%;">Cadastrar-se</a>
                  </div>
              <?php    } ?>
          </div>
      </div>
  </div>
  <div class="row" id="menu">
    <a href="index.php" class="col-2" id="itemMenu"><h5>Home</h5></a>


    <a href="Categorias.php" style="text-decoration: none;">
        <div class="dropdown col-2" id="itemMenu">
            <h5 style="color: white;">Categorias</h5>
            <div class="dropdown-content">
                <a href="#"><h6>Link 1</h6></a>
                <a href="#"><h6>Link 2</h6></a>
                <a href="#"><h6>Link 3</h6></a>
            </div>
        </div>
    </a>
    

    <a href="cadastroProduto.php" class="col-2" id="itemMenu"><h5>Cadastrar Produto</h5></a>
    <a href="maisRecentes.php" class="col-2" id="itemMenu"><h5>Mais Recentes</h5></a>
    <a href="suporte.php" class="col-2" id="itemMenu"><h5>Suporte Técnico</h5></a>
    <a href="seuPerfil.php" class="col-2" id="itemMenu"><h5>Seu Perfil</h5></a>
</div>
</nav>
</head>
<body style="background: #f8f9fa">