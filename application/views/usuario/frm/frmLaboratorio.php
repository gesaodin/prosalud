 <table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
  <tr><td colspan="4">
  		<h4> + Datos del Proveedor</h4>
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


	   <tr><td colspan="4">
  		<h4> + Examenes De Laboratorio Solicitado</h4>
  	</td>
  </tr>
	 
	 <tr>
	 	<td>Categorias: </td>
	  <td align="left"  >
	    <select name="txtCategoria" id="txtCategoria" style="width: 180px;" onchange="Categoria()">
	    	<option>----------</option>
        <?php
        	foreach ($categoria as $sC => $sV) {
						echo "<option value='" . $sV . "'>" .  $sV . "</option>";
					}
        ?>
      </select>
	  </td>
   </tr>
	 
	 <tr>
	 	<td>Perfiles: </td>
	  <td align="left"  >
	    <select name="txtPerfil" id="txtPerfil" style="width: 180px;" onchange="Perfil()">
	    	<option>----------</option>
        <?php
        	foreach ($perfiles as $sC => $sV) {
						echo "<option value='" . $sV . "'>" .  $sV . "</option>";
					}
        ?>
      </select>
	  </td>
	  <td  style="width: 140px;">Costo del Examen: </td>
    <td align="right">
    	 <input name="txtCosto"  type="text" id="txtCosto" style="width: 140px;">
    </td>
   </tr>	
	 <tr>
	 		<td valign="top">Lista de Examenes:</td>
	    <td valign="top" colspan="3" >
	      	<select name="txtListaPerfil" id="txtListaPerfil" style="width: 465px; height: 90" multiple="multiple" ondblclick="Eliminar_Examen()" onclick="Ver_Precio()">
	      	</select>
	    </td>
	 </tr>
	 
	 
	<tr><td colspan="4">
  		<h4> + Examenes De Laboratorio Autorizados</h4>
  	</td>
  </tr>
  
   <tr>
	 		<td valign="top">Lista de Examenes:</td>
	    <td valign="top" colspan="3" >
	      	<select name="lstExamen" id="lstExamen" style="width: 465px; height: 90" multiple="multiple" ondblclick="Eliminar_Examen_D()">
	      		</select>
	    </td>
	 </tr>
   
   
   
   	 <tr>
	 	<td>Solicitud Laboratorio </td>
	  <td align="left"  >
	    <select name="lstOrden" id="lstOrden" style="width: 180px;">
				<option value="0">-</option>
	     </select>
	  </td>
	  <td  style="width: 140px;">Costo Solicitud: </td>
    <td align="right">
    	 <input name="txtCostoE"  type="text" id="txtCostoE" style="width: 140px;">
    </td>
   </tr> 


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

	 	<tr>
	    <td valign="top">Observacion: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtObservacion"  type="text" id="txtObservacion" style="width: 465px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 <tr>
	    <td valign="top"><button onclick="Generar_Clave();">Generar Codigo</button> </td>
	    <td align="left"  colspan=3 >
	      <input name="txtClave"  type="text" id="txtClave" style="width: 180px;">
	    </td>
	 </tr>
	 
	 

</table><br>
	<center><button name="Solicitar" onclick="Guardar();">Guardar Orden de Laboratorio</button></center>