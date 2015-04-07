
<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/registrar.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Registrar Titular</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>
	<div id="tabs" style="width:630px;"> 
    <ul>
      <li><a href="#tabs-1">Datos B&aacute;sico</a></li>      
      <li><a href="#tabs-2">Contrataciones </a></li>
      <li><a href="#tabs-3">Dependientes </a></li>
      <li><a href="#tabs-4">Beneficios Grupo Familiar </a></li>
    </ul>						    							    	
		
		<div id='tabs-1' >																		
				<?php $this->load->view("usuario/frm/frmUsuarioR");?>		
		</div>		
		<div id='tabs-2'>
      <?php $this->load->view("usuario/frm/frmContratacionesR");?>
    </div>
	
		<div id='tabs-3'>
      <?php $this->load->view('usuario/frm/frmAfiliados');?>
    </div>
		
		<div id='tabs-4'>
			<?php $this->load->view('usuario/frm/frmServiciosR')?>
		</div>
	</div>
	
	<br>
	<div id="botones">
		<?php 
			if($_SESSION['usuario']=="luisany" || $_SESSION['usuario']=="emma" || $_SESSION['usuario']=="Crash" || $_SESSION['usuario']=="Oswaldo" || $_SESSION['usuario']=="anaisbiaggi"){
				echo '<button name="Solicitar" onclick="Registrar();">Guardar Titular</button>';	
			}
		?>
			
			
			<button name="Limpiar" onclick="Limpiar()">Limpiar Formulario</button>
			
	</div>
<?php $this->load->view("incluir/pie");?>