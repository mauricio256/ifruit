<?php
    session_start();
    include("php/busca_ordem_servico.php");

    if( !isset($_SESSION['login']) ):
        header('Location:../php/index.html');
    endif;
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





















        <?php if($_SESSION['login']['funcao'] == "fiscal"): /////////////// inicio da condicao de fiscal logado/////////////////////////?>

        <div id="layoutSidenav">
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
                                    <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#cadastro_Funcionario">Funcionário</a>
                                    <a class="nav-link" href="#">Lotes</a>
                                    <a class="nav-link" href="#">Válvulas</a>
                                    <a class="nav-link" href="#">Linhas</a>
                                    <a class="nav-link" href="#">Ordens de Serviços</a>
                                    <a class="nav-link" href="#">Produtos</a>
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
            <div id="layoutSidenav_content">
                    <!-- ---------------------Modal formulario de cadastro de funcionario -->
                    
                    <div class="modal fade bg-light" id="cadastro_Funcionario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h1 class="modal-title fs-5 text-center" id="exampleModalLabel"></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body m-5 p-5 bg-light"> 
                            <h2>Cadastro de funcionário</h2><hr><br>

                            <div class="col-md-6">
                                <form action="" enctype="multipart/form-data" method="POST" onsubmit="move()">
                                    <div class="alert" role="alert">
                                        <img id="output" src='img/upload.png') class="img-fluid" width="100px" height="100px">
                    
                                    </div>  
                                    <div class="mb-3">
                                        <input class="form-control" type="file" name="picture" required id="formFile" accept="image/*" onchange="loadFile(event)">
                                    </div>  
                                </form> <br> 
                             </div>

                            <form class="row g-3">
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="validationDefault01" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationDefault02" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control" id="validationDefault02" value="" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationDefaultUsername" class="form-label">E-mail</label>
                                    <div class="input-group">
                                    <input type="email" class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationDefault03" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="validationDefault03" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">Contato</label>
                                    <input type="text" class="form-control" id="validationDefault01" value="" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="validationDefault01" value="" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">RG</label>
                                    <input type="text" class="form-control" id="validationDefault01" value="" required>
                                </div>

                                <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Função</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected></option>
                                    <option value="fiscal">Fiscal</option>
                                    <option value="usuario">Usuário</option>
                                </select>
                                </div>
                                <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01">Situação contratual</label>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected></option>
                                    <option value="1">Ativo</option>
                                    <option value="2">Desligado</option>
                                </select>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">Nascimento</label>
                                    <input type="date" class="form-control"  value="" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">CEP</label>
                                    <input type="text" class="form-control"  value="" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">Cidade</label>
                                    <input type="text" class="form-control"  value="" required>
                                </div> 
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">Número</label>
                                    <input type="number" class="form-control"  value="" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">Bairro</label>
                                    <input type="text" class="form-control"  value="" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="validationDefault01" class="form-label">Cidade</label>
                                    <input type="date" class="form-control"  value="" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="validationDefault04" class="form-label">Cidade</label>
                                    <select class="form-select" id="validationDefault04" required>
                                    <option selected disabled value=""></option>
                                    <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="EX">Estrangeiro</option>
                                    </select>
                                </div>                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                        </form>
                    </div>
                    <!-- ----------------------FINAL do Modal formulario de cadastro de funcionario -->

                </div>
            </div>
        </div>

        
        <div class="container p-4 pt-5 bg-light" >
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Cod OS</th>
                        <th scope="col">Fiscal</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">Lote</th>
                        <th scope="col">Válvula</th>
                        <th scope="col">Tipo OS</th>
                        <th scope="col">Conteúdo</th>
                        <th scope="col">Meta</th>
                        <th scope="col">Colhida</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mauricio dos Santos França</td>
                    <td>Lucas de Souza Matos</td>
                    <td>1</td>
                    <td>1</td>
                    <td>Atividade</td>
                    <td>Livramento de todas as plantas da válvula</td>
                    <td>10</td>
                    <td>5</td>

                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Mauricio dos Santos França</td>
                    <td>Lucas de Souza Matos</td>
                    <td>1</td>
                    <td>1</td>
                    <td>Pulverização</td>
                    <td>todas as plantas da válvula</td>
                    <td>10</td>
                    <td>0</td>

                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Mauricio dos Santos França</td>
                    <td>1</td>
                    <td>1</td>
                    <td>Adubação</td>
                    <td>Adubar toda a válvula</td>
                    <td>10</td>
                    <td>10</td>
                    </tr>
                </tbody>
            </table>
            <div class="card pb-5 mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Metas
                            </div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Gráfico de desempenho
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        Divisão de ordens de serviço
                                    </div>
                                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted"></div>
                                </div>
                            </div>
                        </div>
        </div>




                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; ifruit 2022</div>
                            <div class="text-muted">Desenvolvido por: <a href="">Friends Academic</a></div>
                         
                        </div>
                    </div>
                </footer>

        <?php endif; //////////////////////////////////////////// fim da condicao?>

        























    

        <?php if($_SESSION['login']['funcao'] == "usuario"): /////////////// inicio da condicao de TELA DE FUNCIONARIO logado/////////////////////////?>
           
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
                            <?php foreach(ordem_servico_atividades($_SESSION['login']['cod_funcionario_pk']) as $row){ ?> 
                                
                                <div class="col-6">
                                    <div class="card mb-3">
                                        <p class="btn btn-warning">Lote: <?php print $row['cod_lote_fk']; ?> | Válvula: <?php print $row['cod_lote_fk']; ?></p>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Fiscal:</strong><br> <?php print $row['fiscal']; ?></p>
                                            <p class="card-text"><strong>Conteúdo:</strong><br> <?php print $row['conteudo']; ?></p>
                                            <p class="card-text"><strong>Meta:</strong> <?php print $row['meta']; ?>
                                            <p class="card-text"><strong>Concluidos:</strong> <?php print $row['colhida']; ?></p>
                                        </div>
                                    </div>
                                </div> 

                            <?php } ?>
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
                            <?php foreach(ordem_servico_pulverizacao($_SESSION['login']['cod_funcionario_pk']) as $row){ ?> 
                                
                                <div class="col-6">
                                    <div class="card mb-3">
                                        <p class="btn btn-warning">Lote: <?php print $row['cod_lote_fk']; ?> | Válvula: <?php print $row['cod_lote_fk']; ?></p>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Fiscal:</strong><br> <?php print $row['fiscal']; ?></p>
                                            <p class="card-text"><strong>Conteúdo:</strong><br> <?php print $row['conteudo']; ?></p>
                                            <p class="card-text"><strong>Meta:</strong> <?php print $row['meta']; ?>
                                            <p class="card-text"><strong>Concluidos:</strong> <?php print $row['colhida']; ?></p>
                                        </div>
                                    </div>
                                </div> 

                            <?php } ?>
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
                            <?php foreach(ordem_servico_adubacao($_SESSION['login']['cod_funcionario_pk']) as $row){ ?> 
                                
                                <div class="col-6">
                                    <div class="card mb-3">
                                        <p class="btn btn-warning">Lote: <?php print $row['cod_lote_fk']; ?> | Válvula: <?php print $row['cod_lote_fk']; ?></p>
                                        <div class="card-body">
                                            <p class="card-text"><strong>Fiscal:</strong><br> <?php print $row['fiscal']; ?></p>
                                            <p class="card-text"><strong>Conteúdo:</strong><br> <?php print $row['conteudo']; ?></p>
                                            <p class="card-text"><strong>Meta:</strong> <?php print $row['meta']; ?>
                                            <p class="card-text"><strong>Concluidos:</strong> <?php print $row['colhida']; ?></p>
                                        </div>
                                    </div>
                                </div> 

                            <?php } ?>
                            <!-- FIM da impressao dos valores do banco -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////////////////////// -->
  

                </div>
            </div>

        <?php endif; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

        
        <script>
            var loadFile = function(event) {
                    const output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                }; 
        </script>

        <script>
        var i = 0;
        function move() {
            if (i == 0) {
                i = 1;
                var elem = document.getElementById("myBar");
                var width = 1;
                var id = setInterval(frame, 10);
                function frame() {
                if (width >= 100) {
                    clearInterval(id);
                    i = 0;
                } else {
                    width++;
                    elem.style.width = width + "%";
                }
                }
            }
        }
        </script>

    </body>
</html>
