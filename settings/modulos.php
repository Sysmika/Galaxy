<?  $TCAT="config";include("../inc/conect.php");?>
<?
    $data_uri   = "settings/extra/modulo";
    $_PGNC		= explode(".", $_SERVER["PHP_SELF"]);
	$filtro		= "";
	$var_page	= '';
	$search 	= $_POST['search'];
	$tipo 		= $_POST['tipos'];
	if($search){
		$filtro		= " WHERE name LIKE '%".($search)."%' " ;
		$var_page	= '&amp;search='.$search;
		}
	if($tipo){
		$filtro		= " WHERE type='".$tipo."' " ;
		$var_page	= '&amp;tipo='.$tipo;
		}
 	$NroRegistros		= $CNSLTS->num_rows('modules',$filtro);
	$RegistrosAMostrar	= 10;
	$i					= 0;
	$order				= '';

	//estos valores los recibo por GET
	 if(isset($_POST['pag'])){
		  $RegistrosAEmpezar	= ($_POST['pag']-1)*$RegistrosAMostrar;
		  $PagAct				= $_POST['pag'];
		  //caso contrario los iniciamos
	 }else{
		  $RegistrosAEmpezar	= 0;
		  $PagAct				= 1;

	 }
?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="bi bi-boxes"></i> Modulos</h3>
        </div>
    </div>
<? include("nav.php");?>
    <!-- page start-->
    <div class="btn-row">
        <div class="btn-group">
            <button class="btn btn-secondary myModal" type="button" data-uri="<?=$data_uri?>" data-id="nuevo" data-bs-toggle="modal" data-bs-target="#myModal" type="button" >Nuevo</button>
            <a class="btn btn-dark cpoint myModal" data-uri="settings/inc/list_type" data-id="nuevo" data-bs-toggle="modal" data-bs-target="#myModal">Agregar tipo</a>
            
                <button  data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="tipo"> Filtrar por tipo <span class="caret"></span> </button>
                <ul class="dropdown-menu" aria-labelledby="tipo">
                    <?
            $valor	= '';
            if(isset($_POST["tipos"])) {$valor	= $_POST["tipos"];}
            $Q_MT 	= $CNSLTS->listar('name,id','modules_type',"WHERE activo = 1 ORDER BY name ASC") or die("Error:   ".$mysqli->error);
                    foreach($Q_MT as $R_MT){
    ?>
            <li class="dropdown-item" id="<?=$R_MT['id']?>" onClick="linkAction('settings/modulos.php','tipos=<?=$R_MT['id']?>','alpha','search')"><a href="#"><?=$R_MT['name']?></a></li>
                    <? }?>
                </ul>
            </div>

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
<button class="btn btn-secondary" type="button"><i class="fa fa-search cpoint" data-capa="main-content" data-uri="config/modulos" data-extra=""></i> Buscar</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-12">
            <section class="border rounded">
                <header class="h6 p-2 text-capitalize">
                 Modulos 
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>tipo</th>
                            <th>nombre</th>
                            <th>descripcion</th>
                            <th>url</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?
	$LST_MD		= $CNSLTS->listar('id,name,type,description,data,active','modules',$filtro."ORDER BY id ASC LIMIT ".$RegistrosAEmpezar.", ".$RegistrosAMostrar." ");
    if($LST_MD){
	   for($I=0;$I < count($LST_MD);$I++){
			if($LST_MD[$I]["active"]== 1){
				$activo='bi-check-square';
			}else{
                $activo	= 'bi-x-square text-danger';
            }
				$KEYNAME	= $CNSLTS->nombre('name','modules_type',"id = '".$LST_MD[$I]["type"]."'");
?>
                           <tr id="tr_<?= $LST_MD[$I]["id"]?>">
                            <td>
                                <?= $LST_MD[$I]["id"]?>
                            </td>
                            <td>
                                <?= $KEYNAME?>
                            </td>
                            <td>
                                <?= $LST_MD[$I]["name"]?>
                            </td>
                            <td>
                                <?= $LST_MD[$I]["description"]?>
                            </td>
                            <td>
                                <?= $LST_MD[$I]["data"]?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm cpoint"><i class="bi <?=$activo?>"></i></a>
                        <a class="btn btn-info btn-sm cpoint myModal text-white" data-uri="<?=$data_uri?>" data-id="<?=$LST_MD[$I]['id']?>" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-save"></i></a>
                                    
                                    <a class="btn btn-danger btn-sm cpoint text-white" onClick="linkAction('bat/delete.php','id=<?=$LST_MD[$I]['id']?>&tabla=modules','tr_<?= $LST_MD[$I]["id"]?>','delete')"><i class="bi bi-trash3"></i></a>
                                </div>
                            </td>
                        </tr>

                        <? }?>
                <? }?>
                    </tbody>
                </table>
                        <? include('../bat/paginacion.php');?>
            </section>
        </div>
    </div>

</section>
<script>
const myLink = gebc("myModal");

myLink.forEach(boton => {
    boton.addEventListener('click', () => {
      var idC       = boton.getAttribute('data-id');
      var data_uri  = boton.getAttribute('data-uri');
      var modalResponse = gebi("modal-response");    
      event.preventDefault(); // This will prevent the link from navigating
        modalResponse.innerHTML = "Loading.....";
        linkAction (data_uri+'.php','id='+idC,'modal-response','search')
    });
});
    
</script>

