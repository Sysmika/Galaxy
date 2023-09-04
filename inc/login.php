<?
session_start();
//////////////////////////// RECIBO LAS CLAVES POR POST //////////////////////////	
if (isset($_POST["email"]) && isset($_POST["password"]) && (isset($_POST["token"]) == $_SESSION['token'])){   
    
	$NOSESS		= TRUE;
	include($_SERVER['DOCUMENT_ROOT'].'/inc/db.php');
	//$passwd = $_POST["clave"];
	$passwd 	= md5($_POST["password"]);
	//$query 		= "SELECT * FROM empresa WHERE mail='".$_POST["email"]."' AND clave=('$passwd') AND activo = 'si'";
	$query 		= "SELECT * FROM members WHERE email_address='".$_POST["email"]."' AND password=('$passwd') AND active = 1";
	$result 	= $mysqli->query($query)or die("Error: ".$mysqli->error);
	if($result->num_rows==1){
	   $_MEMBER 	= $result->fetch_assoc();
       $_SESSION['id']          = $_MEMBER['id'];
       $_SESSION['cookie']      = $_MEMBER['id'];
       $_SESSION['nombre']      = $_MEMBER['nombre'];
       $_SESSION['razonsoc']    = $_MEMBER['razonsoc'];
        
       include("ingreso.php");

       //header ("Location: ../panel.php");

	}else{
    	$_SESSION["error"]='<div class="alert alert-danger text-center"><strong>ERROR</strong><br> intentelo nuevamente</div>';
        header ("Location: ../index.php?error=logeo");
	//echo $_SESSION["error"];
	//die;
	}
}else{
        $_SESSION["error"]='<div class="alert alert-danger text-center"><strong>TOKEN incorrecto</strong><br> intentelo nuevamente</div>';
        header ("Location: ../index.php");
	//echo $_SESSION["error"];
	//die;
}

?>