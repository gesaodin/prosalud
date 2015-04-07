<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/preembolsol.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Reembolsos Pendientes Consultas y Laboratorioe</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>

	<div id="procesar" title="Confirmar Monto Reembolso">
			<table border="0" cellpadding="0" style="width: 550px;"> 
				<tr>
					<td style="width: 150px;">Codigo: </td>
					<td><input type="text" value="" id="txtCodigo" readonly="readonly"></td>
					<td style="width: 120px;">Titular: </td>
					<td><input type="text" value="" id="txtTitular" readonly="readonly"></td>
				</tr>
					<tr>
					<td>Tipo: </td>
					<td><select id="txtTipoDep"  >
								<option>----------</option>
								<option>DEPOSITO</option>
								<option>TRANSFERENCIA</option>
							</select>
							</td>
					<td>Banco Origen: </td>
					<td>
						
						<select id="txtBancoOrigen" >
								<option>----------</option>
				        <option>SOFITASA</option>
				        <option>BICENTENARIO</option>
				        <option>BOD</option>
				        <option>PROVINCIAL</option>
				        <option>VENEZUELA</option>
				        <option>BANESCO</option> 
				        <option>INDUSTRIAL</option>
				        <option>MERCANTIL</option>
				        <option>CAMARA MERCANTIL</option>
				        <option>EL EXTERIOR</option>
				        <option>FONDO COMUN</option>
				        <option>DEL SUR</option>
				        <option>FEDERAL</option>
				        <option>CANARIAS</option>
				        <option>CARONI</option>
				        <option>CARIBE</option>
				        <option>PLAZA</option>
				        <option>CENTRAL</option>
				        <option>NACIONAL DE CREDITO</option>
				        <option>COMERCIO EXTERIOR</option>
				        <option>OCCIDENTAL DE DESCUENTO</option>
				        <option>100% BANCO COMERCIAL</option>
				        <option>BANCORO</option>
				        <option>CORPBANCA</option>
			      	</select>		
					</td>
				</tr>
				<tr>
					<td># Deposito : </td>
					<td><input type="text" value="" id="txtDep"></td>
					<td>Monto: </td>
					<td><input type="text" value="" id="txtMonto"></td>
				</tr>
				
			
				
				<tr>
					<td>Fecha Dep.: </td>
					<td colspan="3"><input type="text" value="" id="txtFecha"></td>
				</tr>
				<tr>
					<td>Banco Destino: </td>
					<td colspan="3">
						 <select id="txtBanco" style="width: 400px;" >
								<option>----------</option>
				        <option>SOFITASA</option>
				        <option>BICENTENARIO</option>
				        <option>BOD</option>
				        <option>PROVINCIAL</option>
				        <option>VENEZUELA</option>
				        <option>BANESCO</option> 
				        <option>INDUSTRIAL</option>
				        <option>MERCANTIL</option>
				        <option>CAMARA MERCANTIL</option>
				        <option>EL EXTERIOR</option>
				        <option>FONDO COMUN</option>
				        <option>DEL SUR</option>
				        <option>FEDERAL</option>
				        <option>CANARIAS</option>
				        <option>CARONI</option>
				        <option>CARIBE</option>
				        <option>PLAZA</option>
				        <option>CENTRAL</option>
				        <option>NACIONAL DE CREDITO</option>
				        <option>COMERCIO EXTERIOR</option>
				        <option>OCCIDENTAL DE DESCUENTO</option>
				        <option>100% BANCO COMERCIAL</option>
				        <option>BANCORO</option>
				        <option>CORPBANCA</option>
			      	</select>						
					</td>
				</tr>
			</table>
			
		</div>


	<div id="ReportesR" style="width: 100%">  </div>		
	


<?php $this->load->view("incluir/pie");?>