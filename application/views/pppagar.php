

<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/pppagar.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func-min.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid-min.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Cuentas Pendientes Por Pagar</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>

	<div id="tabs" style="width:98%">
		  <ul>
        	<li><a href="#tabs-1">Consultas</a></li>
        	<li><a href="#tabs-2">Laboratorio </a></li>
        	    	
	    </ul>
	    <div id='tabs-1' style="padding: 0 0 0 0; background-color: #fff">							
					<div id="Reportes" style="width: 100%">  </div>
					<br><br>
			</div>
		<div id="tabs-2" style="padding: 0 0 0 0; background-color: #fff">
				<div id="ReportesI" style="width: 100%">  </div>
				<br><br>					
		</div>
	</div>
