<?PHP
	session_start();
if(!isset($_SESSION['id_user'])){
    header('Location: '.$_SERVER['document_root'].'/inc/logout.php');
}
	include_once("db.php"); 					// DATOS DE CONEXION BASE DE DATOS Y MSQLI

	include_once("classes/class.DB.php"); 		// CONEXION BASE DE DATOS  						
	include_once("classes/classDb.php");   		// CLASE GENERAL CON CONEXION					
	include_once("classes/classGral.php");  	// CLASE GENERAL SIN CONEXION						
	include_once("classes/classUser.php");  	// CLASE GENERAL SIN CONEXION						
	include_once("classes/class.phpmailer.php");// CLASE PHPMAILER
	include_once("classes/class.smtp.php");   	// CLASE SMTP PHPMAILER
   	$CNSLTS 	= new Consultas();
	$GNRLS		= new Generales();
	$CUSER		= new Usuario();
	$mail		= new PHPMailer(true);

	///////////////////////////// VARIABLES GLOBALES ///////////////////////
	$TODAY	  = date("Y-m-d");
	$ACCOUNT  = $_SESSION['ACCOUNT'];
    $PRFRNC   = $CNSLTS->full_list('preferencias',"WHERE usuario = ".$_SESSION['id_user']."");
?>