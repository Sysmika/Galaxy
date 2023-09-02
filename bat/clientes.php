<? include("../inc/conect.php");?>
<?  
    $TCAT   = "clientes";
    $DATA_a = 'clientes'; 
    $DATA_b = 'clientes.php';
    $DATA_c = $_POST['id'];
if($DATA_c != 'nuevo'){
    $Q_c = $CNSLTS->full_list($DATA_a,"WHERE id = '".$DATA_c."'");
    $DATA_d = $Q_c[0]['nombre'];
}else{
    $DATA_d = 'nuevo';
}
?>
<section class="traslucido p-2 rounded min-vh-75">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="text-capitalize"><i class="bi bi-emoji"></i> <?=$DATA_b?></h3> 
            </div>
        </div>
    </div>
    
    <!-- page start-->

<section class="container-fluid">
<!-- page start-->
    
   <div class="container-fluid mt-2 mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-light bg-gradient border border-2 rounded mt-1" >
              <div class="card-body">
                <h5 class="card-title">Edicion</h5>
                  <?
                    $page_ref		= $DATA_c;
                    $_PGNC			= $DATA_b;
                    $_TBL			= $DATA_a;
                    $_ID    		= $DATA_c;
                
                    $ARR_EXT_TBL	= array();
                    $_EXNTS         = array();                         
                    $AR_OMIT        = array();
                    $AR_RQRD        = array();
                    $_PRE           = 'CLI'; 
                    $_DIR           = 'clientes'; 
                    $CRRX           = 0;
                    $UPLDIMG        = 0;
    
                    include('../tmpls/edicion.php');?>
              </div>
              <div class="card-foo p-4">
              <div class="w-25 btn-group btn-group-sm">
                <button class="btn btn-sm btn-success" onClick="linkAction('bat/submit.php','f_<?=$_TBL?>','respEdito','submit')"><i class="bi bi-save2"></i> Guardar</button>
 <? if ((isset($_POST["id"])) and ($_POST["id"]!='nuevo')){?>
                 <button class="btn btn-sm btn-danger" onClick="linkAction('bat/delete.php','tabla=<?=$_TBL?>&id=<?=$_POST['id']?>','respEdito','delete')"><i class="bi bi-recycle"></i> Borrar</button>
<? }?>
              </div>
              </div>
     <div id="respEdito"></div>
            </div>
        </div>
    </div>
   </div>
</section></section>
    