<?php 
class calcularHora {
    private $horaAtual;
    private $dataAtual;
    private $hora1;
    private $hora2;
    private $hora3;
    private $hora4;
    private $resultado1;
    private $resultado2;

    public function getHoraAtual() {
        return $this->horaAtual;
    }
    public function setHoraAtual ($ha){
        $this->doraAtual =  $ha;
    }
    public function getDataAtual() {
        return $this->dataAtual;
    }
    public function setDataAtual ($da){
        $this->dataAtual = $da;
    }
    public function getHora1() {
        return $this->hora1;
    }
    public function setHora1 ($ho1){
        $this->hora1 = $ho1;
    }
    public function gethora2() {
        return $this->hora2;
    }
    public function setHora2 ($ho2){
        $this->hora2 = $ho2;
    }
    public function getHora3() {
        return $this->hora3;
    }
    public function setHora3 ($ho3){
        $this->hora3 = $ho3;
    }
    public function getHora4() {
        return $this->hora4;
    }
    public function setHora4 ($ho4){
        $this->hora4 = $ho4;
    }
    public function getResultado1() {
        return $this->resultado1;
    }
    public function setResultado1($re1){
        $this->resultado1 = $re1;
    }
    public function getResultado2() {
        return $this->resultado2;
    }
    public function setResultado2 ($re2){
        $this->resultado2 = $re2;
    }
}
?>