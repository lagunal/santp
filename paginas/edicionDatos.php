<?php
    include "../controles/header.php";

    include_once "../clases/cargarLog.php";
    $log = new Log();

	//INICIO AUTORIZAR PÁGINA ***************
	autorizarPagina("ACTUALIZAR");
	//FIN AUTORIZAR PÁGINA ***************

	if (isset($_GET["order"])) $order = @$_GET["order"];
	if (isset($_GET["type"])) $ordtype = @$_GET["type"];
	
	if (isset($_POST["filter"])) $filter = @$_POST["filter"];
	if (isset($_POST["filter_field"])) $filterfield = @$_POST["filter_field"];
	$wholeonly = false;
	if (isset($_POST["wholeonly"])) $wholeonly = @$_POST["wholeonly"];
	
	if (!isset($order) && isset($_SESSION["order"])) $order = $_SESSION["order"];
	if (!isset($ordtype) && isset($_SESSION["type"])) $ordtype = $_SESSION["type"];
	if (!isset($filter) && isset($_SESSION["filter"])) $filter = $_SESSION["filter"];
	if (!isset($filterfield) && isset($_SESSION["filter_field"])) $filterfield = $_SESSION["filter_field"];
?>

<html xmlns="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" xml:lang="es" lang="es">
    <head>
        <meta name="generator" content="HTML Tidy, see www.w3.org" />

        <title><?php echo $config->nombreAplicacion; ?></title>
        <link rel="shortcut icon" href="../favicon.ico" />
        <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
	</head>

    <body>
        <table width="760px" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                	<?php echo $pres->crearEncabezado($config->nombreAplicacion); ?>
				</td>
            </tr>
            <tr>
                <td>
                    <?php 
						$titulo = "<a id='lnkInicio' href='principal.php' class='link_blanco'>Inicio</a>&nbsp;-&nbsp;" .
								 "<a href='organizacion.php' class='link_blanco'>Organización</a>&nbsp;-&nbsp;" .
								 "<a href='servicios.php' class='link_blanco_sel'>Servicios</a>&nbsp;-&nbsp;" .
								 "<a id='lnkNoticias' href='principal.php?noti=1' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
								 "<a id='lnkUltimas' href='principal.php?rec=1' class='link_blanco' title='ÚLTIMAS NORMAS ACTUALIZADAS O DESARROLLADAS'>Últimas Normas</a>" . 
								 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='login.php' class='link_blanco'>Salir</a>";
	                    
	                    echo $pres->crearVentanaInicio($titulo);
	                    include "../controles/menu.php";
	                    echo $pres->crearVentanaIntermedia();
	                ?>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
                            <tr>
                                <td height="10px"></td>
                                <td style="display:none"><input type="hidden" name="accionUsuario" id="accionUsuario" /> </td>
                            </tr>
                            <tr>
                                <td valign="top">

 
<a class="Titulo">Editor de Contenido</a>
<?php
  $conn = connect();
  $showrecs = 20;
  $pagerange = 10;

  $a = @$_GET["a"];
  $recid = @$_GET["recid"];
  $page = @$_GET["page"];
  if (!isset($page)) $page = 1;

  $sql = @$_POST["sql"];

  switch ($sql) {
    case "update":
      sql_update();
      break;
    case "delete":
      sql_delete();
      break;
  }

  switch ($a) {
    case "view":
      viewrec($recid);
      break;
    case "edit":
      editrec($recid);
      break;
    case "del":
      deleterec($recid);
      break;
    default:
      select();
      break;
  }

  if (isset($order)) $_SESSION["order"] = $order;
  if (isset($ordtype)) $_SESSION["type"] = $ordtype;
  if (isset($filter)) $_SESSION["filter"] = $filter;
  if (isset($filterfield)) $_SESSION["filter_field"] = $filterfield;
  if (isset($wholeonly)) $_SESSION["wholeonly"] = $wholeonly;

  pg_close($conn);
?>
</body>
</html>

<?php function select()
  {
  global $a;
  global $showrecs;
  global $page;
  global $filter;
  global $filterfield;
  global $wholeonly;
  global $order;
  global $ordtype;


  if ($a == "reset") {
    $filter = "";
    $filterfield = "";
    $wholeonly = "";
    $order = "";
    $ordtype = "";
  }

  $checkstr = "";
  if ($wholeonly) $checkstr = " checked";
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }
  $res = sql_select();
  $count = sql_getrecordcount();
  if ($count % $showrecs != 0) {
    $pagecount = intval($count / $showrecs) + 1;
  }
  else {
    $pagecount = intval($count / $showrecs);
  }
  $startrec = $showrecs * ($page - 1);
  if ($startrec < $count) {@pg_result_seek($res, $startrec);}
  $reccount = min($showrecs * $page, $count);
