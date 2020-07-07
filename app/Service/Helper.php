<?php 

namespace Simbi\Service;

class Helper{
  
  public function splitPeriod(String $dt):int{

    $dtFormat = explode('/', $dt);

    //dd($dtFormat);

    $data = 
      $dtFormat[2].'-'.$dtFormat[1].'-'.$dtFormat[0];

    $separarPeriodo = strtotime($data);
    
    $dia = date("w", $separarPeriodo);            

    switch ($dia){
      case 0:
        return 3;
        break;

      case 6:
        return 2;
        break;  
      	
      default:
        return 1;
        break;
    }
  }

  public function setDatePtBR(String $dt):string{

     $d = $dt;
     $data = explode('/', $dt);
     
     return $data[2].'-'.$data[1].'-'.$data[0];     
  }
}