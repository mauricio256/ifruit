<?php
include("conexao_db.php");

 $cod_funcionario = $_GET['cod_funcionario'];
 $caminho_img = $_GET['caminho_img'];

    try {
        $conn = conecta();
        $query = $conn->query("DELETE FROM funcionario WHERE cod_funcionario_pk = '$cod_funcionario'");

        if($query->execute()):
            unlink('../'.$caminho_img);
            echo"<script>
                alert('DELETADO COM SUCESSO!');
                javascript:window.location='../cadastro_funcionario.php';
            </script>"; 
        endif;      
        } catch (Exception $e) {
            if($e->getCode() == 23000):
                echo" <div style='width: 100%; padding:20px; background-color:red; color:yellow;'>ATENÇÃO: Esse CADASTRO possui ORDEM(S) DE SERVIÇO(S) em aberto, não é possível excluir sem antes finaliza-las<br></div>";
            endif; 
            echo"<br><a href='../cadastro_funcionario.php'>Voltar</a>";  
        }