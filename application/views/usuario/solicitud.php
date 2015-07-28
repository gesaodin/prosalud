<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/persona.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Solicitud de Servicio</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>
	<div id="tabs" style="width:630px; height: 450px"> 
    <ul>
      <li><a href="#tabs-1">Datos B&aacute;sico</a></li>     
      <li><a href="#tabs-2">Beneficiario</a></li>
      <li><a href="#tabs-3">Servicio</a></li>      
      
    </ul>						    							    	
		
		<div id='tabs-1' >																		
				<?php $this->load->view("usuario/frm/frmUsuarioS");?>		
		</div>		
		<div id='tabs-2'>
			<?php $this->load->view("usuario/frm/frmAfiliadosS");?>
		</div>		
		<div id='tabs-3'>
			<?php $this->load->view("usuario/frm/frmSolicitud");?>
			<div id='solicitudR' style="display: none;">	
				<?php $this->load->view("usuario/frm/frmReembolso");?>
			</div>
			<div id='solicitudOAM' style="">
				<?php $this->load->view("usuario/frm/frmOAM");?>
			</div>
			<div id='solicitudC' style="display: none;">
				<?php $this->load->view("usuario/frm/frmCentro");?>
			</div>
			<div id='solicitudO' style="display: none;">
				<?php $this->load->view("usuario/frm/frmOdontologico");?>
			</div>			
			<div id='solicitudE'></div>
		</div>
		
	</div><br>
	<div id="botones">
			<button name="Solicitar" onclick="Guardar_Solicitud();">Solicitar Servicio</button>
			<button name="Limpiar">Limpiar Formulario</button>
			<button name="Carnet" onclick="Imprimir_Carnet()">Imprimir Carnet</button>
	</div>
<?php $this->load->view("incluir/pie");?>