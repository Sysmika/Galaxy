<? session_start()?>
<div class="row">
    <div class="col-lg-12">
<?
  if($_SESSION['SUPERUSER'] == 'SI'){
      $q_user2     = $CNSLTS->listar("id,name,description","privileges","");
  }elseif($_AACOUNT == 2){
      $q_user2     = $CNSLTS->listar("id,name,description","privileges","WHERE id != 1");
  }else{
      $q_user2     = $CNSLTS->listar("id,name,description","privileges","WHERE account = ".$_AACOUNT."");
  }
	foreach($q_user2 as $R2){
	?>
                <div class="radio">
                    <label class="form-check-label">
            <input type="checkbox" name="privileges[]"  value="<?= $R2["id"]?>" <? if(in_array($R2["id"],$ar_dt)){echo'checked';}?>> <?= $R2["name"]?> <?= $R2["description"]?>
          </label>
                
                </div>
                <? }?>
    </div>
</div>