<?php
 session_start();
 include("php/conexao_db.php");

 if( $_SESSION['login']['funcao'] != "fiscal" ):
     header('Location:login.html');
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

function produtos(){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM produto");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com  o valor da quary
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
                <div class="text-start m-lg-3">
                    <a href="cadastro_ordem_servico.php" class="btn btn-outline-danger">Voltar</a> 
                </div>
                <h3 class="text-center">Produtos | Código OS: <?php print $_GET['cod_os']; ?>  </h3><hr>
                <div class="m-5">

                              <!-- Impressao de produtos da OS em questao-->
                              <div class="bg-white m-5">
                                                <?php if(produto_os($_GET['cod_os'])): ?>
                                                    <table class="table">
                                                        <thead class="table-primary">
                                                            <tr>
                                                                <th scope="col">Descrição</th>
                                                                <th scope="col" class="text-center">Quantidade</th>
                                                                <th scope="col" >Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            <?php  foreach(produto_os($_GET['cod_os']) as $row_produtos){ ?>
                                                                <tr>
                                                                    <th scope="row"><?php print produto($row_produtos['cod_produto_fk'])['descricao']; ?></th>
                                                                    <th scope="row" class="text-center"><?php print $row_produtos['quantidade']; ?></th>
                                                                    <td> <a class="btn btn-danger btn-sm" onclick="return confirma_deleta()" href="php/deleta_produto_os.php?cod_os=<?php print $_GET['cod_os']; ?>&cod_produto=<?php print $row_produtos['cod_produto_fk'];?>">Excluir</a></td>
                                                                </tr> 
                                                                <?php } else: print " &nbsp;&nbsp;&nbsp;<em>Não há produtos cadastrados</em>"; endif; ?> 
                                                        </tbody>
                                                        
                                                    </table>
                                                </div><br>
                                                <button class="btn btn-primary collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Adicionar novo produto
                                                </button> 

                    
                </div>
            </div><br><br><br>

            <div class="card-body">

            <div class="accordion accordion-flush" id="accordionFlushExample">
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="card-body bg-light shadow">
                    <form action="php/processa_cadastro_produto_os.php" method="POST"  class="p-3 "> 
                                                                
                                <input type="number" hidden name="cod_os" value="<?php print $_GET['cod_os']; ?>">
                            
                                <br>
                                    <label for="exampleFormControlTextarea1" class="form-label">Selecione o produto</label>
                                    <select class="form-select" required name="cod_produto" aria-label="Default select example">
                                    <option selected></option>

                                    <?php if(produtos()):  
                                        foreach(produtos() as $row_produtos){ ?>                  
                                            <option value="<?php print $row_produtos['cod_produto_pk']; ?>"><?php print $row_produtos['descricao']; ?></option>
                                        <?php } endif; ?> 

                                    </select>
                                <br>
                                <label for="exampleFormControlInput1" class="form-label">Quantidade</label>
                                    <input type="number" class="form-control" required  name="quantidade" id="exampleFormControlInput1" placeholder="">

                            <div class="mb-3">
                                    <div class="mt-5 text-end">
                                        <a href="produtos_os.php?cod_os=<?php print $_GET['cod_os']; ?>" class="btn btn-outline-danger">Fechar</a>
                                        <button type="submit" class="btn btn-info">Cadastrar</button>   
                                    </div> 
                            </div>  
                    </form> 
                </div>
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