?>
<br>
<table border="0" cellspacing="1" cellpadding="4" width="560">
<tr><td class="Detalle">Número de Datos <?php echo $startrec + 1 ?> - <?php echo $reccount ?> de <?php echo $count ?></td></tr>
</table>
<hr size="1" noshade>
<form action="edicionDatos.php" method="post">
	<table border="0" cellspacing="1" cellpadding="4" width="560">
	<tr>
		<td class="Detalle"><b>Introduzca la palabra a buscar</b>&nbsp;</td>
		<td><input type="text" name="filter" value="<?php echo $filter ?>"></td>
		<td>
			<select name="filter_field" class="Detalle">
				<option value="">Todas las columnas</option>
				<option value="<?php echo "tx_codigo" ?>"<?php if ($filterfield == "tx_codigo") { echo "selected"; } ?>><?php echo htmlspecialchars("Código de la Norma") ?></option>
				<option value="<?php echo "tx_nombre" ?>"<?php if ($filterfield == "tx_nombre") { echo "selected"; } ?>><?php echo htmlspecialchars("Título de la Norma") ?></option>
			</select>
		</td>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="action" value="Buscar"></td>
		<td class="Detalle"><input type="checkbox" name="wholeonly"<?php echo $checkstr ?>>Tomar solo esta Palabra</td>
	</tr>
	</table>
</form>
<hr size="1" noshade>
<table border="0" cellspacing="1" cellpadding="5">
<tr>
<td >&nbsp;</td>
<td >&nbsp;</td>
<td>&nbsp;</td>
<!-- ************************************************************ Tabla con las normas encontradas ************************************************************ -->
<td class="Titulo"><a class="Titulo" href="edicionDatos.php?order=<?php echo "tx_codigo" ?>&type=<?php echo $ordtypestr ?>"><strong><?php echo htmlspecialchars("Código") ?></strong></a></td>
<td class="Titulo"><a class="Titulo" href="edicionDatos.php?order=<?php echo "tx_nombre" ?>&type=<?php echo $ordtypestr ?>"><strong><?php echo htmlspecialchars("Título de la Norma") ?></strong></a></td>
</tr>
<?php
  for ($i = $startrec; $i < $reccount; $i++)
  {
    $row = pg_fetch_assoc($res);
    $style = "dr";
    if ($i % 2 != 0) {
      $style = "sr";
    }
?>
<tr>
	<td bgcolor="#F3F3F3"><a class="Detalle" href="edicionDatos.php?a=view&codigo=<?php echo $row["codigo_norma"];?>&recid=<?php echo $i ?>&page=<?php echo $_GET["page"] ?>">Ver</a></td>
	<td bgcolor="#F3F3F3"><a class="Detalle" href="edicionDatos.php?a=edit&codigo=<?php echo $row["codigo_norma"];?>&recid=<?php echo $i ?>&page=<?php echo $_GET["page"] ?>">Editar</a></td>
	<td bgcolor="#F3F3F3"><a class="Detalle" href="edicionDatos.php?a=del&codigo=<?php echo $row["codigo_norma"];?>&recid=<?php echo $i ?>&page=<?php echo $_GET["page"] ?>">Eliminar</a></td>
	<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars($row["tx_codigo"]) ?></strong></td>
	<td bgcolor="#F3F3F3" class="Detalle" title="<?php echo htmlspecialchars($row["tx_nombre"]) ?>">
	<?php
		$pos = 50;

		if( strlen($row["tx_nombre"]) < $pos )
		{
			echo htmlspecialchars($row["tx_nombre"]);
		} else {
			echo substr( htmlspecialchars($row["tx_nombre"]), 0, $pos ) . "...";
		}
	?>
	</td>
</tr>
<?php
  }
  pg_free_result($res);
?>
</table>
<br>
<?php showpagenav($page, $pagecount); ?>
<?php } ?>

