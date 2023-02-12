<?php
 include("conexao_db.php");


    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $contato = filter_input(INPUT_POST, 'contato', FILTER_SANITIZE_SPECIAL_CHARS);
    $CPF = filter_input(INPUT_POST, 'CPF', FILTER_SANITIZE_SPECIAL_CHARS);
    $RG = filter_input(INPUT_POST, 'RG', FILTER_SANITIZE_SPECIAL_CHARS);
    $funcao = $_POST['funcao'];
    $contrato = $_POST['contrato'];
    $nascimento = $_POST['nascimento'];
    $CEP = filter_input(INPUT_POST, 'CEP', FILTER_SANITIZE_SPECIAL_CHARS);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS);

    if(isset($_FILES['foto'])):
          $ext = strtolower(substr($_FILES['foto']['name'],-4)); //Pegando extensão do arquivo
          $new_name = $nome.$ext; //Definindo um novo nome para o arquivo
          $dir = '../img/funcionario/'; //Diretório para uploads 

          $conn = conecta();
          $query = "INSERT INTO `funcionario` (`cod_funcionario_pk`, `nome`, `sobrenome`, `email`, `senha`, `contato`, `CPF`, `RG`, `funcao`, `contrato`, `nascimento`, `foto`, `CEP`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `cadastro`) 
                    VALUES (NULL,'$nome','$sobrenome','$email','$senha','$contato','$CPF','$RG','$funcao','$contrato','$nascimento','img/funcionario/$new_name','$CEP','$endereco','$numero','$bairro','$cidade','$estado',now())";
                    
          try {
               if($conn->exec($query)):  
                    move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
                    echo"<script>
                              alert('CADASTRADO COM SUCESSO!');
                              javascript:window.location='../cadastro_funcionario.php';
                         </script>";  
                    else:
                         echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro ao cadastrar. tente novamente </div><br><a href='../cadastro_funcionario.php'>Voltar</a>"; 
                    endif;
                    
                    } catch (Exception $e) {
                         echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_funcionario.php'>Voltar</a>"; 
                    }
     else:
          echo"erro img";
     endif;