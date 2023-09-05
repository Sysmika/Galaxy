<?  $TCAT="Admin";include("../../inc/conect.php");?>
<?
if($_POST['save'] == 'ayuda'){
    $mysqli->query("UPDATE empresas SET ayuda = '".$_POST['recordar']."' WHERE id = '".$_AACOUNT."'")or die($mysqli->error);
    
  if($_POST['recordar'] == 'no') {
      echo '<div class="alert alert-marca">La ayuda no se mostrara en el iniciar sesión puede hacerlo en <i class="fa fa-lg fa-info-circle"></i> en la parte superior derecha de la pantalla</div>';
   }else{
      echo '<div class="alert alert-marca">La ayuda se mostrara en el iniciar sesión</div>';
   }
    $_SESSION["ayuda"] = $_POST['recordar'];
 die;
}

if($_POST['save'] == 'si'){
    if(empty($_POST['item'])){
        $_where = "modulo = '".$_POST['modulo']."' AND item = ''";
        $_set   = "modulo = '".$_POST['modulo']."' , item = ''";
    }else{
        $_where = "modulo = '".$_POST['modulo']."' AND item = '".$_POST['item']."'";
        $_set   = "modulo = '".$_POST['modulo']."' , item = '".$_POST['item']."'";
    }
    $react  = $mysqli->query("DELETE FROM help WHERE ".$_where."") or die($mysqli->error);
    $reatb = $mysqli->query("INSERT INTO help SET texto = '".$_POST['texto']."', ".$_set."") or die($mysqli->error);
    
    if($react){
    echo '<div class="alert alert-success">se actualizó la ayuda</div>';
    }else{
    echo '<div class="alert alert-warning">Hubo un error, intentalo nuevamente</div>';
    }
    die;
}

$CPS = explode( '|', $_POST['id'] );
if(count($CPS) == '1') {$WHR = "WHERE modulo = '".$CPS[0]."' AND item = ''";}
else {$WHR = "WHERE modulo = '".$CPS[0]."' AND item = '".$CPS[1]."'";}
$R_d = $CNSLTS->listar('texto','help',$WHR);

?>
<div class="mt-2">
<div id="resp_h"></div>
<form id="helpus">
<input type="hidden" name="save" value="si">    
<div class="row">
    <!-- Bootsrep Editor -->
    <div class="col-lg-6"><input type="text" name="modulo" value="<?=$CPS[0]?>" class="form-control" readonly>
    </div>
    <div class="col-lg-6"><input type="text" name="item" value="<?=$CPS[1]?>" class="form-control" readonly>
    </div>
    <div class="col-lg-12">
        <div class="form-group <?=$HDDN?>">
            <label for="label">
                Texto:</label>
            <textarea id="txtr" class="form-control" name="texto"><?=$R_d[0]['texto']?></textarea>
        </div>

    </div>
    <div class="col-lg-12 mt-2">
          
     <button class="btn btn-secondary" onClick="linkAction('help/extra/help.php','helpus','resp_h','submit')"><i class="bi bi-save"></i> Guardar</button>
    </div>
    </div>
    </form>
    </div>
    
    