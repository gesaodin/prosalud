
<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
  <tr>
    <td style="width: 220px;" >C&eacute;dula Titular(*):</td>
    <td style="width: 185px;" align="left"  colspan="3">
      <select name="txtNacionalidad1" id="txtNacionalidad1" style="width: 50px;" disabled="true">
        <option>V-</option>
        <option>E-</option>
      </select>
      <input name="txtCedulaTitular"  readonly="readonly" type="text" style="width: 125px;" id="txtCedulaTitular" maxlength="10" onKeyPress="Presionar(event)" 
      value="<?php echo $cedula ?>">
      <input name="txtnombreTitular" readonly="readonly"  type="text" style="width: 255px;" id="txtnombreTitular"  
      value="<?php echo $nombre ?>">
    </td>

 
  </tr>
  <tr>
    <td style="width: 220px;" >C&eacute;dula Dependiente:(*):</td>
    <td style="width: 185px;" align="left" >
      <select name="txtNacionalidad2" id="txtNacionalidad2" style="width: 50px;">
        <option>V-</option>
        <option>E-</option>
      </select>
      <input name="txtCedulaDependiente"  readonly="readonly" type="text" style="width: 125px;" id="txtCedulaDependiente" maxlength="10"  
      value="<?php echo $dependiente ?>">
    </td>
	<td >Parentesco:</td>
    <td align="left" colspan="3">
      <select name="txtParentesco" id="txtParentesco" style="width: 150px;"  disabled="true">
       <option value="<?php echo $parentescod ?>"><?php echo $parentescod ?></option>
      <option value="C&oacute;nyuge">C&oacute;nyuge</option>
       <option value="Hijo">Hijo</option>
      <option value="Hermano">Hermano</option>
      <option value="Sobrino">Sobrino</option>
      <option value="Padre">Padre</option>
      <option value="Madre">Madre</option>
      <option value="Nieto">Nieto</option>
      
    </select>
      
    </td>
 
  </tr>
  <tr>
    <td>Apellidos y Nombres: </td>
    <td align="left"  colspan=6 >
      <input name="txtNombre1"  type="text" id="txtNombre1" style="width: 440px;" value="<?php echo $nombred ?>">
    </td>
 </tr>
  <tr>
    <td >Fecha nacimiento:</td>
    <td align="left" ><select name="txtDiaNacimiento" id="txtDiaNacimiento" style="width: 55px;"  disabled="true">
      <option value='<?php echo $dia ?>'><?php echo $dia ?></option>
      <?php 
        for($i = 1; $i <= 31; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select name="txtMesNacimiento" id="txtMesNacimiento" style="width: 55px;"  disabled="true">
      <option value='<?php echo $mes ?>'><?php echo $mes ?></option>
      <?php 
          for($i = 1; $i <= 12; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select name="txtAnoNacimiento" id="txtAnoNacimiento" style="width: 65px;"  disabled="true">
      
      <option value='<?php echo $ano ?>'><?php echo $ano ?></option>
        <?php 
          for($i = 1900; $i <= 2021; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select></td>
    <td >Sexo:</td>
    <td align="left" ><select name="txtSexo" id="txtSexo" style="width: 150px;"  disabled="true">
    	<option value='<?php echo $sexd ?>'><?php echo $sexd ?></option>
      <option>Masculino</option>
      <option>Femenino</option>
    </select></td>
  </tr>
  <tr>
  	<td >Estatus:</td>
    <td align="left" >
    	<select name="txtEstatus" id="txtEstatus" style="width: 180px;"  disabled="true">
    	<option value=<?php echo $estatus ?>  selected="selected"><?php echo $act?></option>	
      <option value=1>Activo</option>
      <option value=0>Inactivo</option>
    </select>
      </td>
    <td >Edad:</td>
    <td align="left">
      <input name="txtEdad"  type="text" id="txtEdad" style="width: 150px;" value="<?php echo $edad ?>">
    </td>   
  </tr>
 
  <tr>
  	<td >Tel&eacute;fono de Habitaci&oacute;n:</td>
    <td align="left">
      <input name="txtTlfHabitacion" type="text"  readonly="readonly" style="width: 180px;" id="txtTlfHabitacion" value="<?php echo $teled ?>" />
    </td>
    <td >Tel&eacute;fono Celular:</td>
    <td align="left">
      <input name="txtTlfCelular" type="text"  readonly="readonly" style="width: 150px;" id="txtTlfCelular" value="<?php echo $celd ?>" />
    </td>
  </tr>
  	<td >Cobertura Disponible:</td>
    <td align="left">
      <input name="txtCoberturaD" type="text"   readonly="readonly" style="width: 180px;" id="txtCoberturaD" value="<?php echo $cobd ?>" />
    </td>
    <td >Retenida:</td>
    <td align="left">
      <input name="txtCoberturaR" type="text"  readonly="readonly" style="width: 150px;" id="txtCoberturaR" value="<?php echo $reted ?>" />
    </td>    
  </tr>
  
  
    <tr>
    <td >Fecha de Ingreso:</td>
    <td align="left" ><select id="txtDiaIngreso" style="width: 55px;"  disabled="true">
      <option value='<?php echo $diai ?>'><?php echo $diai ?></option>
      <?php 
        for($i = 1; $i <= 31; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select id="txtMesIngreso" style="width: 55px;"  disabled="true">
      <option value='<?php echo $mesi ?>'><?php echo $mesi ?></option>
      <?php 
          for($i = 1; $i <= 12; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select>
    <select id="txtAnoIngreso" style="width: 65px;"  disabled="true">
      
      <option value='<?php echo $anoi ?>'><?php echo $anoi ?></option>
        <?php 
          for($i = 2000; $i <= 2021; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
			}
      ?>
    </select></td>
    <td ></td>
    <td align="left" ></td>
  </tr>
  
  
  
 	<tr>
		<td align="left" valign="top">
			Observaciones:
		</td><td colspan=6>	
		<textarea name="txtBreveInforme"  type="text" id="txtBreveInforme" style="width: 440px; height: 45px"></textarea>		
		</td>
	</tr>
	
	
	
	
	
</table>

<!--     <td >Grupo Sangu&iacute;neo:</td>
    <td align="left">
      <select name="txtGrupo" id="txtGrupo" style="width: 150px;"  disabled="true" >
      <option value='O+'>O+</option>
      <option value='O-'>O-</option>
      <option value='A+'>A+</option>
      <option value='A-'>A-</option>
      <option value='B+'>B+</option>
      <option value='B-'>B-</option>
      <option value='AB+'>AB+</option>
      <option value='AB-'>AB-</option>
    </select>
    </td>    -->
