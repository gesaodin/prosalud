



<table style="width:600px" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td colspan="4"><h4> + Usuarios Dependientes</h4>
		<br>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="4">
		<select name="txtafiliados" id="txtafiliados" style="width: 600px;  height: 80px" multiple="true"  onclick="Listar_Cobertura_Dependiente()" ondblclick="Ver_Dependientes()">
			<option value='----------'>----------</option>
		</select></td>
	</tr>
</table>
<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
	<tr>
		<td >Disponible:</td>
		<td align="right" >
		<input name="txtMontoD" id="txtMontoD" type="text" style="width: 80px;">
		</td>
		<td >Cobertura Maternidad:</td>
		<td align="left" >
		<input name="txtMaternidad" type="text" id="txtMaternidad" style="width: 80px;">
		</td>
		<td >Retenido:</td>
		<td align="right" >
		<input name="txtRetenidoD" id="txtRetenidoD" type="text" style="width: 80px;">
		</td>
	</tr>

<tr>
	<td colspan="4" align="right">
		<br><br>
		<button onclick="Add_Dependientes()"> Registrar Dependiente</button>
		
	</td>
	
</tr>

</table>


