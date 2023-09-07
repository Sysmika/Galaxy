<? include("../inc/conect.php");?>
<?
        // fin extras
        //echo $PRM;
        $_TBL               = "compras";                       // TABLA DE LISTADO                      
        $_RTN               = "diario/compras.php";                       // URL RETORNO 
        $_LST               = 'fecha,concepto,proveedor';                       // CAMPOS|COLUMNAS
        $_LST_HDDN          = ',id';                     // ADICIONAL QUERY NO SE MUESTRA EN LAS COLUMNAS
        $_ORDER             = " ORDER BY fecha DESC";                // ADICIONAL WHEREs & REQUEST ORDER 
        $data_uri           = "diario/edit/compra";                       // URL DE EDICIÓN
        $_LST_Ar            = explode(",",$_LST);       // CREO ARRAY CON EL LISTADO DE CAMPOS
        $ARR_XTRA_TBL       = [];                       // CREO ARRAY CON CAMPOS REFERIDOS A OTRAS TABLAS | FORMATO ("campo"=>"campo de la tabla*tabla")
        $RegistrosAMostrar  = "10";                       // CANTIDAD DE REGISTROS A MOSTRAR POR PÁGINA
        $NOEDIT             = 0;                        // TRUE NO PERMITE EDICIÓN
        $NODEL              = 0;                        // TRUE NO PERMITE BORRADO
        $UPLDIMG            = 0;                        // TRUE INCLUYE UPLOADS DE ARCHIVOS
        $NOPAG              = 0;                        // TRUE HABILITA PAGINACIÓN    
        $PGNDR              = '';                       // CORRIGE RUTA PAGINACION EJ: ../    
?>

<section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="text-capitalize"><i class="bi bi-bag"></i> <?=$_TBL?></h3>
    </div>
  </div>
  <?
    // NAVEGADOR DE MODULOS
    include("nav.php"); ?>
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
        <header class="h6 p-2 text-capitalize"> <?=$_TBL?> </header>
          
          
          
        <? include("../tmpls/listado.php");?>
      </section>
    </div>
  </div>
</section>



