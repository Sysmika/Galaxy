<?
include( '../inc/conect.php' );
$name = '';
    if(isset($_POST['id']) and (is_numeric($_POST["id"]))) {
        $nom = $CNSLTS->listar('nombre','gestores',"WHERE id = ".$_POST["id"]."");
        $name = $nom[0]['nombre'];
        

    }
?>

<div id="resp_g"></div>
<form id="f_g">
    <input type="hidden" name="tabla" value="gestores">
    <input type="hidden" name="insert" value="insert">
  <? if(isset($_POST['id']) and (is_numeric($_POST["id"]))) {?>
  <input name="id" id="id" type="hidden" value="<?= $_POST["id"]?>">
  <input name="insert" id="insert" type="hidden" value="update">
  <? }else{?>
  <input name="insert" id="insert" type="hidden" value="insert">
  <? }?>
    
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="<?=$name?>">
  </div>
  <button type="button" onClick="linkAction ('bat/submit.php','f_g','resp_g','submit')" class="btn btn-primary">Submit</button>
</form>