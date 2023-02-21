<?php
 include("conexao_db.php");

     $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
     $tamanho = filter_input(INPUT_POST, 'tamanho', FILTER_SANITIZE_SPECIAL_CHARS);
     $tipo_unidade = filter_input(INPUT_POST, 'tipo_unidade', FILTER_SANITIZE_SPECIAL_CHARS); 
     $valor_unitario = filter_input(INPUT_POST, 'valor_unitario', FILTER_SANITIZE_NUMBER_FLOAT);
     $quantiade_estoque = filter_input(INPUT_POST, 'quantidade_estoque', FILTER_SANITIZE_NUMBER_INT);
     

     $valor = substr_replace($valor_unitario, '.', -2, 0);
     $valor_unitario_moeda = number_format($valor,2,".","."); 

     

          $conn = conecta();
          $query = "INSERT INTO `produto` (`cod_produto_pk`, `descricao`, `tamanho`, `tipo_unidade`, `valor_unitario`, `quantidade_estoque`) 
                    VALUES (NULL, '$descricao', '$tamanho', '$tipo_unidade','$valor_unitario_moeda', '$quantiade_estoque');";
                    
            try {
               if($conn->exec($query)):  
                    echo"<script>
                              alert('CADASTRADO COM SUCESSO!');
                              javascript:window.location='../cadastro_produto.php';
                         </script>";  
                    endif;
                    
            } catch (Exception $e) {

               echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_produto.php'>Voltar</a>"; 
                         
            }
