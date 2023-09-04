<?
///////////////////// clases generales ///////////////////
class Generales extends Consultas{
	private  $RSP = array();
	private  $RST;

	public function timestampdate($fecha) {
        
        $fecha = explode(' ',$fecha);
		$dia   = implode("-", array_reverse( preg_split("/\D/", $fecha[0]) ) );
        return $dia;
	} 

	public function timestamp($fecha) {
        
        $fecha = explode(' ',$fecha);
		$dia   = implode("-", array_reverse( preg_split("/\D/", $fecha[0]) ) );
        return $dia.' '.$fecha[1];
	} 

	public function hourstamp($fecha) {
        
        $fecha = explode(' ',$fecha);
		$dia   = implode("-", array_reverse( preg_split("/\D/", $fecha[0]) ) );
        return $fecha[1];
	} 

	public function fechaes($fecha) {
		return implode("-", array_reverse( preg_split("/\D/", $fecha) ) );
	} 

	public function search($_CPO, $_VAL) {
		$RSP['qry'] 	 = "WHERE ".$_CPO ." LIKE '%".$_VAL."%'"; 
		$RSP['whr'] 	 = '&amp;search='.$_VAL; 
		return $RSP; 
	} 


	public function advanced_search($PST) {
		$R 	= 'WHERE '; 
		$W 	= '&amp;asearch=ok'; 
		foreach($PST as $KEY => $VAL){
			if(!empty($VAL)){
				$R	.= $KEY ." = ".$VAL." AND " ;
				$W	.= '&amp;advs['.$KEY."]=".$VAL." "; 
			}
		}
		$R	= trim($R,' AND ');

		$RSP['qry'] 	 = $R; 
		$RSP['whr'] 	 = $W; 
		return $RSP; 
	} 
	
///////////////////////////// FUNCION COTIZADOR MONEDA EXTRANJERA //////////////////////
    
    
    
    public function euro($tipo){
            $data_out = array();
            $data_in = "https://www.dolarsi.com/api/api.php?type=euro";
            $data_json = @file_get_contents( $data_in );
            if ( strlen( $data_json ) > 0 ) {
                $data_out = json_decode( $data_json, true );
                return $data_out[$tipo]['casa']['venta'];
            }
    }

    public function dolar($tipo){
            $data_out = array();
            $data_in = "https://www.dolarsi.com/api/api.php?type=valoresprincipales";
            $data_json = @file_get_contents( $data_in );
            if ( strlen( $data_json ) > 0 ) {
                $data_out = json_decode( $data_json, true );
                return $data_out[$tipo]['casa']['venta'];
                //return $data_out;
            }
    }
    
    
    
    
///////////////////////////// FUNCION ESPACIOS EN BLANCO //////////////////////
	public function espacios ($campo,$cant)
	{
	$cant_a_completar 	= $cant;
	$cant_cadena 		= strlen($campo);
	$aux 				= $campo;
	$i = 0;
	while ($i < ($cant_a_completar - $cant_cadena)) {
					$aux .= " ";
					$i++;
	}
	return $aux;
	
	}

//////////////////////////////////////// COMPLETA CON 0 ////////////////////////////////////////

