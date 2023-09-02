<? session_start();
   include("../inc/conect.php");
    //echo '<pre>';print_r($_POST);echo '</pre>';die;
if($_POST){
		//print_r($_POST);die;
	////////////////// INGRESO NUEVO  /////////////////	
	if($_POST["insert"]=='insert'){
			$update="INSERT INTO ".$_POST["tabla"]." SET ";
	}else{
	////////////////// EDITO  /////////////////	
			$update="UPDATE ".$_POST["tabla"]." SET ";
		}
			//$tabla=$_POST["tabla"];
	$input='';		
			foreach($_POST as $key =>$campo)
			{

			if(!empty($campo)){
				if(($key!='tabla')and
				   ($key!='id')and
				   ($key!='menu')and
				   ($key!='insert')
				   ){
					   if(is_array($campo)){
						   foreach($campo as $cdn){
							   $CADENA.= $cdn.',';
						   }
						$update.= $key."='".trim($CADENA,',')."',";	

					   }elseif(($key=='clave') or ($key=='password')){
                           if(!empty($campo)){
							$update.= $key."='".md5($campo)."',";
                           }

					   }elseif(($key=='whatsapp') or ($key=='deposito')){
                           if(!empty($campo)){
							$update.= $key."='".$campo."',";
                           }
						}else{
							$update.= $key."='".$campo."',";	
							}
						}
				}
			}

    $update=trim($update,',');

	if($_POST["insert"] == 'update'){
		if($_POST["tabla"] == 'groups_has_privileges'){
			$update.=" WHERE groups_id ='".$_POST["id"]."'";
		}elseif($_POST["tabla"] == 'groups_has_members'){
			$update.=" WHERE members_id ='".$_POST["id"]."'";
		}else{
			$update.=" WHERE id='".$_POST["id"]."'";
			}
	}else{
		if($_POST["tabla"] == 'carteles'){
			$update.=", id ='".$_POST["id"]."'";
		}else{$update.="";}
	}

//echo $update;die;

	////////////////// 	INSERTO  /////////////////	 
	if($_POST["insert"]=='insert'){
			$pdt	= $mysqli->query($update)or die('<div class="alert alert-warning">i '.$mysqli->error.'</div>');
			$nid	= $mysqli->insert_id;
			$input	= '<input name="idu" id="nuevoid" type="hidden" value="'.$nid.'">';
     }else{
	/////////////////// EDITO  //////////////////	
			$pdt	= $mysqli->query($update)or die('<div class="alert alert-warning">u  '.$mysqli->error.'</div>');
			$input	= '<input name="idn" id="nuevoid" type="hidden" value="'.$_POST["id"].'">';
		}

	if($pdt){
        echo'<div class="alert alert-success alert-dismissible fade show text-center" role="alert">se actualizo el registro <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'.$input;
    }else	{
        echo'<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">Hubo un error en el proceso, intentelo nuevamente <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
	
}else{
    echo'<div class="alert alert-danger alert-dismissible fade show text-center" role="alert"><strong>ERROR:</strong> usted no deberia estar aquí <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>
