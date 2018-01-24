<?php
    include_once "../clases/clad.php";

    $clad = new clad();
?>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr valign="top">
	<td width="150px"></td>
        <td align="center" valign="middle" class="pie">
			Para comentarios o solicitar información enviar e-mail a toroms@pdvsa.com<br>
			Teléfonos: 93-56063 / 56403<br>
			Copyright © Petróleos de Venezuela S. A. 1983 

        </td>
        <td align="center" valign="middle" class="Detalle" width="150px" title="Visitas recibidas">
		<?php echo $clad->consultarSesionesTotal(); ?> visitas
	</td>
    </tr>
</table>

