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
            <div class="card-body bg-light m-3 ">
                <div class=" text-start">
                    <a href="painel.php" class="btn btn-outline-danger">Voltar</a> 
                </div>
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
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(ordem_servico()): 
                                            foreach(ordem_servico() as $row){ ?> 
                                            <tr>
                                                <th scope="row"><?php print $row['cod_os_pk']; ?></th>
                                                <th ><?php print $row['cod_lote_fk']; ?></th>
                                                <td><?php print $row['cod_valvula_fk']; ?></td>
                                                <td><?php print $row['fiscal']; ?></td>
                                                <td><?php foreach (busca_funcionario($row['cod_funcionario_fk']) as $row2){print $row2['nome'];} ?></td>
                                                <td><?php print $row['tipo_os']; ?></td>
                                                <td><?php print $row['conteudo']; ?></td>
                                                <td><button type="button" class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Visualizar</button></td>
                                                <td><?php print $row['meta']; ?></td>
                                                <td><?php print $row['colhida']; ?></td>
                                                <td><?php print $row['data_criacao']; ?></td>
                                                <td> <a class="btn btn-danger btn-sm" onclick="return confirma_deleta()" href="php/deleta_os.php?cod_os=<?php print $row['cod_os_pk']; ?>">Excluir</a></td>
                                            </tr>           
                                        <?php } endif; ?> 
                                    </tbody>
                        </table>
                    </div><br><br><br>
            </div>
        </div>

        <div class="card-body bg-light m-3">
            <div>
                <form action="php/processa_cadastro_os.php" method="POST" class="p-3">
                    <h3 class="text-center">Cadastrar ordem de serviço</h3><br>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                            <div class="mt-5 text-end">
                                <a href="painel.php" class="btn btn-outline-danger">Voltar</a>
                                <button type="submit" class="btn btn-info">Cadastrar</button>   
                            </div>
                </form> 
            </div>     
        </div>

                     
        





















                <!-- Modal lista de produtos OS -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Lista de produtos</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php if(produto_os()): 
                                    foreach(produto_os() as $row){ ?> 

                                        Cod do produto:<?php print $row['cod_produto_fk']; ?><br>
                                        Quantidade: <?php print $row['quantidade']; ?><br><hr>

                                <?php } else:print"<br><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nenhum registro encontrado</p>"; endif; ?>       

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
