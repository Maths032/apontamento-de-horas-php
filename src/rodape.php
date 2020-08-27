<?php
require_once('marcarHora.php');
require_once('calendario.php');
require_once('Conexao.php');
$datas = new Calendario;
$data = $_SESSION['data'];
$datas->mensalInfo($data);



$consultatotaldia = new Conexao;
$consultatotaldia->rodarQuery("SELECT * FROM horario 
WHERE id='{$_SESSION['id_horario']}' AND data='{$_SESSION['data']}'");

$dadototal = $consultatotaldia->getResultado();
$totald = $dadototal->fetch_array();

//calcula total mensal atual
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
     $total = explode(':', $total);

     $hora += $total[0] * 3600;
     if (isset($total[1])) {$minuto += $total[1] * 60;}
}  
$horas = ($hora /3600);

$horas = floor($hora /3600);
$minutos = floor($minuto /60);

if ($horas < 10) {$horas = ('0'. $horas);}
if ($minutos < 10) {$minutos = ('0'. $minutos);}



$totalmes = $horas.':'.$minutos;


//http://phpbrasil.com/phorum/read.php?1,175120



?>

<div class='rodape'>
    <h2 style="margin-left: 10px">Data: <?php echo $_SESSION['data']?></h2>
    <h2>Total Dia: <?php echo $totald['total']?></h2>
    <h2>Total Mensal Atual: <?php echo $totalmes?></h2>
    <h2 style="margin-right: 10px">Total Mensal Esperado:  <?php echo $datas->getHoramensal(), ':00';?></h2>
</div>