<?  include("../inc/conect.php");?>
<?
$CPS = explode( '|', 'INICIO' );
if(count($CPS) == '1') $WHR = "WHERE modulo = '".$CPS[0]."'";
else $WHR = "WHERE modulo = '".$CPS[0]."' AND item = '".$CPS[1]."'";
$R_d = $CNSLTS->listar('texto','help',$WHR);

?>
<?= $R_d[0]['texto']?>
<a href="manual ingi.pdf" target="_blank" class="btn btn-sm btn-info">Imprimir</a>
<hr>
<p>Listado de Modulos</p>
                    <ul>
                    <?

    ksort($_SESSION['ACCESO']);
                                 
    $_NVG   = array();

  $KEYNAME	= $CNSLTS->listar('id,name','modules_type',"ORDER BY name");
  foreach($KEYNAME as $KEY => $VALd){
       $V_ARR = explode('-',$VALd['name']);
      if(!empty($_SESSION['ACCESO'][$VALd['id']])){

      if($VALd['name'] != 'Config'){
          if($V_ARR[1] == 'Admin')              {$_ico = 'fa fa-users-cog';}
          elseif($V_ARR[1] == 'Pacientes')      {$_ico = 'fa fa-id-card-alt';}
          elseif($V_ARR[1] == 'Profesionales')  {$_ico = 'fa fa-user-md';}
          elseif($V_ARR[1] == 'Parametros')     {$_ico = 'fa fa-cog';}
          else                                  {$_ico = 'icon_documents_alt';}

?>
                    <li>
                        <a href="javascript:;" class="">
   <i class="<?=$_ico?>"></i>&nbsp;
   <span><?= $V_ARR[1]?></span>
   <i class="menu-arrow arrow_carrot-right"></i>

                      </a>
                        <ul class="sub">
                            <?

	asort($_SESSION['ACCESO'][$VALd['id']]);
  foreach($_SESSION['ACCESO'][$VALd['id']] as $KII => $VII){
	  	$_CAPA	= explode('/',$KII);

?>
                            <li>
                                <a href="javascript:;" class=" help" data-help="<?=$V_ARR[1]?>|<?=$VII?>">
             <i class="fa fa-file-alt"></i>&nbsp;&nbsp; <span><?=$VII?></span>
         </a>
                            </li>
                            <? }?>
                        </ul>

                    </li>
                    <? }?>
                    <? }?>
                    <? }?>
                </ul>

<hr>
  <div class="row">
  <div class="col-lg-2">
  <div class="input-group">
      <div class="checkbox">
  <label><input type="checkbox" <? if($_SESSION['ayuda'] == 'no') echo 'checked';?> id="remember" value="no"><span class="input-group-addon"><i class="fa fa-eye-slash"></i> No mostrar ayuda al iniciar</span></label>
</div>

</div>
</div>
</div>
<div id="resulth"></div>
