<?php
include("conexao_db.php");

$cod_produto = $_GET['cod_produto'];

    try {
        $conn = conecta();
        $query = $conn->query("DELETE FROM produto WHERE  cod_produto_pk = '$cod_produto'");

        if($query->execute()):
            echo"<script>
                alert('DELETADO COM SUCESSO!');
                javascript:window.location='../cadastro_produto.php?cod_produto=$cod_produto';
            </script>"; 
        endif;      
        } catch (Exception $e) {
            if($e->getCode() == 23000):
                echo" <div style='width: 100%; padding:20px; background-color:red; color:yellow;'>ATENÇÃO: Esse PRODUTO está contido um ORDEM(S) DE SERVIÇO(S), não é possível excluir sem antes finaliza-las<br></div>";
            endif; 
            echo"<br><a href='../cadastro_produto.php?cod_produto=$cod_produto''>Voltar</a>";  
        }