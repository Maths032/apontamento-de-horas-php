<?php

require_once('Conexao.php');
require_once('calendario.php');
class  MarcarHora {
   private $idusu;
   private $result;
   private $tipo;
   private $nome;

// result quando 1 tudo certo
// result quando 2 horario ja marcado
// result quando diferente de numero algum erro no sistema

   public function Marcar($t, $usu){
      $this->setTipo($t);
      $this->setIdusu($usu);

      $id = $this->idusu;
      $data = new Calendario;

      
      $hora = date('H:i');

      $query = "select * from horario where id='$id' and data='{$data->getDataatual()}'";
      
      $consultar = new Conexao();   
      $consultar->rodarQuery($query);

      $horario1 = '0';
      $horario2 = '0';
      $horario3 = '0';
      $horario4 = '0';
      
   
      
      while($dado = $consultar->getResultado()->fetch_array()){
         $id_horario = $dado['id_horario'];
         $horario1 = $dado['horario1'];
         $horario2 = $dado['horario2'];
         $horario3 = $dado['horario3'];
         $horario4 = $dado['horario4'];
      }
      //  entrada
      if ($this->tipo == 'h1' && $horario1 == '0' ) {

         $query_h1 = "insert into horario 
         (id, horario1, horario2, horario3, horario4, data) VALUES ('$id', '$hora', '0', '0', '0', '{$data->getDataatual()}') ;";

         $consultar->rodarQuery($query_h1);

         if ($consultar->getErro_query()) {
            $this->setResult(0);
            
         }
         else{
            $this->result = 1;
         }
      }
      if($this->getTipo() == 'h1' && $horario1 <> '0') {
         $this->result = 2;
         }
      
      //   entrada almoço
         if ($this->tipo == 'h2' && $horario1 <> '0' && $horario2 == '0' && $horario4 == '0') {
             $query_h2 = "update horario set horario2 = '$hora' where data = '{$data->getDataatual()}' and id='$id';";

             $consultar->rodarQuery($query_h2);

             if ($consultar->getErro_query()) {
                 $this->setResult(0);
             } else {
               
                 $this->result = 1;
                 $this->calcularDia();
             }
         }
         if($this->getTipo() == 'h2' && $horario2 <> '0' && $horario4 == '0') {
         $this->result = 2;
         }
         if($this->getTipo() == 'h2' && $horario1 == '0'){
            $this->result = 3;
         }
         if ($this->getTipo() == 'h2' && $horario4 <> '0') {
            $this->result = 4;
         } 
         if ($this->tipo == 'h2' && $horario1 == '0'){//verifica se a entrada ja foi registrada
         $this->result = 6;
         }


         // saida almoço :
         if ($this->tipo == 'h3' && $horario2 <> '0' &&  $horario3 == '0' && $horario4 == '0') {

            $query_h3 = "update horario set horario3 = '$hora' where data = '{$data->getDataatual()}' and id='$id';";
   
            $consultar->rodarQuery($query_h3);
   
         if ($consultar->getErro_query()) {
            $this->setResult(0);
         }
         else{
            $this->result = 1;
            
         }
         }
         if($this->getTipo() == 'h3' && $horario3 <> '0' && $horario4 <> 0) {
         $this->result = 2;
         }
         if ($this->getTipo() == 'h3' && $horario2 == '0' && $horario4 == '0') {
         $this->result = 3;
         }
         if ($this->getTipo() == 'h3' && $horario4 <> '0') {
            $this->result = 4;
         }
         if ($this->tipo == 'h3' && $horario1 == '0'){//verifica se a entrada ja foi registrada
            $this->result = 6;
         }  

         
         
         
         



         //  saida
         
         if ($this->tipo == 'h4' && $horario3 <> '0' && $horario4 == '0' ) {//quando os horarios anteriores estao corretos
            
            $query_h4 = "update horario set horario4 = '$hora' where data = '{$data->getDataatual()}' and id='$id';";
   
            $consultar->rodarQuery($query_h4);

            if ($consultar->getErro_query()) {
               $this->setResult(0);
            } else {
               $this->result = 1;
               $this->calcularDia();
            }
         }  

         if($this->tipo == 'h44' && $horario1 <> '0' && $horario2 == '0') {//quando a confirmação de marcar saida sem almoço eh positiva
            $query_h4 = "update horario set horario4 = '$hora' where data = '{$data->getDataatual()}' and id='$id';";
   
            $consultar->rodarQuery($query_h4);

            if ($consultar->getErro_query()) {
               $this->setResult(0);
            }
            else {
               $this->result = 1;
               $this->calcularDia();
            }
         }

         if ($this->tipo == 'h4' && $horario2 == '0' && $horario1 <> '0') {//envia pedido de confirmação
            $this->result = 5;
         }
         if($this->tipo == 'h4' | $this->tipo == 'h44' && $horario4 <> '0'){//informa que o campo ja foi marcado
            $this->result = 4;
         }
         if ($this->tipo == 'h4' | $this->tipo == 'h44' && $horario3 == '0' && $horario2 <> '0') {//informa que é preciso marcar horario anterior
            $this->result = 3;
         }
         if ($this->tipo == 'h4' | $this->tipo == 'h44' && $horario1 == '0'){//verifica se a entrada ja foi registrada
            $this->result = 6;
         }
      // header('location: ../app/marcarhora.php');
      
   }

