<?php
 session_start();
 include("php/conexao_db.php");

 if( $_SESSION['login']['funcao'] != "fiscal" ):
     header('Location:login.html');
 endif;

 function funcionario(){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM funcionario");
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
    <body >
            <div class="card pt-4 p-5">
                <div class="card-body bg-light shadow m-3 ">
                        <div class="text-start">
                            <a href="painel.php" class="btn btn-outline-danger">Voltar</a> 
                        </div>
                        <h3 class="text-center">Funcionários Cadastrados</h3><hr>
                        <div style=" overflow-y: scroll;"> 
                            <table class="table  table-striped ">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Sobrenome</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Contato</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">RG</th>
                                        <th scope="col">Nascimento</th>
                                        <th scope="col">Função</th>
                                        <th scope="col">Contrato</th>
                                        <th scope="col">CEP</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Cidade</th>
                                        <th scope="col">Bairro</th>
                                        <th scope="col">Logradouro</th>
                                        <th scope="col">Número</th>
                                        <th scope="col">Cadastro</th>
                                        <th scope="col">Ações</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php if(funcionario()):
                                         foreach(funcionario() as $row){ 
                                        ?> 

                                        <tr>
                                            <th scope="row"><?php print $row['cod_funcionario_pk']; ?></th>
                                            <td><?php print $row['nome']; ?></td>
                                            <td><?php print $row['sobrenome']; ?></td>
                                            <td><?php print $row['email']; ?></td>
                                            <td><?php print $row['contato']; ?></td>
                                            <td><?php print $row['CPF']; ?></td>
                                            <td><?php print $row['RG']; ?></td>
                                            <td><?php print $row['nascimento']; ?></td>
                                            <td><?php print $row['funcao']; ?></td>
                                            <td><?php print $row['contrato']; ?></td>
                                            <td><?php print $row['CEP']; ?></td>
                                            <td><?php print $row['estado']; ?></td>
                                            <td><?php print $row['cidade']; ?></td>
                                            <td><?php print $row['bairro']; ?></td>
                                            <td><?php print $row['endereco']; ?></td>
                                            <td><?php print $row['numero']; ?></td>
                                            <td><?php print $row['cadastro']; ?></td>
                                            <td> <a class="btn btn-primary btn-sm" href="php/.php?cod_funcionario=<?php print $row['cod_funcionario_pk']; ?>">Editar</a></td>
                                            <td> <a class="btn btn-danger btn-sm" onclick="return confirma_deleta()" href="php/deleta_funcionario.php?cod_funcionario=<?php print $row['cod_funcionario_pk']; ?>&caminho_img=<?php print $row['foto']; ?>">Excluir</a></td>
                                        </tr>           
                                    <?php } endif; ?> 
                                </tbody>
                            </table><br><br>
                        </div>   
            </div>     
            <div class="card-body bg-light shadow m-3">
                                <form action="php/processa_cadastro_funcionario.php" enctype="multipart/form-data" method="POST" class="p-3">
                                           <h3 class="text-center">Cadastro de Funcionário</h3><hr>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <img src="img/add_image.png" class="rounded"  width="auto" height="100px">
                                                        <br>Clique em procurar para carregar uma imagem<br><br><input class="form-control" type="file" name="foto" required id="formFile" accept="image/*" onchange="loadFile(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center m-1">
                                                        <img id="output" src='img/icone_image.png')  class="rounded"  width="auto" height="150px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" name="nome" type="text" require />
                                                        <label for="inputFirstName">Nome</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="sobrenome" id="inputLastName" type="text" require />
                                                        <label for="inputLastName">Sobrenome</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="email" type="email" require />
                                                <label for="inputEmail">E-mail</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="senha" id="inputPassword" type="password"  require/>
                                                        <label for="inputPassword">Senha</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="contato" id="inputLastName" type="text" require />
                                                        <label for="inputLastName">Contato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="CPF" id="inputLastName" type="text" require />
                                                        <label for="inputLastName">CPF</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="RG" id="inputLastName" type="text" require />
                                                        <label for="inputLastName">RG</label>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="nascimento" id="inputLastName" type="date" value="2005-01-01" require />
                                                        <label for="inputLastName">Nascimento</label>
                                                    </div>
                                                </div>
                                            </div>
                                   

                                    
                                            <h3 class="text-center">Endereço</h3><hr>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="CEP" id="inputLastName" type="text" require />
                                                        <label for="inputLastName">CEP</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">    
                                                            <div class="form-floating">
                                                                <select class="form-select" name="estado" aria-label="Default select example">
                                                                    <option disabled selected>Estado</option>
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
                                                 </div> 
                                         </div>    
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="cidade" id="inputLastName" type="text" require />
                                                        <label for="inputLastName">Cidade</label>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="bairro" id="inputLastName" type="text"  require />
                                                        <label for="inputLastName">Bairro</label>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="endereco" id="inputLastName" type="text" require />
                                                        <label for="inputLastName">Logradouro ( Ex. Rua Monteiro Lobato )</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="numero" id="inputLastName" type="number" require />
                                                        <label for="inputLastName">Número</label>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                       
                                            <h3 class="text-center">Empresa</h3><hr> 
                                            <div class="row mb-3">   
                                                <div class="col-md-6">
                                                        <div class="form-floating">
                                                        <select class="form-select" name="funcao" aria-label="Default select example">
                                                            <option disabled selected>Função</option>
                                                            <option value="fiscal">Fiscal</option>
                                                            <option value="usuario">Usuário</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="col-md-6">          
                                                        <div class="form-floating">
                                                            <select class="form-select" name="contrato" aria-label="Default select example">
                                                                <option disabled selected>Contrato</option>
                                                                <option value=1>Ativo</option>
                                                                <option value=0>Desligado</option>
                                                            </select>
                                                        </div>
                                                </div>                          
                                 

                                    <div class="mt-3 text-end">
                                        <a href="painel.php" class="btn btn-outline-danger">Voltar</a>
                                        <button type="submit" class="btn btn-info" onclick ="return msg_salvando()">Cadastrar</button>   
                                    </div>
                                </div>     
                            </div>    
                        </form>    
            </div> 

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            var loadFile = function(event) {
                    const output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                }; 
                
        </script>

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
