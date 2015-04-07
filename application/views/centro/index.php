<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/centro.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Registrar Centros</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>
	<div> 
  <table>
			<tr>
				<td>1.- Estado</td>
				<td>
					<select name="txtEstado"	id="txtEstado"style="" style="width:250px;">				
						<?php
							foreach ($estados as $key => $value) {
								echo "<option value='$value'>" . $value . "</option>";
							}
						?>				
					</select>
				</td>
			</tr>
			<tr>
				<td>2.- Ciudad</td><td><input type="text" name="txtCiudad" id="txtCiudad"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>3.- Tipo</td>
				<td>
					<select name="txtTipo"	id="txtTipo"style="" style="width:250px;">				
						<option value='CLINICO'>CLINICO</option>
						<option value='LABORATORIO'>LABORATORIO</option>
						<option value='APS'>APS</option>
						<option value='MEDICO ESPECIALISTA'>MEDICO ESPECIALISTA</option>
								
			</select>
				</td>
			</tr>

			<tr>
				<td>4.- Nombre del Centro</td><td><input type="text" name="txtNom" id="txtNom"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>5.- Persona de Contacto</td><td><input type="text" name="txtPer" id="txtPer"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>6.- Telefono de Contacto</td><td><input type="text" name="txtTel" id="txtTel"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>7.- Correo de Contacto</td><td><input type="text" name="txtCor" id="txtCor"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>8.- Nombre del Administrador</td><td><input type="text" name="txtNomA" id="txtNomA"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>9.- Razón Social</td><td><input type="text" name="txtRaz" id="txtRaz"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>10.- Rif</td><td><input type="text" name="txtRif" id="txtRif"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>11.- Direccion</td><td><input type="text" name="txtDir" id="txtDir"  style="width:250px;"/></td>
			</tr>

			<tr>
				<td>12.- Telefono Oficina</td><td><input type="text" name="txtTelO" id="txtTelO"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>13.- Fax Oficina</td><td><input type="text" name="txtFax" id="txtFax"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>14.- Banco</td><td><input type="text" name="txtBan" id="txtBan"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>15.- Cuenta</td><td><input type="text" name="txtCue" id="txtCue"  style="width:250px;"/></td>
			</tr>
		</table>
	</div>
		
	<br>
	<br>
	<div id="botones" >
			<button name="Guardar" onclick="Guardar()" >Guardar Datos</button>
			<button name="Limpiar" onclick="Limpiar()">Limpiar Formulario</button>		
	</div>
<?php $this->load->view("incluir/pie");?>