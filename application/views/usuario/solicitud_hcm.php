<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/solicitud_hcm.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<?php 
					if($quien == "h"){
						echo "<h2> Solicitud de HCM Emergencia</h2><br>";
					}else{
						echo "<h2> Solicitud de HCM Cirugia Electiva</h2><br>";
					}
					
				?>
	
	
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>
	<div id="tabs" style="width:630px;"> 
    <ul>
      <li><a href="#tabs-1">Datos B&aacute;sico</a></li>   
      <li><a href="#tabs-2">Servicio</a></li>      
    </ul>	
		<div id='tabs-1' >																		
				<?php $this->load->view("usuario/frm/frmUsuarioS");?>		
		</div>
		<div id='tabs-2'>
				<?php 
					if($quien == "h"){
						$this->load->view("usuario/frm/frmOAM");	
					}else{
						$this->load->view("usuario/frm/frmCE");
					}
					
				?>
		</div>		
	</div><br>
	<div id="botones">
			<button name="Solicitar" onclick="Guardar_Solicitud();">Solicitar Servicio</button>
			<button name="Limpiar">Limpiar Formulario</button>
	</div>
<?php $this->load->view("incluir/pie");?>