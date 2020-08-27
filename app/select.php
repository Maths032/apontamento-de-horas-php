 <?php
 include('../src/Conexao.php');
$dataquebrada = explode('/', $_SESSION['data']);
$usuario = new Conexao();
$option = new Conexao();
$horario = new Conexao();
$datas = new Conexao();
$datar = new Conexao();
$datar->rodarQuery("SELECT RIGHT (DATA, 7) AS 'datar' FROM horario horario GROUP BY datar ORDER BY RIGHT(DATA, 4) DESC, datar desc");
$horario->rodarQuery("select * from horario where id='{$_SESSION['id_horario']}' and data='{$_SESSION['data']}'");
$usuario->rodarQuery("select * from usuarios where id='{$_SESSION['id_horario']}'");
$option->rodarQuery('select * from usuarios');
$datas->rodarQuery("SELECT * FROM horario WHERE
 id='{$_SESSION['id_horario']}' AND data LIKE '%$dataquebrada[1]/$dataquebrada[2]%' ORDER BY id_horario asc");
$resposta_option = $option->getResultado();
$resposta_usuario = $usuario->getResultado();
$resposta_horario = $horario->getResultado();
$resposta_datas = $datas->getResultado();
$resposta_datar = $datar->getResultado();

$dado2 = $resposta_horario->fetch_array();

$horario1 = $dado2['horario1'];
$horario2 = $dado2['horario2'];
$horario3 = $dado2['horario3'];
$horario4 = $dado2['horario4'];
$horarioc1 = $dado2['correcao1'];
$horarioc2 = $dado2['correcao2'];
$horarioc3 = $dado2['correcao3'];
$horarioc4 = $dado2['correcao4'];
$status1 = $dado2['status_correcao1'];
$status2 = $dado2['status_correcao2'];
$status3 = $dado2['status_correcao3'];
$status4 = $dado2['status_correcao4'];
$obs = $dado2['obs'];
$dado1 = $resposta_usuario->fetch_array();
 
    $_SESSION['nome_horario'] = $dado1['usuario'];
 ?>