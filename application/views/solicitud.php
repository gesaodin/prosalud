<?php $this->load->view("incluir/cabezera");?>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/persona.js"></script>
<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Solicitud de Servicios</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>
	<div id="tabs" style="width:630px; height: 450px"> 
    <ul>
      <li><a href="#tabs-1">Datos B&aacute;sico</a></li>      
      <li><a href="#tabs-2">Historial de Pagos </a></li>
      <li><a href="#tabs-3">Contrataciones </a></li>     
      <li><a href="#tabs-4">Datos del Paciente</a></li>
      <li><a href="#tabs-5">Tipo de Servicios </a></li>      
      
    </ul>						    							    	
		
		<div id='tabs-1' >																		
				<?php $this->load->view("usuario/frm/frmUsuario");?>		
		</div>		
		<div id='tabs-2'>
			<div id="Reportes" style="width:600px;"></div>
		</div>
		<div id='tabs-3'>
      <?php $this->load->view("usuario/frm/frmContrataciones");?>
    </div>
		<div id='tabs-4'>
			<?php $this->load->view("usuario/frm/frmAfiliados");?>
		</div>		
		<div id='tabs-5'>			
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