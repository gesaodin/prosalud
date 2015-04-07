<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/varios.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Registrar Contratante</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>

	<div>
		<table>
			<tr>
				<td style="width:220px">1. -Nombre del Contratante</td><td><input type="text" name="txtContratante" id="txtContratante"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>2.- Rif</td><td><input type="text" name="txtRif" id="txtRif"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>3.- Direccion</td><td><input type="text" name="txtDir" id="txtDir"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Estado</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>5.- Ciudad</td><td><input type="text" name="txtCiudad" id="txtCiudad"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>6.- Telefono Oficina</td><td><input type="text" name="txtTel" id="txtTel"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>7.- Fax Oficina</td><td><input type="text" name="txtFax" id="txtFax"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>8.- Organismos Dependiente</td><td><input type="text" name="txtOrganismo" id="txtOrganismo"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>9.- Numero Usuarios</td><td><input type="text" name="txtUsuario" id="txtUsuario"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>10.- Tipo Convenio</td><td><input type="text" name="txtConvenio" id="txtConvenio"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>11.- Cobertura Basico</td><td><input type="text" name="txtBasico" id="txtBasico"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>12.- Cobertura Exceso</td><td><input type="text" name="txtExceso" id="txtExceso"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>13.- Cobertura Total</td><td><input type="text" name="txtTotal" id="txtTotal"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>14.- Cobertura Familiares</td><td><input type="text" name="txtFamiliar" id="txtFamiliar"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>15.- Cobertura Directivo</td><td><input type="text" name="txtDirectivo" id="txtDirectivo"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>16.- Cosultas</td><td><input type="text" name="txtConsultas" id="txtConsultas"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>17.- Laboratorio</td><td><input type="text" name="txtLaboratorio" id="txtLaboratorio"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>18.- Fecha de Vencimiento</td><td><input type="text" name="txtVence" id="txtVence"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>19.- Persona Contacto</td><td><input type="text" name="txtContacto" id="txtContacto"  style="width:250px;"/></td>
			</tr>
		</table>
		
	</div>	
	<br><br>
	<div id="botones">
			<button name="Registrar" >Registrar</button>
			<button name="Limpiar">Limpiar Formulario</button>
			<button name="Carnet">Imprimir Carnet</button>
	</div>
<?php $this->load->view("incluir/pie");?>