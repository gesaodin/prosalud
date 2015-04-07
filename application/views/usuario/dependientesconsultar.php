
<?php $this -> load -> view("incluir/cabezera"); ?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/dependiente.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
<body style="margin: 20px 20px 20px 20px"><br>
	<h2> Consultar Dependiente</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s"); ?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>
	
		<div id="tabs" style="width:630px; "> 
	    <ul>
	      <li><a href="#tabs-1">Datos B&aacute;sico</a></li>
	      <li><a href="#tabs-2">Historial de Servicios </a></li>
	    </ul>
			<div id='tabs-1' >																		
					<?php $this -> load -> view("usuario/frm/frmDependienteConsultar"); ?>			
			</div>		
			<div id='tabs-2' >																		
					<div id="Reportes" style="width:600px;"></div>			
			</div>
		</div>	
	<br><br>
</body>																	
</html>