<?php function showrow($row, $recid)
  {
?>
<table border="0" cellspacing="1" cellpadding="5">
	<tr>
		<td style="display:none">
			<input type="hidden" name="codigo" value="<?php echo $_GET["codigo"]; ?>">
		</td>
	</tr>
	<tr>
		<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars("Código")."&nbsp;" ?></strong></td>
		<td bgcolor="#F3F3F3" class="Detalle"><?php echo htmlspecialchars($row["tx_codigo"]) ?></td>
	</tr>
	<tr>
		<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars("Título de la Norma")."&nbsp;" ?></strong></td>
		<td bgcolor="#F3F3F3" class="Detalle"><?php echo htmlspecialchars($row["tx_nombre"]) ?></td>
	</tr>
	<tr>
		<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars("Ruta")."&nbsp;" ?></strong></td>
		<td bgcolor="#F3F3F3" class="Detalle">
			<a href="<?php echo $row["tx_ruta"]; ?>" class="Detalle" target="_blank">
				<?php echo htmlspecialchars($row["tx_ruta"]) ?>
			</a>
		</td>
	</tr>
</table>
<?php } ?>

<?php function showroweditor($row, $iseditmode)
  {
  global $conn;
?>
<table border="0" cellspacing="1" cellpadding="5" width="50%">
<tr>
	<td style="display:none">
		<input type="hidden" name="codigo" value="<?php echo $_GET["codigo"]; ?>">
	</td>
</tr>
<tr>
<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars("Ruta de Acceso")."&nbsp;" ?></strong></td>
<td bgcolor="#F3F3F3" class="Detalle"><textarea cols="35" rows="4" name="tx_ruta" maxlength="500"><?php echo str_replace('"', '&quot;', trim($row["tx_ruta"])) ?></textarea></td>
</tr>
<tr>
<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars("Fecha / Revisión")."&nbsp;" ?></strong></td>
<td bgcolor="#F3F3F3" class="Detalle"><input type="text" name="tx_fecha" maxlength="30" value="<?php echo str_replace('"', '&quot;', trim($row["tx_fecha"])) ?>"></td>
</tr>
<tr>
<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars("Código de la Norma")."&nbsp;" ?></strong></td>
<td bgcolor="#F3F3F3" class="Detalle"><textarea cols="35" rows="4" name="tx_codigo" maxlength="60"><?php echo str_replace('"', '&quot;', trim($row["tx_codigo"])) ?></textarea></td>
</tr>
<tr>
<td bgcolor="#F3F3F3" class="Detalle"><strong><?php echo htmlspecialchars("Título de la Norma")."&nbsp;"?></strong></td>
<td bgcolor="#F3F3F3" class="Detalle"><textarea cols="35" rows="4" name="tx_nombre" maxlength="500"><?php echo str_replace('"', '&quot;', trim($row["tx_nombre"])) ?></textarea></td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table border="0" cellspacing="1" cellpadding="4" width="560">
<tr>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?a=add">Página</a>&nbsp;</td>
<?php if ($page > 1) { ?>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Anterior</a>&nbsp;</td>
<?php } ?>
<?php
  global $pagerange;

  if ($pagecount > 1) {

  if ($pagecount % $pagerange != 0) {
    $rangecount = intval($pagecount / $pagerange) + 1;
  }
  else {
    $rangecount = intval($pagecount / $pagerange);
  }
  for ($i = 1; $i < $rangecount + 1; $i++) {
    $startpage = (($i - 1) * $pagerange) + 1;
    $count = min($i * $pagerange, $pagecount);

    if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
      for ($j = $startpage; $j < $count + 1; $j++) {
        if ($j == $page) {
?>
<td class="Detalle"><b><?php echo $j ?></b></td>
<?php } else { ?>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } }} ?>
<?php if ($page < $pagecount) { ?>
<td class="Detalle">&nbsp;<a class="Detalle" href="edicionDatos.php?page=<?php echo $page + 1 ?>">Siguiente&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<br>
<table border="0" cellspacing="1" cellpadding="4">
<tr>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php">Inicio</a></td>
<?php if ($recid > 0) { ?>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Anterior </a></td>
<?php } if ($recid < $count - 1) { ?>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Siguiente</a></td>
<?php } ?>
</tr>
</table>
<hr size="1" noshade>
<?php } ?>

<?php function addrec()
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4" width="560">
<tr>
<td><a href="edicionDatos.php">Inicio</a></td>
</tr>
</table>
<hr size="1" noshade>
<form enctype="multipart/form-data" action="edicionDatos.php" method="post">
<p><input type="hidden" name="sql" value="insert"></p>
<?php
$row = array(
  "tx_ruta" => "",
  "tx_fecha" => "",
  "tx_codigo" => "",
  "tx_nombre" => "",
  "tx_body" => "",
  "prue_col_idx" => "");
showroweditor($row, false);
?>
<p><input type="submit" name="action" value="Post"></p>
</form>
<?php } ?>

<?php function viewrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  @pg_result_seek($res, $recid);
  $row = pg_fetch_assoc($res);
  showrecnav("view", $recid, $count);
?>
<br>
<?php showrow($row, $recid) ?>
<br>
<hr size="1" noshade>
<table border="0" cellspacing="1" cellpadding="4" width="560">
<tr>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?a=add">Volver</a></td>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?a=edit&codigo=<?php echo $_GET["codigo"]; ?>&recid=<?php echo $recid ?>">Editar</a></td>
<td class="Detalle"><a class="Detalle" href="edicionDatos.php?a=del&codigo=<?php echo $_GET["codigo"]; ?>&recid=<?php echo $recid ?>">Borrar</a></td>
</tr>
</table>
<?php
  pg_free_result($res);
} ?>

