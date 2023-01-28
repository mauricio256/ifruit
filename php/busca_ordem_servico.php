<?php 
include("conexao_db.php");

function ordem_servico_atividades($cod_funcionario){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM ordem_servico WHERE BINARY cod_funcionario_fk = $cod_funcionario AND tipo_os = 'Atividades' ");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary    
        header('Location:../painel.php');
    else:
       return NULL;
    endif; 
}

function ordem_servico_pulverizacao($cod_funcionario){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM ordem_servico WHERE BINARY cod_funcionario_fk = $cod_funcionario AND tipo_os = 'Pulverização' ");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary    
        header('Location:../painel.php');
    else:
       return NULL;
    endif; 
}

function ordem_servico_adubacao($cod_funcionario){
    $conn = conecta();
    $query = $conn->query("SELECT * FROM ordem_servico WHERE BINARY cod_funcionario_fk = $cod_funcionario AND tipo_os = 'Adubação' ");
    if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
        $query->execute();     /// execulta a query
        $conn = NULL;
        return $query->fetchALL(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary    
        header('Location:../painel.php');
    else:
       return NULL;
    endif; 
}

