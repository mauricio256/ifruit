<?php
 include("conexao_db.php");

     $fiscal = filter_input(INPUT_POST, 'fiscal', FILTER_SANITIZE_SPECIAL_CHARS);   
     $cod_funcionario = filter_input(INPUT_POST, 'funcionario', FILTER_SANITIZE_NUMBER_INT);
     $cod_lote = filter_input(INPUT_POST, 'cod_lote', FILTER_SANITIZE_NUMBER_INT);
     $cod_valvula = filter_input(INPUT_POST, 'cod_valvula', FILTER_SANITIZE_NUMBER_INT);
     $tipo_os = filter_input(INPUT_POST, 'tipo_os', FILTER_SANITIZE_SPECIAL_CHARS);
     $conteudo = filter_input(INPUT_POST, 'conteudo', FILTER_SANITIZE_SPECIAL_CHARS);
     $meta = filter_input(INPUT_POST, 'meta', FILTER_SANITIZE_NUMBER_INT);
     $colhida = 0;

          $conn = conecta();
          $query = " INSERT INTO `ordem_servico` (`cod_os_pk`, `fiscal`, `cod_funcionario_fk`, `cod_lote_fk`, `cod_valvula_fk`, `tipo_os`, `conteudo`, `meta`, `colhida`, `data_criacao`) 
                     VALUES (NULL, '$fiscal', '$cod_funcionario', '$cod_lote', '$cod_valvula', '$tipo_os', '$conteudo', '$meta', default, now()); ";
                    
            try {
               if($conn->exec($query)):  
                    echo"<script>
                              alert('CADASTRADO COM SUCESSO!');
                              javascript:window.location='../cadastro_ordem_servico.php';
                         </script>";  
                    else:
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro ao cadastrar. tente novamente </div><br><a href='../cadastro_ordem_servico'>Voltar</a>"; 
                    endif;
                    
            } catch (Exception $e) {
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_ordem_servico'>Voltar</a>"; 
                         
            }