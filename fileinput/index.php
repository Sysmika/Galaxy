    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link href="fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    
    <script src="fileinput/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="fileinput/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="fileinput/js/locales/es.js" type="text/javascript"></script>
    <script src="fileinput/themes/fas/theme.js" type="text/javascript"></script>
    <script src="fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>    
    
    <div id="imagenes_c" class="container">
        <h4>Imagenes</h4>
	<input name="nom_sector" id="nom_sector" type="hidden" value="<?=$ruta_imagen?>"><br>
        
  <? if(is_numeric($_POST['id'])){
	  
		$T			= 0;
	    $cadauno	= glob($ruta_imagen."/{*.JPG,*.jpg,*.tiff,*.bmp,*.jpeg,*.gif,*.png,*.pdf,*.docs,*.docx,*.txt,*.psd,*.xls,*.xlsx,*.zip}",GLOB_BRACE);
    //print_r($cadauno);
    
    if($TH == 'si'){
	    $cadathumb	= glob($ruta_imagen."/thumb/{*.JPG,*.jpg,*.tiff,*.bmp,*.jpeg,*.gif,*.png}",GLOB_BRACE);
    }
  //echo'<pre>';print_r($ruta_imagen);echo'</pre>';
    $info = new SplFileInfo('foo.txt');
    echo'<div class="row" style="width:100%; height:100%;">';
		foreach($cadauno as $values){
            $ARR_img = array('jpg','gif','png');
                    $info = new SplFileInfo($values);
            if(in_array($info->getExtension(),$ARR_img)){
                $value= explode('/',$values);
				  echo '<div id="wrapper-img-'.$T.'" class="col-lg-4">
                          <image src="img/profiles/'.$_SESSION['id_user'].'/'.end($value).'" class="delimg m-1" thumb="'.$cadathumb[$T].'" height="100" />
                          <i class="fas fa-trash cpoint" data-action="delete" data-page-ref="" data-capa="wrapper-img-'.$T.'" data-frm="'.$values.'&th='.$cadathumb[$T].'" data-uri="bat/unlink"/></i>
                      </div>' ;
            }else{
                
                $doc = explode('/',$values);
                    echo '<div id="wrapper-doc-'.$T.'" class="col-lg-4">
                    '.end($doc).'<br><a href="'.end($value).'" target="_blank">
                    <i class="fas fa-download"></i></a> - 
                    <i class="fas fa-trash cpoint" data-action="delete" data-page-ref="" data-capa="wrapper-doc-'.$T.'" data-frm="'.$value.'" data-uri="bat/unlink"/></i>
                    </div>' ;
                
            }
		$T++;}
    echo'</div>';
	 }?>
<!--
-->

<hr>
    <h4>Ingreso imagenes</h4>

    <form enctype="multipart/form-data">
            <div class="file-loading">
                <input id="file-es" name="file" type="file" multiple  capture="camera">
            </div>
    </form>
        <br>
<script>
    $('#file-es').fileinput({
        theme: 'fas',
        uploadAsync:true,
        language: 'es',
        uploadUrl: 'fileinput/upload.php?codigo=<?= $ruta_upload?>&thumb=<?= $TH?>',
        allowedFileExtensions: ['jpg', 'png', 'gif','pdf','docs','docx','txt','psd','xls','xlsx','zip']
    });
</script>
</div> 
    