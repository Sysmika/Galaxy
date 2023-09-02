<?php
session_start();
require_once ("../inc/db.php");
$Q_login    = $mysqli->query("UPDATE login SET salida = '".date("Y-m-d H:i:s")."' WHERE id = '".$_SESSION["LOGIN"]['id']."' ") or die();
@session_unset();
@session_destroy();
@mysqli_close($mysqli);
if(!$_POST['unload']){
?>
<Script language="javascript">window.location="../login.php"</script>
<? }?>