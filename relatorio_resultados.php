<?php
 session_start();
 include("php/conexao_db.php");

 if( $_SESSION['login']['funcao'] != "fiscal" ):
     header('Location:login.html');
 endif;
    


 if(empty($_POST['cod_funcionario'])):
    $cod_funcionario = null;
 else:
    $cod_funcionario = $_POST['cod_funcionario'];
 endif;

    if(empty($_POST['lote'])):
        $lote = null;
    else:
        $lote = $_POST['lote'];
    endif;

        if(empty( $_POST['valvula'])):
            $valvula = null;
        else:
            $valvula = $_POST['valvula'];
        endif;

            if(empty($_POST['data1'])):
                $data1 = null;
            else:
                $data1 = $_POST['data1'];
            endif;

                if(empty($_POST['data2'])):
                    $data2 = null;
                else:
                    $data2 = $_POST['data2'];
                endif;


    $conn = conecta();
    $query = $conn->query(" SELECT * FROM ordem_servico WHERE cod_funcionario_fk = '$cod_funcionario' and cod_lote_fk = '$lote' and cod_valvula_fk = '$valvula' and data_criacao BETWEEN '$data1' AND '$data2' ");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        $dados = $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary
    else:
        $dados = NULL;
    endif; 


    ///////////////////////////////////////////////////////////////////////////////////////
    function busca_funcionario_usuario(){
        $conn = conecta();
        $query = $conn->query("SELECT * FROM funcionario WHERE funcao = 'usuario' ");
        if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
            $query->execute();     /// execulta a query
            $conn = NULL;
            return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary
        else:
        return NULL;
        endif; 
    }

    function busca_funcionario($cod_funcionario){
        $conn = conecta();
        $query = $conn->query("SELECT * FROM funcionario WHERE cod_funcionario_pk = $cod_funcionario");
        if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
            $query->execute();     /// execulta a query
            $conn = NULL;
            return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary    
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="p-3 pt-4 bg-light h-100">
                <h2>Relatório de Resultados</h2><hr>
                <div class="mb-3">
                    <div style=" overflow-y: scroll;"> 
                        <table class="table table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">Lote</th>
                                            <th scope="col">Válvula</th>
                                            <th scope="col">Usuário</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Meta</th>
                                            <th scope="col">Colhida</th>
                                            <th scope="col">Criada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($dados): 
                                            foreach($dados as $row){ ?> 
                                            <tr>
                                                <td><?php print $row['cod_lote_fk']; ?></td>
                                                <td><?php print $row['cod_valvula_fk']; ?></td>
                                                <td><?php foreach (busca_funcionario($row['cod_funcionario_fk']) as $row2){print $row2['nome']." ".$row2['sobrenome'];} ?></td>
                                                <td><?php print $row['tipo_os']; ?></td>
                                                <td><?php print $row['meta']; ?></td>
                                                <td><?php print $row['colhida']; ?></td>
                                                <td><?php print $row['data_criacao']; ?></td>
                                            </tr>           
                                        <?php } else: echo"<p>Nenhum resultado encontrado</p>"; endif; ?> 
                                    </tbody>
                        </table>
                    </div>                 
        </div><br><br>
            <hr>    
            <form action="relatorio_resultados.php" method="POST">
            <label for="exampleFormControlTextarea1" class="form-label">Selecione o Funcionário</label>
                            <select class="form-select" required name="cod_funcionario" aria-label="Default select example">
                            <option selected></option>

                                <?php foreach(busca_funcionario_usuario() as $row){ ?>                    
                                    <option value="<?php print $row['cod_funcionario_pk'];?>"><strong> Código: <?php print $row['cod_funcionario_pk']." - ( ". $row['nome'] ." ". $row['sobrenome']; ?> )</option>
                                <?php } ?> 

                            </select>
                            <br>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Número do lote</label>
                            <input type="text" class="form-control" name="lote" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Número da válvula</label>
                            <input type="text" name="valvula" class="form-control" aria-label="Last name">
                        </div>
                    </div>
                </div>   
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Data inicio</label>
                            <input type="date" class="form-control" name="data1" aria-label="First name">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Data final</label>
                            <input type="date" name="data2" class="form-control" aria-label="Last name">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn float-end mt-2 btn-success">Buscar</button> <a href="painel.php" class="btn float-end m-2 btn-outline-danger">Fechar</a> 
            </form><br><br><br>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>

            function confirma_deleta() {

                if (confirm("Deseja mesmo DELETAR?")) {

                    return true;

                } else {

                    return false;

                }

            }

        </script>
    </body>
</html>
