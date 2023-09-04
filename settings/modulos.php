<?  $TCAT="config";include("../inc/conect.php");?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-cubes"></i> Modulos</h3>
        </div>
    </div>
<? include("nav.php");?>
    <!-- page start-->
    <div class="btn-row">
        <div class="btn-group">
            <button class="btn btn-default" type="button" data-action="edit" data-title="Nuevo modulo" data-menu="<?=$_POST['menu']?>" data-capa="main-content" id="nuevo" data-uri="config/extra/modulo">Nuevo</button>
            <button class="btn btn-default" type="button" data-action="edit" data-title="Nuevo tipo" data-menu="modal" data-capa="dialog-response" id="nuevo" data-uri="config/inc/list_type">agregar tipo</button>
            <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Filtrar por tipo <span class="caret"></span> </button>
                <ul class="dropdown-menu">
                    <?
            $valor	= $_POST["tipos"];
            $Q_MT 	= $mysqli->query("SELECT * FROM modules_type WHERE activo = 1 ORDER BY name ASC") or die("Error:   ".$mysqli->error);
                    while($R_MT = $Q_MT->fetch_assoc()){
    ?>
            <li class="filtro-mod" id="<?=$R_MT['id']?>" data-menu="menu=<?=$_POST['menu']?>"><a href="#"><?=$R_MT['name']?></a></li>
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
<button class="btn btn-default" type="button"><i class="fa fa-search cpoint" data-capa="main-content" data-uri="config/modulos" data-extra=""></i> Buscar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel panel-danger">
                <header class="panel-heading">
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
	$activo	= 'times-circle';
	$LST_MD		= $CNSLTS->listar('id,name,type,description,data,active','modules',$filtro."ORDER BY id ASC LIMIT ".$RegistrosAEmpezar.", ".$RegistrosAMostrar." ");
    if($LST_MD){
	   for($I=0;$I < count($LST_MD);$I++){
			if($LST_MD[$I]["active"]== 1){
				$activo='check-square';
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
                                    <a class="btn btn-primary cpoint"><i class="fa fa-<?=$activo?>"></i></a>
                                    <a class="btn btn-success cpoint" data-action="edit" data-menu="<?=$_POST['menu']?>&modal=1" data-uri="config/extra/modulo" data-capa="dialog-response" id="<?=$LST_MD[$I]["id"]?>"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger cpoint" data-action="delete" data-capa="tr_<?= $LST_MD[$I]["id"]?>" data-frm="<?= $LST_MD[$I]["id"]?>&tabla=modules" data-uri="bat/delete"><i class="icon_close"></i></a>
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
