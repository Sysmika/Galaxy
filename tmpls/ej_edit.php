<? $TCAT="Parametros";include("../../inc/conect.php");?>
<?
                    $_TBL			= "";       // TABLA
                    $_PRE    		= "SYS";    // PRE CODIGO
                    $ARR_EXT_TBL	= [];       // CREO ARRAY CON CAMPOS REFERIDOS A OTRAS TABLAS | FORMATO ("campo"=>"campo de la tabla*tabla")
                    $AR_RQRD        = [];       // CAMPO REQUERIDOS
                    $_EXNTS         = [];       // EXTENSIONES NO SOPORTADAS                        
                    $AR_OMIT        = [];       // CAMPOS OMITIDOS EN LA EDICIÓN
                    $AR_RQRD        = [];       // CAMPOS REQUERIDOS EN LA EDICIÓN
    
?>
<section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-capitalize"><i class="fa fa-industry"></i>
        <?=$_TBL?>
      </h3>
    </div>
  </div>
  <!-- page start-->
  <div id="wrapper"></div>
  <?
  include( "../../tmpls/edicion.php" );
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
