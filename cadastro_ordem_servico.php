<?php
 session_start();
 include("php/conexao_db.php");

 if( $_SESSION['login']['funcao'] != "fiscal" ):
     header('Location:login.html');
 endif;

 function ordem_servico(){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM ordem_servico");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary
    else:
       return NULL;
    endif; 
}


function produto_os(){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM produto_os");
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

function lote(){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM lote");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary
    else:
       return NULL;
    endif; 
}

function valvula(){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM valvula");
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
        <div class="p-3 pt-4 bg-light h-100 ">
                <div class=" text-start">
                    <a href="painel.php" class="btn btn-outline-danger btn-sm">Voltar</a> 
                </div><br>
                <h3 class="text-center">Ordens de serviço</h3>
                <div class="mb-3">
                    <div style=" overflow-y: scroll;"> 
                        <table class="table table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">Código OS</th>
                                            <th scope="col">Lote</th>
                                            <th scope="col">Válvula</th>
                                            <th scope="col">Fiscal</th>
                                            <th scope="col">Usuário</th>
                                            <th scope="col">Tipo de OS</th>
                                            <th scope="col">Conteúdo</th>
                                            <th scope="col">Produtos</th>
                                            <th scope="col">Meta</th>
                                            <th scope="col">Colhida</th>
                                            <th scope="col">Criada</th>
                                            <th scope="col"></th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(ordem_servico()): 
                                            foreach(ordem_servico() as $row){ ?> 
                                            <tr>
                                                <th ><?php print $row['cod_os_pk']; ?></th>
                                                <th ><?php print $row['cod_lote_fk']; ?></th>
                                                <td><?php print $row['cod_valvula_fk']; ?></td>
                                                <td><?php print $row['fiscal']; ?></td>
                                                <td><?php foreach (busca_funcionario($row['cod_funcionario_fk']) as $row2){print $row2['nome']." ".$row2['sobrenome'];} ?></td>
                                                <td><?php print $row['tipo_os']; ?></td>
                                                <td><?php print $row['conteudo']; ?></td>
                                                <td><a class="btn btn-primary btn-sm"  href="produtos_os.php?cod_os=<?php print $row['cod_os_pk']; ?>">Visualizar</a></td>
                                                <td><?php print $row['meta']; ?></td>
                                                <td><?php print $row['colhida']; ?></td>
                                                <td><?php print $row['data_criacao']; ?></td>
                                                <td> </td>
                                                <td> <a class="btn btn-danger btn-sm" onclick="return confirma_deleta()" href="php/deleta_os.php?cod_os=<?php print $row['cod_os_pk']; ?>">Excluir</a></td>
                                            </tr>           
                                        <?php } endif; ?> 
                                    </tbody>
                        </table>
                    </div>
            </div>

        <h2 class="accordion-header p-3" id="flush-headingOne">
            <button class="btn btn-primary collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Cadastrar nova Ordem de serviço
            </button>
        </h2><br>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">

                        <form action="php/processa_cadastro_os.php" method="POST" class="p-3">

                            <input type="text" name="fiscal" hidden value="<?php print $_SESSION['login']['nome']." ".$_SESSION['login']['sobrenome']; ?>">

                            <h3 class="text-center">Cadastrar ordem de serviço</h3><hr>
                            <label for="exampleFormControlTextarea1" class="form-label">Selecione o lote</label>
                            <select class="form-select" required name="cod_lote" aria-label="Default select example">
                            <option selected></option>

                                <?php foreach(lote() as $row){ ?>                    
                                    <option value="<?php print $row['cod_lote_pk']; ?>"><strong>Lote: <?php print $row['cod_lote_pk']; ?> (<?php print $row['descricao']; ?>)</option>
                                <?php } ?> 

                            </select>
                            <br>
                            <label for="exampleFormControlTextarea1" class="form-label">Selecione a válvula</label>
                            <select class="form-select" required name="cod_valvula" aria-label="Default select example">
                            <option selected></option>

                                <?php foreach(valvula() as $row){ ?>                    
                                    <option value="<?php print $row['cod_valvula_pk']; ?>"><strong>Valvula: <?php print $row['cod_valvula_pk']; ?> (<?php print $row['descricao']; ?>)</option>
                                <?php } ?> 

                            </select>
                            <br>
                            
                            <label for="exampleFormControlTextarea1" class="form-label">Selecione o usuário</label>
                            <select class="form-select" required name="funcionario" aria-label="Default select example">
                            <option selected></option>

                                <?php foreach(busca_funcionario_usuario() as $row){ ?>                    
                                    <option value="<?php print $row['cod_funcionario_pk'];?>"><strong> Código: <?php print $row['cod_funcionario_pk']." - ( ". $row['nome'] ." ". $row['sobrenome']; ?> )</option>
                                <?php } ?> 

                            </select>
                            <br>
                            
                            <label for="exampleFormControlTextarea1" class="form-label">Tipo de OS</label>
                            <select class="form-select"  required name="tipo_os" aria-label="Default select example">
                            <option selected></option>           
                                    <option value="Atividades"><strong>ATIVIDADES</strong></option>
                                    <option value="Pulverização"><strong>PULVERIZAÇÃO</strong></option>
                                    <option value="Adubação"><strong>ADUBAÇÃO</strong></option>
                            </select>
                            <br>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
                                <textarea class="form-control" name="conteudo" placeholder="Ex: Colher todas as uvas da válvula" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Meta</label>
                                <input type="number" class="form-control" name="meta" id="exampleFormControlInput1" placeholder="Apenas números (Digite 0 se não tiver meta)" >
                            </div><br>
                            <hr>
                            <div class="alert d-flex text-center" role="alert">
                               
                                    ATENÇÃO: Os produtos são adicionados após a Ordem de serviço ser criada
                          
                            </div><hr>



                                    <div class="mt-5 text-end">
                                        <a href="cadastro_ordem_servico.php" class="btn btn-outline-danger">Fechar</a>
                                        <button type="submit" class="btn btn-info">Cadastrar</button>   
                                    </div>
                        </form> 
        </div>     
    </div>
   
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
