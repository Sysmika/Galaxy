<?
require_once("../inc/conect.php");
    print_r($_POST);die;

if($_POST["tabla"]){
    
			$update=" WHERE id='".$_POST["id"]."'";
    if(($_POST["tabla"] == 'recibos') or ($_POST["tabla"] == 'contable')){
         $_DEL	=	$mysqli->query("DELETE FROM  ".$_POST["tabla"]." ".$update." ")or die('<div class="alert alert-danger text-center">ERROR: borrado de '.$_POST["tabla"].'  '.$update.' '.$CNSLTS->error().'</div>');
            if($_DEL) 	{die('<div class="alert alert-warning text-center small p-1"><strong>BORRADO</strong> con exito</div>');}
            else 		{die('<div class="alert alert-danger text-center small p-1"><strong>ERROR</strong> no se pudo borrar</div>');}
       
    }else{
       // echo "DELETE FROM ".$_POST["tabla"]." ".$update;
        $_DEL	=	$mysqli->query("UPDATE  ".$_POST["tabla"]." SET activo = 'no' ".$update." ")or die('<div class="alert alert-danger text-center">ERROR: borrado de '.$_POST["tabla"].'  '.$update.' '.$CNSLTS->error().'</div>');
            if($_DEL) 	{die('<div class="alert alert-warning text-center small p-1"><strong>BORRADO</strong> con exito</div>');}
            else 		{die('<div class="alert alert-danger text-center small p-1"><strong>ERROR</strong> no se pudo borrar</div>');}
    }
    
}
?>
