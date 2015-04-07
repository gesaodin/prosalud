<?php $this -> load -> view("incluir/cabezera"); ?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/consultar.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>
<?php $this -> load -> view("incluir/cuerpo"); ?>
	<h2> Consultar Usuario</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s"); ?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>
	
	<div id="divBuscar">
		<br>
		<table border="0" cellpadding="0" cellspacing="0" width="400px" ><tr>
			<td valign="top">
			<input name="txtBuscando" id="txtBuscando" type="text" value="Introducir Numero de Cedula" 
				onclick="this.value='';" onkeypress="Presionar(event)" style="width:450px;height:27px" \></td>
				<td valign="top">								
					<button id="buscar"  style="height:27px" onclick="Consultar()">Consultar</button>								
			</td></tr>
		</table>
	</div>
	<div id="divConsultar" style="display: none">
		<div id="tabs" style="width:630px; "> 
	    <ul>
	      <li><a href="#tabs-1">Datos B&aacute;sico</a></li>      
	      
	      <li><a href="#tabs-2">Contrataci&oacute;n </a></li>     
	      <li><a href="#tabs-3">Beneficiarios</a></li>
	      <li><a href="#tabs-4">Historial de Servicios </a></li>      
	      <li><a href="#tabs-5">Historial de Pagos </a></li>
	    </ul>						    							    	
			
			<div id='tabs-1' >																		
				<?php $this -> load -> view("usuario/frm/frmUsuario"); ?>
				<div id="botones">
					<button name="Carnet" onclick="Imprimir_Carnet()">Imprimir Carnet</button>
					<button onclick=""> Ver Servicios (U.T)...</button>
				</div>
			</div>		
			
			<div id='tabs-2'>
	      <?php $this -> load -> view("usuario/frm/frmContrataciones"); ?>
	    </div>
			<div id='tabs-3'>
				<?php $this -> load -> view("usuario/frm/frmAfiliados"); ?>
			</div>		
			<div id='tabs-4'>			
				<?php $this->load->view("usuario/frm/frmServicios")?>
				
				<div id="ReportesHCM" style="width:600px;"></div>
				<br><br>
				<div id="Servicios" style="width:600px;"></div>
			</div>
			<div id='tabs-5'>
				<div id="Reportes" style="width:600px;"></div>
			</div>
		</div><br>

	</div>
<?php $this -> load -> view("incluir/pie"); ?>