	public function espacios_num ($campo,$cant)
	{
	$cant_a_completar 	= $cant;
	$cant_cadena 		= strlen($campo);
	//$aux = "0";
	$i 					= 0;
	while ($i < ($cant_a_completar - $cant_cadena)) {
					$aux .= "0";
					$i++;
	}
	$aux .= $campo;
	return $aux;
	
	}
//////////////////////////////////// NOMBRE DEL MES ////////////////////////////////////////////
	public	function NOMBRE_mes($mes){
		 setlocale (LC_TIME, "es_ES"); 
        if($mes == 0){
		 return 'Anual';
        }else{
		 $nombre	= strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
		 return $nombre;
        }
	} 

///////////////////////////////////////generador de claves alfanumericas//////////////////////////////////////////
	public function randomText($length) { 
        $key = '';
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			for($i = 0; $i < $length; $i++) { 
				$key .= $pattern[rand(0, 61)]; 
			} 
		return $key; 
	} 

///////////////////////////////////////generador de claves alfabeticas//////////////////////////////////////////
	public function randomOnlyText($length) { 
        $key     = '';
		$pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
			for($i = 0; $i < $length; $i++) { 
				$key .= $pattern[rand(0, 51)]; 
			} 
		return $key; 
	} 

///////////////////////////////////// generador de claves numericas ////////////////////////////////////////////
	public function randomNumber($length) { 
        $key     = '';
		$pattern = "1234567890"; 
			for($i = 0; $i < $length; $i++) { 
				$key .= $pattern[rand(0, 9)]; 
			} 
		return $key; 
	} 

///////////////////////////////////// generador de claves especiales ////////////////////////////////////////////
	public function randomHard($length) { 
        $key     = '';
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&/()=?¡[]{}*"; 
			for($i = 0; $i < $length; $i++) { 
				$key .= $pattern[rand(0, 77)]; 
			} 
		return $key; 
	} 

///////////////////////////////////// pasar de numeros a letras ////////////////////////////////////////////
	public function num2letras($num, $fem = true, $dec = true) { 
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 
		   $matuni[2]  = "dos"; 
		   $matuni[3]  = "tres"; 
		   $matuni[4]  = "cuatro"; 
		   $matuni[5]  = "cinco"; 
		   $matuni[6]  = "seis"; 
		   $matuni[7]  = "siete"; 
		   $matuni[8]  = "ocho"; 
		   $matuni[9]  = "nueve"; 
		   $matuni[10] = "diez"; 
		   $matuni[11] = "once"; 
		   $matuni[12] = "doce"; 
		   $matuni[13] = "trece"; 
		   $matuni[14] = "catorce"; 
		   $matuni[15] = "quince"; 
		   $matuni[16] = "dieciseis"; 
		   $matuni[17] = "diecisiete"; 
		   $matuni[18] = "dieciocho"; 
		   $matuni[19] = "diecinueve"; 
		   $matuni[20] = "veinte"; 
		   $matunisub[2] = "dos"; 
		   $matunisub[3] = "tres"; 
		   $matunisub[4] = "cuatro"; 
		   $matunisub[5] = "quin"; 
		   $matunisub[6] = "seis"; 
		   $matunisub[7] = "sete"; 
		   $matunisub[8] = "ocho"; 
		   $matunisub[9] = "nove"; 
		
		   $matdec[2] = "veint"; 
		   $matdec[3] = "treinta"; 
		   $matdec[4] = "cuarenta"; 
		   $matdec[5] = "cincuenta"; 
		   $matdec[6] = "sesenta"; 
		   $matdec[7] = "setenta"; 
		   $matdec[8] = "ochenta"; 
		   $matdec[9] = "noventa"; 
		   $matsub[3]  = 'mill'; 
		   $matsub[5]  = 'bill'; 
		   $matsub[7]  = 'mill'; 
		   $matsub[9]  = 'trill'; 
		   $matsub[11] = 'mill'; 
		   $matsub[13] = 'bill'; 
		   $matsub[15] = 'mill'; 
		   $matmil[4]  = 'millones'; 
		   $matmil[6]  = 'billones'; 
		   $matmil[7]  = 'de billones'; 
		   $matmil[8]  = 'millones de billones'; 
		   $matmil[10] = 'trillones'; 
		   $matmil[11] = 'de trillones'; 
		   $matmil[12] = 'millones de trillones'; 
		   $matmil[13] = 'de trillones'; 
		   $matmil[14] = 'billones de trillones'; 
		   $matmil[15] = 'de billones de trillones'; 
		   $matmil[16] = 'millones de billones de trillones'; 
		
		   $num = trim((string)@$num); 
		   if ($num[0] == '-') { 
			  $neg = 'menos '; 
			  $num = substr($num, 1); 
		   }else 
			  $neg = ''; 
		   while ($num[0] == '0') $num = substr($num, 1); 
		   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
		   $zeros = true; 
		   $punt = false; 
		   $ent = ''; 
		   $fra = ''; 
		   for ($c = 0; $c < strlen($num); $c++) { 
			  $n = $num[$c]; 
			  if (! (strpos(".,'''", $n) === false)) { 
				 if ($punt) break; 
				 else{ 
					$punt = true; 
					continue; 
				 } 
		
			  }elseif (! (strpos('0123456789', $n) === false)) { 
				 if ($punt) { 
					if ($n != '0') $zeros = false; 
					$fra .= $n; 
				 }else 
		
					$ent .= $n; 
			  }else 
		
				 break; 
		
		   } 
		   $ent = '     ' . $ent; 
		   if ($dec and $fra and ! $zeros) { 
			  $fin = ' con '; 
			  for ($n = 0; $n < strlen($fra); $n++) { 
				 if (($s = $fra[$n]) == '0') 
					$fin .= '0'; 
				 elseif ($s == '1') 
					$fin .= $fem ? ' 1' : ' 1'; 
				 else 
					$fin .= $s ; 
			  }  $fin .= '/00' ; 
		   }else 
			  $fin = ' con 00/00'; 
		   if ((int)$ent === 0) return 'Cero ' . $fin; 
		   $tex = ''; 
		   $sub = 0; 
		   $mils = 0; 
		   $neutro = false; 
		   while ( ($num = substr($ent, -3)) != '   ') { 
			  $ent = substr($ent, 0, -3); 
			  if (++$sub < 3 and $fem) { 
				 $matuni[1] = 'una'; 
				 $subcent = 'os'; 
			  }else{ 
				 $matuni[1] = $neutro ? 'un' : 'uno'; 
				 $subcent = 'os'; 
			  } 
			  $t = ''; 
			  $n2 = substr($num, 1); 
			  if ($n2 == '00') { 
			  }elseif ($n2 < 21) 
				 $t = ' ' . $matuni[(int)$n2]; 
			  elseif ($n2 < 30) { 
				 $n3 = $num[2]; 
				 if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
				 $n2 = $num[1]; 
				 $t = ' ' . $matdec[$n2] . $t; 
			  }else{ 
				 $n3 = $num[2]; 
				 if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
				 $n2 = $num[1]; 
				 $t = ' ' . $matdec[$n2] . $t; 
			  } 
			  $n = $num[0]; 
			  if ($n == 1) { 
				 $t = ' ciento' . $t; 
			  }elseif ($n == 5){ 
				 $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
			  }elseif ($n != 0){ 
				 $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
			  } 
			  if ($sub == 1) { 
			  }elseif (! isset($matsub[$sub])) { 
				 if ($num == 1) { 
					$t = ' mil'; 
				 }elseif ($num > 1){ 
					$t .= ' mil'; 
				 } 
			  }elseif ($num == 1) { 
				 $t .= ' ' . $matsub[$sub] . '?n'; 
			  }elseif ($num > 1){ 
				 $t .= ' ' . $matsub[$sub] . 'ones'; 
			  }   
			  if ($num == '000') $mils ++; 
			  elseif ($mils != 0) { 
				 if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
				 $mils = 0; 
			  } 
			  $neutro = true; 
			  $tex = $t . $tex; 
		   } 
		   $tex = $neg . substr($tex, 1) . $fin; 
		   return ucfirst($tex); 
	}

///////////////////// BORRADO DIRECTORIO Y CONTENIDO ///////////////////////////
	public function rmDir_rf($carpeta)
    {
      foreach(glob($carpeta . "/*") as $archivos_carpeta){             
        if (is_dir($archivos_carpeta)){
          	$this->rmDir_rf($archivos_carpeta);
        } else {
        	unlink($archivos_carpeta);
        }
      }
      rmdir($carpeta);
     }

///////////////////// GENERADOR DE CODIGOS ///////////////////////////
    public function codex($id,$_TBL,$_PRE){

        if(is_numeric($id)){
                $R_U	= $this->listar('codigo',$_TBL,"WHERE id='".$id."'");
                return $R_U[0]['codigo'];
            }else{
                    $Codigo =   $_PRE.'-'.$this->randomNumber(5).$this->randomOnlyText(1);
                if($this->count_r($_TBL) == 0){
                    return $Codigo;
                }else{
                    $DUP = $this->num_rows($_TBL," WHERE codigo = '".$Codigo."'");
                    if($DUP > 0){
                    return $Codigo.$this->randomOnlyText(1);
                    }else{
                        return $Codigo;
                    }
                }
            }
    }


}
/*///////////////////////////////////// END CLASS ////////////////////////////////////////////*/ 

?>