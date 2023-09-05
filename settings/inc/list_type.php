<? $TCAT="config";include("../../inc/conect.php");?>
<?
$type_A='Nuevo';
include("../../inc/conect.php");

if((isset ($_POST["id"])) and ($_POST["id"]!='nodata') and (is_numeric($_POST["id"]))){
			$AGENDA	= $CNSLTS->full_list("modules_type","WHERE id='".$_POST["id"]."'");
			$type_A	= 'Editar '.$AGENDA[0]['name'];
 }
?>
<section class="p-2 border rounded">
  <div class="row">
    <div class="col-12">
      <h3 class="page-header"><i class="bi bi-shield-check"></i> Tipos</h3>
    </div>
  </div>
  <!-- page start-->
<div class="row">
        <div class="col-lg-7">
<div id="mnsg"></div>

  <div id="lista" style="display:<?= $M1;?>; clear:both">
    <h5>Listado</h5>
                <table class="table table-sm table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <th><i class="icon_key_alt"></i> id</th>
                            <th><i class="icon_user"></i> nombre</th>
                            <th><i class="icon_cogs"></i> Action</th>
                        </tr>
                    </thead>
                     <tbody>
   <?
	$LST_TY	= $CNSLTS->listar('id,name,activo','modules_type',"WHERE name != 'Config' ORDER BY name ASC");
	if($CNSLTS->num_rows('modules_type','') == 0){
		?>
		    <div class="alert alert-warning text-center">Busqueda sin resultados </div>

		<?
	}

	for($I=0;$I < count($LST_TY);$I++){
			if($LST_TY[$I]["activo"] == 'si'){
				$activo='';
			}else{
				$activo='bg-warning';
            }
?>
                        <tr id="trm_<?= $LST_TY[$I]["id"]?>" class="<?=$activo?>">
                            <td>
                                <?= $LST_TY[$I]["id"]?>
                            </td>
                            <td>
                                <?= $LST_TY[$I]["name"]?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-success cpoint" onClick="linkAction('settings/inc/list_type.php','id=<?=$LST_TY[$I]["id"]?>','modal-response','search')" ><i class="bi bi-pencil-square"></i></a>
                                    <a class="btn btn-sm btn-danger cpoint" onClick="linkAction('bat/delete.php','tabla=modules_type&id=<?= $LST_TY[$I]["id"]?>','trm_<?= $LST_TY[$I]["id"]?>','delete')"><i class="bi bi-trash2-fill"></i></a>
                                </div>
                            </td>
                        </tr>

                        <? }?>

                    </tbody>
                </table>
    </div>
        </div>
    <div class="col-lg-4">
   <h5><?=$type_A?></h5>
  <div id="respEdit"></div>
  <div id="edito" class="container" style="display:<?= $M2;?>; clear:both;">
    <form enctype="multipart/form-data" method="post" name="mdtype" id="mdtype" onSubmit="return false">
      <input name="tabla" id="tabla" type="hidden" value="modules_type">
      <? if(isset($AGENDA)){?>
      <input name="id" id="id" type="hidden" value="<? if(isset($AGENDA)) echo  $AGENDA[0]["id"]?>">
      <input name="insert" id="insert" type="hidden" value="update">
      <? }else{?>
      <input name="insert" id="insert" type="hidden" value="insert">
      <? }?>
      <div class="form-group"><label for="name">nombre:</label>
        <input class="form-control" name="name" id="name" type="text" size="35"  value="<? if(isset($AGENDA)) echo $AGENDA[0]["name"] ?>" required>
        </div>
        <div class="form-group"><label for="activo">activo:</label>
            <select id="activo" class="form-control" name="activo">
          <option>selec</option>
          <option value="si" <? if(($AGENDA[0]["activo"]=='si') and (isset($AGENDA))){ echo'selected';}?>>si</option>
          <option value="no" <? if(($AGENDA[0]["activo"]=='no') and (isset($AGENDA))){ echo'selected';}?>>no</option>
			</select>
      </div>
            <button class="btn btn-sm btn-success mt-3" onClick="linkAction ('bat/submit.php','mdtype','respEdit','submit')"><i class="fa fa-save"></i> Guardar</button>
<?  if(isset($_POST["id"])){?>
<?  if(is_numeric($_POST["id"])){?>
            <button class="btn btn-sm btn-danger mt-3" onClick="linkAction ('bat/borrar.php','tabla=modules_type&id=<?= $_POST["id"]?>','edito','delete')"><i class="fa fa-trash"></i> Borrar</button>
<? }?>
<? }?>
  <div id="respEdit"></div>
        
    </form>
  </div>

</div>
</div>    
</section>
