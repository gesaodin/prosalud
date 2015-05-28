
<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/registrar.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid-min.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Registrar Titular</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>
	<div id="tabs" style="width:630px; height: 400px"> 
    <ul>
      <li><a href="#tabs-1">Datos B&aacute;sico</a></li>      
      <li><a href="#tabs-2">Contrataciones </a></li>
      <li><a href="#tabs-3">Dependientes </a></li>
           
      
    </ul>						    							    	
		
		<div id='tabs-1' >																		
				<?php $this->load->view("usuario/frm/frmUsuarioR");?>		
		</div>		
		<div id='tabs-2'>
      <?php $this->load->view("usuario/frm/frmContrataciones");?>
    </div>
	
		<div id='tabs-3'>
      <?php $this->load->view("usuario/frm/frmAfiliados");?>
    </div>
		
	</div><br>
	<div id="botones">
		<?php 
			if($_SESSION['usuario']=="Oswaldo" || $_SESSION['usuario']=="Crash"){
				echo '<button name="Solicitar" onclick="Registrar();">Guardar Titular</button>';	
			}
		?>
			
			
			<button name="Limpiar" onclick="Limpiar()">Limpiar Formulario</button>
			
	</div>
<?php $this->load->view("incluir/pie");?>