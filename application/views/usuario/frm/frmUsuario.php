<?php

  /**
   * Formularios de Creacion de Usuarios
   * 
   * -- Manejo de Hmtl 
   * -- Modelo (application.model.usuario.musuario) 
   * @package application.views.usuario
   * 
	 * 
	 * 
	 * 
	 * 
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
      <input name="txtCedula"  type="text" style="width: 125px;" id="txtCedula" maxlength="10" onKeyPress="Presionar(event)" value="">
    </td>
 <td >Tipo de Usuario:</td>
    <td align="right" >
      <input name="txtTipoUsuario" readonly="readonly" id="txtTipoUsuario" type="text"style="width: 150px;" value="">
    </td>
 
  </tr>
  <tr>
    <td>Apellidos y Nombres: </td>
    <td align="left"  colspan=6 >
      <input name="txtNombre1" readonly="readonly" type="text" id="txtNombre1" style="width: 460px;" value="">
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
    <td >Edad:</td>
    <td align="right" >
			<input name="txtEdad" type="text" style="width: 150px;" id="txtEdad" value="" readonly="readonly">
		</td>
  </tr>
  <tr>
  	<td >Sexo:</td>
    <td align="left" ><select name="txtSexo" id="txtSexo" style="width: 180px;" disabled="true">
      <option>Masculino</option>
      <option>Femenino</option>
    </select></td>
  	
    
        
    <td style="width: 120px;">Estado Civil:</td>
    <td align="right">
      <select name="txtEdocivil" id="txtEdocivil" style="width: 150px;" disabled="true">
      <option value=0>Soltero (A)</option>
      <option value=1>Casado (A)</option>
      <option value=2>Divorciado (A)</option>
      <option value=3>Viudo (A)</option>
      <option value=4>Concubino (A)</option>
    </select></td>
  </tr>
  <tr>
    <td >Cargo:</td>
    <td align="left">
      <input name="txtCargo" type="text" style="width: 180px;" id="txtCargo" value="" readonly="readonly">
    </td>   
    <td >Profesi&oacute;n:</td>
    <td align="left">
      <input name="txtProfesion" id="txtProfesion" type="text" style="width: 150px;" readonly="readonly">
      
    </td>
  </tr>
  <tr>
    <td >Ciudad:</td>
    <td align="left" >
      <input name="txtCiudad"  type="text" id="txtCiudad" style="width: 180px;" value="" readonly="readonly">
    </td>
    <td >Estado: </td>
    <td align="right" >
      <input name="txtEstado" id="txtEstado" type="text" style="width: 150px;" value="" readonly="readonly">
    </td>
  </tr>  
  <tr>
    <td >Direcci&oacute;n Habitaci&oacute;n:</td>
    <td align="left" colspan="3">
      <input name="txtDireccionHabitacion" id="txtDireccionHabitacion" type="text" style="width: 460px;" value="" readonly="readonly">
      
    </td>

  <tr>
    <td >Direcci&oacute;n Trabajo:</td>
    <td align="left" colspan="3">
      <input name="txtDireccionTrabajo" id="txtDireccionTrabajo" type="text" style="width: 460px;" readonly="readonly">
      
    </td>
  </tr>
 
    <tr>
    <td>Banco (Nomina)</td>
    <td align="left" style="width: 165px;" >
      <select name="txtbanco_1" id="txtbanco_1" style="width: 180px;" onchange="verifica_banco(this);"  disabled="true">
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
        name="txtTipo_1" id="txtTipo_1" style="width: 150px;" disabled="true">
        <option>----------</option>
        <option>AHORRO</option>
        <option>CORRIENTE</option>
        <option>AHORRO NOMINA</option>
        <option>CORRIENTE NOMINA</option>
      </select></td>    
    </tr>
    <tr>
      <td >N&uacute;m. de Cuenta:</td>
      <td  colspan="3" align="left" readonly="readonly">
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
      <input name="txtTelefono" id="txtTelefono" type="text" style="width: 150px;">
    </td>
  </tr>
  
  <tr>
    <td >Domiciliado por:</td>
    <td align="left" >
      
      <select
        id="txtDomi" style="width: 180px;" disabled="true">
        <option value=0>----------</option>
        <option value=1>BANCO</option>
        <option value=2>NOMINA</option>
        
      </select>
      
    </td>
    
		<td ></td>
    <td align="right" >
      
    </td>
  </tr>
  
  
  <tr>
    <td style="width: 220px;" valign="top">Depende del Titular:</td>
    <td style="width: 185px;" align="left" colspan="3">
      <select name="txtdependede" id="txtdependede" style="width: 460px; height: 45px" multiple="true" ondblclick="Consultar_Depende()">
        <option value='----------'>----------</option>
      </select>      
    </td>       
  </tr>


  
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
		<td>Activacion de Plan</td>
	</tr>
	<tr>
		<td>
			<input name="txtCoberturaDisponible" id="txtCoberturaDisponible" type="text" style="width: 120px; color: black; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtRetenido" id="txtRetenido" type="text" style="width: 120px; color: red; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtMT" id="txtMT" type="text" style="width: 120px; color: black; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtActivoF" id="txtActivoF" type="text" style="width: 130px ;" readonly="readonly">
		</td>
	</tr>
	
	<tr>
		<td>Grupo 1: </td>
		<td>Grupo 2: </td>
		<td>Grupo 3: </td>
		<td>Grupo 4: </td>
	</tr>
	<tr>
		<td>
			<input name="txtG1" id="txtG1" type="text" style="width: 120px; color: black; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtG2" id="txtG2" type="text" style="width: 120px; color: black; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtG3" id="txtG3" type="text" style="width: 120px; color: black; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtG4" id="txtG4" type="text" style="width: 120px; color: black; font-weight: bold;" readonly="readonly">
		</td>
	</tr>
	<tr>
		<td>
			<input name="txtG1R" id="txtG1R" type="text" style="width: 120px; color: red; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtG2R" id="txtG2R" type="text" style="width: 120px; color: red; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtG3R" id="txtG3R" type="text" style="width: 120px; color: red; font-weight: bold;" readonly="readonly">
		</td>
		<td>
			<input name="txtG4R" id="txtG4R" type="text" style="width: 120px; color: red; font-weight: bold;" readonly="readonly">
		</td>
	</tr>
	
	<tr>
		
		<td colspan="4">Estudios Especiales: </td>
	</tr>
	<tr>
		<td colspan="4">
			<input name="txtEE" id="txtEE" type="text" style="width: 120px; color: black; font-weight: bold;" readonly="readonly">
		</td>
	</tr>
</table>