<?php

/**
 * Formularios de Creacion de Usuarios
 *
 * -- Manejo de Hmtl
 * -- Modelo (application.model.usuario.musuario)
 * @package application.views.usuario
 *
 */
?>
<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
  <tr>
    <td style="width: 220px;" >C&eacute;dula (*):</td>
    <td style="width: 185px;" align="left" >
      <select name="txtNacionalidad" id="txtNacionalidad" style="width: 50px;" disabled="true">
        <option>V-</option>
        <option>E-</option>
      </select>
      <input name="txtCedula" type="text" style="width: 125px;" id="txtCedula" maxlength="10" onKeyPress="Presionar(event)" value="" >
    </td>
  </tr>
  <tr>
    <td>Apellidos y Nombres: </td>
    <td align="left"  colspan=6 >
      <input name="txtNombre1"  type="text" id="txtNombre1" style="width: 460px;" value="" disabled="true">
    </td>
 </tr>
  <tr>
    <td >Fecha nacimiento:</td>
    <td align="left" ><select name="txtDiaNacimiento" id="txtDiaNacimiento" style="width: 55px;" disabled="true">
      <option>Dia:</option>
      <?php 
        for($i = 1; $i <= 31; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select name="txtMesNacimiento" id="txtMesNacimiento" style="width: 55px;" disabled="true">
      <option>Mes:</option>
      <?php 
          for($i = 1; $i <= 12; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select name="txtAnoNacimiento" id="txtAnoNacimiento" style="width: 65px;" disabled="true">
      <option>A&ntilde;o:</option>
        <?php 
          for($i = 1900; $i <= 2014; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select></td>
    <td >Sexo:</td>
    <td align="right" >
    	<select name="txtSexo" id="txtSexo" style="width: 150px;" disabled="true">
      	<option selected="selected">Masculino</option>
      	<option>Femenino</option>
    	</select></td>
  </tr>

  <tr>
    <td >Contratante:</td>
    <td align="left" colspan="3">
      <input name="txtOrganismoContratante" id="txtOrganismoContratante" type="text" style="width: 460px;" value=""  disabled="true">
      
    </td>
  </tr>
   <tr>
   	<td >Estado Contratante: </td>
    <td align="left" >
      <input name="txtEstadoContratante" id="txtEstadoContratante" type="text" style="width: 180px;" value=""  disabled="true">
    </td>
    <td >Ciudad Contratante:</td>
    <td align="right" >
      <input name="txtCiudadContratante"  type="text" id="txtCiudadContratante" style="width: 150px;" value=""  disabled="true">
    </td>

  </tr>
  <tr>
<td>Limpiezas Dentales</td>
		<td align="left" >
		<input name="txtLimpiezas" id="txtLimpiezas" type="text" style="width: 130px;" value="0">
		</td>
		<td>Obturaciones Resina</td>
		<td align="right" >
		<input name="txtResina" id="txtResina" type="text" style="width: 130px;" value="0">
		</td>
  </tr>
    <tr>
		<td>Exodoncias Simples</td>
		<td align="left" colspan="3">
		<input name="txtExodoncia" id="txtExodoncia" type="text" style="width: 130px;" value="0">
		</td>
  
  </tr>  
  </table>
  
  
  <table>
		<tr>
			<td colspan="4"><h4> + Quien Recibe el servicio</h4>
			<br>
			</td>
		</tr>
		
			<tr>
			<td style="width: 220px;">Seleccione Usuario:</td>
			<td>
				<td colspan="3">
			<select name="txtTitularU" id="txtTitularU" style="width: 120px;" onblur="Seleccion();" onchange="Seleccion()">
				<option value=2 selected="selected">-</option>
				<option value=0>Mismo Titular</option>
				<option value=1>Dependiente</option>
			</select></td>
			</td>
		</tr>
	</table>
	
	<div id="divTitular" style="display: none">
	<table>
		<tr>
			<td style="width:220px;">Cobertura Disponible:</td>
			<td >
			<input name="txtCoberturaDisponible" id="txtCoberturaDisponible" type="text" style="width: 120px;">
			</td>
			<td>Retenido:</td>
			<td align="center" >
			<input name="txtRetenido" id="txtRetenido" type="text" style="width: 120px;">
			</td>

	<tr>
	</table>
	</div>
	
<div id="divDependiente" style="display: none">
<table style="width:600px" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td colspan="4"><h4> + Usuario Dependientes</h4>
		<br>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="4">
		<select name="txtafiliados" id="txtafiliados" style="width: 580px;  height: 80px" multiple="true"  onclick="Listar_Cobertura_Dependiente()" ondblclick="Ver_Dependientes()">
			<option value='----------'>----------</option>
		</select></td>
	</tr>
</table>
	<div id="divmas" style="display: none">
		<table style="width:600px" border="0" cellspacing="3" cellpadding="0" >
			<tr>
				<td >Parentesco:</td>
				<td align="left" >
				<input name="txtParentescoD" type="text" id="txtParentescoD" style="width: 120px;">
				</td>
				<td >Disponible:</td>
				<td align="right" >
				<input name="txtMontoD" id="txtMontoD" type="text" style="width: 120px;">
				</td>
				<td >Retenido:</td>
				<td align="right" >
				<input name="txtRetenidoD" id="txtRetenidoD" type="text" style="width: 120px;">
				</td>
			</tr>
			</table>
	</div>
</div>