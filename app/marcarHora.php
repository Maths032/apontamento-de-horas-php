<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de horas - painel</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php 

session_start();
include('../src/verificaPerm.php');
include_once('../src/cabeçalho.php');
include('select.php');

?>


<script language="javascript" src="javascript/functions.js"></script>



<?php 
if ($_SESSION['permissao'] <= 1): //mostra função de alterar usuario e data?>
<h3 style="font-weight:unset; padding:5px">Painel do usuario: <?php echo $_SESSION['nome_horario']  ?>, na data: <?php echo $_SESSION['data'] ?>. </h3>
 <button class="botaomenor" value='' onclick="javascript: alterarinfoadm()">alterar data e usuario</button>
<?php endif;?>

<?php if($_SESSION['permissao'] > 1):?>
<h3 style="font-weight:unset; padding:5px">Painel da data: <?php echo $_SESSION['data'] ?>. </h3>
<button class="botaomenor" value='' onclick="javascript: alterarinfopadrao()">alterar data do painel</button>
<?php endif;?>

<div class="geral"> 

<?php
if(isset($_SESSION['aviso'])){
    echo $_SESSION['aviso']; 
}
unset($_SESSION['aviso']);
?>


<div class="botoes">
<div class='ferramentas'><p><a  class='botao' href="marcar.php?var=h1">Registrar Entrada</a></p>
<?php 

if($horario1 <> '0' & $status1 == '0'){ 
    echo $horario1, '<button class="botaomenor" onclick="javascript: corrige1()"> Corrigir</button>';
}
if ($horario1 <> '0' & $status1 <> 0){    
    if ($status1 == 1) {
        echo $horario1, '<button class="botaomenor" onclick="javascript: corrige1()"> Corrigir</button>
        <b>Aguardando Aprovação para o horario ', $horarioc1, '...</b>';

        if ($_SESSION['permissao'] <= 1) {//verifica se o usuario e administrador para liberar botao para analise
            echo '<button class="botaomenor" onclick="javascript: verificacorrecao1()">Ver Solicitação</button>';
        }
    }

    if ($status1 == 2) {
        echo $horario1, '<button class="botaomenor" onclick="javascript: corrige1()"> Corrigir</button>
        <b>Aprovado o horario ', $horarioc1, '!</b>';
    }
    if ($status1 == 3) {
        echo $horario1, '<button class="botaomenor" onclick="javascript: corrige1()"> Corrigir</button>
        <b>Rejeitado o horario ', $horarioc1, '!</b>';
    }
}
?></div>

<div class='ferramentas'><p><a  class='botao' href="marcar.php?var=h2">Registrar Saida p/ Almoço</a></p>
<?php 
if($horario2 <> '0' & $status2 == '0'){ 
    echo $horario2, '<button class="botaomenor" onclick="javascript: corrige2()"> Corrigir</button>';
}
if ($horario2 <> '0' & $status2 <> 0){
    if ($status2 == 1) {
        echo $horario2, '<button class="botaomenor" onclick="javascript: corrige2()"> Corrigir</button>
        <b>Aguardando Aprovação para o horario ', $horarioc2, '...</b>';
        if ($_SESSION['permissao'] <= 1) {//verifica se o usuario e administrador para liberar botao para analise
            echo '<button class="botaomenor" onclick="javascript: verificacorrecao2()">Ver Solicitação</button>';
        }
    }

    if ($status2 == 2) {
        echo $horario2, '<button class="botaomenor" onclick="javascript: corrige2()"> Corrigir</button>
        <b>Aprovado o horario ', $horarioc2, '!</b>';
    }
    if ($status2 == 3) {
        echo $horario2, '<button class="botaomenor" onclick="javascript: corrige2()"> Corrigir</button>
        <b>Rejeitado o horario ', $horarioc2, '!</b>';
    }
}
?></div>

<div class='ferramentas'><p><a  class='botao' href="marcar.php?var=h3">Registrar Volta Do Almoço</a></p>
<?php 
if($horario3 <> '0' & $status3 == '0'){ 
    echo $horario3, '<button class="botaomenor" onclick="javascript: corrige3()"> Corrigir</button>';
}
if ($horario3 <> '0' & $status3 <> 0){
    if ($status3 == 1) {
        echo $horario3, '<button class="botaomenor" onclick="javascript: corrige3()"> Corrigir</button>
        <b>Aguardando Aprovação para o horario ', $horarioc3, '...</b>';
        if ($_SESSION['permissao'] <= 1) {//verifica se o usuario e administrador para liberar botao para analise
            echo '<button class="botaomenor" onclick="javascript: verificacorrecao3()">Ver Solicitação</button>';
        }
    }

    if ($status3 == 2) {
        echo $horario3, '<button class="botaomenor" onclick="javascript: corrige3()"> Corrigir</button>
        <b>Aprovado o horario ', $horarioc3, '!</b>';
    }
    if ($status3 == 3) {
        echo $horario3, '<button class="botaomenor" onclick="javascript: corrige3()"> Corrigir</button>
        <b>Rejeitado o horario ', $horarioc3, '!</b>';
    }
}
?></div>

<div class='ferramentas'><p><a  class='botao' href="marcar.php?var=h4">Registrar Saida</a></p>
<?php 
if($horario4 <> '0' & $status4 == '0'){ 
    echo $horario4, '<button class="botaomenor" onclick="javascript: corrige4()"> Corrigir</button>';
}
if ($horario4 <> '0' & $status4 <> 0){
    if ($status4 == 1) {
        echo $horario4, '<button class="botaomenor" onclick="javascript: corrige4()"> Corrigir</button>
        <b>Aguardando Aprovação para o horario ', $horarioc4, '...</b>';
        if ($_SESSION['permissao'] <= 1) {//verifica se o usuario e administrador para liberar botao para analise
            echo '<button class="botaomenor" onclick="javascript: verificacorrecao4()">Ver Solicitação</button>';
        }
    }

    if ($status4 == 2) {
        echo $horario4, '<button class="botaomenor" onclick="javascript: corrige4()"> Corrigir</button>
        <b>Aprovado o horario ', $horarioc4, '!</b>';
    }
    if ($status4 == 3) {
        echo $horario4, '<button class="botaomenor" onclick="javascript: corrige4()"> Corrigir</button>
        <b>Rejeitado o horario ', $horarioc4, '!</b>';
    }
}
?></div>
</div>
<a href="marcar.php?var=apagar">Resetar horarios</a>




<!-- POP-UPS SAO INSERIDOS INSERIDOS -->
<?php
include_once('javascript/popup.php');
?>




</div>
<pre>
<!-- <?php print_r($conn);?> -->
</pre>
<?php
include_once('../src/rodape.php')
?>
</body>
</html>