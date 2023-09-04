<?PHP
	/////////////////////// SET COOKIE RECORDAR ////////////////////
			@session_unset();
			@session_destroy();
			setcookie("id_extreme","x",time()-3600,"/");
			session_start();
    /////////////////////////////////////////////////////////////////////    
        
    ///////////////////// CONTROL UN SOLO LOGING X USUARIO ////////////////////
        
        $Q_lg  = $mysqli->query("SELECT * FROM login WHERE user='".$_MEMBER["id"]."' AND salida = 0") or die($mysqli->error);
        $RW    = $Q_lg->fetch_assoc();
        $date1 = new DateTime($RW['entrada']);
        $date2 = new DateTime(date("Y-m-d H:i:s"));
        $diff  = $date1->diff($date2);
       //$_SESSION["count"] = $Q_lg->num_rows;
        if($Q_lg->num_rows > 0 ){
                 $Q_login    = $mysqli->query("UPDATE login SET salida = '".date("Y-m-d H:i:s")."' WHERE user = '".$_MEMBER["id"]."'") or die($mysqli->error);
        }


		//@session_unset($_SESSION["error"]);
		$_SESSION["id_user"]	= $_MEMBER["id"];
		$_SESSION["usuario"]	= $_MEMBER["first_name"];
		$_SESSION["logeado"] 	= "SI";
		$_COOKIE["ALMNQ"] 		= "SI";

    /////////////////////// REGISTRO EL LOGIN DE ENTRADA ////////////////////
        $Q_login    = $mysqli->query("INSERT INTO login SET user = '".$_MEMBER["id"]."', entrada = '".date("Y-m-d H:i:s")."', ip = '".$_SERVER['REMOTE_ADDR']."' ") or die($mysqli->error);
        $_SESSION["LOGIN"]['id']	= $mysqli->insert_id;
        $_SESSION["LOGIN"]['hora']	= date("Y-m-d H:i:s");
        $_SESSION["LOGIN"]['user']	= $_MEMBER["id"];

	/////////////////////// AUTOLOAD ////////////////////
			$_MODO					= 'unica';
			//$_SESSION["AUTOLOAD"]	= $_MODO;
	/////////////////// FIN AUTOLOAD ////////////////////
        
	/////////////////// INGRESO DATOS DE SESSION ////////////////////
			$_SESSION['ACCOUNT']	= $_MEMBER["account"];		
			$_SESSION['GROUPS']	    = $_MEMBER["groups"];		
	//////////////////////////// SELECCIONO LOS MODULOS //////////////////////////	
        $Q_MOD_MEMBER	= $mysqli->query("SELECT privileges FROM groups WHERE id='".$_MEMBER["groups"]."' AND active='1'")or die("Error: p".$mysqli->error);
        $R_MOD_MEMBER   = $Q_MOD_MEMBER->fetch_assoc();
        $AR_PRIV        = explode(',',$R_MOD_MEMBER['privileges']);
        $_ACCESO        = [];
            foreach($AR_PRIV as $VL){
                $Q_PRIV	= $mysqli->query("SELECT data FROM privileges WHERE id='".$VL."' AND active = '1'")or die("Error: o".$mysqli->error);
                while($R_priv = $Q_PRIV->fetch_assoc()){
                        $AR_GRP    = explode(',',$R_priv['data']);   
                        foreach($AR_GRP as $VG){
                                 $Q_MODULES	= $mysqli->query("SELECT data,type,name FROM modules WHERE id='".$VG."' AND active = '1'")or die("Error: f".$mysqli->error);
                                 $_Mm		= $Q_MODULES->fetch_assoc();
                                 $Q_type	= $mysqli->query("SELECT name FROM modules_type WHERE id='".$_Mm["type"]."' AND activo = 'si'")or die("Error: mt".$mysqli->error);
                                 $_Mt		= $Q_type->fetch_assoc();
                                if($_Mm["type"]){
                                    $_ACCESO[$_Mt["name"]][$_Mm["data"]] = $_Mm["name"];
                                }
                        }
                   
                }
            }
        $_SESSION['ACCESO']	= $_ACCESO;	
        foreach ($_SESSION['ACCESO'] as $K=>$V){
            asort($_SESSION['ACCESO'][$K]);
        }
        $_SESSION['SUPERUSER']='NO'; 
        //if(($_SESSION['id_user'] == 1) or ($_SESSION['id_user'] == 2) or ($_SESSION['id_user'] == 3)){
        if($_SESSION['id_user'] == 1){
            $_SESSION['SUPERUSER']='SI'; 
        }
        //echo '<pre>';print_r($_SESSION);echo '</pre>';die;
        $_SESSION["error"]='<div class="alert alert-success text-center">Ingresando, un momento, por favor...<input name="exito" id="exito" value="si" type="hidden"></div>';
        header ("Location: ../panel.php");
?>