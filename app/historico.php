<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Sistema de Horas - Historico</title>
</head>
<body>
<script language="javascript" src="javascript/functions.js"></script>
<?php

if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
    session_start();
}
include('../src/verificaPerm.php');
include_once('../src/cabeçalho.php');

$dataquebrada = explode('/', $_SESSION['data']);
include('../src/Conexao.php');



$historico = new Conexao();
$option = new Conexao();
$datas = new Conexao();
$option->rodarQuery('select * from usuarios');

$datas->rodarQuery("SELECT * FROM horario WHERE
 id='{$_SESSION['id_horario']}' AND data LIKE '%$dataquebrada[1]/$dataquebrada[2]%' ORDER BY id_horario asc");

$historico->rodarQuery("SELECT * FROM horario
WHERE id='{$_SESSION['id_horario']}' AND data LIKE '%$dataquebrada[1]/$dataquebrada[2]' ORDER BY data asc  ");
$resposta_option = $option->getResultado();
$resposta_datas = $datas->getResultado();

 


?>
<script language="javascript" type="text/javascript">
function alterarinfoadm(){
     document.getElementById('alterarinfoadm').style.display = 'block';
     document.getElementById('alterarinfoadm').style.opacity = '1';
     document.getElementById('alterarinfoadm').style.width = '360px';
     
    }

    function alterarinfopadrao(){
    document.getElementById('alterarinfopadrao').style.display = 'block';
    document.getElementById('alterarinfopadrao').style.opacity = '1';
    document.getElementById('alterarinfopadrao').style.width = '360px';
    }
</script>
<?php if ($_SESSION['permissao'] <= 1): //mostra função de alterar usuario e data?>
<h3 style="font-weight:unset; padding:5px">Painel do usuario: <?php echo $_SESSION['nome_horario']  ?>, na data: <?php echo $_SESSION['data'] ?>. </h3>
 <button class="botaomenor" value='' onclick="javascript: alterarinfoadm()">alterar data e usuario</button>
<?php endif;?>

<?php if($_SESSION['permissao'] > 1):?>
<h3 style="font-weight:unset; padding:5px">Painel da data: <?php echo $_SESSION['data'] ?>. </h3>
<button class="botaomenor" value='' onclick="javascript: alterarinfopadrao()">alterar data do painel</button>
<?php endif;?>

<div class="geral">
<table class="tabela">

<tr>
    <td class="cabecalho">data</td>
    <td class="cabecalho">Entrada</td>
    <td class="cabecalho">Saida P/ Almoço</td>
    <td class="cabecalho">Volta do almoço</td>
    <td class="cabecalho">Saida</td>
    <td class="cabecalho">total</td>
    <td class="cabecalho">status</td>
    <td class="cabecalho">Alterar</td>
</tr>
<?php while($dado = $historico->getResultado()->fetch_array()):
    if ($dado['status_correcao1'] == 0 && $dado['status_correcao2'] == 0 && $dado['status_correcao3'] == 0 && $dado['status_correcao4'] == 0 ) {//define se ha alguma correção solicitada no dia.
        $status_correcao = '<img src="../img/icons/check.png" title="Sem Alteração" alt="Tudo Certo">';
    }
    if ($dado['status_correcao1'] == 2 || $dado['status_correcao2'] == 2 || $dado['status_correcao3'] == 2 || $dado['status_correcao4'] == 2) {
        $status_correcao = '<img src="../img/icons/check.png" title="Um dos horarios foi corrigido" alt="Tudo Certo">';
    }
    if ($dado['status_correcao1'] == 3 || $dado['status_correcao2'] == 3 || $dado['status_correcao3'] == 3 || $dado['status_correcao4'] == 3) {
        $status_correcao = '<img src="../img/icons/cross.png" title="Um horario foi Rejeitado" alt="Um horario foi Rejeitado">';
    }
    if ($dado['status_correcao1'] == 1 || $dado['status_correcao2'] == 1 || $dado['status_correcao3'] == 1 || $dado['status_correcao4'] == 1) {
        $status_correcao = '<img src="../img/icons/aguardando.png" title="Um horario esta aguardando aprovação" alt="Um horario esta aguardando aprovação">';
    }
    if ($dado['horario1'] <> '0' && $dado['horario4'] == '0') {
        $status_correcao = '<img src="../img/icons/cross.png" title="O horario não esta completo" alt="O horario não esta completo">';
    }
    ?>
<tr class="linha">
    <td class="dados"><?php echo $dado['data']?></td>
    <td class="dados"><?php echo $dado['horario1']?></td>
    <td class="dados"><?php echo $dado['horario2']?></td>
    <td class="dados"><?php echo $dado['horario3']?></td>
    <td class="dados"><?php echo $dado['horario4']?></td>
    <td class="dados"><?php echo $dado['total']?></td>
    <td class="dados"><?php echo $status_correcao?></td>
    <td class="dados"><?php echo '<a href="','marcar.php?datah=',$dado['data'],'">Ver</a>'?></td>
</tr>
<?php endwhile;?>
</table>


</div>
<div class='popup' id='alterarinfoadm'>
    <h4>Coloque o Usuario e Data do painel.</h4><br> 
    <form action="marcar.php" method="GET"> 
   <p>Usuario:<select name="usuarioh" required>
           <option selected></option>
           <?php while($dado = $resposta_option->fetch_array()){ 
        echo '<option value="',$dado['id'],'">',$dado['usuario'],'</option>';
     }?>
       </select><br>
       Data:<input  type="date" name="data" id="data" required>
       <br>
       <input class="botaomenor" type="button" value="Cancelar" onclick="javascript: fechar('alterarinfoadm')"> <input type="submit" class="botaomenor" value="Alterar">
   </form> 
</div>

<div class='popup' id='alterarinfopadrao'><h4>Escolha a data do painel.</h4><br> 
    <form action="marcar.php" method="GET"> 
   <p>Data:<select name="datah" required>
           <option selected></option>
           <?php while($dado = $resposta_datas->fetch_array()){ 
        echo '<option value="',$dado['data'],'">',$dado['data'],'</option>';
       }?>
       </select><br>
      
       <input class="botaomenor" type="button" value="Cancelar" onclick="javascript: fechar('alterarinfopadrao')">
       <input type="submit" class="botaomenor" value="Alterar Data">
   </form> 
</div>


<?php

include_once('../src/rodape.php');
?>

</body>
</html>