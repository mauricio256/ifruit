<?php
include("conexao_db.php");

 $cod_valvula = $_GET['cod_valvula'];

    try {
        $conn = conecta();
        $query = $conn->query("DELETE FROM valvula WHERE cod_valvula_pk = '$cod_valvula'");

        if($query->execute()):
            echo"<script>
                alert('DELETADO COM SUCESSO!');
                javascript:window.location='../cadastro_valvula.php';
            </script>"; 
        endif;      
        } catch (Exception $e) {
            if($e->getCode() == 23000):
                echo" <div style='width: 100%; padding:20px; background-color:red; color:yellow;'>ATENÇÃO: Essa VÁLVULA possui LINHA(S) cadastrada(s), não é possível excluir<br></div>";    
            endif; 
            echo"<br><a href='../cadastro_valvula.php'>Voltar</a>";  
        }