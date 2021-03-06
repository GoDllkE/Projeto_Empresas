<?php session_start();?>

<html>
    <head>
        <meta charset="UTF-8">

        <!-- Carregando funções JS pré compiladas do Bootstrap/JQuery/JS -->
        <script src="../src/js/popper.js"></script>
        <script src="../src/js/jquery-3.2.1.js"></script>
        <script src="../src/js/bootstrap.js"></script>
        <script src="../src/js/bootstrap.bundle.js"></script>
        
        
        
        <!-- Carregando CSS do Bootstrap  -->
        <link rel="stylesheet" href="../src/css/bootstrap.css" />
        
        <!-- Carregamento do CSS personalizado -->
        <link rel="stylesheet" href="../src/css/Estilo.css" />
        
        <!-- Carregamento do JS personalizado 
        <script src="../src/js/funcoes.js"></script>
        -->
        
    </head>
    <body>
        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">H3F</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- Inclui Regiões ao NavBar -->
                <li class="nav-item">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <font color="white" >Regiões</font>
                    </a>
                    <?php include "./menuRegioes.php";?>
                </li>
                <li class="nav-item">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <font color="white" >Empresas</font>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(!isset($_SESSION['statusLogin']) || $_SESSION['statusLogin']!=1){ ?>
                        <a class="dropdown-item" href="./index.php?codPg=10">Cadastrar</a>
                        <a class="dropdown-item" href="./index.php?codPg=11">Empresas Cadastradas</a>
                        <?php } else { ?>
                        <a class="dropdown-item" href="./index.php?codPg=10">Editar</a>
                        <a class="dropdown-item" href="./index.php?codPg=11">Empresas Cadastradas</a>
                        <?php } ?>
                    </div>
                </li>
                <li class="nav-item">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <font color="white" >Serviços</font>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(isset($_SESSION['statusLogin']) && $_SESSION['statusLogin']==1){ ?>
                        <a class="dropdown-item" href="./index.php?codPg=20">Adicionar</a>
                        <a class="dropdown-item" href="./index.php?codPg=23">Editar serviços</a>
                        <?php } ?>
                        <a class="dropdown-item" href="./index.php?codPg=21">Visualizar serviços</a>
                    </div>
                </li>
              </ul>
                <!-- Verifica se há sessão para definir objeto de exibição -->
              <?php  if(!isset($_SESSION['statusLogin']) || $_SESSION['statusLogin']!=1){ ?>
              <form class="form-inline my-2 my-lg-0">
                  <a href="./index.php?codPg=01">
                    <input type="button" class="btn btn-outline-primary my-2 my-sm-0" value="Login">
                  </a>
                  <a href="./index.php?codPg=10">
                    <input type="button" class="btn btn-outline-info my-2 my-sm-0" value="Cadastrar" style="margin-left: 5px;">
                  </a>
              </form>
              <?php } else { ?>
                <div class="form-inline my-2 my-lg-0">
                    <span class="navbar-text">Logado como: <b><font color="yellow"><a href="./index.php?codPg=12&codEmp=<?=$_SESSION['codigo']?>"><?=$_SESSION['nome'];?></a></font></b></span>
                    <div style="margin-left: 15px;"
                        <form action="./Logoff.php" method="POST" name="FormSair" class="form-inline my-2 my-lg-0">
                            <a href="./Logoff.php">
                                <input type="button" class="btn btn-outline-danger my-2 my-sm-0" value="Sair">
                            </a>
                        </form>
                    </div>
                </div>
              <?php } ?>
            </div>
        </nav>
        <br>
        <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--senão houver a variável codPg, carrega padrão -->
                        <?php if(!isset($_GET['codPg'])) { include "./homeContent.php"; ?>
                        <br>
                        <?php } else {
                                $codPg=$_GET['codPg'];
                                if($codPg==01){ include "./doLogin.php";}
                                else if($codPg==10){ include "./FormEmpresa.php";}
                                else if($codPg==11){ include "./ListaEmpresa.php";}
                                else if($codPg==12){ include "./DetalhesEmpresa.php";}
                                else if($codPg==13 && $_SESSION['statusLogin'] == 1){ include "./FormEditaEmpresa.php";}
                                else if($codPg==13 && $_SESSION['statusLogin'] == 0){ echo "alert('Você precisa estar logado!')"; header("location: ./index.php");}
                                else if($codPg==20 && $_SESSION['statusLogin'] == 1){ include "./FormCadastraServico.php";}
                                else if($codPg==20 && $_SESSION['statusLogin'] == 0){ echo "alert('Você precisa estar logado!')"; header("location: ./index.php");}
                                else if($codPg==21){ include "./ListaServico.php";}
                                else if($codPg==22){ include "./DetalhesServico.php"; }
                                else if($codPg==23 && $_SESSION['statusLogin'] == 1){ include "./FormEditaServico.php";}
                                else if($codPg==23 && $_SESSION['statusLogin'] == 0){ echo "alert('Você precisa estar logado!')"; header("location: ./index.php");}
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
