<? $TCAT="Parametros";include("../../inc/conect.php");?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-industry"></i> Empresas</h3>
        </div>
    </div>
  <? //include("../../bat/nav.php");?>
  <!-- page start-->
<div id="wrapper"></div>
<?
                    $page_ref		= $_POST["id"];
                    $_PGNC			= "parametros/empresas";
                    $_TBL			= "empresas";
                    $_ID    		= $_POST["id"];
                    $_PRE    		= "SYS";
                    $ARR_EXT_TBL	= array("localidad"=>"nombre*localidades","provincia"=>"nombre*provincias");
                    $AR_RQRD        = array('empresa','contacto','telefono','activo');
                    $_POST['refP']  = 'main-content';
                    $_EXNTS         = array();                         
                    $AR_OMIT         = array();
                    $AR_RQRD         = array();
    
    
    include("../../tmpls/edicion.php");
?>
    </div>
              <div class="card-foo p-4">
              <div class="w-25 btn-group btn-group-sm">
                <button class="btn btn-sm btn-success" onClick="linkAction('bat/submit.php','f_<?=$_TBL?>','respEdito','submit')"><i class="bi bi-save2"></i> Guardar</button>
 <? if ((isset($_POST["id"])) and ($_POST["id"]!='nuevo')){?>
                 <button class="btn btn-sm btn-danger" onClick="linkAction('bat/delete.php','tabla=<?=$_TBL?>&id=<?=$_POST['id']?>','respEdito','delete')"><i class="bi bi-recycle"></i> Borrar</button>
<? }?>
              </div>
                       <div id="respEdito"></div>

              </div>

</section>