<? include("../../inc/conect.php");?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-cube"></i> MODULO</h3>
        </div>
    </div>
  <? include("../nav.php");?>
      <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Modulo

                </header>
 <!-- page start-->
<div id="wrapper"></div>
<?
if($_POST["id"]!='nuevo'){
$q_user	= $mysqli->query("SELECT * FROM modules WHERE id='".$_POST["id"]."'") or die($mysqli->error);
$row	= $q_user->fetch_assoc();
}
elseif($_POST["id"]=='nuevo'){$tipe='nuevo';}
?>
<div class="row">
  <div class="col-lg-12">
    <h4>Modulo</h4>
     <small class="text-center text-info"><i class="fa fa-info-circle"></i> Bordes en azul obligatorios</small>

<form name="modules" id="modules" onsubmit="return false" method="post">
    <input name="tabla" id="tabla" type="hidden" value="modules">
    <?
	if($_POST["id"]!='nuevo'){?>
    <input name="insert" id="insert" type="hidden" value="update">
    <input name="id" type="hidden" id="id" value="<?= $row["id"] ?>" />
    <? }else{?>
    <input name="insert" type="hidden" id="insert" value="insert" />
    <? }?>
    
  <div class="form-group">
       <label for="name">nombre:</label>
       <input type="text" name="name" class="form-control" id="name" required value="<?= $row["name"] ?>" <? if($_GET["tipo"]=='edit') echo'disabled="disabled" class="disabled"';?>  >
  </div>
    
  <div class="form-group">
      <label for="type">tipo:</label>
      <select name="type" id="type" class="form-control" required>
        <option value="">seleccione</option>
        <?
            $valor	= $row["type"];

            $Q_MT 	= $mysqli->query("SELECT * FROM modules_type WHERE activo = 1 ORDER BY name ASC") or die("Error:   ".$mysqli->error);
                    while($R_MT = $Q_MT->fetch_assoc()){

            echo "<option value='".$R_MT['id']."'"; if($valor == $R_MT['id']) {echo" selected";} echo">".$R_MT['name']."</option>";

                                }		
    ?>
      </select>
  </div>
  <div class="form-group">
      <label for="description">descripción:</label>
      <input name="description" class="form-control" type="text" id="description" value="<?= $row["description"] ?>" required />
  </div>
  <div class="form-group">
      <label for="data">url:</label>
      <input name="data" class="form-control" type="text" id="data" value="<?= $row["data"] ?>"  required/>
  </div>
  <div class="form-group">
      <label for="active">activo:</label>
      <select id="active" class="form-control" name="active" class="overflow" required>
        <option value="1"<? if($row["active"]=='1'){echo'selected';}?>>si</option>
        <option value="2"<? if($row["active"]=='2'){echo'selected';}?>>no</option>
      </select>
  </div>
  <div class="form-group">completar todos los campos</div>
    <button class="btn btn-success" data-action="save" data-reload="config/modulos" data-page-ref="main-content" data-menu="<?=$_POST['menu']?>&check=true" data-capa="wrapper" data-frm="modules" data-uri="bat/submit"><i class="fa fa-save"></i> Guardar</button>
    <?
    if(is_numeric($_POST["id"])){?>
<button class="btn btn-danger" data-action="delete" data-reload="" data-capa="wrapper" data-frm="<?= $_POST["id"]?>&tabla=modules" data-uri="bat/delete"><i class="fa fa-trash"></i> Borrar</button>
<? }?>
<button class="btn btn-default" type="button" data-action="edit" data-title="Nuevo modulo" data-menu="<?=$_POST['menu']?>" data-capa="main-content" id="nuevo" data-uri="config/extra/edit_mod">Nuevo</button>                    
</form>
    </div></div>
</section>
    </div></div>
