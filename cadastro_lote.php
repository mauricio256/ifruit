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
        <div class="card pt-4 w-100">
            <div class="card-body bg-light m-3">
            <h3 class="text-center">Cadastro de Lote</h3><hr>
                <div class="m-3 " >
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
                </div><br><br>
                <form action="php/processa_cadastro_lote.php" method="POST"  class="p-3 ">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Número do Lote</label>
                        <input type="number" class="form-control" required  name="cod_lote" id="exampleFormControlInput1" placeholder="">
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
