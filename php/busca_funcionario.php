<?php 
include("conexao_db.php");

function busca_funcionario($cod_funcionario){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM funcionario WHERE cod_funcionario_pk = $cod_funcionario");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary    
        header('Location:../painel.php');
    else:
       return NULL;
    endif; 
}