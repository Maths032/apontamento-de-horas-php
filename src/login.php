<?php
$data = date('d/m/Y');
require_once('Conexao.php');
session_start();
if(empty($_POST['login']) || empty($_POST['senha'])) {
    header('location: ../');
    exit();
}
$consulta = new Conexao();



$usuario = mysqli_real_escape_string($consulta->getConn(), $_POST['login']);
$senha = mysqli_real_escape_string($consulta->getConn(), $_POST['senha']);

$query = "select * from usuarios where usuario = '{$usuario}' and senha=md5('{$senha}')";

$consulta->rodarQuery($query);//Faz toda consulta no banco
// $resultado = mysqli_query($consulta->getConn(), $consulta->getResultado());

$linhas = mysqli_num_rows($consulta->getResultado());



while($dado = $consulta->getResultado()->fetch_array()){
     $id = $dado['id'];
     $nome = $dado['nome'];
     $entrada = $dado['horario1'];
     $almoco1 = $dado['horario2'];
     $almoco2 = $dado['horario3'];
     $saida = $dado['horario4'];
     $perm = $dado['permissao'];
}

if ($linhas == 1){
    $_SESSION['data'] = date('d/m/Y');
    $_SESSION['limite'] = '900';
    $_SESSION['tempo'] = time('s');
    $_SESSION['permissao'] = $perm;
    $_SESSION['id_usuario'] = $id;
    $_SESSION['id_horario'] = $id;
    $_SESSION['status'] = 1; 
    $_SESSION['usuario'] = $nome;
    $_SESSION['entrada'] = $entrada;
    $_SESSION['almoco1'] = $almoco1;
    $_SESSION['almoco2'] = $almoco2;
    $_SESSION['saida'] = $saida;
    header('location: ../app/marcarHora.php');
    exit();
}
if($linhas > '1'){  
    $_SESSION['naologado'] = true;
    header('location: ../index.php');
    exit();
    }
else{ 
$_SESSION['naologado'] = true;
header('location: ../index.php');
exit();
}
