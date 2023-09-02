<?
session_start();
//////////////////////////// RECIBO LAS CLAVES POR POST //////////////////////////	
if (isset($_POST["email"]) && isset($_POST["password"]) && (isset($_POST["token"]) == $_SESSION['token'])){   
    
	$NOSESS		= TRUE;
	include($_SERVER['DOCUMENT_ROOT'].'/inc/db.php');
	//$passwd = $_POST["clave"];
	$passwd 	= md5($_POST["password"]);
	$query 		= "SELECT * FROM empresa WHERE mail='".$_POST["email"]."' AND clave=('$passwd') AND activo = 'si'";
	$result 	= $mysqli->query($query)or die("Error: ".$mysqli->error);
	if($result->num_rows==1){
	   $_MEMBER 	= $result->fetch_assoc();
       $_SESSION['id']          = $_MEMBER['id'];
       $_SESSION['nombre']      = $_MEMBER['nombre'];
       $_SESSION['razonsoc']    = $_MEMBER['razonsoc'];

       header ("Location: ../panel.php");

	}else{
    	$_SESSION["error"]='<div class="alert alert-danger text-center"><strong>ERROR</strong>, intentelo nuevamente</div>';
        header ("Location: ../index.php?error=logeo");
	//echo $_SESSION["error"];
	//die;
	}
}else{
        $_SESSION["error"]='<div class="alert alert-danger text-center"><strong>TOKEN incorrecto</strong>, intentelo nuevamente</div>';
        header ("Location: ../index.php");
	//echo $_SESSION["error"];
	//die;
}

?>