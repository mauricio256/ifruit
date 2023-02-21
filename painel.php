<?php
    session_start();
    include("php/busca_ordem_servico.php");
    include_once("php/conexao_db.php");

    if( !isset($_SESSION['login']) ):
        header('Location:../php/index.html');
    endif;

    function produto_os($cod_os_fk){
        $conn = conecta();
        $query = $conn->query("SELECT * FROM produto_os WHERE cod_os_fk = $cod_os_fk ");
        if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
            $query->execute();     /// execulta a query
            $conn = NULL;
            return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary
        else:
           return NULL;
        endif; 
    }

    function produto($cod_produto){
        $conn = conecta();
        $query = $conn->query("SELECT descricao FROM produto WHERE cod_produto_pk = $cod_produto");
        if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
            $query->execute();     /// execulta a query
            $conn = NULL;
            return $query->fetch(PDO::FETCH_ASSOC);   ///returna um objeto com  o valor da quary
        else:
           return NULL;
        endif; 
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/676/676422.png">
        <title>ifruit</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
        body{
            background-image: url('img/vinhedo.jpg'); 
            background-size: 100%; 
            background-repeat: no-repeat;
            font-family: 'Open Sans';
            }
            @media only screen and (max-width: 950px) {
                      body{  
                          background-image:url('img/vinhedo_mobile.jpg');   
                      }
                }
        </style>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="painel.php">ifruit</a>
            <!-- Sidebar Toggle-->
            <?php if($_SESSION['login']['funcao'] == "fiscal"):?>
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <?php endif; ?>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item " href="perfil.php">Meu perfil</a></li>
                        <li><a class="dropdown-item " href="painel.php">Menu</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item text-danger" href="php/processa_logout.php">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </nav>









        <!--    ------------------- inicio da condicao de fiscal logado --------------------    -->          
        
        <?php if($_SESSION['login']['funcao'] == "fiscal"):?>
 
        <div id="layoutSidenav" style="height: 800px;">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="painel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Inicio
                            </a>
                            <div class="sb-sidenav-menu-heading">Painel de controle</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Cadastros
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <!-- Button modal casdastros-->
                                    <a class="nav-link" href="cadastro_funcionario.php">Funcionário</a>
                                    <a class="nav-link" href="cadastro_lote.php">Lote</a>
                                    <a class="nav-link" href="cadastro_valvula.php">Válvula</a>
                                    <a class="nav-link" href="cadastro_linha.php">Linha</a>
                                    <a class="nav-link" href="cadastro_ordem_servico.php">Ordem de Serviço</a>
                                    <a class="nav-link" href="cadastro_produto.php">Produto</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                               Relatórios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="#">Funcionário</a>
                                    <a class="nav-link" href="#">Orden de Serviço</a>
                                    <a class="nav-link" href="#">Produto</a>   
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"></div>
                               
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"></div>
                                
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Usuário:</div>
                        <?php print $_SESSION['login']['nome']; print " ".$_SESSION['login']['sobrenome'] ?>
                    </div>
                </nav>
            </div>        
        </div>   
        <footer class="p-4 bg-dark">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; ifruit 2022</div>
                            <div class="text-muted">Desenvolvido por: <a href="#">Friends Academic</a></div>
                        </div>
                    </div>
        </footer>
    </body>
        
    <!-- FIM DA LISTA ORDENS DE SERVIÇO  -->
     
           
    <?php endif; //////////////////////////////////////////// fim da condicao?>

        























    <!-- ---------------- inicio da condicao de TELA DE FUNCIONARIO logado ------- --> 

        <?php if($_SESSION['login']['funcao'] == "usuario"): ?>
           
            <div class="alert-dark p-3 text-center" role="alert">   
                <strong>Usuário: </strong><?php print $_SESSION['login']['nome']; print " ".$_SESSION['login']['sobrenome'] ?>
            </div>

            <a class="float-end m-3" href="painel.php"><img src="https://cdn-icons-png.flaticon.com/512/2267/2267901.png") width="50"></a>
            <div class="container-xl p-lg-3 p-5 mt-5">
                <div class="d-grid gap-2">

                    <!-- Button trigger modal ATIVIDADES -->
                    <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    <img src="img/atividades.png" alt="Imagem responsiva" width="50"><strong>ATIVIDADES </strong> 
                    </button>

                    <!-- Modal -->
            
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-xxl-down" >
                        <div class="modal-content">
                        <div class="modal-header btn btn-info">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Atividades</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            
                            <!-- Impressao dos valores do banco -->
                            <?php if(ordem_servico_atividades($_SESSION['login']['cod_funcionario_pk'])):
                                foreach(ordem_servico_atividades($_SESSION['login']['cod_funcionario_pk']) as $row){ ?> 
                                
                                <div class="col-12">
                                    <div class="card mb-3 bg-light">
                                        <p class="btn btn-warning"> Lote: <?php print $row['cod_lote_fk']; ?> | Válvula: <?php print $row['cod_lote_fk']; ?></p>
                                        <div class="card-body">
                                            <p class="card-text"><strong>OS:</strong><br> <?php print $row['cod_os_pk']; ?></p>
                                            <p class="card-text"><strong>Fiscal:</strong><br> <?php print $row['fiscal']; ?></p>
                                            <p class="card-text"><strong>Conteúdo:</strong><br> <?php print $row['conteudo']; ?></p>
                                            <p class="card-text"><strong>Produtos:</strong></p>

                                            <!-- Impressao de produtos da OS em questao-->
                                            <div class="bg-white">
                                            <?php if(produto_os($row['cod_os_pk'])): ?>
                                                <table class="table">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th scope="col">Descrição</th>
                                                            <th scope="col" class="text-center">Quantidade</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <?php    foreach(produto_os($row['cod_os_pk']) as $row_produtos){ ?>
                                                            <tr>
                                                                <th scope="row"><?php print produto($row_produtos['cod_produto_fk'])['descricao']; ?></th>
                                                                <th scope="row" class="text-center"><?php print $row_produtos['quantidade']; ?></th>
                                                                
                                                            </tr> 
                                                            <?php } else:  print " &nbsp;&nbsp;&nbsp;<em>Não há produtos cadastrados</em>"; endif; ?> 
                                                    </tbody>
                                                </table>
                                            </div><br>  

                                            <p class="card-text"><strong>Meta:</strong> <?php print $row['meta']; ?>
                                            <p class="card-text"><strong>Concluidos:</strong> <?php print $row['colhida']; ?></p>
                                        </div>
                                    </div>
                                </div> 

                            <?php } else:print"<br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nenhum registro encontrado</p>"; endif; ?>
                            <!-- FIM da impressao dos valores do banco -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                    </div>


                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                     <!-- Button trigger modal Pulvarizaçao -->
                     <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    <img src="img/pulverizacao.png" alt="Imagem responsiva" width="50"><strong>PULVERIZAÇÃO</strong> 
                    </button>

                    <!-- Modal -->
            
                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-xxl-down" >
                        <div class="modal-content">
                        <div class="modal-header btn btn-info">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pulverização</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            
                            <!-- Impressao dos valores do banco -->
                            <?php if(ordem_servico_pulverizacao($_SESSION['login']['cod_funcionario_pk'])):
                                foreach(ordem_servico_pulverizacao($_SESSION['login']['cod_funcionario_pk']) as $row){ ?> 
                                
                                 <!-- FIM da impressao de produtos -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <p class="btn btn-warning">Lote: <?php print $row['cod_lote_fk']; ?> | Válvula: <?php print $row['cod_lote_fk']; ?></p>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Fiscal:</strong><br> <?php print $row['fiscal']; ?></p>
                                            <p class="card-text"><strong>Conteúdo:</strong><br> <?php print $row['conteudo']; ?></p>
                                            <p class="card-text"><strong>Produtos:</strong></p>
                                                <!-- Impressao de produtos da OS em questao-->
                                                <div class="bg-white">
                                                    <?php if(produto_os($row['cod_os_pk'])): ?>
                                                    <table class="table">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th scope="col">Descrição</th>
                                                                <th scope="col" class="text-center">Quantidade</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                              <?php  foreach(produto_os($row['cod_os_pk']) as $row_produtos){ ?>
                                                                <tr>
                                                                    <th scope="row"><?php print produto($row_produtos['cod_produto_fk'])['descricao']; ?></th>
                                                                    <th scope="row" class="text-center"><?php print $row_produtos['quantidade']; ?></th>
                                                                    
                                                                </tr> 
                                                                <?php } else:  print " &nbsp;&nbsp;&nbsp;<em>Não há produtos cadastrados</em>"; endif; ?> 
                                                        </tbody>
                                                    </table>
                                                </div><br> 
                                            
                                            <p class="card-text"><strong>Meta:</strong> <?php print $row['meta']; ?>
                                            <p class="card-text"><strong>Concluidos:</strong> <?php print $row['colhida']; ?></p>
                                        </div>
                                    </div>
                                </div>  

                            <?php } else:print"<br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nenhum registro encontrado</p>"; endif;?>
                            <!-- FIM da impressao dos valores do banco -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                    </div>


                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->

                     <!-- Button trigger modal adubacao -->
                     <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                    <img src="img/adubacao.png" alt="Imagem responsiva" width="50"><strong>ADUBAÇÃO</strong> 
                    </button>

                    <!-- Modal -->
            
                    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen-xxl-down" >
                        <div class="modal-content">
                        <div class="modal-header btn btn-info">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Adubação</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            
                            <!-- Impressao dos valores do banco -->
                            <?php if(ordem_servico_adubacao($_SESSION['login']['cod_funcionario_pk'])):
                                foreach(ordem_servico_adubacao($_SESSION['login']['cod_funcionario_pk']) as $row){ ?> 
                                
                                <!-- FIM da impressao de produtos -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <p class="btn btn-warning">Lote: <?php print $row['cod_lote_fk']; ?> | Válvula: <?php print $row['cod_lote_fk']; ?></p>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Fiscal:</strong><br> <?php print $row['fiscal']; ?></p>
                                            <p class="card-text"><strong>Conteúdo:</strong><br> <?php print $row['conteudo']; ?></p>
                                            <p class="card-text"><strong>Produtos:</strong></p>
                                                <!-- Impressao de produtos da OS em questao-->
                                                <div class="bg-white">
                                                <?php if(produto_os($row['cod_os_pk'])): ?>
                                                    <table class="table">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th scope="col">Descrição</th>
                                                                <th scope="col" class="text-center">Quantidade</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            <?php  foreach(produto_os($row['cod_os_pk']) as $row_produtos){ ?>
                                                                <tr>
                                                                    <th scope="row"><?php print produto($row_produtos['cod_produto_fk'])['descricao']; ?></th>
                                                                    <th scope="row" class="text-center"><?php print $row_produtos['quantidade']; ?></th>
                                                                    
                                                                </tr> 
                                                                <?php } else: print " &nbsp;&nbsp;&nbsp;<em>Não há produtos cadastrados</em>"; endif; ?> 
                                                        </tbody>
                                                    </table>
                                                </div><br> 
      
                                            <p class="card-text"><strong>Meta:</strong> <?php print $row['meta']; ?>
                                            <p class="card-text"><strong>Concluidos:</strong> <?php print $row['colhida']; ?></p>
                                        </div>
                                    </div>
                                </div> 

                            <?php } else:print"<br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nenhum registro encontrado</p>"; endif;?>
                            <!-- FIM da impressao dos valores do banco -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br> <br> <br> <br>                 
        <footer class="py-4 mt-5 bg-dark">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; ifruit 2022</div>
                            <div class="text-muted">Desenvolvido por: <a href="#">Friends Academic</a></div>
                        </div>
                    </div>
        </footer>  

               
    <!-- ///////////////////////////////////////////// FIM da condicao de TELA DE FUNCIONARIO logado/////////////////////////////////////////////////////////////////// -->

    <?php endif; ?> 






        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        <script>

            function confirma_deleta() {

                if (confirm("Deseja mesmo DELETAR essa ordem de serviço?")) {

                    return true;

                } else {

                    return false;

                }

            }

    </script>
    </body>
</html>
