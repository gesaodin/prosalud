<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/varios.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Registrar Centros</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>
	<div> 
  <table>
			<tr>
				<td >1.- Tipo de Proveedor</td>
     <td align="right">
      <select name="txtTipoProveedor" id="txtTipoProveedor" style="width: 160px;" >
      <option value=0>Centro de Salud</option>
      <option value=1>Profesional de la Salud</option>
    </select></td>

				</td>
			</tr>
			<tr>
				<td>2.- Nombre del Centro</td><td><input type="text" name="txtRif" id="txtRif"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>3.- Persona de Contacto</td><td><input type="text" name="txtDir" id="txtDir"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Telefono de Contacto</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>5.- Correo de Contacto</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>6.- Nombre del Administrador</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Razón Social</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Rif</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Direccion</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Estado</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Ciudad</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Telefono Oficina</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
			<tr>
				<td>4.- Fax Oficina</td><td><input type="text" name="txtEstado" id="txtEstado"  style="width:250px;"/></td>
			</tr>
		</table>
	</div>
		
	</div><br>
	<div id="botones">
			<button name="Solicitar" >Solicitar Servicio</button>
			<button name="Limpiar">Limpiar Formulario</button>
			<button name="Carnet">Imprimir Carnet</button>
	</div>
<?php $this->load->view("incluir/pie");?>