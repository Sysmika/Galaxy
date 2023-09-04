<? $TCAT="config";include("../../inc/conect.php");?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-sitemap"></i> Privilegio</h3>
        </div>
    </div>
    <? //include("../../bat/nav.php");?>
    <!-- page start-->
    <div id="wrapper"></div>
    <form name="privileges" id="privileges" onsubmit="return false" method="post">
        <input name="tabla" id="tabla" type="hidden" value="groups">

        <div class="row">
            <div class="col-lg-12">
            <section class="panel panel-marca">
               <header class="panel-heading">Privilegios</header>

                <?
  if($_SESSION['SUPERUSER'] == 'SI'){
            $AR_AUTH  = array('cuentas','empresa','grupos','Login','modulos','privilegios','secciones','usuarios');
            $WHR = "";
  }elseif($_AACOUNT == 2){
            $AR_AUTH  = array('cuentas','empresa','grupos','privilegios','usuarios');
            $WHR = "";
  }else{
            $AR_AUTH  = array('grupos','privilegios','usuarios');
            $WHR = "WHERE cuenta='".$_AACOUNT."'";
  }
if($_POST["id"]!='nuevo'){
$q_user	= $mysqli->query("SELECT * FROM privileges WHERE id='".$_POST["id"]."'") or die($mysqli->error);
$row	= $q_user->fetch_assoc();
}
elseif($_POST["id"]=='nuevo'){$tipe='nuevo';}
?>
               
                    <input name="tabla" id="tabla" type="hidden" value="privileges">
                    <input name="account" id="account" type="hidden" value="<?=$_AACOUNT?>">
                    <?
	if($_POST["id"]!='nuevo'){?>
                    <input name="insert" type="hidden" id="update" value="update"/>
                    <input name="id" type="hidden" id="id" value="<?= $row["id"] ?>"/>
                    <? }else{?>
                    <input id="insert" name="insert" type="hidden" value="insert"/>
                    <? }?>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group"><label for="name">nombre: </label>
                                <input class="form-control" name="name" type="text" id="name" required value="<?= $row["name"] ?>" <? if($_GET[ "tipo"]=='edit' ) echo 'disabled="disabled" class="disabled"';?> />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group"><label for="name">grupo: </label>
                                <select name="groups" class="form-control selectpicker">
                                 <?
                                $q_grp	= $mysqli->query("SELECT id,name FROM groups $WHR") or die($mysqli->error);
                                    print_r($q_grp);
                                while($row2	= $q_grp->fetch_assoc()){?>
                                  <option value="<?=$row2['id']?>" <? if($row["groups"] == $row2['id']){echo'selected';}?>><?=$row2['name']?></option>  
                                    <? }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group"><label for="name">descripcion: </label>
                                <input class="form-control" name="description" type="text" id="description" value="<?= $row["description"] ?>"/>
                            </div>
                        </div>
                    </div>
                    <h3>modulos:</h3>
                    <div class="row">
                        <? 
		$Q_MT 	= $mysqli->query("SELECT * FROM modules_type ORDER BY name ASC") or die("Error:   ".$mysqli->error);
                  $tt  = $CNSLTS->num_rows('modules_type',$filtro)/4;
				while($R_MT = $Q_MT->fetch_assoc()){
                    
?>
                        <div class="col-lg-2">
                            <h4>
                                <?= $R_MT['name'];?>:</h4>
                            <div class="row">
                                <div class="col-lg-12 caja m-1 round">
                                    <?
    $datas		= explode (',',$row["data"]);
    $q_user		= $mysqli->query("SELECT id, name FROM modules WHERE active=1 AND type='".$R_MT['id']."' ORDER BY name ") or die($mysqli->error);
        while($rows	= $q_user->fetch_assoc()){
if($R_MT['name'] == 'config'){
if(in_array($rows["name"],$AR_AUTH)){
?>
                                    <label class="checkbox">(<?= $rows["id"]?>)<?= $rows["name"]?>
    <input type="checkbox" id="data[<?= $rows["id"]?>]" name="data[<?= $rows["id"]?>]" class="form-check-input" value="<?= $rows["id"]?>" <? foreach ($datas as &$data) {if($rows["id"]==$data){echo'checked';}?>  <? }?> >
  </label>
                                    <? } ?>
                                    <? }else{ ?>
                                    <label class="checkbox">(<?= $rows["id"]?>)<?= $rows["name"]?>
    <input type="checkbox" id="data[<?= $rows["id"]?>]" name="data[<?= $rows["id"]?>]" class="form-check-input" value="<?= $rows["id"]?>" <? foreach ($datas as &$data) {if($rows["id"]==$data){echo'checked';}?>  <? }?> >
  </label>
                                    <? } ?>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                        <? }?>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="check-inline">
                                <label class="radio">
            <input type="radio" class="form-check-input" name="active" value="1" <? if($row["active"]==1){echo'checked';}?>>Activo si
          </label>
                            

                            </div>
                            <div class="check-inline">
                                <label class="radio">
            <input type="radio" class="form-check-input" name="active" value="2" <? if($row["active"]==2){echo'checked';}?>>Activo no
          </label>
                            

                            </div>
                            <button class="btn btn-success" data-action="save" data-reload="" data-page-ref="nomodal" data-capa="wrapper" data-frm="privileges" data-menu="<?=$_POST['menu']?>&check=true" data-uri="bat/submit"><i class="fa fa-save"></i> Guardar</button>
                            <?
    if(is_numeric($_POST["id"])){?>
                            <button class="btn btn-danger" data-action="delete" data-reload="" data-capa="wrapper" data-frm="<?= $_POST["id"]?>&tabla=privileges" data-uri="bat/delete"><i class="fa fa-trash"></i> Borrar</button>
                            <? }?>
                        </div>
                    </div>
</section>
            </div>
        </div>
        </form>
</section>
    