<?php
	include("../clases/dhtmlgoodies_tree.class.php");
	include_once "../clases/clad.php";
	$clad = new clad();
	
	$tree = new dhtmlgoodies_tree();
	
	$rutasPrin = $clad->obtenerRutasPrincipales();
	$archivosRec = $clad->obtenerArchivosRecientes();
	
	$c = count($rutasPrin);
	$c2 = count($archivosRec);
	
	//print_r($archivosRec);

	$tree->addToArray($rutasPrin[0]["codigo_estructura"], $rutasPrin[0]["nombre"], $rutasPrin[0]["codigo_padre"], 
    	              "", "frmMain", "../imagenes/dhtmlgoodies_folder.gif");
	
	for($i=1; $i<$c; $i++){
		$existe = false;
		
		//Agregar archivos
		for($j=0; $j<$c2;$j++){
			if(strpos($archivosRec[$j]["tx_ruta"], $rutasPrin[$i]["codigo_estructura"])!==false){
				$tree->addToArray($archivosRec[$j]["tx_ruta"], $archivosRec[$j]["tx_codigo"] . " " . $archivosRec[$j]["tx_nombre"], 
								  $rutasPrin[$i]["codigo_estructura"], $archivosRec[$j]["tx_ruta"], 
								  "frmMain", "../imagenes/dhtmlgoodies_sheet.gif");
				$existe = true;
			}
		}

		//Agregar carpeta
		if($existe){
			$tree->addToArray($rutasPrin[$i]["codigo_estructura"], $rutasPrin[$i]["nombre"], $rutasPrin[$i]["codigo_padre"], 
		    	              "", "frmMain", "../imagenes/dhtmlgoodies_folder.gif");
		}
	}
	
	$tree->writeCSS();
	$tree->writeJavascript();
	$tree->drawTree();
?>
<script language="JavaScript" type="text/javascript">
  control = document.getElementById('plusMinussantp/');
  expandNode(null, control);
</script>
