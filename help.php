<? include("inc/conect.php");?>

<section class="border rounded p-2 wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="bi bi-info-square"></i> Ayuda | Uso del sistema</h3>
    </div>
  </div>
  <!-- page start-->
  <div class="row">
    <div class="col-lg-12">
      <section class="panel panel-marca">
        <header class="panel-heading"> Complete los items para mostrar al usuario el funcionamiento del sistema </header>
        <?
        ?>
        <div class="row">
          <div class="col-lg-12 mt-2">
            <div class="mb-4 alert alert-info"> Para editar la ayuda del modulo apretar <i class="bi bi-pencil"></i> | Para editar la ayuda de cada item, apretando sobre el icono de la izquierda  <i class="bi bi-download"></i>, se desplegara el listado de item seleccione el que desea apretando <i class="bi bi-pencil-fill"></i><br>
              <small>Nota: Inicio no tiene items adicionales</small> </div>
          </div>
          <div class="col-lg-6">
            <header class="panel-heading mb-4"> Modulos </header>
              <div class="fw-bold"> 
                  <a class=""> <i class="bi bi-house-fill"></i> <span class="pl-2">INICIO</span> </a> 
                  <i class="bi bi-pencil cpoint float-end mt-2" onClick="linkAction('help/extra/help.php','','resphelp','search')" ></i> 
              </div>
            <?
            ksort( $_SESSION[ 'ACCESO' ] );
            $_NVG = array();
            $KEYNAME = $CNSLTS->listar( 'id,name', 'modules_type', "ORDER BY name" );
            foreach ( $KEYNAME as $KEY => $VALd ) {
              $V_ARR = explode( '-', $VALd[ 'name' ] );
              if ( !empty( $_SESSION[ 'ACCESO' ][ $VALd[ 'name' ] ] ) ) {

                if ( $VALd[ 'name' ] != 'Config' ) {
                  if ( $V_ARR[ 1 ] == 'admin' ) {
                    $_ico = '<i class="bi bi-download"></i>';
                  } else {
                    $_ico = '<i class="bi bi-save2"></i>';
                  }
                  ?>
            
            <!--collapse start-->
              <div class="fw-bold" id="accordion"> 
                  <a class="" data-bs-toggle="collapse" data-parent="#accordion" href="#collapse<?=$V_ARR[1]?>"> <?=$_ico?> <span class="pl-2"><?= $V_ARR[1]?></span> </a> 
                  <i class="bi bi-pencil cpoint float-end mt-2" onClick="linkAction('help/extra/help.php','id=<?= $V_ARR[1]?>','resphelp','search')"></i> 
              </div>
              <div id="collapse<?=$V_ARR[1]?>" class="collapse">
                  <div class="row">
                      <?
                      asort( $_SESSION[ 'ACCESO' ][ $VALd[ 'name' ] ], SORT_NATURAL | SORT_FLAG_CASE );
                      foreach ( $_SESSION[ 'ACCESO' ][ $VALd[ 'name' ] ] as $KII => $VII ) {
                        $_CAPA = explode( '/', $KII );

                        ?>
                      <div class="col-lg-4 m-3 p-4 border"> <i class="bi bi-pencil-fill cpoint mt-2" onClick="linkAction('help/extra/help.php','id=<?= $V_ARR[1]?>|<?=$VII?>','resphelp','search')"  ></i>
                        <?=$VII?>
                      </div>
                      <? }?>
                  </div>
              </div>
            <!--collapse end-->
            
            <? }?>
            <? }?>
            <? }?>
          </div>
          <div class="col-lg-6">
            <header class="panel-heading"> Textos </header>
            <div id="resphelp"></div>
          </div>
        </div>
      </section>
    </div>
  </div>
</section>
