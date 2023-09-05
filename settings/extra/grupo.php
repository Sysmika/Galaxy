<? $TCAT="config";include("../../inc/conect.php");?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-layer-group"></i> Grupo</h3>
        </div>
    </div>
    <? //include("../../bat/nav.php");?>
    <!-- page start-->
    <div id="wrapper"></div>
    <form name="groups_has_privileges" id="groups_has_privileges" onsubmit="return false" method="post">
               <input name="tabla" id="tabla" type="hidden" value="groups">

        <div class="row">
            <div class="col-lg-6">
                <?    
                    $_PGNC			= "settings/grupos";
                    $_TBL			= "groups";
                    $_ID    		= $_POST["id"];
                    $_PRE    		= "GRP";
                    $ARR_EXT_TBL	= array();
                    $AR_RQRD        = array('nombre');
                    $_EXNTS         = array();                         
                    $AR_OMIT        = array();
                    $AR_RQRD        = array();


    if(is_numeric($_POST['id'])){
       $grp     = $CNSLTS->full_list("groups","WHERE  id = ".$_POST['id']." AND active = 1");
       $ar_dt   = explode(',',$grp[0]['privileges']);
?>
                <input name="insert" type="hidden" id="update" value="update"/>
               <input name="id" type="hidden" id="id" value="<?= $_POST["id"]?>" required="required"/>
<? }else{?>
                <input name="insert" type="hidden" id="update" value="insert"/>
               <input name="id" type="hidden" id="id" value="nuevo" required="required"/>                
                <? }?>
                <?    
    include("../inc/edit_group.php");
?>
            </div>
            <div class="col-lg-6">
                 <?    
    include("../inc/edit_account.php");
    include("../inc/edit_priv.php");
                
                //config/extra/save
?>
           </div>
        </div>
  <div class="card-foo p-4">
    <div class="w-25 btn-group btn-group-sm">
      <button class="btn btn-sm btn-success" onClick="linkAction('bat/submit.php','groups_has_privileges','respEdito','submit')"><i class="bi bi-save2"></i> Guardar</button>
      <? if ((isset($_POST["id"])) and ($_POST["id"]!='nuevo')){?>
      <button class="btn btn-sm btn-danger" onClick="linkAction('bat/delete.php','tabla=<?=$_TBL?>&id=<?=$_POST['id']?>','respEdito','delete')"><i class="bi bi-recycle"></i> Borrar</button>
      <? }?>
    </div>
    <div class="mt-3" id="respEdito"></div>
  </div>
    </form>
</section>