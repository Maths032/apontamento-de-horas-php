<?php


class Calendario{
    private $datainicio;
    private $datafim;
    private $naouteis;
    private $uteis;
    private $horamensal;
    private $horadiaria;
    private $dataatual;

    public function mensalInfo($data){
        
        $data = explode('/', $data);

        $datai = ""; // insira a data inicial em formato brasileiro de forma manual
        $dataf = ""; // insira a data final em formato brasileiro de forma manual
        
       if($data[1] == '01' | $data[1] ==  '03' | $data[1] == '05' | $data[1] ==  '07' | $data[1] ==  '08' | $data[1] ==  '10' | $data[1] ==  '12') {//cadastra quantidade de dias de acordo com o mes
         $this->datainicio = "01/{$data[1]}/{$data[2]}";
         $datai = $this->datainicio;
         $this->datafim = "31/{$data[1]}/{$data[2]}";
         $dataf = $this->datafim;
       }
       if($data[1] == '04' |  $data[1] == '06' | $data[1] == '09' | $data[1] ==  '11'){//cadastra quantidade de dias de acordo com o mes
         $this->datainicio = "01/{$data[1]}/{$data[2]}";
         $datai = $this->datainicio;
         $this->datafim = "30/{$data[1]}/{$data[2]}";
         $dataf = $this->datafim;
       }
       if($data[1] == '02'){//cadastra quantidade de dias de acordo com o mes
         $this->datainicio = "01/{$data[1]}/{$data[2]}";
         $datai = $this->datainicio;
         $this->datafim = "29/{$data[1]}/{$data[2]}";
         $dataf = $this->datafim;
       }
       $datai = explode('/', $datai);
       $dataf = explode('/', $dataf);
   
       $tempoi = strtotime("$datai[2]-$datai[1]-$datai[0]"); // timestamp inicial
       $tempof = strtotime("$dataf[2]-$dataf[1]-$dataf[0]"); // timestamp final
       $diautil = 0;
       $naoutil = 0;
       $feriados = 0;
       while ($tempoi <= $tempof){
       $feriado = date('d/m/Y', $tempoi);  
       $semana = date('N', $tempoi);
   
         if( //inserir feriados.
         $feriado == '01/01/2020' & $semana <= 5 | 
         $feriado == '24/02/2020' & $semana <= 5 |
         $feriado == '25/02/2020' & $semana <= 5 |
         $feriado == '10/04/2020' & $semana <= 5 |
         $feriado == '21/04/2020' & $semana <= 5 |
         $feriado == '01/05/2020' & $semana <= 5 |
         $feriado == '11/06/2020' & $semana <= 5 |
         $feriado == '07/09/2020' & $semana <= 5 |
         $feriado == '12/10/2020' & $semana <= 5 |
         $feriado == '02/11/2020' & $semana <= 5 |
         $feriado == '15/11/2020' & $semana <= 5 |
         $feriado == '25/12/2020' & $semana <= 5 
         ){
           $naoutil += 1;
           $diautil -= 1;
           $feriados += 1;
         }
       if($semana >= 6){
         $naoutil += 1;
       }
       if($semana <= 5 ){
         $diautil += 1;
       }
       
       $tempoi += 86400; // 86400 = 24h = um dia medido em segundos
       }
       $this->naouteis = $naoutil;
       $this->uteis = $diautil;
       $this->horamensal = $diautil * 6;
       return $this->uteis;
    }


    public function __construct(){
        $data = $_SESSION['data'];
        $this->setDatainicio('');
        $this->setDatafim('');
        $this->setNaouteis(0);
        $this->setUteis(0);
        $this->setHoramensal(0);
        $this->setHoradiaria(6);
        $this->setDataatual($data);
    }

    public function getDatainicio(){
        return $this->datainicio;
    }
    public function setDatainicio($di){
         $this->datainicio = $di;
    }


    public function getDatafim(){
        return $this->datafim;
    }
    public function setDatafim($df){
        $this->datafim = $df;
    }


    public function getNaouteis(){
        return $this->naouteis;
    }
    public function setNaouteis($nu){
        $this->naouteis = $nu;
    }


    public function getUteis(){
        return $this->uteis;
    }
    public function setUteis($du){
        $this->uteis = $du;
    }
    
    
    public function getHoramensal(){
        return $this->horamensal;
    }
    public function setHoramensal($hm){
        $this->horamensal = $hm;
    }
    
    
    public function getHoradiaria(){
        return $this->horadiaria;
    }
    public function setHoradiaria($di){
        $this->horadiaria = $di;
    }

    public function getDataatual(){
        return $this->dataatual;
    }
    public function setDataatual($da){
        $this->dataatual = $da;
    }
}
?>