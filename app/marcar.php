<?php
session_start();
$id = $_SESSION['id_horario'];

require_once('../src/marcarHora.php');
require_once('../src/calendario.php');

$horario = new MarcarHora;
//converte a data enviada pelo formulario para o padrao brasileiro e joga na variavel de sessao e altera no painel
if(isset($_GET['data']) && $_SESSION['permissao'] <= 1 && isset($_GET['usuario'])){
    $_SESSION['id_horario'] = $_GET['usuario'];
    $dataalterada = $_GET['data'];
    $dataalterada = strtotime($dataalterada);
    $datacerta = date('d/m/Y', $dataalterada);
    $_SESSION['data'] = $datacerta;
    $horario->setResult(7);
}
//converte a data enviada pelo formulario para o padrao brasileiro e joga na variavel de sessao e altera no historico
if(isset($_GET['data']) && $_SESSION['permissao'] <= 1 && isset($_GET['usuarioh'])){
    $_SESSION['id_horario'] = $_GET['usuarioh'];
    $dataalterada = $_GET['data'];
    $dataalterada = strtotime($dataalterada);
    $datacerta = date('d/m/Y', $dataalterada);
    $_SESSION['data'] = $datacerta;
    $horario->setResult(7);
    header('location: historico.php');
}

if(isset($_GET['data']) && $_SESSION['permissao'] > 1){
    $_SESSION['data'] = $_GET['data'];
    $horario->setResult(7);
}
if(isset($_GET['datah'])){
    $_SESSION['data'] = $_GET['datah'];
    $horario->setResult(7);
}

if(isset($_GET['rejeita'])){
    $horario->rejeitaCorrecao($_GET['rejeita'], $_SESSION['data'], $_SESSION['id_horario']);
}

if(isset($_GET['aprova'])){
    $horario->aprovaCorrecao($_GET['aprova'], $_SESSION['data'], $_SESSION['id_horario']);
}


$data = $_SESSION['data'];

if(isset($_GET['correcao']) ){
    if(isset($_GET['correcao']) && $_GET['correcao']  == 1 || $_GET['correcao']  == 2 || $_GET['correcao']  == 3 || $_GET['correcao']  == 4){
        $horario->solicitaCorrecao(//solicita a correção
            $_GET['correcao'], $_GET['hora'], $_SESSION['id_horario'], $_SESSION['data'], $_GET['obs']
        );
    }
}
if(isset($_GET['var'])){
    $tipo = $_GET['var'];
    $horario->Marcar($tipo, $id);
}

if ($tipo == 'apagar') {
    $horario->deletar($id, $data);
}


 if ($horario->getResult() == 1) {
     $_SESSION['aviso'] = '<p class="certo">Registro feito com sucesso</p>';
 }
 if ($horario->getResult() == 2) {
     $_SESSION['aviso'] = '<p class="erro">Erro registro ja realizado</p>';
 }
 if ($horario->getResult() == 3) {
     $_SESSION['aviso'] = '<p class="erro">Marque o Horario Anterior primeiro</p>';
 }
 if ($horario->getResult() == 0){
     $_SESSION['aviso'] = '<p class="erro">Erro interno do sistema, favor consultar o departamento de T.I!</p>';
 }
 if($horario->getResult() == 4){
     $_SESSION['aviso'] = '<p class="erro">Erro! A saida ja foi registrada</p>';
 }
 if($horario->getResult() == 5){
    $_SESSION['aviso'] = '<p class="aviso">Confirme o popup <br><body onLoad="javascript: abrir()"></p>';
 }
 if($horario->getResult() == 6){
    $_SESSION['aviso'] = '<p class="erro">Marque sua Entrada primeiro.<br></p>';
 }
if($horario->getResult() == 7){
    $_SESSION['aviso'] = '<p class="aviso">A data do painel foi alterada com sucesso<br></p>';
}
if($horario->getResult() == 8){
    $_SESSION['aviso'] = '<p class="aviso">Sua Correção foi solicitada com sucesso<br></p>';
}
if($horario->getResult() == 9){
    $_SESSION['aviso'] = '<p class="aviso">A Correção foi aprovada com sucesso!<br></p>';
}
if($horario->getResult() == 10){
    $_SESSION['aviso'] = '<p class="certo">A correção foi rejeitada com sucesso<br></p>';
}
if($horario->getResult() == 11){
    $_SESSION['aviso'] = '<p class="certo">A correção foi aprovada com sucesso<br></p>';
}
// $_SESSION['aviso'] = $horario->getResult();
// $_SESSION['aviso'] = $horario->getResult();
?>

<pre>
    <?php
    header('location: marcarHora.php');
    print_r($horario);
    
    ?>
</pre>