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