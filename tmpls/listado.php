<div class="table-responsive container-fluid" id="print_list">
    <table class="table table-hover">
        <thead>
            <tr>
                <?	
                $clsp    = count($_LST_Ar) + 1;
                foreach ($_LST_Ar as $K => $V){ 
            if(($V == 'activo') or ($V == 'destacado')){}else{
                $OO = 'ASC';if(($_POST['cls']) and ($_POST['busca'] == $_LST_Ar[$K])){$OO = $_POST['cls'];}
                $dtcapa = 'main-content';$panel='';
                if($_POST['panel']){
                    $dtcapa = 'panel-content'; 
                    $panel = "&panel=true";
                }
                ?>
                <th scope="col" 
                    data-action='order' 
                    data-capa="<?=$dtcapa?>" 
                    data-menu="<?= $_POST['menu']?><?=$panel?>" 
                    data-url="<?= $data_pg?>" 
                    data-order='<?= $OO?>' 
                    data-search='<?=$_LST_Ar[$K]?>' 
                    id='<?=$_POST['id']?>'
                    class="text-center cpoint">
                   <i class="fa fa-sort fa-sm"></i> <?=$V?>
                </th>
                <?	}?>
                <?	}?>
                <? if (($_TBL  == 'clientes_XXX')){?>
                <th>Motivo</th>
                <th>Monto</th>
                <th>MP</th>
                <?}?>
                
               <th class="hidden-print text-center"><i class="icon_cogs"></i></th>
            </tr>
        </thead>
        <tbody>
            <?  

  	$search		= $_POST['search'];
  	$search_id	= $_POST['search_id'];
  	$order		= $_POST['order'];
  	$busca		= $_POST['busca'];
  	$adicional	= '';
  	$adicvar	= '';
    if(isset($_POST['panel'])){
        $filtro	    = "WHERE cliente = '".$_POST['id']."' ";
        $adicvar	= "&cliente=".$_POST['id']."&id=".$_POST['id'];
    }
	if($busca){ 
		$_ORDER		= $filtro."ORDER BY ".$busca." ".$order ;
		$var_page	.= '&amp;busca='.$busca.'&amp;order='.$order.'&amp;menu='. $_POST['menu'].$adicvar.$panel;
	}

  	$var_page	= '&amp;menu='. $_POST['menu'].'&amp;consorcio='. $_POST['consorcio'].'&amp;account='.$_AACOUNT.'&amp;tabla='.$_TBL.$adicvar.$panel;

     if($_TBL == 'personal'){
  	     $var_page	= '&amp;menu='. $_POST['menu'].'&amp;consorcio='. $_POST['consorcio'].'&amp;account='.$_AACOUNT.$adicvar.$panel;
     }
	if($search_id){
		$filtro		= "WHERE id = '".$search_id."'" ;
    }
	if($search){
		$filtro		= "WHERE $_LST_Ar[1] LIKE '%".($search)."%'  OR $_LST_Ar[2] LIKE '%".($search)."%'" ;
		$var_page	= '&amp;search='.$search.'&amp;menu='. $_POST['menu'].$adicvar.$panel;
		}
        //  echo   $filtro.$adicional,'<hr>';
            
 	$NroRegistros		= $CNSLTS->num_rows($_TBL,$filtro);

	 if(isset($_POST['pag'])){
		  $RegistrosAEmpezar	= ($_POST['pag']-1)*$RegistrosAMostrar;
		  $PagAct				= $_POST['pag'];
	 }else{
		  $RegistrosAEmpezar	= 0;
		  $PagAct				= 1;
	 }
$_XTR		= $_ORDER." LIMIT ".$RegistrosAEmpezar.", ".$RegistrosAMostrar." ";
//print_r($_TBL);          
            
