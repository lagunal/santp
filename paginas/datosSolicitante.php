<table border="0" cellpadding="0" cellspacing="0" width="580px">
	<tr>
		<td align="center" valign="middle" class="Titulo">
			<strong>Solicitud de Elaboración o Revision de Normas Técnicas PDVSA</strong>
        	<br>
        	<br>       	
        	<strong>DATOS DEL SOLICITANTE</strong>
        	<br>
        	<br>
		</td>
    </tr>
    <tr>
        <td valign="top" align="left">
            <table border="0" cellpadding="2" cellspacing="0">
                <tr>
                    <td bgcolor="#FFFFFF" class="Detalle" width="150px">
                        <div align="left">
                            9. Indicador:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input id="indicador" name="indicador" type="text" size="30" maxlength="20">
                        </div>
                    </td>
                    <td colspan="2" align="left">
                    	<input type="button" name="verificar" value="Verificar" onclick="enviar('verificar')" style="visibility: visible; ">
                    	<input type="button" name="cancelar" value="Cancelar" onclick="abortar();" style="visibility:hidden; width:0px">
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            10. Nombre y Apellido:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input name="nombre" type="text" size="45" maxlength="100" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            11. Extensión:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input name="telefono" type="text" size="25" maxlength="5" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            12. Número celular:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input name="celular" type="text" size="25" maxlength="11" disabled >
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            13. Indicador del Supervisor:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input name="indicador2" type="text" size="20" maxlength="20" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            14. Nombre del Supervisor:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input name="nombre2" type="text" size="45" maxlength="100" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            15. Extensión del Supervisor:
                        </div>
                    </td>

                    <td align="right">
                        <div align="left">
                            <input name="telefono2" type="text" size="7" maxlength="50" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            16. Lugar:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input name="lugar" type="text" size="45" maxlength="40" disabled>
                        </div>
                    </td>
                    <td class="Detalle">13. Fecha:</td>
                    <td>
                    	<input name="fecha" type="text" size="8" value="<?php echo date("d/m/Y"); ?>" disabled  >
                    </td>
                </tr>
                <tr>
                    <td align="right" class="Detalle">
                        <div align="left">
                            17. Filial / Gerencia/ Unidad:
                        </div>
                    </td>
                    <td align="right">
                        <div align="left">
                            <input name="filial" type="text" size="45" maxlength="30" disabled >
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" align="right">
                        <div align="center" class="Detalle">
                            <table border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="13" align="right">
                                    	<img src="../imagenes/bt_esq_izq.gif" width="13" height="33">
                                    </td>
                                    <td width="67" align="middle" background="../imagenes/bt_bg.gif">
                                        <div align="center" style='cursor:pointer; border:1px #FFF'>
                                            <a class="Detalle" onclick="enviar('guardar')">»ENVIAR«</a>
                                        </div>
                                    </td>
                                    <td width="14" align="left"><img height="33" src="../imagenes/bt_esq_der.gif" width="13"></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
