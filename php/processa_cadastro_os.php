<?php
 include("conexao_db.php");


    $cod_lote = filter_input(INPUT_POST, 'cod_lote', FILTER_SANITIZE_NUMBER_INT);
    $cod_valvula = filter_input(INPUT_POST, 'cod_valvula', FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $variedade = filter_input(INPUT_POST, 'variedade', FILTER_SANITIZE_SPECIAL_CHARS);
    $numero_plantas = filter_input(INPUT_POST, 'numero_plantas', FILTER_SANITIZE_NUMBER_INT);
    $area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_NUMBER_FLOAT);
    $escapamento = filter_input(INPUT_POST, 'escapamento', FILTER_SANITIZE_NUMBER_FLOAT);

          $conn = conecta();
          $query = " INSERT INTO `ordem_servico` (`cod_os_pk`, `fiscal`, `cod_funcionario_fk`, `cod_lote_fk`, `cod_valvula_fk`, `tipo_os`, `conteudo`, `meta`, `colhida`, `data_criacao`) 
                     VALUES (NULL, 'Mauricio França', '7', '2', '1', 'Atividades', 'Livramento de plantas', '50', '20', '2023-02-13 23:57:42') ";
                    
            try {
               if($conn->exec($query)):  
                    echo"<script>
                              alert('CADASTRADO COM SUCESSO!');
                              javascript:window.location='../cadastro_os.php';
                         </script>";  
                    else:
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro ao cadastrar. tente novamente </div><br><a href='../cadastro_os.php'>Voltar</a>"; 
                    endif;
                    
            } catch (Exception $e) {
                        echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_os.php'>Voltar</a>"; 
                         
            }
