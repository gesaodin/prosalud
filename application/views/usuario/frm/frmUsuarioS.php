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
      <select name="txtNacionalidad" id="txtNacionalidad" style="width: 50px;">
        <option>V-</option>
        <option>E-</option>
      </select>
      <input name="txtCedula" type="text" style="width: 125px;" id="txtCedula" maxlength="10" onKeyPress="Presionar(event)" value="">
    </td>
  </tr>
  <tr>
    <td>Apellidos y Nombres: </td>
    <td align="left"  colspan=6 >
      <input name="txtNombre1"  type="text" id="txtNombre1" style="width: 460px;" value="">
    </td>
 </tr>
  <tr>
    <td >Fecha nacimiento:</td>
    <td align="left" ><select name="txtDiaNacimiento" id="txtDiaNacimiento" style="width: 55px;">
      <option>Dia:</option>
      <?php 
        for($i = 1; $i <= 31; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select name="txtMesNacimiento" id="txtMesNacimiento" style="width: 55px;">
      <option>Mes:</option>
      <?php 
          for($i = 1; $i <= 12; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select name="txtAnoNacimiento" id="txtAnoNacimiento" style="width: 65px;">
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
    <td align="right" ><select name="txtSexo" id="txtSexo" style="width: 150px;">
      <option selected="selected">Masculino</option>
      <option>Femenino</option>
    </select></td>
  </tr>

  <tr>
    <td >Contratante:</td>
    <td align="left" colspan="3">
      <input name="txtOrganismoContratante" id="txtOrganismoContratante" type="text" style="width: 460px;" value="">
      
    </td>
  </tr>
   <tr>
   	<td >Estado Contratante: </td>
    <td align="left" >
      <input name="txtEstadoContratante" id="txtEstadoContratante" type="text" style="width: 180px;" value="">
    </td>
    <td >Ciudad Contratante:</td>
    <td align="right" >
      <input name="txtCiudadContratante"  type="text" id="txtCiudadContratante" style="width: 150px;" value="">
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
			<td style="width:185px;">
			<input name="txtCoberturaDisponible" id="txtCoberturaDisponible" type="text" style="width: 120px;" readonly="readonly"> 
			</td>
			<td style="width:150px;">Retenido:</td>
			<td align="center" >
			<input name="txtRetenido" id="txtRetenido" type="text" style="width: 120px;" readonly="readonly">
			</td>
		<tr>
			
		<tr>
			<td style="width:220px;">Grupo 1:</td>
			<td >
			<input name="txtG1" id="txtG1" type="text" style="width: 120px;" readonly="readonly">
			</td>
			<td>Grupo 1 Retenido:</td>
			<td align="center" >
			<input name="txtG1R" id="txtG1R" type="text" style="width: 120px;" readonly="readonly">
			</td>
		<tr>
			
					<tr>
			<td style="width:220px;">Grupo 2:</td>
			<td >
			<input name="txtG2" id="txtG2" type="text" style="width: 120px;" readonly="readonly">
			</td>
			<td>Grupo 2 Retenido:</td>
			<td align="center" >
			<input name="txtG2R" id="txtG2R" type="text" style="width: 120px;" readonly="readonly">
			</td>
		<tr>
			
					<tr>
			<td style="width:220px;">Grupo 3:</td>
			<td >
			<input name="txtG3" id="txtG3" type="text" style="width: 120px;" readonly="readonly">
			</td>
			<td>Grupo 3 Retenido:</td>
			<td align="center" >
			<input name="txtG3R" id="txtG3R" type="text" style="width: 120px;" readonly="readonly">
			</td>
		<tr>
			
					<tr>
			<td style="width:220px;">Grupo 4:</td>
			<td >
			<input name="txtG4" id="txtG4" type="text" style="width: 120px;" readonly="readonly">
			</td>
			<td>Grupo 4 Retenido:</td>
			<td align="center" >
			<input name="txtG4R" id="txtG4R" type="text" style="width: 120px;" readonly="readonly">
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
<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
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