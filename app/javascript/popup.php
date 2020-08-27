<?php
include_once('select.php');
?>
<div class='popup' id='confirmahorario' value="horario">
    <h4>Tem certeza que deseja registrar a saida sem almoço?</h4><br>
    <a href="marcarHora.php"><buttton class="botaomenor" >Cancelar</buttton></a><a href="marcar.php?var=h44"><buttton class="botaomenor" >Confirmar</button></a>
</div>

<div class='popup' id='corrigehorario1'>
    <h4>Coloque o horario correto da entrada e Confirme.</h4><br>
    <form action="marcar.php" method="GET">
        Horario Correto:<br>
        <input type="time" name="hora" required><br>
        Observação: <br>
        <textarea name="obs" cols="35" rows="2" placeholder="Observação" required></textarea>
        <input type="hidden" name="datasolicitada" value="<?php echo $_SESSION['data'];?>">
        <input type="hidden" name="correcao" value="1"><br>
        <input class="botaomenor" type="button" value="Cancelar" onclick='javascript: fechar("corrigehorario1")'><input class="botaomenor"  type="submit" value="Solicitar">
    </form>
</div>

<div class='popup' id='corrigehorario2'>
    <h4>Coloque o horario correto da saida para o almoço e Confirme.</h4><br>
    <form action="marcar.php" method="GET">
        Horario Correto:<br>
        <input type="time" name="hora" required><br>
        Observação: <br>
        <textarea name="obs" cols="30" rows="2" placeholder="Observação" required></textarea>
        <input type="hidden" name="datasolicitada" value="<?php echo $_SESSION['data'];?>">
        <input type="hidden" name="correcao" value="2">
        <input class="botaomenor" type="button" value="Cancelar" onclick="javascript: fechar('corrigehorario2')"><input class="botaomenor" type="submit" value="Solicitar">
    </form>
</div>

<div class='popup' id='corrigehorario3'>
    <h4>Coloque o horario correto da volta do almoço e Confirme.</h4><br>
    <form action="marcar.php" method="GET">
        Horario Correto:<br>
        <input type="time" name="hora" required><br>
        Observação: <br>
        <textarea name="obs" cols="30" rows="2" placeholder="Observação" required></textarea>
        <input type="hidden" name="datasolicitada" value="<?php echo $_SESSION['data'];?>">
        <input type="hidden" name="correcao" value="3">
        <input class="botaomenor" type="button" value="Cancelar" onclick="javascript: fechar('corrigehorario3')"><input class="botaomenor" type="submit" value="Solicitar">
    </form>
</div>

<div class='popup' id='corrigehorario4'>
    <h4>Coloque o horario da saida correto e Confirme.</h4><br>  
    <form action="marcar.php" method="GET">
        Horario Correto:<br>
        <input type="time" name="hora" required><br>
        Observação: <br>
        <textarea name="obs" cols="30" rows="2" placeholder="Observação" required></textarea>
        <input type="hidden" name="datasolicitada" value="<?php echo $_SESSION['data'];?>">
        <input type="hidden" name="correcao" value="4">
        <input class="botaomenor" type="button" value="Cancelar" onclick="javascript: fechar('corrigehorario4')"><input class="botaomenor" type="submit" value="Solicitar">
    </form>
</div>

<div class='popup' id='alterarinfoadm'>
    <h4>Coloque o Usuario e Data do painel.</h4><br> 
    <form action="marcar.php" method="GET"> 
   <p>Usuario:<select name="usuario" required>
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
   <p>Data:<select name="data" required>
           <option selected></option>
           <?php while($dado = $resposta_datas->fetch_array()){ 
        echo '<option value="',$dado['data'],'">',$dado['data'],'</option>';
       }?>
       </select><br>
      
       <input class="botaomenor" type="button" value="Cancelar" onclick="javascript: fechar('alterarinfopadrao')">
       <input type="submit" class="botaomenor" value="Alterar Data">
   </form> 
</div>

<div class="popup" id="verificacorrecao1">
    
   <h4> Solicitação de Correção do usuario: <?php  echo $_SESSION['nome_horario']; ?></h4><br>
   <p> Hora Registrada:  <?php  echo $horario1; ?><br>
    Hora Corrigida: <?php  echo $horarioc1; ?><br><br></p>
    Observação: <br> <textarea cols="40" rows="2"><?php  echo $obs; ?></textarea>
    <button class='botaomenor' onclick="javascript: fechar('verificacorrecao1')">Cancelar</button>
    <a href="marcar.php?rejeita=1"><button class='botaomenor'>Negar</button></a>
    <a href="marcar.php?aprova=1"><button class='botaomenor'>Aprovar</button></a>
    
    
</div>

<div class="popup" id="verificacorrecao2">
    
   <h4> Solicitação de Correção do usuario: <?php  echo $_SESSION['nome_horario']; ?></h4><br>
   <p> Hora Registrada:  <?php  echo $horario2; ?><br>
    Hora Corrigida: <?php  echo $horarioc2; ?><br><br></p>
    Observação: <br> <textarea cols="40" rows="2"><?php  echo $obs; ?></textarea>
    <button class='botaomenor' onclick="javascript: fechar('verificacorrecao2')">Cancelar</button>
    <a href="marcar.php?rejeita=2"><button class='botaomenor'>Negar</button></a>
    <a href="marcar.php?aprova=2"><button class='botaomenor'>Aprovar</button></a>
    
    
</div>

<div class="popup" id="verificacorrecao3">
    
   <h4> Solicitação de Correção do usuario: <?php  echo $_SESSION['nome_horario']; ?></h4><br>
   <p> Hora Registrada:  <?php  echo $horario3; ?><br>
    Hora Corrigida: <?php  echo $horarioc3; ?><br><br></p>
    Observação: <br> <textarea cols="40" rows="2"><?php  echo $obs; ?></textarea>
    <button class='botaomenor' onclick="javascript: fechar('verificacorrecao3')">Cancelar</button>
    <a href="marcar.php?rejeita=3"><button class='botaomenor'>Negar</button></a>
    <a href="marcar.php?aprova=3"><button class='botaomenor'>Aprovar</button></a>
    
    
</div>

<div class="popup" id="verificacorrecao4">
    
   <h4> Solicitação de Correção do usuario: <?php  echo $_SESSION['nome_horario']; ?></h4><br>
   <p> Hora Registrada:  <?php  echo $horario4; ?><br>
    Hora Corrigida: <?php  echo $horarioc4; ?><br><br></p>
    Observação: <br> <textarea cols="40" rows="2"><?php  echo $obs; ?></textarea>
    <button class='botaomenor' onclick="javascript: fechar('verificacorrecao4')">Cancelar</button>
    <a href="marcar.php?rejeita=4"><button class='botaomenor'>Negar</button></a>
    <a href="marcar.php?aprova=4"><button class='botaomenor'>Aprovar</button></a>
    
    
</div>
