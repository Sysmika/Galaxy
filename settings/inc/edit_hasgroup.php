<div class="row">

<? 
  if($_SESSION['SUPERUSER'] == 'SI'){
      $q_user     = $CNSLTS->listar("id,name,description,privileges","groups","");
  }elseif($_AACOUNT == 2){
       $q_user     = $CNSLTS->listar("id,name,description,privileges","groups","WHERE account != 1 AND creado <= 2");
  }else{
       $q_user     = $CNSLTS->listar("id,name,description,privileges","groups","WHERE  account = ".$_AACOUNT."");
  }
	foreach($q_user as $R3){
    if($R3){?>
  <input name="id" id="id" type="hidden" value="<?= $R3["id"]?>">
  <input name="insert" id="insert" type="hidden" value="update">
  <? }else{?>
  <input name="insert" id="insert" type="hidden" value="insert">
  <? }?>
    <?   
        $prv = explode(',',$R3["privileges"]);
?>
    <div class="col-lg-12">
        <div class="radio">
            <label class="form-check-label">
            <input type="radio" required name="groups"  value="<?= $R3["id"]?>" <? if($R3["id"]==$usuarios['groups']){echo'checked';}?>> <?= $R3["name"]?> <?= $R3["description"]?>
<?
    foreach($prv as $v){
      $R_priv     = $CNSLTS->listar("name,description",'privileges',"WHERE id = '".$v."'") or die($mysqli->error);
?>
               <br># <?=$R_priv[0]['name']?> <?=$R_priv[0]['description']?>
<? }?><hr>
            </label>
        </div>
    </div>
<? }?>
</div>

