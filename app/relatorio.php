<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<?php
session_start();
include_once('../src/verificaPerm.php');
include_once('../src/cabeçalho.php');
include_once('select.php');
?>
    <form action="modelor.php" method="GET">
      <p>Nome: <select name="nome_relatorio" required>
          <option value="" default></option>
          <?php while($opcao = $resposta_option->fetch_array()):?>
            <option value="<?php echo $opcao['id'];?>"><?php echo $opcao['usuario']; ?></option>
          <?php endwhile;?>
      </select>
      Mes: <select name="data_relatorio" required>
         <option value=""></option>
         <?php while($opcao_data = $resposta_datar->fetch_array()):?>
            <option value="<?php echo $opcao_data['datar'];?>"><?php echo $opcao_data['datar']; ?></option>
          <?php endwhile;?>
      </select>
      
      
    <input type="submit" value="Gerar">
    </p>

    </form>
<?php
include_once('../src/rodape.php');
?>

</body>
</html>