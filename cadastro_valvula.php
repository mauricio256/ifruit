<?php
 session_start();
 include("php/conexao_db.php");

 if( $_SESSION['login']['funcao'] != "fiscal" ):
     header('Location:login.html');
 endif;

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
        <div class="card p-5 pt-4 w-100">
            <div class="card-body bg-light shadow m-3">  
                <div class="text-start">
                    <a href="painel.php" class="btn btn-outline-danger">Voltar</a> 
                </div>
                <h3 class="text-center">Válvulas Cadastradas</h3><hr>
                <div class="mb-3">
                    <div style=" overflow-y: scroll;"> 
                        <table class="table table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">Lote</th>
                                            <th scope="col">Válvula</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Variedade</th>
                                            <th scope="col">Quantidade de plantas</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Escapamento</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(valvula()): 
                                            foreach(valvula() as $row){ ?> 
                                            <tr>
                                                <th scope="row"><?php print $row['cod_lote_fk']; ?></th>
                                                <th scope="row"><?php print $row['cod_valvula_pk']; ?></th>
                                                <td><?php print $row['descricao']; ?></td>
                                                <td><?php print $row['variedade']; ?></td>
                                                <td><?php print $row['numero_plantas']; ?></td>
                                                <td><?php print $row['area']; ?></td>
                                                <td><?php print $row['escapamento']; ?></td>
                                                <td> <a class="btn btn-danger btn-sm" onclick="return confirma_deleta()" href="php/deleta_valvula.php?cod_valvula=<?php print $row['cod_valvula_pk']; ?>">Excluir</a></td>
                                            </tr>           
                                        <?php } endif; ?> 
                                    </tbody>
                        </table>
                    </div> <br><br>
                </div>    
            </div>
        <div class="card-body">                                       
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="btn btn-primary collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Cadastrar nova Válvula
                        </button>
                    </h2><br>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            
                <div class="card-body bg-light shadow">
                    <h3 class="text-center">Cadastro de válvula</h3><hr>
                    <form action="php/processa_cadastro_valvula.php" method="POST" class="p-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Selecione o lote da válvula</label>
                        <select class="form-select" required name="cod_lote" aria-label="Default select example">
                        <option selected></option>

                            <?php foreach(lote() as $row){ ?>                    
                                <option value="<?php print $row['cod_lote_pk']; ?>"><strong>Lote: <?php print $row['cod_lote_pk']; ?> (<?php print $row['descricao']; ?>)</option>
                            <?php } ?> 

                        </select><br>
                            <label for="exampleFormControlInput1" class="form-label">Número da Valvula</label>
                            <input type="number" required class="form-control" name="cod_valvula" id="exampleFormControlInput1" placeholder="">
                
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                                    <textarea class="form-control" required name="descricao" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div> 

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Variedade</label>
                                    <input type="text" required class="form-control" name="variedade" id="exampleFormControlInput1" placeholder="">                            
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Quantidade de plantas</label>
                                    <input type="number" required class="form-control" name="numero_plantas" id="exampleFormControlInput1" placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Área</label>
                                    <input type="text" required class="form-control" name="area" id="exampleFormControlInput1" placeholder="">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Escapamento</label>
                                    <input type="text" required class="form-control" name="escapamento" id="exampleFormControlInput1" placeholder="">
                                </div>
                        

                    
                                <div class="mt-5 text-end">
                                    <a href="cadastro_valvula.php" class="btn btn-outline-danger">Fechar</a>
                                    <button type="submit" class="btn btn-info">Cadastrar</button>   
                                </div>
                        </div>
                    </form>        
                </div>
            </div>    
        </div> <br><br><br>
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
