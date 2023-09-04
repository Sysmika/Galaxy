<? include("../inc/conect.php");?>

<section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="bi bi-buildings"></i> EMPRESAS</h3>
    </div>
  </div>
  <? include("nav.php");?>
  <!-- page start-->
  <div class="btn-row my-2">
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
      <button class="btn btn-secondary" type="button" onClick="linkAction('settings/empresas.php','search='+encodeURIComponent(document.getElementById('search').value),'alpha','search')"><i class="bi bi-search cpoint"></i> Buscar</button>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <section class="border rounded">
        <header class="h6 p-2"> Empresas </header>
<?
        // extras para logeo
        $PRM = "AND id = " . $_AACOUNT;
        if ( $_SESSION[ 'SUPERUSER' ] == 'SI' ) {
          $PRM = '';
        }
        if ( $_AACOUNT == 2 ) {
          $PRM = "AND id >= " . $_AACOUNT;
        }
        // fin extras
        //echo $PRM;
        $_PGNC = explode( ".", $_SERVER[ "PHP_SELF" ] );
        $_TBL = "empresas";
        $_RTN = "settings/empresas";
        $_LST = 'id,empresa,direccion,email,telefono,contacto';
        $_ORDER = $PRM . " ORDER BY empresa DESC";
        $data_uri = "settings/extra/empresa";
        $_LST_Ar = explode( ",", $_LST );
        $ARR_XTRA_TBL = array( "" => "" );
        $RegistrosAMostrar = "20";
        $NOEDIT = 0;
        $NODEL = 0;
        $NOACT = 0;
        $AR_OMIT = array();
          
?>
<? include("../tmpls/listado.php");?>
      </section>
    </div>
  </div>
</section>