<?php 
	function editrec($recid)
	{
		$res = sql_select();
		$count = sql_getrecordcount();
		@pg_result_seek($res, $recid);
		$row = pg_fetch_assoc($res);
		showrecnav("edit", $recid, $count);
?>
		<br>
		<form enctype="multipart/form-data" action="edicionDatos.php" method="post">
		
		<table>
			<tr>
				<td style="display:none">
					<input type="hidden" name="sql" value="update">
					<input type="hidden" name="xtx_fecha" value="<?php echo $row["tx_fecha"] ?>">
					<input type="hidden" name="xtx_body" value="<?php echo $row["tx_body"] ?>">
					<input type="hidden" name="xprue_col_idx" value="<?php echo $row["prue_col_idx"] ?>">
				</td>
			</tr>
		</table>
		
		<?php showroweditor($row, true); ?>
		<p style="padding-left:260px;"><input type="submit" name="action" value="Enviar"></p>
		</form>
<?php
  		pg_free_result($res);
	} 
?>

<?php 
	function deleterec($recid)
	{
		$res = sql_select();
		$count = sql_getrecordcount();
		@pg_result_seek($res, $recid);
		$row = pg_fetch_assoc($res);
		showrecnav("del", $recid, $count);
?>
	<br>
	<form action="edicionDatos.php<?php if(isset($_GET["page"]) && !empty($_GET["page"]) ) echo "?page=" . $_GET["page"]; ?>" method="post">
	<input type="hidden" name="sql" value="delete">
	<input type="hidden" name="xtx_fecha" value="<?php echo $row["tx_fecha"] ?>">
	<input type="hidden" name="xtx_body" value="<?php echo $row["tx_body"] ?>">
	<input type="hidden" name="xprue_col_idx" value="<?php echo $row["prue_col_idx"] ?>">
	<?php showrow($row, $recid) ?>
	<p><input type="submit" name="action" value="Confirm"></p>
	</form>
<?php
		pg_free_result($res);
	} 
?>

