
<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/dependiente.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid-min.js"></script>
<body style="margin: 20px 20px 20px 20px"><br>
		<h2> Registrar Dependientes</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>
	

				<?php $this->load->view("usuario/frm/frmDependiente");?>		
		</div>		

		<br>
	<center>
	<div id="botones">
			<button name="Solicitar" onclick="Registrar();">Guardar Titular</button>
			<button name="Limpiar" onclick="Limpiar();">Limpiar Formulario</button>
			
	</div>
	</center>
</body>																	
</html>