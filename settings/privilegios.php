<? include("../inc/conect.php");
        $data_uri = "settings/extra/privilegio";
?>
<section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="bi bi-filetype-key"></i> PRIVILEGIOS</h3>
    </div>
  </div>
  <? include("nav.php");?>
  <!-- page start-->
  <div class="btn-row mt-2">
    <div class="btn-group">
        <a class="btn btn-secondary btn-sm cpoint myModal text-white" data-id="nuevo" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-plus"></i> Asignar</a>

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
  <div class="row mt-2">
    <div class="col-lg-12">
            <section class="border rounded">
        <?
        if ( $_SESSION[ 'SUPERUSER' ] == 'SI' ) {
          $LST_AC = $CNSLTS->listar( 'id,name,description,data,account,active', 'privileges', "ORDER BY id ASC" );
        } elseif ( $_AACOUNT == 2 ) {
          $LST_AC = $CNSLTS->listar( 'id,name,description,data,account,active', 'privileges', "WHERE id != 1 ORDER BY id ASC" );
        } else {
          $LST_AC = $CNSLTS->listar( 'id,name,description,data,account,active', 'privileges', "WHERE id != 1 AND id != 2 AND active = 1 ORDER BY id ASC" );
        }
        for ( $I = 0; $I < count( $LST_AC ); $I++ ) {
          if ( $LST_AC[$I]["active"] == 1 ) {
            $activo = 'bi-check-square';
          } else {
            $activo = 'bi-plus-square';
          }
          // $EMP = $GNRLS->listar('empresa','empresas',"WHERE id = '".$LST_AC[$I]["account"]."'");
          ?>
        <table class="table table-striped table-advance table-hover">
          <thead>
            <tr>
              <th>nombre</th>
              <?
              $MOD = $CNSLTS->listar( 'id,name', 'modules_type', "ORDER BY name ASC" );
              foreach ( $MOD as $V_mod ) {

                if ( $V_mod[ 'name' ] != 'Config' ) {
                  $each = explode( '-', $V_mod[ 'name' ] );
                  $V_mod[ 'name' ] = end( $each );
                }
                ?>
              <th class="text-capitalize"><?=$V_mod['name']?></th>
              <?   }?>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr id="tr_<?= $LST_AC[$I]["id"]?>">
              <td><?= $LST_AC[$I]["name"]?></td>
              <?
              $MOD = $CNSLTS->listar( 'id,name', 'modules_type', "ORDER BY name ASC" );
              foreach ( $MOD as $V_mod ) {

                if ( $V_mod[ 'name' ] != 'Config' ) {
                  $each = explode( '-', $V_mod[ 'name' ] );
                  $V_mod[ 'name' ] = end( $each );
                }
                ?>
              <td class="text-capitalize" style="vertical-align: top!important;"><?
              ?>
                <?
                $LST_PRV[ $I ] = $CNSLTS->listar( 'id,name,active', 'modules', "WHERE type = '" . $V_mod[ 'id' ] . "' " );
                if ( !empty( $LST_PRV[ $I ][ 0 ][ "name" ] ) ) {
                  $datas = explode( ',', trim( $LST_AC[ $I ][ "data" ], ',' ) ); //id='".$value."'
                  foreach ( $datas as $value ) {
                    $nMod = $CNSLTS->listar( 'id,name,active', 'modules', "WHERE id = '" . $value . "' AND type = '" . $V_mod[ 'id' ] . "' " );
                    ?>
                <p>
                  <?= $nMod[0]['name']?>
                </p>
                <? } ?>
                <? } ?></td>
              <?   }?>
                <td class="hidden-print hidden">
                    <div class="btn-group btn-group-sm pull-right">
                        <a class="btn btn-info cpoint text-white"><i class="bi <?= $activo?>"></i></a>
                        <a class="btn btn-info btn-sm cpoint myModal text-white" data-id="<?=$LST_AC[$I]["id"] ?>" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-save"></i></a>
                  <? if($LST_AC[$I]["id"] != 1){?>
                        <a class="btn btn-danger btn-sm cpoint text-white" onClick="linkAction('bat/delete.php','id=<?=$LST_AC[$I]["id"] ?>','respEdit','delete')"><i class="bi bi-trash3"></i></a>
                        <?}?>
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
<script>
const myLink = gebc("myModal");

myLink.forEach(boton => {
    boton.addEventListener('click', () => {
      var idC = boton.getAttribute('data-id');
      var modalResponse = gebi("modal-response");    
      event.preventDefault(); // This will prevent the link from navigating
        modalResponse.innerHTML = "Loading.....";
        linkAction ('<?=$data_uri?>.php','id='+idC,'modal-response','search')
    });
});
    
</script> 
