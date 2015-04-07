 <table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
  <tr style="visibility: hidden"><td colspan="4">
  		<h4> + Datos del Centro y Profesionales</h4>
  	</td>
  </tr>
  <tr  style="display: none">
    <td style="width: 220px;">Estado: </td>
    <td align="left" style="width: 165px;">
      <select name="txtEstados" id="txtEstados" style="width: 180px;" onblur="Listar_Ciudades();" onchange="Listar_Ciudades();">
      	<option>----------</option>
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
	<tr  style="display: none">
    <td>Nombre del Centro: </td>
    <td align="left" colspan="3" >
      <input name="txtNombreCentro"  type="text" id="txtNombreCentro" style="width: 460px;">
    </td>

	 </tr>
	 <tr style="display: none">
	 		  <td>Analista del Centro: </td>
	  <td align="left" colspan="3" >
	    <input name="txtAnalista"  type="text" id="txtAnalista" style="width: 460px;">
	  </td>
	 </tr>
	 
	 
	 <tr style="display: none"><td colspan="4">
 		<br>
  		<h4> + Datos Generales del Servicio</h4>
  	</td>
  </tr>
  
	<tr style="display: none">
		<td style="width: 220px;">Tipo de Servicio: </td>
    <td align="left" style="width: 165px;">
      <select name="txtTipoS" id="txtTipoS" style="width: 180px;" onblur="STServicio();" onchange="STServicio();">
        <option>----------</option>
        <option>Ambulatorio</option>
        <option>Cirugia</option>
        <option>Hospitalizacion</option>
        <option>Maternidad</option>
      </select>
    </td>
		
		<td style="width: 140px;">Tipo de Tratamiento: </td>
    <td align="right" >
      <select name="txtTipoT" id="txtTipoT" style="width: 140px;" >
        <option>----------</option>
      </select>
    </td>
	</tr>
	<tr style="display: none">
	<td>Tipo de Ingreso: </td>
	<td align="left"  colspan=3>
      <select name="txtTipoI" id="txtTipoI" style="width: 465px;" >
        <option>----------</option>
      </select>
    </td>
	 
	  
	 </tr>
	 
	 	 <tr style="display: none">
	    <td valign="top">Motivo de consulta: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtMotivoConsulta"  type="text" id="txtMotivoConsulta" style="width: 465px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 	 <tr style="display: none">
	    <td valign="top">Diagnostico: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtDiagnostico"  type="text" id="txtDiagnostico" style="width: 460px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 	<tr>
	    <td valign="top">Tratamiento: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtBreveInforme"  type="text" id="txtBreveInforme" style="width: 475px; height: 45px"></textarea>
	    </td>
	 </tr>

	<tr>
    <td>Fecha: </td>
    <td align="left"  >
      <input name="txtFechaCentro"  type="text" id="txtFechaCentro" style="width: 160px;">
    </td>
	  <td>Hora: </td>
	  <td align="right" >
	    <input name="txtHora"  type="text" id="txtHora" style="width: 140px;">
	  </td>
	 </tr>

	 

	 
	 	<tr>
	    <td valign="top">Observacion: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtObservacion"  type="text" id="txtObservacion" style="width: 475px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 <tr>
	    <td valign="top"><button onclick="Generar_Clave();">Generar Codigo </button> </td>
	    <td align="left"  colspan=3 >
	      <input name="txtClave"  type="text" id="txtClave" style="width: 180px;">
	    </td>
	 </tr>
	 
	 

	</table>
	
<input name="txtModulo"  type="hidden" id="txtModulo" style="width: 180px;" value="0">