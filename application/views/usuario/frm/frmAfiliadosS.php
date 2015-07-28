<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >

<tr>
		<td colspan="4"><br>
		</td>
	</tr>
	<tr>
		<td align="center">Coonsultas Disponibles:</td>
		<td align="center">
		<input name="txtConsultasD" id="txtConsultasD" type="text" style="width: 120px;">
		</td>
		<td align="center">Examenes Disponibles:</td>
		<td align="center" >
		<input name="txtExamenD" id="txtExamenD" type="text" style="width: 120px;">
		</td>
	</tr>

</table>

<table style="width:600px" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td colspan="4"><h4> + Usuario Dependientes</h4>
		<br>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="4">
		<select name="txtafiliados" id="txtafiliados" style="width: 580px;  height: 80px" multiple="true"  onclick="Listar_Cobertura_Dependiente()" ondblclick="Ver_Dependientes()">
			<option value='----------'>----------</option>
		</select></td>
	</tr>
</table>

<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
	<tr>
		<td >Parentesco:</td>
		<td align="left" >
		<input name="txtParentescoD" type="text" id="txtParentescoD" style="width: 120px;">
		</td>
		<td >Disponible:</td>
		<td align="right" >
		<input name="txtMontoD" id="txtMontoD" type="text" style="width: 120px;">
		</td>
		<td >Retenido:</td>
		<td align="right" >
		<input name="txtRetenidoD" id="txtRetenidoD" type="text" style="width: 120px;">
		</td>
	</tr>
</table>