$LST_MBR	= $CNSLTS->listar($_LST.$_LST_HDDN,$_TBL,$filtro.$_XTR);
if($LST_MBR == 0){echo'<div class="alert alert-danger text-center"><strong>ERROR</strong>, no hay resultados</div>';
                 }else{
	foreach ($LST_MBR as $KY => $VL){
?>
        <th id="th<?=$VL['id']?>">

<?            
        
    if($_TBL == 'dominios'){
			if(!empty($VL["dom_extra"])) 	$adic		.= '(Alias)';
			if($VL["activo"]=='n') 		    $adic		.= '(Susp)';
			if($VL["plan"]=='14') 			$adic		.= '(Sin Host)';
			if($VL["plan"]=='19') 			$adic		= '<span class="text-red">BAJA</span>';
				
			$CPANEL			= 'http://'.$VL["dominio"].':2082/login/?user='.$VL["usuario"].'&pass='.$VL["claves"];	
			$PROP			= $CNSLTS->listar('nombre,apellido','clientes',"WHERE id = '".$VL["cliente"]."'");	

    }
        
        
        
        if ($_TBL   == 'categorias'){
                $CAT_PA 	= $CNSLTS->listar('cat_father_id',$_TBL,"WHERE id = '".$VL['id']."'");
        }
	?>
            <tr id="<?=$_TBL?>_<?=$VL['id']?>" class="">
                <?	foreach ($_LST_Ar as $K => $V){
    $AD_CT     = '';
      
        //*////////////////////////// si hay categorias ////////////////////////////////
        
     if (($_TBL   == 'categorias') and ($V   == 'categoria') and ($CAT_PA[0]['cat_father_id'] != 0)){
         $LST_SCAT	= $CNSLTS->listar('categoria',$_TBL,"WHERE id = '".$CAT_PA[0]['cat_father_id']."'");
         $AD_CT     = $LST_SCAT[0]['categoria'].' / ';
     }
        //////////////////////////// si hay categorias //////////////////////////////*//
        $i = $_LST_Ar[$K];
        
        
      //echo'<pre>'; print_r($_LST_Ar[$K]); echo'</pre>';
     
    if(is_numeric($VL[$i])){$AR = 'text-right';}else{$AR = 'text-left';  }
        $activo = false;
        if(($_LST_Ar[$K] == 'activo') or ($_LST_Ar[$K] == 'destacado')){
            
            if(($VL["destacado"]=="si") or ($VL["activo"]=="si") or ($VL["activo"]=="s")){$activo='check-square';}
            else{$activo='times-circle text-danger';}
            
            
      }elseif((is_array($ARR_XTRA_TBL)) and (array_key_exists($_LST_Ar[$K],$ARR_XTRA_TBL))){
            foreach($ARR_XTRA_TBL as $KR => $VR){
                $RS = explode('*',$VR);
         $LST_JOIN	= $CNSLTS->listar($RS[0],$RS[1],"WHERE id = '".$VL[$i]."'");
	?>
                <td class="text-left text-truncate">
                    <?=$LST_JOIN[0][$RS[0]]?>
                </td>
                <?	}?>
                <?	}else{
                
            if(($i == "whatsapp") and ($VL[$i])) {$ws = '<a href="https://api.whatsapp.com/send?phone=+'.$VL[$i].'&text=hola" target="_blank"><i class="fab fa-2x text-success fa-whatsapp"></i></a>';$AR = 'text-center'; }
            else{$ws = $VL[$i];}
                ?>
                <td class="text-truncate <?=$AR?>">
                    <?=$ws?>
                </td>
                <?	}?>
                <?	}?>
                
                
                <td class="hidden-print hidden">
                    <div class="btn-group btn-group-sm pull-right">
                        <? if ($NOACT  == true){?>
                        <a class="btn btn-info cpoint"><i class="bi bi-<?= $activo?>"></i></a>
                        <?}?>
                        <? if ($NOEDIT  == false){?>
                        <a class="btn btn-info btn-sm cpoint myModal text-white" data-id="<?=$VL['id']?>" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-save"></i></a>
                        <?}?>
                        <? if ($NODEL  == false){?>
                        <a class="btn btn-danger btn-sm cpoint text-white" onClick="linkAction('bat/delete.php','id=<?=$VL['id']?>&tabla=<?=$_TBL?>','<?=$_TBL?>_<?=$VL['id']?>','delete')"><i class="bi bi-trash3"></i></a>
                        <?}?>
                    </div>
                </td>

                </th>
                <? }?>
                <? }?>
        </tbody>
    </table>
</div>
<? 
$correct = '';
if($PGNDR) $correct = $PGNDR;
if(!$NOPAG) include($correct.'../bat/paginacion.php');
?>

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





