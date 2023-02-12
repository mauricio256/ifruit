<?php
 include("conexao_db.php");


    $cod_lote = filter_input(INPUT_POST, 'cod_lote', FILTER_SANITIZE_NUMBER_INT);
    $cod_valvula = filter_input(INPUT_POST, 'cod_valvula', FILTER_SANITIZE_NUMBER_INT);
    $cod_linha = filter_input(INPUT_POST, 'cod_linha', FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

          $conn = conecta();
          $query = "INSERT INTO `linha` (`cod_lote_fk`, `cod_valvula_fk`, `cod_linha_pk`, `descricao`) 
                    VALUES ('$cod_lote', '$cod_valvula', '$cod_linha', '$descricao'); ";
                    
            try {
               if($conn->exec($query)):  
                    echo"<script>
                              alert('CADASTRADO COM SUCESSO!');
                              javascript:window.location='../cadastro_linha.php';
                         </script>";  
                    else:
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro ao cadastrar. tente novamente </div><br><a href='../cadastro_linha.php'>Voltar</a>"; 
                    endif;
                    
            } catch (Exception $e) {
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_linha.php'>Voltar</a>"; 
                         
            }
