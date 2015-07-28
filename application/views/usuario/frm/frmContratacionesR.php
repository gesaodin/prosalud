<input name="txtCiudadContratante"  type="hidden" id="txtCiudadContratante" style="width: 0px;" value="" readonly="readonly">
<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
	<tr>
		<td >Estado: </td>
		<td align="left" colspan="3">	
			<select name="txtEstadoContratante"	id="txtEstadoContratante" onblur="Organismos()" style="width: 480px;">				
				<option value='0'>Todos</option>
				<?php
					foreach ($estados as $key => $value) {
						echo '<option value="' . $value . '">' . $value . '</option>';
					}
				?>				
			</select>
		</td>
	</tr>
	<tr>
		<td>Contratante:</td>
		<td align="left" colspan="3">		
			<select name="txtOrganismoContratante"	id="txtOrganismoContratante"style="" onclick="Consultar_Cobertura()" onchange="Consultar_Cobertura()" style="width: 480px;">				
				<option value='-----------'>-----------</option>
			</select>		
		</td>
	</tr>

	<tr>
		<td >Contrataci&oacute;n</td>
		<td align="left">
		<select name="txtTipoServicio" id="txtTipoServicio" style="width: 130px;" disabled="true">
			<option value=0>Basico</option>
			<option value=1>Exceso</option>
		</select></td>

		<td>Renovacion del Plan:</td>
		<td align="right" >
			<input name="txtActivoR" id="txtActivoR" type="text" style="width: 130px;">
		</td>
	</tr>
	<tr>
		<td >Cobertura Titular:</td>
		<td align="left" >
		<input name="txtCobertura" type="text" id="txtCobertura" style="width: 130px;">
		</td>
		<td >Cobertura Familiar:</td>
		<td align="right" >
		<input name="txtCoberturaFamiliar" id="txtCoberturaFamiliar" type="text" style="width: 130px;">
		</td>
	</tr>
	<tr>
		<td >Maternidad Titular:</td>
		<td align="left" >
		<input name="txtCoberturaMT" type="text" id="txtCoberturaMT" style="width: 130px;">
		</td>
		<td >Maternidad C&oacute;nyuge:</td>
		<td align="right" >
		<input name="txtCoberturaMF" id="txtCoberturaMF" type="text" style="width: 130px;">
		</td>
	</tr>
	<tr>
		<td >Consultas</td>
		<td align="left" >
		<input name="txtConsultas" id="txtConsultas" type="text" style="width: 130px;">
		</td>
		<td>Examenes Laboratorio</td>
		<td align="right" >
		<input name="txtExamen" id="txtExamen" type="text" style="width: 130px;">
		</td>
	</tr>
	<tr>
		<td>Limpiezas Dentales</td>
		<td align="left" >
		<input name="txtLimpiezas" id="txtLimpiezas" type="text" style="width: 130px;">
		</td>
		<td>Obturaciones Resina</td>
		<td align="right" >
		<input name="txtResina" id="txtResina" type="text" style="width: 130px;">
		</td>
	</tr>
	<tr>
		<td>Exodoncias Simples</td>
		<td align="left">
		<input name="txtExodoncia" id="txtExodoncia" type="text" style="width: 130px;">
		</td>
		<td>Estudios Especiales</td>
		<td align="right">
		<input name="txtEstudiosEspeciales" id="txtEstudiosEspeciales" type="text" style="width: 130px;">
		</td>
	</tr>
	<tr>
		<td>Grupo 1</td>
		<td align="left">
		<input name="txtGrupo1" id="txtGrupo1" type="text" style="width: 130px;">
		</td>
		<td>Grupo 2</td>
		<td align="right">
		<input name="txtGrupo2" id="txtGrupo2" type="text" style="width: 130px;">
		</td>
	</tr>
		<tr>
		<td>Grupo 3</td>
		<td align="left">
		<input name="txtGrupo3" id="txtGrupo3" type="text" style="width: 130px;">
		</td>
		<td>Grupo 4</td>
		<td align="right">
		<input name="txtGrupo4" id="txtGrupo4" type="text" style="width: 130px;">
		</td>
	</tr>
</table>

