<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/reportes.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Reportes Generales</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>
	<div>
	<table >
		<tr>
			
			<td align="center">
				<img src="<?php echo __IMG__ ?>reportes/factura.png" style='width:48px' onClick="muestra_div('proveedores_imp');"/><br>Proveedores</td>
			<td style="width: 50px"></td>
			<td align="center">
				<img src="<?php echo __IMG__ ?>reportes/busca_contrato.jpg" style='width:48px' onClick="muestra_div('nomina_imp');"/><br>Nominas</td>
			<td style="width: 50px"></td>
			<td align="center">
				<img src="<?php echo __IMG__ ?>reportes/estadistica.png" style='width:48px' onClick="muestra_div('estadisticas_imp');"/><br>Estadisticas</td>
		</tr>
		</table>	
		
		<div id="nomina_imp" class="dialogo" title="Nominas Generales">
			<br>
			<?php $this->load->view("reportes/frm/nomina");?>									
		</div>
		
		<div id="proveedores_imp" class="dialogo" title="Lista Proveedores">
			<br>
			<?php $this->load->view("reportes/frm/proveedores");?>									
		</div>
		
		<div id="estadisticas_imp" class="dialogo" title="Listado de Servicios">
			<br>
			<?php $this->load->view("reportes/frm/estadisticas");?>									
		</div>
		
	</div>
	<div id="Reportes" style="width: 100%;"></div>
<?php $this->load->view("incluir/pie");?>