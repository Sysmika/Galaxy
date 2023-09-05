<div class="row">
                <? 
  if($_SESSION['SUPERUSER'] == 'SI'){
      $q_user     = $CNSLTS->listar("id,empresa","empresas","");
  }elseif($_AACOUNT == 2){
      $q_user     = $CNSLTS->listar("id,empresa","empresas","WHERE id != 1");
  }else{
       $q_user     = $CNSLTS->listar("id,empresa","empresas","WHERE  id = ".$_AACOUNT."");
 }
	foreach($q_user as $R2){
	?>
<div class="col-lg-4">
    <div class="radio">
        <label class="form-check-label">
            <input type="radio" required name="account"  value="<? echo $R2["id"]?>" <? if($R2["id"]==$grp[0]['account']){echo'checked';}?>><?= $R2["empresa"]?> 
        </label>               
    </div>
</div>
<? }?>
</div>
