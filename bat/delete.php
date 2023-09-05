<?
require_once("../inc/conect.php");
    print_r($_POST);die;

if($_POST["tabla"]){
			$update=" WHERE id='".$_POST["id"]."'";
   // echo "DELETE FROM ".$_POST["tabla"]." ".$update;
    $_DEL	=	$mysqli->query("DELETE  FROM ".$_POST["tabla"]." ".$update." ")or die("DELETE  ".$_POST["tabla"]." ".$update." ");
        if($_DEL) 	{die('<div class="alert alert-warning text-center"><strong>BORRADO</strong> con exito</div>');}
        else 		{die('<div class="alert alert-danger text-center"><strong>ERROR</strong> no se pudo borrar</div>');}

}
?>
