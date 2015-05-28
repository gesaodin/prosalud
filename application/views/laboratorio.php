<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/laboratorio.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func-min.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid-min.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Solicitudes de Laboratorio Realizadas</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>

	<div id="ReportesR" style="width: 100%">  </div>	

