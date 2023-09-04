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

                    $page_ref		= $_POST["id"];
                    $_PGNC			= "config/grupos";
                    $_TBL			= "groups";
                    $_ID    		= $_POST["id"];
                    $_PRE    		= "SYS";
                    $ARR_EXT_TBL	= array();
                    $AR_RQRD        = array('nombre');
                    $_POST['refP']  = 'main-content';
                    $_EXNTS         = array();                         
                    $AR_OMIT         = array();
                    $AR_RQRD         = array();


    if(is_numeric($_POST['id'])){
      $q_user = $mysqli->query("SELECT * FROM groups WHERE  id = ".$_POST['id']." AND active = 1") or die($mysqli->error);
        $usuarios    = $q_user->fetch_assoc();
        $ar_dt = explode(',',$usuarios['privileges']);
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
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-success" data-action="save" data-page-ref="nomodal" data-reload="" data-menu="<?=$_POST['menu']?>&check=1" data-capa="wrapper" data-frm="groups_has_privileges" data-uri="bat/submit"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
    </form>
</section>