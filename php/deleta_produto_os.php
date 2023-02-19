<?php
include("conexao_db.php");

$cod_os = $_GET['cod_os'];
$cod_produto = $_GET['cod_produto'];

    try {
        $conn = conecta();
        $query = $conn->query("DELETE FROM produto_os WHERE cod_os_fk = '$cod_os' AND cod_produto_fk = '$cod_produto'");

        if($query->execute()):
            echo"<script>
                alert('DELETADO COM SUCESSO!');
                javascript:window.location='../produtos_os.php?cod_os=$cod_os';
            </script>"; 
        endif;      
        } catch (Exception $e) {
            echo "<div style='width: 100%; padding:20px; background-color:red; color:yellow;'>Ocorreu um erro: Mesangem de erro:".  $e->getMessage() ."</div><br><a href='../produtos_os.php?cod_os=$cod_os'>Voltar</a>";    
        }