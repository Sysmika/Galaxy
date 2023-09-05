<?  $TCAT="config";include("../inc/conect.php");?>
<?
                // extras para logeo
                $PRM = "AND id = ".$_AACOUNT;
                if($_SESSION['SUPERUSER'] == 'SI'){$PRM = '';}
                if($_AACOUNT == 2){$PRM = "AND id >= ".$_AACOUNT;}
                // fin extras
                    $_TBL			= "groups";
                    $_RTN           = "settings/grupos.php";                       // URL RETORNO 
                    $_LST			= 'id,name,description';
                    $_ORDER    		= $PRM." ORDER BY name DESC";
                    $data_uri    	= "settings/extra/grupo";
                    $_LST_Ar		= explode(",",$_LST);
                    $ARR_XTRA_TBL	= array(""=>"");
                    $RegistrosAMostrar	= "20";
                    $NOEDIT         = 0; 
                    $NODEL          = 0;
                    $NOACT          = 0;
                    $UPLDIMG        = 0;                        // TRUE INCLUYE UPLOADS DE ARCHIVOS
                    $AR_OMIT        = [];                       // CREO ARRAY DE CAMPOS OCULTOS
?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-layer-group"></i> Grupos</h3>
        </div>
    </div>
<? include("nav.php");?>
    <!-- page start-->
  <div class="btn-row">
    <div class="btn-group">
      <button class="btn btn-secondary myModal" type="button" data-id="nuevo" data-bs-toggle="modal" data-bs-target="#myModal">Nuevo</button>
      <div class="btn-group" id="top_menu"> 
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="form">
              <input class="form-control" id="search" placeholder="buscar" type="text">
            </form>
          </li>
          <li></li>
        </ul>
        <!--  search form end --> 
      </div>
      <button class="btn btn-secondary" type="button" onClick="linkAction('<?=$_RTN?>','search='+encodeURIComponent(document.getElementById('search').value),'alpha','search')"><i class="bi bi-search cpoint"></i> Buscar</button>
    </div>
  </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <section class="border rounded">
                <header class="h6 p-2 text-capitalize">
                 Grupos 
                </header>
                <? include("../tmpls/listado.php");?>
              </section>
        </div>
    </div>
</section>