   public function deletar($idd){
      $data = new Calendario;
      
      $deletar = new Conexao();
      $deletar->conectarDb('127.0.0.1', 'root', '', 'estagiarios');
      $deletar->rodarQuery("delete from horario where id='$idd' and data='{$data->getDataatual()}'");
   }

   public function solicitaCorrecao($tipocorrecao, $horariocorrecao, $idusu, $data, $obs){
      $scorrecao = new Conexao;
      
      if ($tipocorrecao == 1) {
         $scorrecao->rodarQuery("UPDATE horario SET correcao1 = '{$horariocorrecao}', obs = '{$obs}', status_correcao1 = '1'
         WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($scorrecao->getErro_query() == '') {
            $this->setResult(8);
         }
      }
      if ($tipocorrecao == 2) {
         $scorrecao->rodarQuery("UPDATE horario SET correcao2 = '{$horariocorrecao}', obs = '{$obs}', status_correcao2 = '1'
         WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($scorrecao->getErro_query() == '') {
            $this->setResult(8);
         }
      }
      if ($tipocorrecao == 3) {
         $scorrecao->rodarQuery("UPDATE horario SET correcao3 = '{$horariocorrecao}', obs = '{$obs}', status_correcao3 = '1'
         WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($scorrecao->getErro_query() == '') {
            $this->setResult(8);
         }
      }
      if ($tipocorrecao == 4) {
         $scorrecao->rodarQuery("UPDATE horario SET correcao4 = '{$horariocorrecao}', obs = '{$obs}', status_correcao4 = '1'
         WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($scorrecao->getErro_query() == '') {
            $this->setResult(8);
         }
      }
     
   }

   public function aprovaCorrecao($acorrecao, $data, $idusu){
      $aprovar = new Conexao;
      
      if ($acorrecao == 1) {
         $aprovar->rodarQuery("UPDATE horario SET horario1 = correcao1, status_correcao1 = '2'
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($acorrecao->getErro_query == '') {
            $this->setResult(9);
            $this->calcularDia();
         }
      }

      if ($acorrecao == 2) {
         $aprovar->rodarQuery("UPDATE horario SET horario2 = correcao2, status_correcao2 = '2'
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($acorrecao->getErro_query == '') {
            $this->setResult(9);
            $this->calcularDia();
         }
      }

      if ($acorrecao == 3) {
         $aprovar->rodarQuery("UPDATE horario SET horario3 = correcao3, status_correcao3 = '2'
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($acorrecao->getErro_query == '') {
            $this->setResult(9);
            $this->calcularDia();
         }
      }

      if ($acorrecao == 4) {
         $aprovar->rodarQuery("UPDATE horario SET horario4 = correcao4, status_correcao4 = '2'
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
         if ($acorrecao->getErro_query == '') {
            $this->setResult(9);
            $this->calcularDia();
         }
      }
   }

   public function rejeitaCorrecao($rcorrecao, $data, $idusu){
      $rejeitar = new Conexao();
      $this->setResult('oi'); 
      if ($rcorrecao == 1) {
         $rejeitar->rodarQuery("UPDATE horario SET status_correcao1 = '3' 
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
          if($rejeitar->getErro_query == ''){
            $this->setResult(10);
            $this->calcularDia();
          }
      }

      if ($rcorrecao == 2) {
         $rejeitar->rodarQuery("UPDATE horario SET status_correcao2 = '3' 
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
          if($rejeitar->getErro_query == ''){
            $this->setResult(10);
            $this->calcularDia();
          }
      }

      if ($rcorrecao == 3) {
         $rejeitar->rodarQuery("UPDATE horario SET status_correcao3 = '3' 
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
          if($rejeitar->getErro_query == ''){
            $this->setResult(10);
            $this->calcularDia();
          }
      }

      if ($rcorrecao == 4) {
         $rejeitar->rodarQuery("UPDATE horario SET status_correcao4 = '3' 
          WHERE id= '{$idusu}' AND DATA = '{$data}';");
          if($rejeitar->getErro_query == ''){
            $this->setResult(10);
            $this->calcularDia();
          }
      }
   }

   public function calcularDia(){
      
      $caldia = new Conexao;
      $caldia->rodarQuery
      ("SELECT * FROM horario WHERE id = '{$_SESSION['id_horario']}' AND data = '{$_SESSION['data']}'");

      $dado = $caldia->getResultado()->fetch_array();
      
      $hora1 = $dado['horario1'];
      $hora2 = $dado['horario2'];
      $hora3 = $dado['horario3'];
      $hora4 = $dado['horario4'];
      $cal1 = strtotime($hora1);
      $cal2 = strtotime($hora2);
      $cal3 = strtotime($hora3);
      $cal4 = strtotime($hora4);
      
      if ($hora1 <> '0' && $hora2 <> '0' && $hora3 == 0 && $hora4 == 0) {//calcula hora quando a saida pro almoço foi solicitada
         $calcular = $cal2 - $cal1;
         $resultado = gmdate('H:i', $calcular);
         $caldia->rodarQuery
         ("UPDATE horario set total = '$resultado' 
         WHERE id = '{$_SESSION['id_horario']}' AND data = '{$_SESSION['data']}'");
      }

      if ($hora3 <> '0' && $hora4 <> '0') {//calcula a hora quando todos os horarios estiverem marcados
         $calcular = $cal2 - $cal1 + $cal4 - $cal3;
         $resultado = gmdate('H:i', $calcular);
         $caldia->rodarQuery
         ("UPDATE horario set total = '$resultado' 
         WHERE id = '{$_SESSION['id_horario']}' AND data = '{$_SESSION['data']}'");
      }

      if ($hora1 <> '0' && $hora4 <> '0' && $hora3 == 0) {//calcula a hora quando todos os horarios estiverem marcados
         $calcular = $cal4 - $cal1;
         $resultado = gmdate('H:i', $calcular);
         $caldia->rodarQuery
         ("UPDATE horario set total = '$resultado' 
         WHERE id = '{$_SESSION['id_horario']}' AND data = '{$_SESSION['data']}'");
      }
      
     
   }
   public function setTipo($ti){
      $this->tipo = $ti;
   }

   public function getTipo(){
      return $this->tipo;
   }

   public function setResult($re){
      $this->result = $re;
   }
   public function getResult(){
      return $this->result;
   }

   public function getIdusu(){
      return $this->idusu;
   }

   public function setIdusu($id){
      $this->idusu = $id;
   }

   public function setHorario1($h1){ 
      $this->horario1 = $h1;
   }
   
    public function getHorario1(){
       return $this->horario1;
   }

    public function setHorario2($h2){
      $this->horario1 = $h2;
   }

   public function getHorario2(){
    return $this->horario2;
   }
  
   public function setHorario3($h3){  
    $this->horario1 = $h3;
   }

   public function getHorario3(){
    return $this->horario3;
   }
   
   public function setHorario4($h4){  
    $this->horario1 = $h4;
   }
    
   public function getHorario4(){
       return $this->horario4;
   }
   
 
}