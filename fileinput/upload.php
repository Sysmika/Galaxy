<?php
/**
 * upload.php
 *
 * Copyright 2013, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */
// Make sure file is not cached (as it happens for example on iOS devices)
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


 function redimensionar_gd($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad,$tipo) {
	  // crear una imagen desde el original 
	  if($tipo=='png'){ 
		  $img = imagecreatefrompng($img_original);}
	  elseif($tipo=='gif'){ 
		  $img = imagecreatefromgif($img_original);}
	  else{
		  $img = imagecreatefromjpeg($img_original);}


	// determina el tamaño de la imagen
	$imx 				= @ImageSX($img);
	$imy 				= @ImageSY($img);
	
	//determina proporcion en unidades
	$x 					= $imx/$img_nueva_anchura;
	$y 					= $imy/$img_nueva_altura;
	
	// calcula la escala
	if($x>$y) $scale 	= $img_nueva_anchura/$imx;
	if($x<$y) $scale 	= $img_nueva_altura/$imy;
	if($x==$y) $scale 	= $img_nueva_altura/$imy;
	
	//Escala la imagen
	$x = intval($imx*$scale);
	$y = intval($imy*$scale);
		  
	  // crear una imagen nueva 
	  $thumb = imagecreatetruecolor($x,$y); 
	  // redimensiona la imagen original copiandola en la imagen 
	  imagecopyresized($thumb,$img,0,0,0,0,$x,$y,ImageSX($img),ImageSY($img)); 
	  // guardar la nueva imagen redimensionada donde indicia  $img_nueva
	  if($tipo=='png'){ 
	  	  $negro = imagecolorallocate($thumb, 0, 0, 0);
		  imagecolortransparent($thumb, $negro);
		  imagepng($thumb,$img_nueva,9); }
	  elseif($tipo=='gif'){ 
		  imagegif($thumb,$img_nueva); }
	  else{
		  imagejpeg($thumb,$img_nueva,100); }
		  
	  imagedestroy($img); 

  }


/* 
// Support CORS
header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	exit; // finish preflight CORS requests here
}
*/

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
if($_GET["codigo"]){
	$targetDir 			= $_GET["codigo"].DIRECTORY_SEPARATOR;
	$targetThumbDir 	= $_GET["codigo"].DIRECTORY_SEPARATOR .'thumb';
}
$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds

// Create target dir
if (!file_exists($targetDir)) {
	@mkdir($targetDir, 0777, true);
}
if (!file_exists($targetThumbDir)) {
	@mkdir($targetThumbDir, 0777, true);
}

// Get a file name
if (isset($_REQUEST["name"])) {
	$fileName 	= $_REQUEST["name"];
} elseif (!empty($_FILES)) {
	$fileName 	= $_FILES["file"]["name"];
} else {
	$fileName 	= uniqid("file_");
}

$filePath 		= $targetDir. $fileName;
$filePathThumb  = $targetThumbDir . DIRECTORY_SEPARATOR . $fileName;
$trozos 		= explode(".", $fileName); 
$ext  			= end($trozos);

// Chunking might be enabled
$chunk 			= isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks 		= isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

// Remove old temp files	
if ($cleanupTargetDir) {
	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory"}, "'.$targetDir.'" : "id"}');
	}

	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// If temp file is current file proceed to the next
		if ($tmpfilePath == "{$filePath}.part") {
			continue;
		}

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
}	


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
	}

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
} else {	
	if (!$in = @fopen("php://input", "rb")) {
		//die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "Failed to open input stream."}, "id" : "id"}');
	}
}

while ($buff = fread($in, 4096)) {
	fwrite($out, $buff);
}

@fclose($out);
@fclose($in);
// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
		//die('{"jsonrpc" : "2.0", "error" : {"code": 1548, "message": "el error donde esta?."}, "id" : "'.$targetThumbDir . DIRECTORY_SEPARATOR . $fileName.'"}');
	// Strip the temp .part suffix off 
	$tmpfileThumbPath = $targetThumbDir . DIRECTORY_SEPARATOR . $fileName;
	if($_GET['thumb']=='si'){
		redimensionar_gd("{$filePath}.part", $tmpfileThumbPath, 400,200, 100,$ext);
	}
	/*
	if($_GET['crop']=='false'){
		redimensionar_gd("{$filePath}.part", $filePath,800,600, 100,$ext);
	}else{
	foreach (glob($targetDir."/{*.part}",GLOB_BRACE) as $nombre_archivo){unlink($nombre_archivo);}
	rename("{$filePath}.part", $filePath);
	}
	*/
	rename("{$filePath}.part", $filePath);
	?>

<? }

// Return Success JSON-RPC response
die('{"jsonrpc" : "2.0", "result" : null, "id" : "'.$filePath.'"}');
 
?> 