<? include("../inc/conect.php");?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-key"></i> PRIVILEGIOS</h3>
        </div>
    </div>
 <? include("nav.php");?>
    <!-- page start-->
    <div class="btn-row">
        <div class="btn-group">
            <button class="btn btn-success text-dark text-bold" type="button" data-action="edit" id="nuevo" data-menu="<?=$_POST['menu']?>" data-frm="nuevo" data-uri="config/extra/privilegio" data-capa="main-content"><i class="fa fa-plus"></i> <strong>Asignaar</strong></button>
 <!--
<div class="btn-group" id="top_menu">
                <ul class="nav top-menu">
                    <li>
                        <form class="form">
                            <input class="form-control" id="search" placeholder="Search" type="text">
                        </form>
                    </li>
                </ul>
            </div>
<button class="btn btn-default" type="button"><i class="fa fa-search cpoint" data-capa="main-content" data-uri="config/list_priv" data-extra=""> Buscar</i></button>
-->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel panel-info">
                <header class="panel-heading">
                </header>
                       <?
if($_SESSION['SUPERUSER'] == 'SI'){
    $LST_AC	= $CNSLTS->listar('id,name,description,data,account,active','privileges',"ORDER BY id ASC");    
}elseif($_AACOUNT == 2){
    $LST_AC	= $CNSLTS->listar('id,name,description,data,account,active','privileges',"WHERE id != 1 ORDER BY id ASC");    
}else{
	$LST_AC	= $CNSLTS->listar('id,name,description,data,account,active','privileges',"WHERE id != 1 AND id != 2 AND active = 1 ORDER BY id ASC");    
}
for($I=0;$I < count($LST_AC);$I++){
		if($LST_AC[$I]["active"]== 1){$activo='check-square';}else{$activo='times-circle';}
   // $EMP = $GNRLS->listar('empresa','empresas',"WHERE id = '".$LST_AC[$I]["account"]."'");
?>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <th>nombre</th>
                            <?
	$MOD	= $CNSLTS->listar('id,name','modules_type',"ORDER BY name ASC");  
    foreach($MOD as $V_mod){
                            
                            if($V_mod['name'] != 'Config'){ 
                                $each = explode('-',$V_mod['name']); $V_mod['name'] = end($each);
                            }
                            ?>
                            <th class="text-capitalize"><?=$V_mod['name']?></th>   
                            
                            <?   }?>

                            <th>Acción</th>
                        </tr>
                    </thead>
                     <tbody>
                        <tr id="tr_<?= $LST_AC[$I]["id"]?>">
                            <td>
                                <?= $LST_AC[$I]["name"]?>
                            </td>
                            <?
                            	$MOD	= $CNSLTS->listar('id,name','modules_type',"ORDER BY name ASC");  
    foreach($MOD as $V_mod){
                            
                            if($V_mod['name'] != 'Config'){ 
                                $each = explode('-',$V_mod['name']); $V_mod['name'] = end($each);
                            }
                            ?>
                            <td class="text-capitalize" style="vertical-align: top!important;"> 
                             	<?
    ?>
<?
        $LST_PRV[$I]	= $CNSLTS->listar('id,name,active','modules',"WHERE type = '".$V_mod['id']."' ");
		if(!empty($LST_PRV[$I][0]["name"])){
        $datas	= explode(',',trim($LST_AC[$I]["data"],','));//id='".$value."'
        foreach($datas as $value){
        $nMod	= $CNSLTS->listar('id,name,active','modules',"WHERE id = '".$value."' AND type = '".$V_mod['id']."' ");
?>
		<p><?= $nMod[0]['name']?></p> 
		<? } ?>
	<? } ?>

                            </td>
                            <?   }?>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary cpoint"><i class="fa fa-<?= $activo?>"></i></a>
                                    <a class="btn btn-success cpoint" data-action="edit" data-menu="<?=$_POST['menu']?>&modal=true" data-uri="config/extra/privilegio" data-capa="dialog-response" id="<?=$LST_AC[$I]["id"]?>"><i class="fa fa-edit"></i></a>
                              <? if($LST_AC[$I]["id"] != 1){?>
                                   <a class="btn btn-danger cpoint" data-action="delete" data-capa="tr_<?= $LST_AC[$I]["id"]?>" data-frm="<?= $LST_AC[$I]["id"]?>&tabla=privileges" data-uri="bat/delete"><i class="icon_close_alt2"></i></a>
                             <? }?>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

                        <? }?>
            </section>
        </div>
    </div>

</section>