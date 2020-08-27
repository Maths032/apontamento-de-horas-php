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
?>
<body>

<?php
echo '<pre>';
$datas = new Calendario;
$data = date('d/m/Y');
$datas->mensalInfo($data);

$hora1 = '10:00';
$hora2 = '12:30';
$hora3 = '13:30';
$hora4 = '17:00';


$cal1 = strtotime($hora1);
$cal2 = strtotime($hora2);
$cal3 = strtotime($hora3);
$cal4 = strtotime($hora4);

$calcular = $cal2 - $cal1 + $cal4 - $cal3;  

$resultado = gmdate('H:i', $calcular);


echo 'hora1 timestamp: ', $cal1,  '<br>';
echo 'hora2 timestamp: ',$cal2,  '<br>';
echo 'hora3 timestamp: ',$cal3,  '<br>';
echo 'hora4 timestamp: ',$cal4,  '<br>';
echo 'resultado em timestamp: ', $calcular,  '<br>';
echo 'resultado em horas: ',$resultado,  '<br>';





?>
    

<?php include_once('rodape.php')?>
</body>


</html>