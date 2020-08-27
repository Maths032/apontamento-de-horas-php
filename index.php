<?php
session_start();

?>

<!doctype HTML>
<html>
<head>
<meta charset="utf-8">
<title>Controle de Horas - login</title>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/index.css">
<metahttp-equiv="refresh" content="1" >
<meta>
</head>
<body>
<div id="geral">

<div id="form">
<hr>
    <h2>LOGIN</h2>
    
    <?php if(isset($_SESSION['naologado'])): ?>
    <p class="alerta">Usuario e/ou Senha incorretos</p>
    
    <?php endif;
    if( isset($_SESSION['status'])){
        if ($_SESSION['status'] == 'naoautorizado') {
            echo '<p class="alerta">Acesso Negado, Faça login Novamente</p>';
            header('location:sla');
        }
    
    }
     unset($_SESSION['naologado']);
    ?>

    <form action="src/login.php" method="POST">
    <input class="campo" type="text" maxlength="50" placeholder="Login" name="login"><br>
    <input class="campo" type="password" maxlength="30" placeholder="Senha" name="senha">
    <input class="botao" type="submit" value="Entrar">
    </form>
</div>
</div>
</body>
</html>