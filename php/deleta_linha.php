<?php
include("conexao_db.php");

 $cod_linha = $_GET['cod_linha'];

    try {
        $conn = conecta();
        $query = $conn->query("DELETE FROM linha WHERE cod_linha_pk = '$cod_linha'");

        if($query->execute()):
            echo"<script>
                alert('DELETADO COM SUCESSO!');
                javascript:window.location='../cadastro_linha.php';
            </script>"; 
        endif;      
        } catch (Exception $e) {
            echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../cadastro_linha.php'>Voltar</a>";     
        }