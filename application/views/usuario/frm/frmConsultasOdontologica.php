<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >

  <tr>
    <td style="width: 240px;">Limpiezas Dental: </td>
    <td align="left" style="width: 165px;" colspan=3>
      <select name="lstLD" id="lstLD" style="width: 180px;">
				<option value="0">----</option>
      </select>
    </td>
  </tr>
  <tr>
   	<td  style="width: 140px;">Obturaciones con Resina: </td>
    <td align="left" colspan=3>
    	<select name="lstOR" id="lstOR" style="width: 180px;" >
        <option value="0">---</option>
      </select>  
    </td>    
  </tr>  
  
  <tr>
   	<td  style="width: 140px;">Exodoncias Simples: </td>
    <td align="left" colspan=3>
    	<select name="lstES" id="lstES" style="width: 180px;" >
        <option value="0">---</option>
      </select>  
    </td>    
  </tr>  
  	 <tr>
	    <td valign="top">Observacion: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtObservacion"  type="text" id="txtObservacion" style="width: 450px; height: 45px"></textarea>
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
  <?
  /**
	 * update `td_afiliacion` join odontologia on `td_afiliacion`.cedula=odontologia.cedula SET 
`td_afiliacion`.LD=odontologia.LD,`td_afiliacion`.OR=odontologia.OR,`td_afiliacion`.ES=odontologia.ES
	 */
  ?>
  
 </table>