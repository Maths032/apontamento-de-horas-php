<?php 
if($_SESSION['status'] <> 1){
    header('location: ../index.php');
    exit();
}

// Class verificaPerm{
//     private $permissaon;
//     private $permissaoa;

//     public function __construct(){
//        $this->setPermissaoN(0);
//        $this->setPermissaoA(0);
//     }

//     public function verificarPermissao($a, $p){
//         if ($a >= $p) {
//         $_SESSION['status'] = 'naoautorizado';
//         header('location: ../index.php');
//         session_destroy();
//         exit();
//         }
//     }

//     public function getPermissaoN(){
//         return $this->permissaon;
//     }

//     public function setPermissaoN($pn) {
//         $this->permissaon = $pn;
//     }


//     public function getPermissaoA(){
//         return $this->permissaoa;
//     }

//     public function setPermissaoA($pa) {
//         $this->permissaoa = $pa;
//     }
// }


// ?>