<? include("../inc/conect.php");?>

<section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="bi bi-building"></i> EMPRESA</h3>
    </div>
  </div>
  <? include("nav.php");?>
  <!-- page start-->
  <div class="row">
    <div class="col-lg-12 p-2">
      <section class="border rounded">
        <header class="h6 p-2"> Empresa </header>
        <?
        $_TBL = 'empresa';
        $_CAPA = 'empresa';
        $Q_usuarios = $mysqli->query( "SELECT *  FROM " . $_TBL . "" )or die( 'adm: ' );
        $usuarios = $Q_usuarios->fetch_assoc();
        ?>
        <div class="panel-body m-2">
          <div id="wrapper"></div>
          <div class="form">
            <form class="form-validate form-horizontal " id="f_<?=$_TBL?>" method="POST" onSubmit="return; false">
              <div class="row">
                <div class="col-lg-6">
                  <input name="tabla" id="tabla" type="hidden" value="<?=$_TBL?>">
                  <input name="id" id="id" type="hidden" value="<?= $usuarios["id"]?>">
                  <input name="insert" id="insert" type="hidden" value="update">
                  <?
                  $INCR = 0;
                  $Q_U = $mysqli->query( "SHOW FIELDS FROM $_TBL " )or die( 'cli: ' );
                  $trr = round( $Q_U->num_rows / 2 ) + 1;
                  while ( $R_U = $Q_U->fetch_assoc() ) {
                    //echo $R_U["Type"].'<br>';

                    $TYPE_SET = strpos( $R_U[ "Type" ], 'set' );
                    $TYPE_ENUM = strpos( $R_U[ "Type" ], 'enum' );
                    $TYPE_DEC = strpos( $R_U[ "Type" ], 'float' );
                    $TYPE_TXT = strpos( $R_U[ "Type" ], 'text' );
                    $TYPE_INT = strpos( $R_U[ "Type" ], 'int' );
                    $tipo_campo = $R_U[ "Type" ];
                    $esfecha = 'text';
                    $adic = '';
                    if ( $tipo_campo == 'date' ) {
                      $esfecha = 'date';
                      $adic = $_POST[ "id" ];
                    } elseif ( ( $tipo_campo == 'int' )or( $TYPE_DEC === 0 )or( $TYPE_INT === 0 ) ) {
                      $esfecha = 'number';
                      $adic = $_POST[ "id" ];
                    }

                    if ( ( $R_U[ "Field" ] == 'id' )or( $R_U[ "Field" ] == 'lclave' ) ) {} elseif ( $R_U[ "Field" ] == 'codigo' ) {
                        $Codigo = $GNRLS->codex( 'CLI', $_POST[ 'id' ], $_TBL );
                        ?>
                  <div class="form-group ">
                    <label for="<?= $R_U["Field"]?>" class="control-label col-lg-2">
                      <?= $R_U["Field"]?>
                      :<span class="required">*</span> </label>
                    <div class="col-lg-10">
                      <input id="<?= $R_U["Field"]?>" class="form-control" name="<?= $R_U["Field"]?>" type="text" value="<?= $Codigo?>" readonly>
                    </div>
                  </div>
                  <?
                  } elseif ( ( $TYPE_SET === 0 )or( $TYPE_ENUM === 0 ) ) {
                      $EX_ser = $R_U[ "Type" ];
                      $A_TYPE = explode( '(', $EX_ser );
                      $A_set = str_replace( array( $A_TYPE[ 0 ], "(", "'", ")" ), "", $EX_ser );
                      $A_set = explode( ',', $A_set );
                      ?>
                  <div class="form-group ">
                    <label for="<?= $R_U["Field"]?>" class="control-label col-lg-2">
                      <?= $R_U["Field"]?>
                      :<span class="required">*</span> </label>
                    <div class="col-lg-10">
                      <select id="<?= $R_U["Field"]?>" name="<?= $R_U["Field"]?>" class="form-control">
                        <option value="">seleccione</option>
                        <? foreach($A_set as $V_set){?>
                        <option value="<?= $V_set;?>" <? if($usuarios[$R_U[ "Field"]]==$V_set){echo 'selected';}?>>
                        <?= $V_set;?>
                        </option>
                        <? }?>
                      </select>
                    </div>
                  </div>
                  <?
                  } elseif ( $TYPE_TXT === 0 ) {
                      ?>
                  <div class="form-group ">
                    <label for="ta_<?= $R_U["Field"]?>" class="control-label col-lg-2">
                      <?= $R_U["Field"]?>
                      :<span class="required">*</span> </label>
                    <div class="col-lg-10">
                      <textarea id="ta_<?= $R_U["Field"]?>" class="form-control" name="<?= $R_U["Field"]?>" type="<?= $esfecha?>"><?= $usuarios[$R_U["Field"]]?>
</textarea>
                    </div>
                  </div>
                  <? }else{ ?>
                  <div class="form-group ">
                    <label for="<?= $R_U["Field"]?>" class="control-label col-lg-2">
                      <?= $R_U["Field"]?>
                      :<span class="required">*</span> </label>
                    <div class="col-lg-10">
                      <input id="<?= $R_U["Field"]?>" class="form-control" name="<?= $R_U["Field"]?>" type="<?= $esfecha?>" value="<?= $usuarios[$R_U["Field"]]?>">
                    </div>
                  </div>
                  <? }?>
                  <?
                  $INCR++;
                  if ( $INCR == $trr ) {
                    ?>
                </div>
                <div class="col-lg-6">
                  <?
                  $INCR = 0;
                  }
                  }
                  ?>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10 mt-2">
                      <button class="btn btn-primary" type="button" onClick="linkAction ('bat/submit.php','f_<?=$_TBL?>','betha','reload')" ><i class="bi bi-save"></i> Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="container mt-4" id="betha"></div>
          </div>
        </div>
      </section>
    </div>
  </div>
  
  <!-- page end--> 
</section>
