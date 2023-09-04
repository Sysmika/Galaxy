<?  $TCAT="config";include("../inc/conect.php");?>
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-layer-group"></i> Grupos</h3>
        </div>
    </div>
<? include("nav.php");?>
    <!-- page start-->
    <div class="btn-row">
        <div class="btn-group">
            <button class="btn btn-default" type="button" data-action="edit"  data-menu="<?=$_POST["menu"]?>&modal=true" data-title="Nuevo modulo" data-capa="dialog-response" id="nuevo" data-uri="config/extra/grupo">Nuevo</button>
            <div class="btn-group" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">
                    <li>
                        <form class="form">
                            <input class="form-control" id="search" placeholder="buscar" type="text">
                        </form>
                    </li>
                    <li></li>
                </ul>
                <!--  search form end -->
            </div>
<button class="btn btn-default" type="button"><i class="fa fa-search cpoint" data-capa="main-content" data-uri="config/grupos" data-extra="menu=<?=$_POST["menu"];?>"></i> Buscar</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel panel-marca">
                <header class="panel-heading">
                 Grupos 
                </header>
                    <?
                // extras para logeo
                $PRM = "AND id = ".$_AACOUNT;
                if($_SESSION['SUPERUSER'] == 'SI'){$PRM = '';}
                if($_AACOUNT == 2){$PRM = "AND id >= ".$_AACOUNT;}
                // fin extras
                    $_PGNC			= explode(".", $_SERVER["PHP_SELF"]);
                    $_TBL			= "groups";
                    $_LST			= 'id,name,description';
                    $_ORDER    		= $PRM." ORDER BY name DESC";
                    $data_uri    	= "config/extra/grupo";
                    $_LST_Ar		= explode(",",$_LST);
                    $ARR_XTRA_TBL	= array(""=>"");
                    $RegistrosAMostrar	= "20";
                    $NOEDIT         = 0; 
                    $NODEL          = 0;
                    $NOACT          = 0;
                    ?>
                <? include("../tmpls/listado.php");?>
              </section>
        </div>
    </div>
</section>