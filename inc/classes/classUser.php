<? 
/*///////////////////////////////////// BIGIN CLASS USER ////////////////////////////////////////////*/ 

class Usuario extends Consultas{

	public function select($_CPO,$_CPO2,$_TBL,$_WHERE,$_TT,$_SLCT){
		$OPT	= '<option value="">seleccione '.$_TT.'</option>';
		$_DEL	= $this->_db->query("SELECT ".$_CPO.", ".$_CPO2." FROM ".$_TBL." ".$_WHERE." ")or die($this->_db->error);
        if($_DEL->num_rows > 0){
            while($R = $_DEL->fetch_assoc()){
                if($_SLCT == $R[$_CPO]){$SEL = 'selected';}else{$SEL = '';}
                $OPT	.= '<option value="'.$R[$_CPO].'" '.$SEL.'>'.$R[$_CPO2].'</option>';
            }
		}else{
                $OPT	.= '<option value="">sin resultados</option>';
        }
		return $OPT;
	}
    

    public function selectcomplex($_CPO,$_CPO2,$_TBL,$_WHERE,$_TT,$_SLCT){
		$OPT	= '<option value="">seleccione '.$_TT.'</option>';
		$_DEL	= $this->_db->query("SELECT ".$_CPO.", ".$_CPO2." FROM ".$_TBL." ".$_WHERE." ")or die($this->_db->error);
		while($R = $_DEL->fetch_assoc()){
			$EX1	= explode('.',$_CPO);
			$EX2	= explode('.',$_CPO2);
			if($_SLCT == $R[$EX1[1]]){$SEL = 'selected';}else{$SEL = '';}
			$OPT	.= '<option value="'.$R[$EX1[1]].'" '.$SEL.'>'.$R[$EX2[1]].'</option>';
		}
		return $OPT;
	}
    
    public function setCampos($_TBL,$FLD,$SEL,$ID){
         $Q_U	= $this->_db->query("SHOW FIELDS FROM $_TBL WHERE Field = '".$FLD."'")or die('set: '.$this->_db->error);
        //print_r($Q_U->fetch_assoc());
                        $R_U            = $Q_U->fetch_assoc();
                        $TYPE_SET 		= strpos($R_U["Type"], 'set');
                        $TYPE_ENUM 		= strpos($R_U["Type"], 'enum');
        if(($TYPE_SET===0) or ($TYPE_ENUM===0)){						
                                $EX_ser = $R_U["Type"]; 
                                $A_TYPE	= explode('(',$EX_ser);
                                $A_set  = str_replace( array($A_TYPE[0], "(","'",")"), "", $EX_ser );
                                $A_set  = explode(',',$A_set);				

                    $RET ='<select name="'.$R_U["Field"].'" id="'.$ID.'" class="form-control">
                    <option value="">seleccione</option>';
            foreach($A_set as $V_set){
                    $RET .='<option value="'.$V_set.'"';
                 if($SEL==$V_set){$RET .=' selected';}
                $RET.='>'.$V_set.'</option>';
                    }
                    $RET .='</select>';

                     }
        return $RET;
    }

    
}
/*///////////////////////////////////// END CLASS ////////////////////////////////////////////*/ 

?>