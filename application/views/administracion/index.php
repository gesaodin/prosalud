<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/administracion.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Recepcion de Facturas</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br>
	<h4> Usuario Conectado: <?php echo $_SESSION['nombre'];?></h4><br>
	<div>
		<div id="frmAdministracion" title="Control de Recepcion">
			<center>
				<h2><label id="lblClinica">Clinica: XXXXX</label></h2>
				<h4><label id="lblClave">Clave: XXXXX</label></h4>
			<br>
			
			<table width="100%">
				
				<tr>
					<td>Fecha Recepcion&nbsp;&nbsp;</td><td colspan="4"><input type="text" style="width: 120px" id="txtFechaR" /></td>
				</tr>
				<tr>
					<td>Monto Comprometido&nbsp;</td><td><input type="text" id="txtMontoC" style="width: 140px" readonly="readonly"/></td>
					<td style="width: 10px"></td>
					<td>Monto Pronto Pago&nbsp;&nbsp;</td><td>
						<select id="cmbPPago" style="width: 160px">
							<option value=0>NO APLICA</option>
							<option value=5>5 %</option>
							<option value=10>10 %</option>
							<option value=15>15 %</option>
							<option value=20>20 %</option>
							<option value=25>25 %</option>
						</select>
					</td>
					<td style="width: 10px"></td>
				</tr>
							
				<tr>
					<td>Numero Factura </td><td><input type="text" style="width: 140px" id="txtNFactura" /></td>
					<td style="width: 10px"></td>
					<td>Fecha Factura </td><td><input type="text" style="width: 140px" id="txtFechaF"/></td>
				</tr>
				<tr>
					<td>Monto Factura&nbsp;</td><td><input type="text" id="txtMonto" style="width: 140px"/></td>
					<td style="width: 10px"></td>
					<td>Descuento Por&nbsp;&nbsp;</td><td>
						<select id="cmbSeleccion" style="width: 160px" onchange="ISRL()">
							<option value=0>--------</option>
							<option value=1>FACTURA</option>
							<option value=2>COMPROMISO</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Monto I.S.R.L&nbsp;</td><td><input type="text" id="txtISRL" style="width: 140px" readonly="readonly"/></td>					
					<td style="width: 10px"></td>
					<td>Monto Pronto Pago&nbsp;</td><td><input type="text" id="txtMontoPP" style="width: 160px" readonly="readonly"/></td>
				</tr>
				<tr>
					<td>Monto Total&nbsp;</td><td colspan="4"><input type="text" id="txtMontoT" style="width: 140px" readonly="readonly"/></td>	
					
					<input type="hidden" id="txtClave" />				
					<input type="hidden" id="txtClinica" />
					<input type="hidden" id="txtEstado" />
					<input type="hidden" id="txtCiudad" />
				</tr>
				<tr><td colspan="5"><textarea style="width: 560px; height: 45px" id="txtDiagnostico"></textarea></td></tr>
			</table>			
			</center>
		</div>
		<div id="centros">
		<table>	
		<tr>
    <td style="width: 220px;">Estado: </td>
    <td align="left" style="width: 165px;">
      <select name="txtEstadoCentroOAM" id="txtEstadoCentroOAM" style="width: 450px;"  onchange="Listar_Ciudades()">
        <option>----------</option>
        <?php
        	foreach ($estadosP as $sC => $sV) {
						echo "<option value='" . $sV . "'>" .  $sV . "</option>";
					}
        ?>
      </select>
    </td>
   </tr>
   <tr>
    <td  style="width: 140px;">Ciudad: </td>
    <td align="right">
      <select name="txtCiudadCentroOAM" id="txtCiudadCentroOAM" style="width: 450px;" onclick="Listar_Centros()" >
        <option>----------</option>
      </select>  
    </td>    
  </tr>  
  <tr>
    <td>Nombre Completo: </td>
    <td align="left"  >
    <select name="txtProveedoresOAM" id="txtProveedoresOAM" style="width: 450px;" >
        <option>----------</option>
      </select>  
    </td>

   </tr>
   <tr>
   <td colspan="2" align="right"><br>
   		<button onclick="Ver_Listado()"> Servicios Pendientes</button>   
   		<button onclick="Ver_Cuentas()"> Pendientes Por Pagar</button>
   		<button onclick="Ver_Pagados()"> Cuentas Canceladas</button>
   </td>
   </tr>
   </table>
   
   </div>
   
   <div id="frmControlCheque" title="Control de Cheques">
   	<center>
   	<br>
   	<input type="hidden" style="width: 120px;" id="txtfch"  />
   	<input type="hidden" style="width: 120px;" id="txtest"  />
   	<input type="hidden" style="width: 120px;" id="txtciu"  />
   	
   	<input type="hidden" style="width: 120px;" id="txtrif"  />
   	<input type="hidden" style="width: 120px;" id="txtemp"  />
   		<table>
   			<tr>
   				<td>Fecha del Cheque:</td>
   				<td><input type="text" style="width: 120px;" id="txtFechaCheque"  /></td>
   				<td style="width: 10px"></td>
					<td>Banco: </td><td>
						<select name="txtBanco" id="txtBanco" style="width: 160px;">
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
			        <option>BANCARIBE</option>
			      </select>						
					</td>
   			</tr>
   			<tr>
					<td>Monto Cheque </td><td><input type="text" style="width: 140px; font-weight: bold; color:black;" id="txtMontoCheque" readonly="readonly" /></td>
					<td style="width: 10px"></td>
					<td>Numero Cheque&nbsp;</td><td><input type="text" id="txtNumeroCheque" style="width: 160px" /></td>
				</tr>
   		</table>
   		</center>
   </div>
   <br>
   <div id="DivReportes" style="width: 100%;"></div>
   <br><br>
   </div>		
	</div>
	
<?php $this->load->view("incluir/pie");?>