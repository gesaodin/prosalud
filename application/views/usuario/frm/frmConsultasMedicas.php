 <table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
  <tr><td colspan="4">
  		<h4> + Datos del Centro y Profesionales</h4>
  	</td>
  </tr>
  <tr>
    <td style="width: 220px;">Estado: </td>
    <td align="left" style="width: 165px;">
      <select name="txtEstados" id="txtEstados" style="width: 180px;" onblur="Listar_Ciudades();" onchange="Listar_Ciudades();">
        <?php
        	foreach ($estados as $sC => $sV) {
						echo "<option value='" . $sV . "'>" .  $sV . "</option>";
					}
        ?>
      </select>
    </td>
   	<td  style="width: 140px;">Ciudad: </td>
    <td align="right">
    	<select name="txtCiudades" id="txtCiudades" style="width: 140px;" >
        <option>----------</option>
      </select>  
    </td>    
  </tr>  
	<tr>
    <td>Nombre del Centro: </td>
    <td align="left" colspan="3" >
      <input name="txtNombreCentro"  type="text" id="txtNombreCentro" style="width: 465px;">
    </td>

	 </tr>
	 
	 <tr>
	 	<td>Nombre Doctor(a): </td>
	  <td align="left" colspan="3" >
	    <input name="txtAnalista"  type="text" id="txtAnalista" style="width: 465px;">
	  </td>
	 </tr>
	 
	  <tr>
	  <td>Especialidad: </td>
	  <td align="left">
	    <select name="txtEspecialidades" id="txtEspecialidades" style="width: 180px;" onchange="Verificar_Especialidad()">
        <?php
        	foreach ($especialidades as $sC => $sV) {
						echo "<option value='" . $sV . "'>" .  $sV . "</option>";
					}
        ?>
      </select>
	  </td>
	  <td>Cant. Emitidas: </td>
	  <td align="left"  >
	    <input type="text" name="txtCantidadesD" id="txtCantidadesD" value="0" style="width: 140px;"></input>
	  </td>
	 </tr>
	
	<!--
	 <tr>
	    <td valign="top">Diagnostico: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtDiagnostico"  type="text" id="txtDiagnostico" style="width: 460px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 	<tr>
	    <td valign="top">Tratamiento: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtBreveInforme"  type="text" id="txtBreveInforme" style="width: 460px; height: 45px"></textarea>
	    </td>
	 </tr>
   !-->
	<tr>
    <td>Fecha: </td>
    <td align="left"  >
      <input name="txtFechaCentro"  type="text" id="txtFechaCentro" style="width: 160px;">
    </td>
	  <td>Hora: </td>
	  <td align="left" >
	    <input name="txtHora"  type="text" id="txtHora" style="width: 140px;">
	  </td>
	 </tr>

	 <!--
	 <tr>
	    <td valign="top">Motivo de consulta: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtMotivoConsulta"  type="text" id="txtMotivoConsulta" style="width: 465px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 <tr>
	 	<td>Cant. Orden: </td>
	  <td align="left" colspan="3" >
	    <select name="lstOrden" id="lstOrden" style="width: 180px;">
				<option value="0">-</option>
	     </select>
	  </td>
	 </tr>!-->
	 	<tr>
	    <td valign="top">Observacion: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtObservacion"  type="text" id="txtObservacion" style="width: 465px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 <tr>
	    <td valign="top"><button onclick="Generar_Clave();">Generar Codigo</button> </td>
	    <td align="left"  colspan=3 >
	      <input name="txtClave"  type="text" id="txtClave" style="width: 180px;" disabled="true">
	    </td>
	 </tr>
	 <tr>
	 	<td colspan="4">	 		
	 		<center><button name="Solicitar" onclick="Guardar_Solicitud();">Solicitar Servicio</button></center>
	 	</td> 	
	 </tr>
	 

	</table>