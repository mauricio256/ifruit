<?php
 session_start();
 include("php/conexao_db.php");

 if( $_SESSION['login']['funcao'] != "fiscal" ):
     header('Location:login.html');
 endif;

 

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
        <div class="bg-light h-100">    
                <div class="text-start ">
                    <a href="painel.php" class="btn btn-outline-danger btn-sm m-3 ">Voltar</a> 
                </div><br>
                <h3 class="text-center">Lotes Cadastrados</h3><hr>
                <div class="m-3">
                    <div style=" overflow-y: scroll;">  
                        <table class="table table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Número do Lote</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(lote()): 
                                    foreach(lote() as $row){ ?> 
                                        <tr>
                                            <th scope="row"><?php print $row['cod_lote_pk']; ?></th>
                                            <td><?php print $row['descricao']; ?></td>
                                            <td> <a class="btn btn-danger btn-sm" onclick="return confirma_deleta()" href="php/deleta_lote.php?cod_lote=<?php print $row['cod_lote_pk']; ?>">Excluir</a></td>
                                        </tr>           
                                    <?php } endif;?> 
                                </tbody>
                        </table>
                    </div>
                </div>
            
            <div class="accordion accordion-flush " id="accordionFlushExample">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="btn btn-primary  collapsed m-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Cadastrar novo Lote
                        </button>
                    </h2>
                    <br>

                    <div id="flush-collapseOne" class="accordion-collapse collapse p-2 mb-3" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <h3 class="text-center">Cadastro de lote</h3><hr>
                            <form action="php/processa_cadastro_lote.php" method="POST"> 
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Número do Lote</label>
                                            <input type="number" class="form-control" required  name="cod_lote" id="exampleFormControlInput1" placeholder="">
                                            </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                                                        <textarea class="form-control" required name="descricao" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>                             

                                            <div class="mt-5 text-end">
                                                <a href="cadastro_lote.php" class="btn btn-outline-danger">Fechar</a>
                                                <button type="submit" class="btn btn-info">Cadastrar</button>   
                                            </div> 
                                    </div>  
                            </form> 
                        </div>
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
