

<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/crudlab.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Bienvenidos... Noticias del d&iacute;a</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>

	<br><br>
	
		<div id="Reportes" style="width: 100%">  </div>
	<br><br>	
	<br><br>
</font>
<?php $this->load->view("incluir/pie");?>
  