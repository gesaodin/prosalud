

<?php $this -> load -> view("incluir/cabezera"); ?>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/modificar_hcm.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/func.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/tgrid.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/paginador.js"></script>
	<script type="text/javascript" src="<?php echo __JSVIEW__ ?>tgrid/xls.js"></script>

<?php $this -> load -> view("incluir/cuerpo"); ?>



	<h2> Modificar Solicitud HCM Verificaci&oacute;n de Usuario
		<?php 

    	if(($ingreso['tipos'] == '----------') || ($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo')){
    		echo 'Cirugia Electiva';
    	}else{
    		echo 'Emergencia';
    	}
    	?>
		
	</h2><br>
	<h3> Fecha y hora actual del Sistema <?php echo date("d/m/Y h:m:s"); ?></h3><br><br>
	
	<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
		  	 <tr>
    <td>Fecha Emisi&oacute;n: </td>
    <td align="left"  >
      <input name="txtfechas"  type="text" id="txtfechas" style="width: 140px;" value="<?php echo $ingreso['fecha']?>">
      
    </td>
  </tr>
  
	 	<tr>
	 		<td>Codigo: </td>
    	<td align="left"  >
      	<input name="txtCodigoOAM"  type="text" readonly="readonly" id="txtCodigoOAM" style="width: 160px;"  value="<?php echo $codigo ?>">
    	</td>
	 </tr>
	 <tr>
    <td >Beneficiario: </td>
    <td align="left" colspan="4" >
      <input name="txtBeneficiarioOAM" readonly="readonly" type="text" id="txtBeneficiarioOAM" style="width: 160px;" value="V-<?php echo $dependiente ?>">
      <input name="txtNombre" readonly="readonly"  type="text" id="txtNombre" style="width: 250px;" value="<?php echo $nombre ?>">
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
      <select name="txtEstadoCentroOAM" id="txtEstadoCentroOAM" style="width: 180px;" onblur="Listar_Ciudades();" onchange="Listar_Ciudades();">
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
        <option>-----------</option>
      </select>  
    </td>    
  </tr>  
	<tr>
    <td>Nombre Completo: </td>
    <td align="left"  >
      <input name="txtNombreCentroOAM"  type="text" id="txtNombreCentroOAM" style="width: 180px;" value="<?php echo $ingreso['centro']; ?>">
    </td>
	  <td>Analista del Centro: </td>
	  <td align="left" >
	    <input name="txtAnalistaMedicoOAM"  type="text" id="txtAnalistaMedicoOAM" style="width: 140px;" value="<?php echo $ingreso['analista']; ?>">
	  </td>
	 </tr>
	 
 <tr><td colspan="4">
 		<br>
  		<h4> + Datos Generales del Servicio</h4>
  	</td>
  </tr>
  
  <tr>
  	<td>Fecha de Solicitud:</td>
  	
  	<td>
  		<input name="txtfechae"  type="text" id="txtfechae" style="width: 160px;" value="<?php echo $ingreso['fechae']?>">
  		<input name="txtSolicitud" type="hidden" id="txtSolicitud"  value="<?php echo $ingreso['modulo']; ?>"/>
  		</td>
  </tr>
  
	<tr>
		<td style="width: 220px;">Tipo de Servicio: </td>
    <td align="left" style="width: 165px;">
      <select name="txtTipoS" id="txtTipoS" style="width: 180px;" onblur="STServicio();">
      	<option ><?php echo $ingreso['tipos']; ?></option>
        <option>Ambulatorio</option>
        <option>Cirugia</option>
        <option>Hospitalizacion</option>
        <option>Maternidad</option>
      </select>
    </td>
		
		<td style="width: 140px;">Tipo de Tratamiento: </td>
    <td align="right" >
      <select name="txtTipoT" id="txtTipoT" style="width: 140px;" >
      	<option><?php echo $ingreso['tipot']; ?></option>
      </select>
    </td>
	</tr>
	<td>Tipo de Ingreso: </td>
	<td align="left"  colspan=3>
		
      <select name="txtTipoI" id="txtTipoI" style="width: 460px;" >
      	<option><?php echo $ingreso['tipoi']; ?></option>
      </select>
    </td>
	 
	  

	 
	 	<tr>
	    <td valign="top">Tratamiento: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtBreveInforme"  type="text" id="txtBreveInforme" style="width: 460px; height: 45px"><?php echo $ingreso['tratamiento']; ?></textarea>
	    </td>
	 </tr>
	
	

	 <tr>
	    <td valign="top">Motivo: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtObservacion"  type="text" id="txtObservacion" style="width: 460px; height: 45px" ><?php echo $ingreso['motivo']; ?></textarea>
	    </td>
	 </tr>
	 	 </tr>
	 
	 <tr style="visibility: hidden">
	    <td valign="top">Diagnostico: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtDiagnostico"  id="txtDiagnostico" style="width: 460px; height: 45px"><?php echo $ingreso['diagnostico']; ?></textarea>
	    </td>
	 </tr>
	</table>
	<input name="txtTitular"  type="hidden" id="txtTitular" style="width: 180px;" value="<?php echo $titular ?>">
	<input name="txtDependiente"  type="hidden" id="txtDependiente" style="width: 180px;" value="<?php echo $dependiente ?>">
	<br>
		<div id="botones">
			<button name="Solicitar" onclick="Guardar();">Actualizar Datos Solicitud</button>
			<button name="Limpiar"  onclick="Limpiar();">Volver Atr&aacute;s</button>
			<button name="Limpiar"  onclick="Limpiar();">Limpiar Formulario</button>
	</div>
	<?php $this -> load -> view("incluir/pie"); ?>
