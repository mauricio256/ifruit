<?php
 include("conexao_db.php");


     $cod_os = filter_input(INPUT_POST, 'cod_os', FILTER_SANITIZE_NUMBER_INT);
     $cod_produto = filter_input(INPUT_POST, 'cod_produto', FILTER_SANITIZE_NUMBER_INT);
     $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);


     $conn = conecta();
     $query = "INSERT INTO `produto_os` (`cod_produto_os_pk`, `cod_os_fk`, `cod_produto_fk`, `quantidade`) 
               VALUES (NULL, '$cod_os', '$cod_produto', '$quantidade');";
               
       try {
          if($conn->exec($query)):  
               echo"<script>
                         alert('CADASTRADO COM SUCESSO!');
                         javascript:window.location='../produtos_os.php?cod_os=$cod_os';
                    </script>";  
               else:
                   echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro ao cadastrar. tente novamente </div><br><a href='../produtos_os.php?cod_os=$cod_os'>Voltar</a>"; 
               endif;
               
       } catch (Exception $e) {
                   echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../produtos_os.php?cod_os=$cod_os'>Voltar</a>"; 
                    
       }
   

