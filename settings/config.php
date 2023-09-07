<? include("../inc/conect.php");
$type = 'insert';
$_COOKIE['id']  = $_SESSION['id_user'];
$q_preference	= $CNSLTS->full_list('preferencias',"WHERE usuario = '".$_SESSION['id_user']."'");
?>
<section class="wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h3 class="h6 p-2"><i class="fa fa-building"></i> EMPRESA</h3>
        </div>
    </div>
<? include("nav.php");?>
<section class="bg-light p-2 rounded vh-90">
    
      <div id="response"></div>
    <form id="save_pref"> 
        <?
if($q_preference){
?>    
        <input type="hidden" value="update" name="insert">
        <input type="hidden" value="<?=$q_preference[0]['id']?>" name="id">
<? }else{?>
        <input type="hidden" value="insert" name="insert">
        <? }?>        
        <input type="hidden" value="preferencias" name="tabla">
        <input type="hidden" value="<?=$_COOKIE['id']?>" name="usuario">
      <div class="card">
        <div class="card-header h2"><strong>Personalizar</strong></div>
        <div class="card-body">
            <div class="row py-1">
                <div class="col-12 mb-2">Esquema de Colores</div>
                <div class="col-4 small">
                    Cool
                    <input type="radio" name="estilo" class="form-check-input" value="cool"<? if($q_preference[0]['estilo'] == 'cool') echo 'checked';?>>
                </div>
                <div class="col-4 small">
                    Claro
                    <input type="radio" name="estilo" class="form-check-input" value="claro"<? if($q_preference[0]['estilo'] == 'claro') echo 'checked';?>>
                </div>
                <div class="col-4 small">
                    Oscuro
                    <input type="radio" name="estilo" class="form-check-input" value="oscuro"<? if($q_preference[0]['estilo'] == 'oscuro') echo 'checked';?>>
                </div>
            </div> 
            <div class="row mt-2 py-1">
                <div class="col-12">Imagen de fondo</div>
                <div class="col-4 border rounded p-1 text-center mt-2 mr-1">
                    <label for="img1"><img src="img/background/1.jpg" alt="fondo #1" class="img-fluid"></label><br>
                    <input type="radio" id="img1" name="fondo" class="form-check-input" value="1" <? if($q_preference[0]['fondo'] == 1) echo 'checked';?>>
                </div>
                <div class="col-4 border rounded p-1 text-center mt-2">
                    <label for="img2"><img src="img/background/2.jpg" alt="fondo #2" class="img-fluid"></label><br>
                    <input type="radio" id="img2" name="fondo" class="form-check-input" value="2" <? if($q_preference[0]['fondo'] == 2) echo 'checked';?>>
                </div>
                <div class="col-4 border rounded p-1 text-center mt-2" mr-1>
                    <label for="img3"><img src="img/background/3.jpg" alt="fondo #3" class="img-fluid"></label><br>
                    <input type="radio" id="img3" name="fondo" class="form-check-input" value="3" <? if($q_preference[0]['fondo'] == 3) echo 'checked';?>>
                </div>
                <div class="col-4 border rounded p-1 text-center mt-2">
                    <label for="img4"><img src="img/background/4.jpg" alt="fondo #4" class="img-fluid"></label><br>
                    <input type="radio" id="img4" name="fondo" class="form-check-input" value="4" <? if($q_preference[0]['fondo'] == 4) echo 'checked';?>>
                </div>
                <div class="col-4 border rounded p-1 text-center mt-2">
                    <label for="img5"><img src="img/background/5.jpg" alt="fondo #5" class="img-fluid"></label><br>
                    <input type="radio" id="img5" name="fondo" class="form-check-input" value="5" <? if($q_preference[0]['fondo'] == 5) echo 'checked';?>>
                </div>
                <div class="col-4 border rounded p-1 text-center mt-2">
                    <label for="img6"><img src="img/background/6.jpg" alt="fondo #5" class="img-fluid"></label><br>
                    <input type="radio" id="img6" name="fondo" class="form-check-input" value="6" <? if($q_preference[0]['fondo'] == 6) echo 'checked';?>>
                </div>
            </div> 

        </div>
        <div class="card-footer"> <button class="btn btn-sm btn-success" type="button" name="config" onClick="linkAction('../bat/submit.php','save_pref','response','redir')">Guardar</button></div>
      </div>
     </form>    
</section>
</section>

