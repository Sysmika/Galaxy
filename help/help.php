<?  include("../inc/conect.php");?>
<a class="btn btn-info cpoint" data-uri="help/general" data-menu="<?=$_POST['menu']?>&modal=true" data-capa="dialog-response" id="hlp" data-action="edit" data-user="<?=$_POST['menu']?>">
    <i class="fa fa-info-circle"></i> Inicio
    </a> 
<span class="ml-4 h3"><?=$_POST['ayuda']?></span>
<div class="jumbotron mt-2">
<?
$CPS = explode( '|', $_POST['ayuda'] );
if(count($CPS) == '1') {$WHR = "WHERE modulo = '".$CPS[0]."' AND item = ''";}
else {$WHR = "WHERE modulo = '".$CPS[0]."' AND item = '".$CPS[1]."'";}
$R_d = $CNSLTS->listar('texto','help',$WHR);
if($R_d){ echo $R_d[0]['texto'];}else{
?>
  <h2>Por el momento no tenemos información para mostrarte</h2>
  <p class="lead">a la brevedad la completaremos, disculpas por la molestia
  </p>
<?}?>
</div>
