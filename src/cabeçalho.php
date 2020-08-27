<?php
$hora = date('H:i');

?>
    <nav class="menu">
            <ul>
                <li>
                    <a>Sistema de hora</a>
                    <ul>
                        <li><a href="marcarHora.php">Marcar Hora</a></li>
                        <li><a href="historico.php">Historico</a></li>
                    </ul>
                </li><?php if($_SESSION['permissao'] <= 1):?>
                <li>
                    <a>Administração</a>
                    <ul>
                        <li><a href="relatorio.php">Gerar Relatorio</a></li>
                        <li><a href="cadastrar.php">Cadastrar</a></li>
                        <li><a href="../src">Test</a></li>
                    </ul>
                </li>
                <?php endif;?>
                <li>
                    <a>Bem Vindo, <?php echo $_SESSION['usuario']?></a>
                    <ul>
                        <li><a href="../src/logout.php">Sair</a></li>
                        <li><button onclick="">Alterar Senha</button></li>
                    </ul>
                </li>
            </ul>
            <h2>Horario do servidor: <?php echo $hora;?></h2>
      </nav>