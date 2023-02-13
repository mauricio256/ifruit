<?php
include("conexao_db.php");

 $cod_os = $_GET['cod_os'];

    try {
        $conn = conecta();
        $query1 = $conn->query("DELETE FROM produto_os WHERE cod_os_fk = '$cod_os'");
        $query1->execute();  

        $query2 = $conn->query("DELETE FROM ordem_servico WHERE cod_os_pk = '$cod_os' ");
        if($query2->execute()):
            echo"<script>
                alert('DELETADO COM SUCESSO!');
                javascript:window.location='../cadastro_ordem_servico.php';
            </script>"; 
        endif;      
        } catch (Exception $e) {
            echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_ordem_servico.php'>Voltar</a>";     
        }