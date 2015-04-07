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
    <td >Cargo:</td>
    <td align="left">
      <input name="txtCargo" type="text" style="width: 180px;" id="txtCargo" value="">
    </td>   
        
    <td style="width: 120px;">Estado Civil:</td>
    <td align="right">
      <select name="txtEdocivil" id="txtEdocivil" style="width: 150px;" >
      <option value=0>Soltero (A)</option>
      <option value=1>Casado (A)</option>
      <option value=2>Divorciado (A)</option>
      <option value=3>Viudo (A)</option>
      <option value=4>Concubino (A)</option>
    </select></td>
  </tr>
    <tr>
    <td >Profesion:</td>
    <td align="left" colspan="3">
      <input name="txtProfesion" id="txtProfesion" type="text" style="width: 460px;">
      
    </td>
  </tr>
  <tr>
    <td >Ciudad:</td>
    <td align="left" >
      <input name="txtCiudad"  type="text" id="txtCiudad" style="width: 180px;" value="">
    </td>
    <td >Estado: </td>
    <td align="right" >
      <input name="txtEstado" id="txtEstado" type="text" style="width: 150px;" value="">
    </td>
  </tr>  
  <tr>
    <td >Direcci&oacute;n Habitaci&oacute;n:</td>
    <td align="left" colspan="3">
      <input name="txtDireccionHabitacion" id="txtDireccionHabitacion" type="text" style="width: 460px;" value="">
      
    </td>
  </tr>
  
  <tr>
    <td >Direcci&oacute;n Trabajo:</td>
    <td align="left" colspan="3">
      <input name="txtDireccionTrabajo" id="txtDireccionTrabajo" type="text" style="width: 460px;">
      
    </td>
 
    <tr>
    <td>Banco (Nomina)</td>
    <td align="left" style="width: 165px;">
      <select name="txtbanco_1" id="txtbanco_1" style="width: 180px;" onchange="verifica_banco(this);" >
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

    <td  style="width: 110px;">Tipo de Cuenta: </td>
    <td align="right">
      <select
        name="txtTipo_1" id="txtTipo_1" style="width: 150px;" >
        <option>----------</option>
        <option>AHORRO</option>
        <option>CORRIENTE</option>
        <option>AHORRO NOMINA</option>
        <option>CORRIENTE NOMINA</option>
      </select></td>    
    </tr>
    <tr>
      <td >N&uacute;m. de Cuenta:</td>
      <td  colspan="3" align="left" >
      <input name="txtcuenta_1" type="text"style="width: 460px;" id="txtcuenta_1" maxlength="20" onblur="Verificar_Cuenta(this.value);" >
    </td>
  </tr>
  
 
  <tr>
    <td >Correo Electronico:</td>
    <td align="left" >
      <input name="txtCorreo" type="text" id="txtCorreo" style="width: 180px;">
    </td>
    
		<td >N&uacute;m. Tel&eacute;fono:</td>
    <td align="right" >
      <input name="txtTelefono" id="txtTelefono" type="text" style="width: 150px;" >
    </td>
  </tr>


<?php 
	$seg = '';
	if ($_SESSION['usuario'] == "emma" || $_SESSION['usuario'] == "anaisbiaggi") {
		$seg = 'readonly="readonly"';
		
	}
?>
  
</table>
<br>
<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
	<tr>
		<td colspan="2"><h4> + Cobertura Usuario Titular</h4>
		</td>
	</tr>
	<tr>
		<td>Cobertura Disponible:</td>
		<td>Retenido:</td>
		<td>Cobertura Maternidad:</td>
		<td>Activacion del Plan</td>
	</tr>
	<tr>
		<td>
			<input name="txtCoberturaDisponible" id="txtCoberturaDisponible" type="text" style="width: 120px;" <?php echo $seg; ?>>
		</td>
		<td >
			<input name="txtRetenido" id="txtRetenido" type="text" style="width: 120px;" <?php echo $seg; ?>>
		</td>
		<td >
			<input name="txtCoberturaMaternidad" id="txtCoberturaMaternidad" type="text" style="width: 120px;" <?php echo $seg; ?>>
		</td>
		<td>
			<input name="txtActivoF" id="txtActivoF" type="text" style="width: 115px;">
		</td>
	</tr>
</table>