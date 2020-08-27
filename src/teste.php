<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<?php
// include('verificaPerm.php');
session_start();
include_once('cabeçalho.php');
require_once('calendario.php');
require_once('marcarHora.php');
?>
<body>

<?php
echo '<pre>';

$dataquebrada = explode('/', $_SESSION['data']);
$consultatotalmes = new Conexao;
$consultatotalmes->rodarQuery("SELECT * FROM horario
WHERE id='{$_SESSION['id_horario']}' AND data LIKE '%$dataquebrada[1]/$dataquebrada[2]%' ");

$dadototalmes = $consultatotalmes->getResultado();
$hora = 0;
$minuto = 0;
while($totalmes = $dadototalmes->fetch_array()){
    
     $total = $totalmes['total'];
     $data = $totalmes['data'];
     echo $data, ': ';
     echo $total, '<br>';
     $total = explode(':', $total);

     $hora += $total[0] * 3600;
     $minuto += $total[1] * 60;
}  
$horas = ($hora /3600);

$horas = floor($hora /3600);
$minutos = floor($minuto /60);

if ($horas < 10) {$horas = ('0'. $horas);}
if ($minutos < 10) {$minutos = ('0'. $minutos);}



$horatotal = $horas.':'.$minutos;

echo  $horatotal;
//http://phpbrasil.com/phorum/read.php?1,175120
?>
    

<?php include_once('rodape.php')?>
</body>


</html>