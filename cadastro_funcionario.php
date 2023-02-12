<?php
 session_start();

 if( $_SESSION['login']['funcao'] != "fiscal" ):
     header('Location:login.html');
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
                            <div class="card pt-4">
                                    <div class="card-body bg-light m-3 ">
                                        <form action="php/processa_cadastro_funcionario.php" enctype="multipart/form-data" method="POST" class="p-3">
                                            <h3 class="text-center">Dados Pessoais</h3><hr>
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
                                    </div>

                                    <div class="card-body bg-light m-3 ">    
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
                                    </div>
                                    <div class="card-body bg-light m-3 ">    
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
                                    </div>
                                    <div class="card-body bg-light  ">
                                  
                                        <div class="mt-5 text-end">
                                            <a href="painel.php" class="btn btn-outline-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-info" onclick ="return msg_salvando()">Cadastrar</button>   
                                        </div>
                                </form>        
                            </div>
                        </div> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            var loadFile = function(event) {
                    const output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                }; 
                
        </script>
    </body>
</html>
