

<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/buzon.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Solicitudes de Servicios Pendientes Por HCM</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>

	<div id="tabs" style="width:98%">
		  <ul>
        	<li><a href="#tabs-1">Lista de Solicitudes (HCM) </a></li>
        	<li><a href="#tabs-2">Lista de Ingresos(HCM) </a></li>
        	<li><a href="#tabs-3">Lista de Egresos(HCM) </a></li>    	
        	<li><a href="#tabs-4">Pendientes por confirmar(HCM) </a></li>
	    </ul>
	    <div id='tabs-1' style="padding: 0 0 0 0; background-color: #fff">							
					<div id="Reportes" style="width: 100%">  </div>
					<br><br>
			</div>
		<div id="tabs-2" style="padding: 0 0 0 0; background-color: #fff">
				<div id="ReportesI" style="width: 100%">  </div>
				<br><br>					
		</div>
		<div id="tabs-3" style="padding: 0 0 0 0; background-color: #fff">
				<div id="ReportesE" style="width: 100%">  </div>
				<br><br>				
		</div>
		<div id="tabs-4" style="padding: 0 0 0 0; background-color: #fff">
				<div id="ReportesP" style="width: 100%">  </div>
				<br><br>				
		</div>
	</div>
	


<?php $this->load->view("incluir/pie");?>
  