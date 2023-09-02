<?
/*///////////////////////////////////// CLASS FOR DB ////////////////////////////////////////////*/ 

class Consultas extends Conexion{
/* Clase encargada de gestionar las tablas */
	public function __construct() 
    { 
        parent::__construct(); 
    } 

 	private $R 		= array();
 	private $RTRN 	= '';
 	public $I	 	= '';
	public function lastID(){
      	return $this->_db->insert_id;
   }

    public function max_id($_TBL){
	$_MAX	= $this->_db->query("SELECT MAX(id) as max FROM ".$_TBL."")or die($this->_db->error);
		 return $_MAX->fetch_assoc();
   }
   public function error(){
	$_ERR	= $this->_db->error;
		 return $_ERR;
   }

   public function insert(){
	$_INS	= $this->_db->insert_id;
		 return $_INS;
   }


	public function count_r($_TBL){
	$_MAX	= $this->_db->query("SELECT COUNT(*) as total FROM ".$_TBL."")or die('en count '.$this->_db->error);
		 return $_MAX->fetch_assoc();
   }
	public function sum_r($CPO,$TBL,$WHR){
	$_MAX	= $this->_db->query("SELECT SUM(".$CPO.") AS ".$CPO." FROM ".$TBL." ".$WHR."")or die('en count '.$this->_db->error);
		 return $_MAX->fetch_assoc();
   }
	public function sum_v($_CPO,$_TBL,$_WHR){
	$_MAX	= $this->_db->query("SELECT SUM(".$_CPO.") as ".$_CPO. " FROM ".$_TBL." ".$_WHR."")or die('en count '.$this->_db->error);
		 return $_MAX->fetch_assoc();
   }

	public function num_rows($_TBL,$_FLTR){
	$_NRWS	= $this->_db->query("SELECT * FROM ".$_TBL." ".$_FLTR."")or die('num_rows '.$this->_db->error);
		 return $_NRWS->num_rows;
   }

	public function eliminar($_TBL,$_ID){
		$_DEL	=	$this->_db->query("DELETE FROM ".$_TBL." WHERE id='".$_ID."'")or die($this->_db->error);
		if($_DEL) 	{return 'EXITO: se borro el archivo <input id="exito" value="si">';}
		else 		{return 'ERROR: hubo un error en el proceso <input id="exito" value="no">';}
	}

	public function eliminar_varios($_TBL,$_ID){
		$_DELv	=	$this->_db->query("DELETE FROM ".$_TBL." WHERE ".$_ID."")or die($this->_db->error);
	}

    public function guardar($_TYP,$_TBL,$_SET,$_WHR){
		$_GRD	=	$this->_db->query("".$_TYP." ".$_TBL." ".$_SET." ".$_WHR."")or die("".$this->_db->error);
		if($_GRD) 	{return '<div class="alert alert-success"><strong>OK</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button> El registro de la tabla '.$_TBL.' de realizó correctamente</div>';}
		else 		{return '<div class="alert alert-danger"><strong>KO</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button> El registro de la tabla '.$_TBL.' NO se guardo</div>';}
	}

	public function listar($_CPO,$_TBL,$_WHERE){
		$I		= 0;
		$R		= array();
		$_LST	= $this->_db->query("SELECT ".$_CPO." FROM ".$_TBL." ".$_WHERE." ")or die('listar '.$_TBL .':'.$this->_db->error);
		while ($Res		= $_LST->fetch_assoc()){
			$ARR_R	= explode(',',$_CPO);
				foreach($ARR_R as $V){
					$R[$I][$V]= $Res[$V];
				}
					$I ++;
		}
		return $R;
	}

    public function full_list($_TBL,$_WHERE){
		$I		= 0;
		$R		= array();
		$_LST	= $this->_db->query("SELECT * FROM ".$_TBL." ".$_WHERE." ")or die('listar '.$_TBL .':'.$this->_db->error);
		while ($Res		= $_LST->fetch_assoc()){
					$R[$I]= $Res;
					$I ++;
		}
		return $R;
	}

    
	public function sumar($_CPO,$_TBL,$_WHERE,$_GROUP){
		$_LST	= $this->_db->query("SELECT ".$_CPO." FROM ".$_TBL." ".$_WHERE." ".$_GROUP." ")or die($this->_db->error);
		$Res	= $_LST->fetch_assoc();
		return $Res;
	}

	public function nombre($_CPO,$_TBL,$_WHERE){
		$_NMB	= $this->_db->query("SELECT ".$_CPO." FROM ".$_TBL." WHERE ".$_WHERE." ")or die($this->_db->error);
		$R		= $_NMB->fetch_assoc();
		return $R[$_CPO];
	}
	public function comments($_TBL,$_FLD){

        $squery     = "SHOW FULL columns FROM ".$_TBL."";
        $iquery     = $this->_db->query($squery);
        if ($iquery) {
            
            $cmnt       = '';
            $irow       = 0;
            $ilastrow   = $iquery->num_rows;
               while ($irow < $ilastrow) {
                    $Res = $iquery->fetch_assoc();
                   //$R[] = $Res;
                  if(($Res['Field']==$_FLD) and ($Res['Comment'])){return '('.($Res['Comment']).')'; }


               $irow++;
               }
            //return $R;
	    }
	}

    public function select_join($_CPOS,$_TBLS,$_JOIN,$_ON,$_WHERE){
	$I		= 0;
	$R		= array();
    //return "SELECT ".$_CPOS." FROM ".$_TBLS." INNER JOIN ".$_JOIN." ON  ".$_ON." WHERE  ".$_WHERE." ";
	$_NMB	= $this->_db->query("SELECT ".$_CPOS." FROM ".$_TBLS." INNER JOIN ".$_JOIN." ON ".$_ON." WHERE ".$_WHERE." ")or die($this->_db->error);
	while ($Res		= $_NMB->fetch_assoc()){
		$ARR_R	= explode(',',$_CPOS);
				foreach($ARR_R as $V){
                 // $X  = explode('.',$V);
				//	$R[$I][$V]= $Res[$X[1]];
					$R[$I][$V]= $Res[$V];
				}
					$I ++;
		}
        return $R;
	}

    public function doble_join($_CPOS,$_TBLS,$_JOIN,$_ON,$_WHERE){

		$I		= 0;
 		$R		= array();
        //return "SELECT ".$_CPOS." FROM ".$_TBLS." INNER JOIN ".$_JOIN." ON  ".$_ON." WHERE  ".$_WHERE." ";
		$_NMB	= $this->_db->query("SELECT ".$_CPOS." FROM ".$_TBLS." INNER JOIN ".$_JOIN." ON ".$_ON." WHERE ".$_WHERE." ")or die($this->_db->error);
		while ($Res		= $_NMB->fetch_assoc()){
            $ARR_R	= explode(',',$_CPOS);
				foreach($ARR_R as $V){
                  $X  = explode('.',$V);
				  $R[$I][$X[1]]= $Res[$X[1]];
					//$R[$I][$V]= $Res[$V];
				}
					$I ++;
		}
        return $R;
	}

	public function provincia($_PRV){
	$_NPRV	= $this->_db->query("SELECT nombre FROM provincias WHERE id = '".$_PRV."'")or die('provincias'.$this->_db->error);
		 return $_NPRV['nombre'];
   }
    
    
    
    
/*///////////////////////////////////// END CLASS ////////////////////////////////////////////*/ 

}
?>