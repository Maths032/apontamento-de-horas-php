
<?php

  $ano = date('Y');
  $mes = date('m');
     $datai = ""; // insira a data inicial em formato brasileiro de forma manual
     $dataf = ""; // insira a data final em formato brasileiro de forma manual
     
    if ($mes == '01' | $mes ==  '03' | $mes == '05' | $mes ==  '07' | $mes ==  '08' | $mes ==  '10' | $mes ==  '12') {
      $datai = "01/{$mes}/{$ano}";
      $dataf = "31/{$mes}/{$ano}";
    }
    if ($mes == '04' |  $mes == '06' | $mes == '09' | $mes ==  '11'){
      $datai = "01/{$mes}/{$ano}";
      $dataf = "30/{$mes}/{$ano}";
    }
    if($mes == '02'){
      $datai = "01/{$mes}/{$ano}";
      $dataf = "29/{$mes}/{$ano}";
    }
      echo '<br>data inicial: ',$datai;
      echo '<br>data final: ',$dataf;
      
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
    
echo '<br>quantidade de dias não uteis: ',$naoutil;
echo '<br>quantidade de dias uteis: ',$diautil;
echo '<br>quantidade de horas totais esperadas p/ mes ', ($diautil * 6), ':00';
echo '<br>quantidade de de feriados: ',$feriados;

?>
