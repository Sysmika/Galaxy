<?
$usuarios = [];
if(isset($_POST['id'])){
    if($_POST["id"]!='nuevo'){
        $q_user	= $mysqli->query("SELECT * FROM $_TBL WHERE id='".$_POST["id"]."'") or die("erro ".$mysqli->error);
        $usuarios	= $q_user->fetch_assoc();
    }elseif(
        $_POST["id"]=='nuevo'){
        $tipe='nuevo';
        $usuarios	= FALSE;
    }
}else{
   $_POST['id'] = '';
}
print_r($_POST['id']);
?>
<?
if(!in_array('sinboton',$_EXNTS)){
?>
<div id="respEdit"></div>
<form enctype="multipart/form-data" method="post" name="f_<?=$_TBL?>" id="f_<?=$_TBL?>" onSubmit="return false" class="form clearfix">
      <input name="tabla" id="tabla" type="hidden" value="<?=$_TBL?>">
  <? if(isset($_POST['id']) and (is_numeric($_POST["id"]))) {?>
  <input name="id" id="id" type="hidden" value="<?= $usuarios["id"]?>">
  <input name="insert" id="insert" type="hidden" value="update">
  <? }else{?>
  <input name="insert" id="insert" type="hidden" value="insert">
  <? }?>

<?}?>
<?
			$INCR   = 0;
            $_CAPA  = $_TBL;
            $Q_U	= $mysqli->query("SHOW FIELDS FROM $_TBL ")or die('cli: '.$mysqli->error);
            $colg   = 'col-12';
