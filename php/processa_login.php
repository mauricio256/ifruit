<?php
    session_start();
    include("conexao_db.php");

    $user  = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

    function limpaCPF_CNPJ($valor){
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    $user =  limpaCPF_CNPJ($user);

        $conn = conecta();
        $query = $conn->query("SELECT * FROM funcionario WHERE BINARY CPF = '$user' AND BINARY senha = '$pass' ");
        if($query->fetch()):   //// verifica se a query retorna algum valor caso nao, dado nao possui no banco 
            $query->execute();     /// execulta a query
            $dados = $query->fetch(PDO::FETCH_ASSOC);   ///returna um objeto com todos os valores da quary    
            header('Location:../painel.php');
            $_SESSION['login'] = $dados;
            $conn = NULL; 
        else:
            echo"<script>
                    alert('Usuário ou senha incorretos! Tente novamente');
                    javascript:window.location='../login.html';
                </script>";  
        endif;   