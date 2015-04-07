

<?php $this->load->view("incluir/cabezera");?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/ingreso.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>

<?php $this->load->view("incluir/cuerpo");?>
	<h2> Solicitudes de Ingresos</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s");?></h3><br><br>
	<!-- ALTER TABLE `wt_docegreso` ADD `fechaingreso` DATE NOT NULL AFTER `oid`  -->
	<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
  <tr>
    <td>Fecha Emisi&oacute;n: </td>
    <td align="left"  >
      <input name="txtfechae"  type="text" id="txtfechae" style="width: 160px;" value="<?php 
      if(!isset($ingreso['fechac'])){
					echo "";
				}else{						
							

				echo $ingreso['fechac'];
				}
      ?>">
      <input name="txtSolicitud" type="hidden" id="txtSolicitud"  value=""/>
    </td>
	 </tr>
	 
	 
  	<tr>
    <td>Codigo: </td>
    <td align="left"  >
      <input name="txtCodigoOAM"  type="text" readonly="readonly" id="txtCodigoOAM" style="width: 180px;"  value="<?php echo $codigo ?>">
    </td>
	 </tr>
	 <tr>
	  <td >Cobertura Disponible: </td>
    <td align="left" >
      <input name="txtCoberturaDOAM" readonly="readonly" type="text" id="txtCoberturaDOAM" style="width: 180px;" value="<?php echo $cobertura ?>">
      
    </td>
    <td >Cobertura Retenida: </td>
    <td align="left"  >
      <input name="txtCoberturaROAM" readonly="readonly" type="text" id="txtCoberturaROAM" style="width: 140px;" value="<?php echo $retenido ?>">
      
    </td>
	 </tr>
	 <tr>
    <td >Beneficiario: </td>
    <td align="left" colspan="4" >
      <input name="txtBeneficiarioOAM" readonly="readonly" type="text" id="txtBeneficiarioOAM" style="width: 140px;" value="V-<?php echo $dependiente ?>">
      <input name="txtNombre" readonly="readonly"  type="text" id="txtNombre" style="width: 180px;" value="<?php echo $nombre ?>">
      <input name="txtTipo"  readonly="readonly" type="text" id="txtTipo" style="width: 40px;" value="<?php echo $tipo ?>">
    </td>
	 </tr>
	 <tr><td colspan="4"><br><br>
  		<h4> + Datos del Centro y Profesionales</h4>
  	</td>
  </tr>
  <tr>
    <td style="width: 220px;">Estado: </td>
    <td align="left" style="width: 165px;">
      <select name="txtEstadoCentroOAM" id="txtEstadoCentroOAM" style="width: 180px;" >
        <option value="<?php echo $ingreso['estado'];?>"><?php echo $ingreso['estado'];?></option>
        <?php
        	foreach ($estados as $sC => $sV) {
						echo "<option value='" . $sV . "'>" .  $sV . "</option>";
					}
        ?>
      </select>
    </td>
   	<td  style="width: 140px;">Ciudad: </td>
    <td align="right">
    	<select name="txtCiudadCentroOAM" id="txtCiudadCentroOAM" style="width: 140px;" >
        <option value="<?php echo $ingreso['ciudad'];?>"><?php echo $ingreso['ciudad'];?></option>
      </select>  
    </td>    
  </tr>  
	<tr>
    <td>Nombre Completo: </td>
    <td align="left"  >
      <input name="txtNombreCentroOAM"  type="text" id="txtNombreCentroOAM" style="width: 180px;" value="<?php echo $ingreso['centro'];?>">
    </td>
	  <td>
	  	<?php 
    	if($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo'){
    		echo 'Responsable: ';
    	}else{
    		echo 'Analista del Centro:';
    	}
    	?>
	  	 </td>
	  <td align="left" >
	    <input name="txtNombreMedicoOAM"  type="text" id="txtNombreMedicoOAM" style="width: 140px;" value="<?php echo $ingreso['analista'];?>">
	  </td>
	 </tr>
	 
 <tr><td colspan="4">
 		<br>
  		<h4> + Datos Generales del Servicio</h4>
  	</td>
  </tr>
  
  <tr>
    <td>Fecha <?php 
    	if($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo'){
    		echo 'Activacion';
    	}else{
    		echo 'Solicitud';
    	}
    	?>: </td>
    <td align="left"  >
      <input name="txtfechas"  type="text" id="txtfechas" style="width: 160px;" value="<?php 
      if(!isset($ingreso['fechas'])){
					echo "";
				}else{					
				echo $ingreso['fechas'];
				}
      ?>">
      
    </td>
	 </tr>
  
	<tr>
		<td style="width: 220px;">Tipo de Servicio: </td>
    <td align="left" style="width: 165px;">
      <select name="txtTipoS" id="txtTipoS" style="width: 180px;" onblur="STServicio();">
      	<option ><?php echo $ingreso['tipos'];?></option>
        <option>Ambulatorio</option>
        <option>Cirugia</option>
        <option>Hospitalizacion</option>
        <option>Maternidad</option>
      </select>
    </td>
		
		<td style="width: 140px;">Tipo de Tratamiento: </td>
    <td align="right" >
      <select name="txtTipoT" id="txtTipoT" style="width: 140px;" >
      	<option><?php echo $ingreso['tipot'];?></option>
      </select>
    </td>
	</tr>
	<td>Tipo de Ingreso: </td>
	<td align="left"  colspan=3>
		
      <select name="txtTipoI" id="txtTipoI" style="width: 460px;" >
      	<option><?php echo $ingreso['tipoi'];?></option>
      </select>
    </td>
	 
	  
	 </tr>
	 	 <tr>
	    <td valign="top">Motivo de Consulta: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtMotivo"  type="text" id="txtMotivo" style="width: 460px; height: 45px" ><?php echo $ingreso['motivo'];?></textarea>
	    </td>
	 </tr>
	 <tr>
	    <td valign="top">Diagnostico: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtDiagnostico"  type="text" id="txtDiagnostico" style="width: 460px; height: 45px"><?php echo $ingreso['diagnostico'];?></textarea>
	    </td>
	 </tr>
	 
	 	<tr>
	    <td valign="top">Tratamiento: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtBreveInforme"  type="text" id="txtBreveInforme" style="width: 460px; height: 45px"><?php echo $ingreso['tratamiento'];?></textarea>
	    </td>
	 </tr>
	 
	  <tr>
	    <td valign="top">Descuento Por: </td>
	    <td align="left"  colspan=3 >
	     <select name="txtDescuento" id="txtDescuento" style="width: 180px;" onblur="txtDescuento();">
      	<?php
      		foreach ($descuento as $k => $v) {
				echo '<option value="' . $k . '">' . $v . '</option>';  
			  }
      	?>
      </select>
	    </td>
	 </tr>
	 <tr><td colspan="4"><br><br>
  		<h4> + Movimiento de cuenta</h4>
  	</td>
  </tr>
	 	<tr>
    <td>Factura: </td>
    <td align="left"  valign="top" >
    	<select name="txtTipoF" id="txtTipoF" style="width: 100px;" >
    		<option><?php 
    		if(!isset($ingreso['tipof'])){
					echo "";
				}else{						
							

				echo $ingreso['tipof'];
				}
    		?></option>
        <option>Presupuesto</option>
        <option>Prefactura</option>
        <option>Factura</option>
        <option>Cuenta Paciente</option>
        <option>Corte Cuenta</option>
        <option>Estado de Cuenta</option>
      </select>
      <input name="txtFactura"  type="text" id="txtFactura" style="width: 60px;" value="<?php 
      if(!isset($ingreso['factura'])){
					echo "";
				}else{						
							

				echo $ingreso['factura'];
				}?>">
    </td>
	  <td>Fecha Factura: </td>
	  <td align="left" >
	    <input name="txtFechaF"  type="text" id="txtFechaF" style="width: 120px;" value="<?php 
	    if(!isset($ingreso['fechaf'])){
					echo "";
				}else{						
							

				echo $ingreso['fechaf'];
				}?>">
	  </td>
	 </tr>
	 
	 
	 <tr>
    <td colspan="4"><br><br></td>
    
	 </tr>

	 <tr>
    <td>Monto Solicitado: </td>
    <td align="left"  >
      <input name="txtMontoS"  type="text" id="txtMontoS" style="width: 180px;" value="<?php 
      if(!isset($ingreso['montos'])){
					echo "";
				}else{						
							

				echo $ingreso['montos'];
				}?>">
    </td>
	  <td>Monto Cubierto: </td>
	  <td align="left" >
	    <input name="txtMontoC"  type="text" id="txtMontoC" style="width: 140px;" onblur="Calcular_Cubierto()"  value="<?php 
	    if(!isset($ingreso['montoc'])){
					echo "";
				}else{						
							

				echo $ingreso['montoc'];
				}?>">
	  </td>
	 </tr>
	 	 <tr>
    <td>Monto No Cubierto: </td>
    <td align="left"  >
      <input name="txtMontoNC"  type="text" id="txtMontoNC" style="width: 180px;" onblur="Calcular_NOCubierto()"  value="<?php 
      if(!isset($ingreso['monton'])){
					echo "";
				}else{						
							

				echo $ingreso['monton'];
				}
      ?>">
    </td>
	  <td>Tipo de Cobertura: </td>
	  <td align="left" >
	    <select name="txtTipoCobertura" id="txtTipoCobertura" style="width: 140px;" >
	    	<option><?php 
      if(!isset($ingreso['tipoc'])){
					echo "";
				}else{						
							

				echo $ingreso['tipoc'];
				}
      ?></option>
        <option>Basico</option>
        <option>Exceso</option>
      </select>
	  </td>
	 </tr>
	 <tr>
	    <td valign="top">Observacion: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtObservacion"  type="text" id="txtObservacion" style="width: 460px; height: 45px" ><?php echo $ingreso['observacion'];?></textarea>
	    </td>
	 </tr>
	 
	</table>
	<input name="txtTitular"  type="hidden" id="txtTitular" style="width: 180px;" value="<?php echo $titular ?>">
	<input name="txtDependiente"  type="hidden" id="txtDependiente" style="width: 180px;" value="<?php echo $dependiente ?>">
	<br>
		<div id="botones">
			<button name="Solicitar" onclick="Guardar();">Guardar Compromiso de Ingreso</button>
			<button name="Limpiar"  onclick="Limpiar();">Limpiar Formulario</button>
	</div>
	<?php $this->load->view("incluir/pie");?>
