<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastro</title>
</head>
<body>
<?php 
session_start();
include_once('../src/cabeçalho.php');
include_once('../src/Conexao.php');
include_once('../src/verificaPerm.php');
?>
<div class="formulario">
<form action="cadastrar.php" method="get">
    <p>Nome completo:<input required class="campo-texto" type="text" name="nomec" id="nomec"></p>
    <p>Apelido: <input required class="campo-texto" type="text" name="apelido" id="apelido"></p>
    <p>Usuario: <input required class="campo-texto" type="text" name="usuario" id="usuario"></p>
    <p>Senha: <input required class="campo-texto" type="password" name="senha" id="senha"></p>
    <p>Entrada: <input required class="campo-hora" type="time" name="horario1" id="horario1"></p>
    <p>Saida p/ Almoço: <input required class="campo-hora" type="time" name="horario2" id="horario2"></p>
    <p>Volta do Almoço:<input required class="campo-hora" type="time" name="horario3" id="horario3"></p>
    <p>Saida: <input required class="campo-hora" type="time" name="horario4" id="horario4"></p>
    <p>Permissao: <select required class="campo-select" name="perm" id="">
    <option value="2">Padrao</option>
    <option value="1">Administrador</option>
    </select></p>
    <input type="submit" value="Cadastrar">
</form>
<?php



if(isset($_GET['nomec'])){
$verifica = new Conexao;
$verifica->rodarQuery("SELECT * FROM usuarios WHERE usuario='{$_GET['usuario']}'");
$resultado = $verifica->getResultado();
$row = mysqli_num_rows($resultado); 

    if ( $row >= 1) {
        echo "<p class='erro'>O Usuario ", $_GET['usuario'], " ja existe</p>";
        exit();
    }
    $cadastra = new Conexao;
    $cadastra->rodarQuery("INSERT INTO usuarios (nome_completo, nome, usuario, senha, horario1, horario2, horario3, horario4, permissao) VALUES
    ('{$_GET['nomec']}', '{$_GET['apelido']}', '{$_GET['usuario']}', MD5('{$_GET['senha']}'), '{$_GET['horario1']}', '{$_GET['horario2']}', '{$_GET['horario1']}', '{$_GET['horario1']}', '{$_GET['perm']}');");
    if ($cadastra->getErro_query() == '') {
        echo "<p class='certo'>Usuario ", $_GET['usuario'], " cadastrado com sucesso! </p>";
    }
}
?>
</div>
</body>
</html>