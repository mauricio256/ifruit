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

function linha(){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM linha");
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
        <div class="card pt-4 w-100">
            <div class="card-body bg-light m-3">
                <form action="php/processa_cadastro_linha.php" method="POST" class="p-3">
                <h3 class="text-center">Cadastro de linha</h3><hr>
                <div class="mb-3">
                    <table class="table table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Lote</th>
                                        <th scope="col">Válvula</th>
                                        <th scope="col">Linha</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(linha()):
                                         foreach(linha() as $row){ ?> 
                                        <tr>
                                            <th scope="row"><?php print $row['cod_lote_fk']; ?></th>
                                            <th scope="row"><?php print $row['cod_valvula_fk']; ?></th>
                                            <th scope="row"><?php print $row['cod_linha_pk']; ?></th>
                                            <td><?php print $row['descricao']; ?></td>
                                            <td> <a class="btn btn-danger btn-sm" onclick="return confirma_deleta()" href="php/deleta_linha.php?cod_linha=<?php print $row['cod_linha_pk']; ?>">Excluir</a></td>
                                        </tr>           
                                    <?php } endif;?> 
                                </tbody>
                    </table>

                <br><br>
                <label for="exampleFormControlTextarea1" class="form-label">Selecione o lote da válvula</label>
                <select class="form-select" required name="cod_lote" aria-label="Default select example">
                <option selected></option>

                    <?php foreach(lote() as $row){ ?>                    
                        <option value="<?php print $row['cod_lote_pk']; ?>"><strong>Lote: <?php print $row['cod_lote_pk']; ?> (<?php print $row['descricao']; ?>)</option>
                    <?php } ?> 

                </select>
                <br>
                <label for="exampleFormControlTextarea1" class="form-label">Selecione a válvula da linha</label>
                <select class="form-select" required name="cod_valvula" aria-label="Default select example">
                <option selected></option>

                    <?php foreach(valvula() as $row){ ?>                    
                        <option value="<?php print $row['cod_valvula_pk']; ?>"><strong>Valvula: <?php print $row['cod_valvula_pk']; ?> (<?php print $row['descricao']; ?>)</option>
                    <?php } ?> 

                </select>
                <br>

                        <label for="exampleFormControlInput1" class="form-label">Número da Linha</label>
                        <input type="number" required class="form-control" name="cod_linha" id="exampleFormControlInput1" placeholder="">
            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                                <textarea class="form-control" required name="descricao" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div> 

                        </div>

                        <div class="card-body bg-light  ">
                            <div class="mt-5 text-end">
                                <a href="painel.php" class="btn btn-outline-danger">Voltar</a>
                                <button type="submit" class="btn btn-info">Cadastrar</button>   
                            </div>
                        </div>
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
