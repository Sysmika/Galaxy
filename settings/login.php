<?  $TCAT="config";include("../inc/conect.php");?>
<?
/////////////////////// BACH BORRADO /////////////////////////
if($_POST['delete']){
    $CNSLTS->eliminar_varios('login'," salida != 0");
}
?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-sign-in-alt"></i> Registro de Logeos</h3>
        </div>
    </div>
<? include("nav.php");?>
    <!-- page start-->
    <div class="btn-row mt-4">
        <div class="btn-group">
<button class="btn btn-light" type="button" data-action="delete" data-uri="config/login" data-capa="main-content" data-frm="1&menu=1&delete=all"><i class="fa fa-trash cpoint"></i> Eliminar pasados</button>
            <div class="btn-group" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">
                    <li>
                        <form class="form">
                            <input class="form-control" id="search" placeholder="Search" type="text">
                        </form>
                    </li>
                    <li></li>
                </ul>
                <!--  search form end -->
            </div>
<button class="btn btn-secondary" type="button"><i class="fa fa-search cpoint" data-capa="main-content" data-uri="config/login" data-extra="menu=<?=$_POST["menu"];?>"></i> Buscar</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 p-2">
            <section class="border rounded">
                <header class="h6 p-2">
                 Registro de Logeos 
                </header>
                    <?
                    $_PGNC			= explode(".", $_SERVER["PHP_SELF"]);
                    $_TBL			= "login";
                    $_LST			= "id,user,ip,entrada,salida";
                    $_ORDER    		= "ORDER BY id DESC";
                    $data_uri    	= "";
                    $_LST_Ar		= explode(",",$_LST);
                    $ARR_XTRA_TBL	= array("user"=>"user*members");
                    $RegistrosAMostrar	= "20";
                    $NOEDIT         = true; 
                    $NODEL          = 0;
                    $NOACT          = 1;
                
 print_r($POST);
               
                    ?>
<div class="table-responsive" id="print_list">
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <?	foreach ($_LST_Ar as $K => $V){?>
                <th>
                    <?=$V?>
                </th>
                <?	}?>
                <th class="hidden-print"><i class="bi bi-clock"></i> Tiempo</th>
                <th class="hidden-print"><i class="bi bi-arrow-down-circle"></i> Action</th>
            </tr>
        </thead>
        <tbody>
            <?  
  	$search		= $_POST['search'];
  	$var_page	= '&amp;menu='. $_POST['menu'];
	$filtro		= '';
	if($search){
         $LST_USER	= $CNSLTS->listar('id','members',"WHERE user = '".$search."'");
        if($_POST['pag'] > 1) {$search = $_POST['search'];}else{$search = $LST_USER[0]['id'];}   
        echo $search;
		$filtro		= " WHERE user = '".($search)."' " ;
		$var_page	= '&amp;search='.$search.'&amp;menu='.$_POST['menu'];
		}
 	$NroRegistros		= $CNSLTS->num_rows($_TBL,$filtro);

	 if(isset($_POST['pag'])){
		  $RegistrosAEmpezar	= ($_POST['pag']-1)*$RegistrosAMostrar;
		  $PagAct				= $_POST['pag'];
	 }else{
		  $RegistrosAEmpezar	= 0;
		  $PagAct				= 1;
	 }

$_XTR		= $_ORDER." LIMIT ".$RegistrosAEmpezar.", ".$RegistrosAMostrar." ";
$LST_MBR	= $CNSLTS->listar($_LST.$_LST_HDDN,$_TBL,$filtro.$_XTR);
if($LST_MBR == 0){echo'<div class="alert alert-danger text-center"><strong>ERROR</strong>, no hay resultados</div>';
                 }else{
	foreach ($LST_MBR as $KY => $VL){
        
    
	?>
            <tr id="<?=$_TBL?>_<?=$VL['id']?>">
                <?	foreach ($_LST_Ar as $K => $V){
    $AD_CT     = '';
      
        $i = $_LST_Ar[$K];
        
        
      //echo'<pre>'; print_r($_LST_Ar[$K]); echo'</pre>';
     
    if(is_numeric($VL[$i])){$AR = 'text-right';}else{$AR = 'text-left';  }
        if($VL["salida"]== 0){$activo='check-square';$text_activo='Activo';$dsbld='';
            $date1 = new DateTime($VL["entrada"]);
            $date2 = new DateTime(date("Y-m-d H:m:s"));
            $diff = $date1->diff($date2);
                             }
        else{$activo='times-circle text-danger';$text_activo='Inactivo';$dsbld='';
            $date1 = new DateTime($VL["entrada"]);
            $date2 = new DateTime($VL["salida"]);
            $diff = $date1->diff($date2);
            }
            
      if((is_array($ARR_XTRA_TBL)) and (array_key_exists($_LST_Ar[$K],$ARR_XTRA_TBL))){
            foreach($ARR_XTRA_TBL as $KR => $VR){
                $RS = explode('*',$VR);
         $LST_JOIN	= $CNSLTS->listar($RS[0],$RS[1],"WHERE id = '".$VL[$i]."'");
	?>
                <td class="text-left text-truncate">
                    <?=$LST_JOIN[0][$RS[0]]?>
                </td>
                <?	}?>
                <?	}else{?>
                <td class="text-truncate <?=$AR?>">
                    <?=$VL[$i]?>
                </td>
                <?	}?>
                <?	}?>
                <td class="text-truncate <?=$AR?>">
                    <?= $diff->h ?>:<?= $diff->i?> horas
                </td>
                <td class="hidden-print">
                    <div class="btn-group">
                        <? if ($NOEDIT  == false){?>
                        <a class="btn btn-success cpoint" data-action="edit" data-capa="dialog-response" data-menu="<?=$_POST['menu']?>&modal=true" data-title="Edicion de <?= $_LST_Ar[1]?>" data-uri="<?=$data_uri?>" data-frm="<?=$VL['id']?>" id="<?=$VL['id']?>"><i class="bi bi-arrow-down-circle"></i></a>
                        <?}?>
                        <? if ($NODEL  == false){?>
                        <a class="btn btn-danger cpoint" <?=$dsbld?> data-uri="bat/delete" data-action="delete" data-page-ref="<?=$_POST['id']?>" data-capa="<?=$_TBL?>_<?=$VL['id']?>" data-frm="<?= $VL["id"]?>&tabla=<?=$_TBL?>"><i class="bi bi-trash"></i></a>
                        <?}?>
                    </div>
                </td>

                </th>
                <? }?>
                <? }?>
        </tbody>
    </table>
</div>
<? include('../bat/paginacion.php');?> 
            </section>
        </div>
    </div>
</section>