<?php 
	function connect()
	{
	  $config = new config();
	  $conn = pg_connect($config->queryString);
	
	  return $conn;
	}
	
	function sqlvalue($val, $quote)
	{
	  if ($quote)
	    $tmp = sqlstr($val);
	  else
	    $tmp = $val;
	  if ($tmp == "")
	    $tmp = "NULL";
	  elseif ($quote)
	    $tmp = "'".$tmp."'";
	  return $tmp;
	}
	
	function sqlstr($val)
	{
	  return str_replace("'", "''", $val);
	}
	
	function sql_select()
	{
	  global $conn;
	  global $order;
	  global $ordtype;
	  global $filter;
	  global $filterfield;
	  global $wholeonly;
	
	  $filterstr = sqlstr($filter);
	
	  if (!$wholeonly && isset($wholeonly) && $filterstr!='') $filterstr = "%" . strtolower($filterstr) ."%";
	
	  $sql = "SELECT tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma FROM prueba_santp";
	
	  if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
	    $sql .= " where lower(" .sqlstr($filterfield) .") like '" .$filterstr ."' AND visible=1";
	  } elseif (isset($filterstr) && $filterstr!='') {
	    $sql .= " where ( (lower(tx_codigo) like '" .$filterstr ."') or (lower(tx_nombre) like '" .$filterstr ."') ) AND visible=1";
	  }else{
	    $sql .= " where visible=1";
          }

	  
	  if (isset($order) && $order!='') $sql .= " order by \"" .sqlstr($order) ."\"";
	  if (isset($ordtype) && $ordtype!='') $sql .= " " .sqlstr($ordtype);
	
	  $res = pg_query($conn, $sql) or die(pg_last_error());
	  
	  return $res;
	}
	
	function sql_getrecordcount(){
		global $conn;
		global $order;
		global $ordtype;
		global $filter;
		global $filterfield;
		global $wholeonly;
		
		$filterstr = sqlstr($filter);
		if (!$wholeonly && isset($wholeonly) && $filterstr!='') $filterstr = "%" . strtolower($filterstr) ."%";
		
		$sql = "SELECT COUNT(*) FROM prueba_santp";
		
		if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
		$sql .= " where lower(" .sqlstr($filterfield) .") like '" .$filterstr ."'  AND visible=1";
		} elseif (isset($filterstr) && $filterstr!='') {
		$sql .= " where ( (lower(tx_codigo) like '" .$filterstr ."') or (lower(tx_nombre) like '" .$filterstr ."') ) AND visible=1";
		}else{
		$sql .= " where visible=1";
		}
		
		$res = pg_query($conn, $sql) or die(pg_last_error());
		$row = pg_fetch_assoc($res);
		
		reset($row);
		
		return current($row);
	}
	
	function sql_insert()
	{
	  global $conn;
	  global $_POST;
	
	  $sql = "insert into prueba_santp (tx_ruta, tx_fecha, tx_codigo, tx_nombre, tx_body, prue_col_idx) values (" .sqlvalue(@$_POST["tx_ruta"], true).", " .sqlvalue(@$_POST["tx_fecha"], true).", " .sqlvalue(@$_POST["tx_codigo"], true).", " .sqlvalue(@$_POST["tx_nombre"], true).", " .sqlvalue(@$_POST["tx_body"], true).", " .sqlvalue(@$_POST["prue_col_idx"], true).")";
	  pg_query($conn, $sql) or die(pg_last_error());
	}
	
	function sql_update()
	{
	  global $conn;
	  global $_POST;
	
	  //$sql = "update prueba_santp set tx_ruta=" .sqlvalue(@$_POST["tx_ruta"], true).", tx_fecha=" .sqlvalue(@$_POST["tx_fecha"], true).", tx_codigo=" .sqlvalue(@$_POST["tx_codigo"], true).", tx_nombre=" .sqlvalue(@$_POST["tx_nombre"], true).", tx_body=" .sqlvalue(@$_POST["tx_body"], true).", prue_col_idx=" .sqlvalue(@$_POST["prue_col_idx"], true) ." where " .primarykeycondition();
	  $sql = "update prueba_santp set tx_ruta=" .sqlvalue(@$_POST["tx_ruta"], true).", tx_fecha=" .sqlvalue(@$_POST["tx_fecha"], true).", tx_codigo=" .sqlvalue(@$_POST["tx_codigo"], true).", tx_nombre=" .sqlvalue(@$_POST["tx_nombre"], true)." where codigo_norma=" . $_POST["codigo"];
	  pg_query($conn, $sql) or die(pg_last_error());
	}
	
	function sql_delete()
	{
		global $conn;
		
		//$sql = "delete from prueba_santp where " .primarykeycondition();
		$sql = "delete from prueba_santp where codigo_norma=" . $_POST["codigo"];
		pg_query($conn, $sql) or die(pg_last_error());
	}
	
	function primarykeycondition()
	{
		global $_POST;
		$pk = "";
		$pk .= "(tx_fecha";
		if (@$_POST["xtx_fecha"] == "") {
		$pk .= " IS NULL";
		}else{
		$pk .= " = " .sqlvalue(@$_POST["xtx_fecha"], true);
		};
		$pk .= ") and ";
		$pk .= "(tx_body";
		if (@$_POST["xtx_body"] == "") {
		$pk .= " IS NULL";
		}else{
		$pk .= " = " .sqlvalue(@$_POST["xtx_body"], true);
		};
		$pk .= ") and ";
		$pk .= "(prue_col_idx";
		if (@$_POST["xprue_col_idx"] == "") {
		$pk .= " IS NULL";
		}else{
		$pk .= " = " .sqlvalue(@$_POST["xprue_col_idx"], true);
		};
		$pk .= ")";
		return $pk;
	}
?>

                                	
                                </td>
                            </tr>
                        </table>
                    <?php echo $pres->crearVentanaFin(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $pres->crearPie(); ?></td>
            </tr>
        </table>
    </body>
</html>
