<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/relatorio.css">
    <meta http-equiv="refresh" content="">
    <title></title>
</head>
<body>
<?php
session_start();
include_once('../src/Conexao.php');
include_once('../src/verificaPerm.php');
include_once('../src/calendario.php');
$mesr = new Calendario;
$dataa = '01/'.$_GET['data_relatorio'];

$mesr->mensalInfo($dataa);
$horamensal = $mesr->getHoramensal();
$id = $_GET['nome_relatorio'];
$periodo = $_GET['data_relatorio'];



$consulta_relatorio = new Conexao;
$consulta_nomecompleto = new Conexao;
$consulta_relatorio->rodarQuery("SELECT * FROM horario WHERE id='$id' AND data LIKE '%$periodo' order by data; ");
$consulta_nomecompleto->rodarQuery("SELECT * FROM usuarios WHERE id='$id'");
$nomecompleto = $consulta_nomecompleto->getResultado()->fetch_array();
$consultatotalmes = new Conexao;
$consultatotalmes->rodarQuery("SELECT * FROM horario
WHERE id='$id' AND data LIKE '%$periodo' ");
// echo $consultatotalmes->getQuery();
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


?>
<div class="centralizar">
  
    <table>
        <tr class="nome-linha"><p class="titulo">Controle de Horas</p>
            <td colspan="6" class="nome-dado"><?php echo $nomecompleto['nome_completo']?></td>
        </tr>
        <tr class="cabeçalho-linha">
            <td class="cabeçalho-dado">data</td>
            <td class="cabeçalho-dado">entrada</td>
            <td class="cabeçalho-dado">Saida p/ almoço</td>
            <td class="cabeçalho-dado">Volta do Almoço</td>
            <td class="cabeçalho-dado">Saida</td>
            <td class="cabeçalho-dado">Total</td>
        </tr>
        <?php while($hora_relatorio = $consulta_relatorio->getResultado()->fetch_array()):?>
        <tr class="horario-linha">
            
            <td class="horario-dado"><?php echo $hora_relatorio['data']?></td>
            <td class="horario-dado"><?php echo $hora_relatorio['horario1']?></td>
            <td class="horario-dado"><?php echo $hora_relatorio['horario2']?></td>
            <td class="horario-dado"><?php echo $hora_relatorio['horario3']?></td>
            <td class="horario-dado"><?php echo $hora_relatorio['horario4'] ?></td>
            <td class="horario-dado"><?php echo $hora_relatorio['total'] ?></td>

        </tr>
        <?php endwhile;?>
        <tr class="jornada-linha">
            <td class="jornada-dado" colspan="3">Jornada Mensal Esperada: <?php echo $horamensal, ':00'?></td>
            <td class="jornada-dado" id="lateral" colspan="3">Jornada Mensal Realizada: <?php echo $totalmes ?></td>
        </tr>
        <tr class="observação-linha">
            <td class="observação-dado" colspan="6">observação:<br><textarea cols="56" rows="2"></textarea></td>
        </tr>
        <tr class="assinatura-linha">
        <td class="assinatura-dado"colspan="6">
            Assinatura do Empregado: <br>
            Assinatura do Responsavel: 
        </td>
        </tr>
    </table>

</div>
</body>
</html>