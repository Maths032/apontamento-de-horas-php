<?php

class Conexao {

    private $host;
    private $user;
    private $pass;
    private $db;
    private $conn;
    private $query;
    private $resultado;
    private $erro_query;

    public function __construct()
    {
        $this->setHost('127.0.0.1');
        $this->setUser('geral');
        $this->setPass('123456');
        $this->setDb('estagiarios');
      
        $this->setConn(mysqli_connect
        ($this->host,
        $this->user,
        $this->pass,
        $this->db,
        )
    );
    }
    
    public function conectarDb($h, $u, $p, $d){
        $this->setHost($h);
        $this->setUser($u);
        $this->setPass($p);
        $this->setDb($d);

        $this->setConn
        (mysqli_connect
        (
        $this->host,
        $this->user,
        $this->pass,
        $this->db,
        )
    );
        
    }
    public function rodarQuery($q){
        $this->setQuery($q);
        
        $this->resultado = mysqli_query($this->conn, $this->query) or 
        ($this->erro_query = mysqli_error($this->conn));
        
    }
  
    public function getErro_query(){
        return $this->erro_query;
    }

    public function setErro_query($eq){
        $this->erro_query = $eq;
    }

    public function getResultado(){
        return $this->resultado;
    }
    public function setResultado($r){
        $this->resultado = $r;
    }
    public function getQuery(){
        return $this->query;
    }
    public function setQuery($q){
        $this->query = $q;
    }
    public function setConn($c){
        $this->conn = $c;
    }
    public function getConn(){
        return $this->conn;
    }
    public function setHost($h){
        $this->host = $h;
    }
    public function getHost(){
        return $this->host;
    }
    public function setUser($u){
        $this->user = $u;     
    }
    public function getUser(){
        return $this->user;
    }
    public function setPass($p){
        $this->pass = $p;
    }
    public function getPass(){
        return $this->pass;
    }
    public function setDb($d){
        $this->db = $d;
    }    
    public function getDb(){
        return $this->db;
    }
}

?>