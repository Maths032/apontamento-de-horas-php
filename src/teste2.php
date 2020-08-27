<?php
require_once('Conexao.php');
$data = date('d/m/Y');
    $query = "select * from horario where id='15' and data='$data'";
    echo $query;
    $consultar = new Conexao();
    $consultar->rodarQuery($query);

    $horario1 = '0';
    $horario2 = '0';
    $horario3 = '0';
    $horario4 = '0';
    
   
    while($dado = $consultar->getResultado()->fetch_array()){
       $id_horario = $dado['id_horario'];
       $horario1 = $dado['horario1'];
       $horario2 = $dado['horario2'];
       $horario3 = $dado['horario3'];
       $horario4 = $dado['horario4'];
   }
    echo $horario1,"<br>";
    echo $horario2,"<br>";
    echo $horario3,"<br>";
    echo $horario4,"<br>";


?>  