<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/renovar.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Renovacion de Coberturas</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>	
	<br>
	<div id="renovar" class="dialogo" title="Nominas Generales">
			<br>
			<?php $this->load->view("reportes/frm/nomina");?>									
	</div>
	<div id="botones">
			<button name="Consultar" onclick="Consultar();">Consultar Cobertura</button>
	</div>
	<br>
	<br>
	
<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >

	<tr>
		<td >Contrataci&oacute;n</td>
		<td align="left">
		<select name="txtTipoServicio" id="txtTipoServicio" style="width: 130px;"	>
			<option value="B&aacute;sico">B&aacute;sico</option>
			<option value="Exceso">Exceso</option>
		</select></td>

		<td>Fecha de Renovacion:</td>
		<td align="right" >
		<input name="txtActivoF" id="txtActivoF" type="text" style="width: 130px;">
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
		<td >Cobertura Directivo:</td>
		<td align="left" colspan="3">
		<input name="txtDirectivo" type="text" id="txtDirectivo" style="width: 130px;">
		<input name="txtCodigo" type="hidden" id="txtCodigo" style="width: 130px;">
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
		<td>Obturaciones  Con Resina</td>
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

		
	<div id="botones">
			<button name="Solicitar" onclick="Renovar();">Renovar Cobertura</button>
			<button name="Limpiar">Limpiar Formulario</button>
	</div>
<?php $this->load->view("incluir/pie");?>