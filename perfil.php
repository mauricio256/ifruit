<?php
    session_start();
    include("php/busca_funcionario.php");
    
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
                        <li><a class="dropdown-item " href="perfil.php">Perfil</a></li>
                        <li><a class="dropdown-item " href="painel.php">Menu</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item text-danger" href="php/processa_logout.php">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="container-md btn-light p-4 pb-5">
            <div class="mb-3 m-2">
                <h2 class="text-center">Perfil de usuário</h2><br>
                <h6 class="text-center btn-info">Dados pessoais</h6>
                <?php foreach(busca_funcionario($_SESSION['login']['cod_funcionario_pk']) as $row){ ?> 
                    <img src="img/funcionario/perfil.jpg" class="img-fluid float-end m-2 "  width="90px" alt="">
                    
                    <label class="form-label opacity-50">Nome: </label> <?php print $row['nome'] ." ". $row['sobrenome']; ?><br>
                    <label class="form-label opacity-50">E-mail: </label> <?php print $row['email'];?><br>
                    <label class="form-label opacity-50">Contato: </label> <?php print $row['contato']; ?><br>
                    <label class="form-label opacity-50">CPF: </label> <?php print $row['CPF']; ?><br>
                    <label class="form-label opacity-50">RG: </label> <?php print $row['RG']; ?><br>
                    
                    <label class="form-label opacity-50">Função: </label> <?php print $row['funcao']; ?><br>
                    <label class="form-label opacity-50">Status do contrato: </label> <?php if($row['contrato']):print "Ativo"; else:print "Desligado"; endif; ;?><br>
                    <br><h6 class="text-center btn-info">Endereço</h6>
                    <label class="form-label opacity-50">Nascimento: </label> <?php print $row['nascimento']; ?><br>
                    <label class="form-label opacity-50">CEP: </label> <?php print $row['CEP']; ?><br>
                    <label class="form-label opacity-50">Endereço: </label> <?php print $row['endereco']; ?><br>
                    <label class="form-label opacity-50">Número: </label> <?php print $row['numero']; ?><br>
                    <label class="form-label opacity-50">Bairro: </label> <?php print $row['bairro']; ?><br>
                    <label class="form-label opacity-50">Cidade: </label> <?php print $row['cidade']; ?><br>
                    <label class="form-label opacity-50">Estado: </label> <?php print $row['estado']; ?><br>
                    <br><h6 class="text-center btn-info">Sistema</h6>
                    <label class="form-label opacity-50 ">Data do cadastro: </label> <?php print $row['cadastro']; ?><br>
                    <hr>
                    <a href="#" type="button" class="btn btn-warning float-start small">Alterar</a>
                    <a href="painel.php" type="button" class="btn btn-info float-end small">Inicio</a>
                <?php } ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>