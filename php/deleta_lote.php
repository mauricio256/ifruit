<?php
include("conexao_db.php");

 $cod_lote = $_GET['cod_lote'];

    try {
        $conn = conecta();
        $query = $conn->query("DELETE FROM lote WHERE cod_lote_pk = '$cod_lote'");

        if($query->execute()):
            echo"<script>
                alert('DELETADO COM SUCESSO!');
                javascript:window.location='../cadastro_lote.php';
            </script>"; 
        endif;      
        } catch (Exception $e) {
            echo "<br>";     
            if($e->getCode() == 23000):
                echo" <div style='width: 100%; padding:20px; background-color:red; color:yellow;'>ATENÇÃO: Esse LOTE possui LINHA(S) e/ou VALVULA(S) cadastrada(s), não é possível excluir<br></div>";
            endif; 
            echo"<br><a href='../cadastro_lote.php'>Voltar</a>";       
        }