?>
<div id="<?= $_CAPA?>"  class="form-row pb-3">
<div class="<?=$colg?>">
<? 
			while($R_U = $Q_U->fetch_assoc()){
				
				//echo $R_U["Type"].'<br>';
                $decimal        = '';
                $RQRD           = '';
                $rqr_border     = '';
                $HDDN           = '';
                if(($AR_RQRD) and (in_array($R_U["Field"],$AR_RQRD))){
                    $RQRD       = 'required';
                    $rqr_border = 'border-danger border-4 border';
                }
                if(($AR_OMIT) and (in_array($R_U["Field"],$AR_OMIT))){
                    $HDDN       = 'hidden';
                }
				$TYPE_SET 		= strpos($R_U["Type"], 'set');
				$TYPE_ENUM 		= strpos($R_U["Type"], 'enum');
				$TYPE_DEC 		= strpos($R_U["Type"], 'float');
				$TYPE_DBL 		= strpos($R_U["Type"], 'double');
				$TYPE_TXT 		= strpos($R_U["Type"], 'text');
				$TYPE_INT 		= strpos($R_U["Type"], 'int');
				$tipo_campo		= $R_U["Type"];
				$esfecha		= 'text';
				$adic			= '';
				$fecha_value			= '';
			if($tipo_campo=='timestamp'){
				$esfecha		= 'datetime';
				$adic			= $_POST["id"];
			}
			if($tipo_campo=='date'){
				$esfecha		= 'date';
                $fecha_value    = date("Y-m-d");
				$adic			= $_POST["id"];
			}
			elseif($tipo_campo=='time'){
				$esfecha		= 'time';
				//$adic			= $_POST["id"];
			}
			elseif(($tipo_campo=='int') or ($TYPE_DEC === 0) or ($TYPE_INT === 0) or ($TYPE_DBL === 0)){
				$esfecha		= 'number';
                $decimal        = 'step="0.01"';
				$adic			= $_POST["id"];
			}elseif($R_U["Field"] == 'color'){
 				$esfecha		= 'color';
            }
                
                
			if($R_U["Field"]=='sku'){$esCode = ' onkeypress="return teclas(event);"'; }else{$esCode = '';}
 				
            if(($_EXNTS) and (in_array($R_U["Field"],$_EXNTS))){}
            elseif($R_U["Field"]=='account'){}
			//elseif(($R_U["Field"]=='usuario') or ($R_U["Field"]=='id')){
			elseif(($R_U["Field"]=='id')){
    ?>
    <?      }
			elseif(($R_U["Field"]=='cargo') and (is_numeric($_POST['id']))){
?>
			<div class="form-group <?=$HDDN?>"><label class="text-capitalize" for="label"><?= $R_U["Field"]?>:</label>
				<input id="<?= $R_U["Field"]?>" class="form-control <?=$rqr_border?>" name="<?= $R_U["Field"]?>" type="text" value="<?= $usuarios[$R_U["Field"]]?>" readonly></div>
            <? }
			elseif($R_U["Field"]=='codigo'){
            $Codigo     = $GNRLS->codex($_POST['id'],$_TBL,$_PRE);
?>
			<div class="form-group"><label class="text-capitalize" for="label"><?= $R_U["Field"]?>:</label>      
				<input id="<?= $R_U["Field"]?>" class="form-control <?=$rqr_border?>" name="<?= $R_U["Field"]?>" type="text" value="<?= $Codigo?>" readonly></div>
            <? }
			elseif(($R_U["Field"]=='password') or ($R_U["Field"]=='clave')){
?>
			<div class="form-group"><label class="text-capitalize" for="label"><?= $R_U["Field"]?>:<br><small>Complete solo para cambiarla o nuevo ingreso</small></label>      
				<input id="<?= $R_U["Field"]?>" class="form-control <?=$rqr_border?>" name="<?= $R_U["Field"]?>" type="text" value=""></div>
            <? }
                
			elseif(($R_U["Field"]=='category_id') or ($R_U["Field"]=='cat_father_id') or (($R_U["Field"]=='categoria') and ($_TBL=='articulos'))){?>
    
         <div class="form-group <?=$HDDN?>"><label class="text-capitalize" for="<?= $R_U["Field"]?>"><?= $R_U["Field"]?>(*): </label>
            <?	
            $parent_id  = $usuarios[$R_U["Field"]];	
            $SELCAT     = $mysqli->query("SELECT *  FROM categorias WHERE id='".$parent_id."' AND account = '".$_AACOUNT."'")or die($mysqli->error);
            $R_SEL      = $SELCAT->fetch_assoc();
            print "<select name=\"".$R_U["Field"]."\" id=\"".$R_U["Field"]."\" ".$RQRD." class=\"form-control\">";
            print "<option value=\"0\" ";if($parent_id==0){echo " selected";}echo">Categoria</option>";
            $select     = $mysqli->query("SELECT *  FROM categorias")or die($mysqli->error);
            while ($row = $select->fetch_assoc())
              {
                  $cat_id_dd    = $row["id"];
                  $cat_id_dd2   = $row["cat_father_id"];

            echo"<option value=\"$cat_id_dd\"";
            if($cat_id_dd==$parent_id){echo " selected";}
            echo">";
	
		  $category 		= htmlentities($row["categoria"]);
		  $catfatherid_1 	= $row["cat_father_id"];
	      $t1 				= $category;

        if ($catfatherid_1 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_1."' AND cat_father_id!=0";
             $result1 		= $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row1 			= $result1->fetch_assoc();
             $catfatherid_2 = $row1["cat_father_id"];
             $catname_2 	= htmlentities($row1["categoria"]);
             $t2 			= $catname_2;
             $catid2 		= $catid_2;
        }

        if ($catfatherid_2 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_2."' AND cat_father_id!=0";
             $result2 		= $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row2 			= $result2->fetch_assoc();
             $catfatherid_3 = $row2["cat_father_id"];
             $catname_3 	= htmlentities($row1["categoria"]);
             $t3 			= $catname_3;
             $catid3 		= $catid_3;
        }

        if ($catfatherid_3 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_3."' AND cat_father_id!=0";
             $result3 		=  $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row3 			= $result3->fetch_assoc();
             $catfatherid_4 = $row3["cat_father_id"];
             $catname_4 	= htmlentities($row1["categoria"]);
             $t4 			= $catname_4;
             $catid4 		= $catid_4;
        }

        if ($catfatherid_4 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_4."' AND cat_father_id!=0";
             $result4 		=  $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row4 			= $result4->fetch_assoc();
             $catfatherid_5 = $row4["cat_father_id"];
             $catname_5 	= htmlentities($row1["categoria"]);
             $t5 			= $catname_5;
             $catid5 		= $catid_5;
        }

        if ($catfatherid_5 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_5."' AND cat_father_id!=0";
             $result5		=  $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row5 			= $result5->fetch_assoc();
             $catfatherid_6 = $row5["cat_father_id"];
             $catname_6 	= htmlentities($row1["categoria"]);
             $t6 			= $catname_6;
             $catid6 		= $catid_6;
        }

        if ($catfatherid_6 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_6."' AND cat_father_id!=0";
             $result6 		=  $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row6 			= $result6->fetch_assoc();
             $catfatherid_7 = $row6["cat_father_id"];
             $catname_7 	= htmlentities($row1["categoria"]);
             $t7 			= $catname_7;
             $catid7 		= $catid_7;
        }
		
		if ($catfatherid_7 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_7."' AND cat_father_id!=0";
             $result7 		= $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row7 			= $result7->fetch_assoc();
             $catfatherid_8 = $row7["cat_father_id"];
             $catname_8 	= htmlentities($row1["categoria"]);
             $t8 			= $catname_8;
             $catid8 		= $catid_8;
        }

		if ($catfatherid_8 <> 0)
        {
             $sql_lowercat 	= "SELECT *  FROM categorias WHERE id = '".$catfatherid_8."' AND cat_father_id!=0";
             $result8 		=  $mysqli->query($sql_lowercat)or die($mysqli->error);
             $row8			= $result8->fetch_assoc();
             $catfatherid_9 = $row8["cat_father_id"];
             $catname_9 	= htmlentities($row1["categoria"]);
             $t9 			= $catname_9;
    
        }


if ($t9)
print "$t9/";
if ($t8)
print "$t8/";
if ($t7)
print "$t7/";
if ($t6)
print "$t6/";
if ($t5)
print "$t5/";
if ($t4)
print "$t4/";
if ($t3)
print "$t3/";
if ($t2)
print "$t2/";
if ($t1)
print "$t1/";

unset($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$catfatherid_1,$catfatherid_2,$catfatherid_3,$catfatherid_4,$catfatherid_5,$catfatherid_6,$catfatherid_7,$catfatherid_8,$catfatherid_9,$catname_1,$catname_2,$catname_3,$catname_4,$catname_5,$catname_6,$catname_7,$catname_8,$catname_9);
	echo"</option>";}
    echo"</select>";
?>
              </div>
    <? 
    }elseif(($TYPE_SET===0) or ($TYPE_ENUM===0)){
						$EX_ser = $R_U["Type"]; 
						$A_TYPE	= explode('(',$EX_ser);
						$A_set  = str_replace( array($A_TYPE[0], "(","'",")"), "", $EX_ser );
						$A_set  = explode(',',$A_set);				
						?>
   			<div class="form-group <?=$HDDN?>"><label class="text-capitalize" for="<?= $R_U["Field"]?>"><?= $R_U["Field"]?>:</label>
 
    <div class="btn-row">
                  <div class="btn-group" data-toggle="buttons">
			<? foreach($A_set as $V_set){
                            $chk ='';$conga ='';
                            if($usuarios){
                              if($usuarios[$R_U["Field"]]==$V_set){$chk ='checked';$conga ='active';}
                            }
                      ?>
                    <label class="text-capitalize btn btn-sm btn-dark <?= $conga?>  <?=$rqr_border?>">
                                          <input type="radio" <?=$chk?> name="<?= $R_U["Field"]?>" id="<?= $R_U["Field"]?>" value="<?= $V_set;?>"><br><?= ($V_set);?>
                                      </label>
			<? }?>
                  </div>
                </div>
    
    
			</div>
    
    
    
		<?}elseif((is_array($ARR_EXT_TBL)) and (array_key_exists($R_U["Field"],$ARR_EXT_TBL))){
            foreach($ARR_EXT_TBL as $KR => $VR){
                
                $RS = explode('*',$VR);
                if($R_U["Field"] == $KR){
                    if(($KR == 'provincia') or ($KR == 'localidad')){
                        $xwh='';}
                    elseif($KR == 'rubro'){
                        $xwh = "";}
                    else{
                        $xwh = " WHERE activo ='si' AND account = '".$_AACOUNT."'";
                    }
                    /*
                    if($_POST['cliente'] and $_SESSION['cliente'] and $R_U["Field"] == 'cliente'){
                        $xwh = " WHERE id = '".$_SESSION['cliente']."'";
                        //$xwh = "id,".$RS[0]."/".$RS[1]."/".$xwh." ORDER BY ".$RS[0];
                    }
                    */
                    if(($R_U["Field"] == 'rubro') and ($_TBL == 'compras')){
                        $xwh = "WHERE tipo = 'compra' AND  activo ='si' AND account = '".$_AACOUNT."'";}
                    elseif(($R_U["Field"] == 'rubro') and ($_TBL == 'ventas')){
                        $xwh = "WHERE tipo = 'venta' AND  activo ='si' AND account = '".$_AACOUNT."'";}
                    
               ?>
			<div class="form-group <?=$HDDN?>"><label class="text-capitalize" for="<?= $R_U["Field"]?>"><?= $R_U["Field"]?>:</label>
<? if($_TBL == 'notificaciones'){?>
			<select name="<?= $R_U["Field"]?>[]" style="background-color: #FFF;" id="<?= $R_U["Field"]?>" class="form-control  show-tick  <?=$rqr_border?>" data-live-search="true" title="Seleccione..." data-size="5" <?=$MULTI?> <?=$RQRD?>>
    <?
            $LST_JOIN	= $CNSLTS->listar("id,".$RS[0],$RS[1],$xwh." ORDER BY $RS[0]");
                foreach($LST_JOIN as $v){
                    $concat = '';
                        $ar_v = explode(',',$RS[0]);
                    foreach($ar_v as $r){
                        
                        $concat .= $v[$r].' ';
                        
                    }
                    $concat = trim($concat,',');
                     $dataloc   = '';  
            $js_destiny = array();
            if(isset($usuarios[$R_U["Field"]])){
                $js_destiny = json_decode($usuarios[$R_U["Field"]]);
            }                    

                    
		?>
			 <option <?=$dataloc?> <? if(in_array($v['id'],$js_destiny)){echo' selected';}?> value="<?=$v['id']?>:<?=$concat?>"><?=$concat;?></option>

		<? }?>
			</select>
                
<? }else{?>
			<select name="<?= $R_U["Field"]?><?=$ADDM?>" style="background-color: #FFF;" id="<?= $R_U["Field"]?>" class="form-control selectpicker show-tick <?=$rqr_border?>" data-live-search="true" title="Seleccione..." data-size="5" <?=$MULTI?> <?=$RQRD?>>
    <?
            $LST_JOIN	= $CNSLTS->listar("id,".$RS[0],$RS[1],$xwh." ORDER BY $RS[0]");
                foreach($LST_JOIN as $v){
                    $concat = '';
                        $ar_v = explode(',',$RS[0]);
                    foreach($ar_v as $r){
                        
                        $concat .= $v[$r].' ';
                        
                    }
                    $concat = trim($concat,',');
                     $dataloc   = '';  
                    if(isset($usuarios['localidad'])){
                     $dataloc   = 'data-loc="'.$usuarios['localidad'].'"' ; 
                    }

		?>
			 <option <?=$dataloc?> <? if(isset($usuarios[$R_U["Field"]]) and ($usuarios[$R_U["Field"]] == $v['id'])){echo' selected';}?> value="<?=$v['id']?>"><?=$concat;?></option>

		<? }?>
			</select>
<? }   ?>             
			</div>
		<? }?>
		<? }?>
        <? }
			elseif($TYPE_TXT === 0){
    if($usuarios){ $val_d   = $usuarios[$R_U["Field"]];}else{$val_d   = '';}
                
		?>
			<div class="form-group <?=$HDDN?>"><label class="text-capitalize" for="label"><?= $R_U["Field"]?>:</label>
				<textarea id="ta_<?= $R_U["Field"]?>" class="form-control <?=$rqr_border?>" name="<?= $R_U["Field"]?>">  <?=$RQRD?><?= $val_d?></textarea></div>
    
    <script>
    var editor =  CKEDITOR.replace('ta_<?= $R_U["Field"]?>', {
      language: 'es'
    });
    editor.on( 'change', function( evt ) {
        $("#ta_<?= $R_U["Field"]?>").val(evt.editor.getData());
    });
/**/    </script>
        <? }
				else{ 
    if($usuarios){ 
        $val_d   = $usuarios[$R_U["Field"]];
    }else{
        if($esfecha){
            $val_d   = $fecha_value;
        }else{
            $val_d   = '';
        }
        
    }
    ?>
			<div class="form-group <?=$HDDN?>"><label class="text-capitalize" for="label"><?= $R_U["Field"]?>: </label>
				<input id="<?= $R_U["Field"]?>" class="form-control <?=$rqr_border?>" name="<?= $R_U["Field"]?>" type="<?= $esfecha?>" <?= $decimal?> value="<?= $val_d?>" <?=$RQRD?> <?=$esCode?>></div>
				
				<? }?>
    <? }?>
    </div>
<? if(!in_array('sinboton',$_EXNTS)){
?>
</div>
</form>
<?  
    $panel = '';
    if(isset($_POST['origin'])){
        $_PGNC=$_POST['origin'];
        $_POST['refP'] = "panel-content";
        $panel = '&panel=true';
    }
?>
<?
if($UPLDIMG){
      include("../../bat/inc_upload.php");
}?>
 <div class="container mb-5">

<?
if($_TBL == 'notificaciones'){?>
     <button class="btn btn-sm btn-success" onClick="linkAction('bat/send_submit.php','f_<?=$_TBL?>','respEdit','submit')"><i class="bi bi-save"></i> Guardar Y <i class="bi bi-envelope"></i> Enviar</button>     
<? }?>
</div>
                
 <? }?> 



