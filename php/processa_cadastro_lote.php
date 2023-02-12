<?php
 include("conexao_db.php");


    $cod_lote = filter_input(INPUT_POST, 'cod_lote', FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    

          $conn = conecta();
          $query = "INSERT INTO `lote` (`cod_lote_pk`, `descricao`) 
                    VALUES ($cod_lote,'$descricao')";
                    
            try {
               if($conn->exec($query)):  
                    echo"<script>
                              alert('CADASTRADO COM SUCESSO!');
                              javascript:window.location='../cadastro_lote.php';
                         </script>";  
                    else:
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro ao cadastrar. tente novamente </div><br><a href='../cadastro_lote.php'>Voltar</a>"; 
                    endif;
                    
            } catch (Exception $e) {
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_lote.php'>Voltar</a>"; 
                         
            }
