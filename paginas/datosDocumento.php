<table border="0" cellpadding="0" cellspacing="0" width="575px">
    <tr>
        <td align="center" valign="middle" class="Titulo">
        	<strong>Solicitud de Elaboración o Revision de Normas Técnicas PDVSA</strong>
        	<br>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table border="0" align="center" bgcolor="#FFFFFF" cellpadding="2" cellspacing="0">
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr bgcolor="#D6D6DD">
                    <td width="100%" colspan="4" align="right">
                        <div align="center" class="Titulo">
                            DATOS DEL DOCUMENTO TÉCNICO
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="Detalle">
                        <div align="left">
                            1. Documento Propuesto:
                        </div>
                    </td>
                    <td colspan="2">

			<textarea name="texta4" class="Detalle" cols="60" rows="2" id="texta4" onkeypress="checklength(texta4,remLen3,254);" onchange="checklength(texta4,remLen3,254)"></textarea>
                    	<input readonly type="text" id="remLen3" name="remLen3" size="3" maxlength="3" value="254">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="Detalle">
                        <div align="left">
                            2. Documento:
                        </div>
                    </td>
                    <td>
                    	<select name="documento" size="1" id="documento" onchange='validar2(document.getElementById("documento").value)' class="Detalle">
                            <option value="0">[Seleccione]</option>
                            <option value="Nuevo">Nuevo</option>
							<option value="Existente">Existente</option>
                    	</select>
                    </td>
                    <td class="Detalle" id="tu2" style="display:none ">
                        <div align="left">
                            Código N°: <input name="text2" type="text" size="10" maxlength="20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="Detalle">
                        <div align="left">
                            3. Prioridad:
                        </div>
                    </td>
                    <td>
                    	<select name="prioridad" size="1" id="select" class="Detalle">
                        	<option value="0">[Seleccione]</option>
                        	<option value="Alta">Alta</option>
                        	<option value="Media">Media</option>
                        	<option value="Baja">Baja</option>
                    	</select>
                    </td>
                    <td height="14">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="Detalle">
                        <div align="left">
                            4. Manual Técnico:
                        </div>
                    </td>
                    <td>
                    	<select name="manual" size="1" id="select4" onchange='validar4(document.getElementById("select4").value)' class="Detalle">
                        	<option value="0">[Seleccione]</option>
                            <option value="Materiales">Materiales</option>
                            <option value="Ingenieria">Ingenieria</option>
                            <option value="Inspección">Inspección</option>
                            <option value="Procesos">Procesos</option>
                            <option value="Riesgos">Riesgos</option>
                        	<option value="No sabe">No sabe</option>
                            <option value="otro">Otro</option>
                    	</select>
                    </td>
                    <td class="Detalle">
                        <div align="left" id="tu4" style="display:none ">
                            Otro: <input name="text4" type="text" size="20" maxlength="20">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr bgcolor="#D6D6DD">
                    <td width="100%" colspan="4" align="right" class="Detalle">
                        <div align="center" class="Titulo">
                            DATOS DE LA SOLICITUD
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#FF9999">
                    <td colspan="2" align="right" bordercolor="#990000" class="Detalle">
                        <div align="left">
                            5. Aplicación en Actividad de:
                        </div>
                    </td>
                    <td align="right" bordercolor="#990000" class="Detalle">
                        <div align="center">
                            6. Utilizada en:
                        </div>
                    </td>
                    <td bordercolor="#990000" class="Detalle">
                        <div align="right">
                            7. Requerido por razones de:
                        </div>
                    </td>
                </tr>
                <tr bgcolor="#ECE9D8">
                    <td width="24%" align="right" class="Detalle">
                        <div align="right">
                            Operación <input type="checkbox" name="arre5[]" value="Operación">
                        </div>
                    </td>
                    <td width="3%" align="right" class="Detalle">&nbsp;</td>
                    <td width="21%" align="right" class="Detalle">
                        <div align="right">
                            Refinación <input type="checkbox" name="arre6[]" value="Refinación">
                        </div>
                    </td>
                    <td width="47%" align="right" class="Detalle">
                        <div align="right">
                            Avance Tecnológico <input type="checkbox" name="arre7[]" value="Avance Tecnológico">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="8" align="right" class="Detalle">
                        <div align="right">
                            Mantenimiento <input type="checkbox" name="arre5[]" value="Mantenimiento">
                        </div>
                    </td>
                    <td width="3%" align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Petroquímica <input type="checkbox" name="arre6[]" value="Petroquímica">
                        </div>
                    </td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Cambio Norma Base <input type="checkbox" name="arre7[]" value="Cambio de Norma Base">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            Transporte <input type="checkbox" name="arre5[]" value="Transporte">
                        </div>
                    </td>
                    <td width="3%" align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Producción <input type="checkbox" name="arre6[]" value="Producción">
                        </div>
                    </td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Ordenar Trabajo <input type="checkbox" name="arre7[]" value="Ordenar Trabajo">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            Construcción <input type="checkbox" name="arre5[]" value="construcción">
                        </div>
                    </td>
                    <td width="3%" align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Mercado Interno <input type="checkbox" name="arre6[]" value="Mercado Interno">
                        </div>
                    </td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Unificar Criterios <input type="checkbox" name="arre7[]" value="Unificar Criterios">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            Pruebas <input type="checkbox" name="arre5[]" value="Pruebas">
                        </div>
                    </td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Costa Afuera <input type="checkbox" name="arre6[]" value="Costa Afuera">
                        </div>
                    </td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Simplificar Actividades <input type="checkbox" name="arre7[]" value="Simplificar Actividades">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            Compras <input type="checkbox" name="arre5[]" value="Compras">
                        </div>
                    </td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Planta piloto <input type="checkbox" name="arre6[]" value="Planta piloto">
                        </div>
                    </td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Reducir Costos <input type="checkbox" name="arre7[]" value="Reducir Costos">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            Seguridad <input type="checkbox" name="arre5[]" value="Seguridad">
                        </div>
                    </td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Otro <input type="checkbox" name="arre6[]" value="otro" id="p6" onclick="Enviar6('J')">
                        </div>
                    </td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Mayor Seguridad <input type="checkbox" name="arre7[]" value="Mayor Seguridad">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            Calidad <input type="checkbox" name="arre5[]" value="Calidad">
                        </div>
                    </td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">Otro: <input type="text" name="text6" id="text6" disabled></td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Calidad <input type="checkbox" name="arre7[]" value="Calidad">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            Inspección <input type="checkbox" name="arre5[]" value="Inspección">
                        </div>
                    </td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">
                        <div align="right">
                            Mejorar la productividad <input type="checkbox" name="arre7[]" value="Mejorar la productividad">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">Higiene <input type="checkbox" name="arre5[]" value="Higiene"></td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">Mejorar la Calidad <input type="checkbox" name="arre7[]" value="Mejorar la Calidad"></td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">Diseño <input type="checkbox" name="arre5[]" value="Diseño"></td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">Implantar nuevas técnicas <input type="checkbox" name="arre7[]" value="Implantar nuevas técnicas"></td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">Otro <input type="checkbox" name="arre5[]" value="otro" id="otro" onclick="Enviar5('J')"></td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td class="Detalle">
                        <div align="right">
                            Imposiciones Legales <input type="checkbox" name="arre7[]" value="Imposiciones Legales">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">Otro:</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td class="Detalle">
                        <div align="right">
                            Reducir montos de Adquisición <input type="checkbox" name="arre7[]" value="Reducir montos de Adquisición">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle"><input type="text" name="text5" id="text5" disabled></td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td class="Detalle">
                        <div align="right">
                            Reducir montos de contratación <input type="checkbox" name="arre7[]" value="Reducir montos de contratación">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td align="right" class="Detalle">&nbsp;</td>
                    <td class="Detalle">
                        <div align="right">
                            Mejorar intercambiabilidad <input type="checkbox" name="arre7[]" value="Mejorar intercambiabilidad">
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td height="16" align="right" class="Detalle">
                        <div align="right">
                            <p align="center">&nbsp;</p>
                        </div>
                    </td>
                    <td width="3%" align="right" class="Detalle">&nbsp;</td>
                    <td width="21%" align="right" class="Detalle">&nbsp;</td>
                    <td width="47%" class="Detalle">
                        <div align="right">
                            <p>Otro <input type="checkbox" name="arre7[]" value="otro" id="p7" onclick="Enviar7('J')"></p>
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#0066CC" bgcolor="#ECE9D8">
                    <td colspan="2" align="right" class="Detalle">&nbsp;</td>
                    <td colspan="2" class="Detalle">
                        <div align="right">
                            Otro: <input type="text" name="text7" id="text7" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" class="Detalle">
                        <div align="left">
                            8. Motivo:
                        </div>
                    </td>
                    <td colspan="2">
                        <textarea name="txObser2" class="Detalle" cols="60" rows="3" id="txObser2" onkeypress="checklength(txObser2,remLen2,254);" onchange="checklength(txObser2,remLen2,254);"></textarea>
                        <input readonly type="text" id="remLen2" name="remLen2" size="3" maxlength="3" value="254"> 
                    </td>
                </tr>
            </table>
            <table border="0" align="center" cellpadding="0" cellspacing="0">
            	<tr>
            		<td style="display:none">
                        <input type="hidden" id="pagina" value="0"> 
			            <input type="hidden" id="prueba" value="0">	
            		</td>
            	</tr>
                <tr>
                    <td width="13" align="right"><img src="../imagenes/bt_esq_izq.gif" width="13" height="33"></td>
                    <td width="67" align="middle" background="../imagenes/bt_bg.gif">
                        <div align="center" style='cursor:pointer; border:1px #FFF'>
                            <a class="Detalle" onclick="verificar();buscar();">
                            	<strong>»&nbsp;SIGUIENTE&nbsp;«</strong>
                            </a>
                        </div>
					</td>
                    <td width="14" align="left"><img height="33" src="../imagenes/bt_esq_der.gif" width="13"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

