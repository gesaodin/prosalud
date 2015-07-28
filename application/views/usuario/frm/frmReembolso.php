<table style="width:600px" border="0" cellspacing="3" cellpadding="0"  >
  <tr><td colspan="4">
  		<h4> + Datos de Facturas Para Su Recepci&oacute;n</h4><br>
  	</td>
  </tr>

<tr>
    <td style="width: 130px;">Fecha Recepcion:</td>
    <td align="left" style="width: 185px;"><select name="txtDiaRecepcion" id="txtDiaRecepcion" style="width: 55px;">
      <option value=0>Dia:</option>
      <?php 
        for($i = 1; $i <= 31; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
					}
      ?>
    </select>
    <select name="txtMesRecepcion" id="txtMesRecepcion" style="width: 55px;">
      <option value=0>Mes:</option>
      <?php 
          for($i = 1; $i <= 12; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
					}
      ?>
    </select>
    <select name="txtAnoRecepcion" id="txtAnoRecepcion" style="width: 65px;">
      <option value=0>A&ntilde;o:</option>
        <?php 
          for($i = 2010; $i <= 2016; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
					}
      ?>
    </select></td>
  </tr>


<tr>
    <td style="width: 130px;">Fecha:</td>
    <td align="left" style="width: 185px;"><select name="txtDiaFactura" id="txtDiaFactura" style="width: 55px;">
      <option value=0>Dia:</option>
      <?php 
        for($i = 1; $i <= 31; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
					}
      ?>
    </select>
    <select name="txtMesFactura" id="txtMesFactura" style="width: 55px;">
      <option value=0>Mes:</option>
      <?php 
          for($i = 1; $i <= 12; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
					}
      ?>
    </select>
    <select name="txtAnoFactura" id="txtAnoFactura" style="width: 65px;">
      <option value=0>A&ntilde;o:</option>
        <?php 
          for($i = 2010; $i <= 2016; $i++){
      ?>
        <option value='<?php echo $i ?>'><?php echo $i ?></option>
      <?php
					}
      ?>
    </select></td>
    <td >N&uacute;mero:</td>
    <td align="right" ><input type="text" name="txtNumeroFactura" id="txtNumeroFactura" style="width: 180px;"></td>
  </tr>
  
   <tr>
	  <td valign="top">Conceptos: </td>
	  <td align="left"  colspan=3>
	    <textarea name="txtConceptoFactura"  type="text" id="txtConceptoFactura" style="width: 465px; height: 45px"></textarea>
	  </td>
	 </tr>
  <tr>
	  <td valign="top">Monto: </td>
	  <td align="left">
	    <input type="text" name="txtMontoFactura"  type="text" id="txtMontoFactura" style="width: 180px;">
	  </td>
	  <td colspan="2">
	  	<select name="lstTipo" id="lstTipo" style="width: 150px;">
	  		<option value="Hcm">Hcm</option>
	  	</select>
	  
	  	<button name='agregar' style="height: 22px;" onclick="Agregar_Facturas()"/>Agregar Factura</button>
	  </td>
	 </tr>
	<tr>
		<td valign="top">Listado General: </td>
		<td colspan="3">
			<select name="txtListaFactura" id="txtListaFactura" style="width: 465px; height: 80px" multiple="true" ondblclick="Quitar_Facturas()">
       
      </select>
		</td>
	</tr>
  	 <tr>
	    <td valign="top">Monto Total Sol.: </td>
	    <td align="left"  colspan=3 >
	      <input name="txtMontoTo"  type="text" id="txtMontoTo" style="width: 180px;">
	    </td>
	 </tr>
  	 
  	  </tr>
 
     <tr>
      <td >Titular Cuenta:</td>
      <td  colspan="3" align="left" readonly="readonly">
      <input name="txtTitularc" type="text"style="width: 460px;" id="txtTitularc" >
    </td>
  </tr>
    <tr>
    <td>Banco </td>
    <td align="left" style="width: 165px;" >
      <select name="txtBancoc" id="txtBancoc" style="width: 180px;" onchange="verifica_banco(this);">
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
      </select>
    </td> 

    <td  style="width: 80px;">Tipo: </td>
    <td align="right">
      <select
        name="txtTipoc" id="txtTipoc" style="width: 150px;">
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
      <input name="txtCuenta" type="text"style="width: 460px;" id="txtCuenta" maxlength="20" onblur="Verificar_Cuenta(this.value);" >
    </td>
  </tr>
  	 
  	 
  	 
	 	<tr>
	    <td valign="top">Observacion: </td>
	    <td align="left"  colspan=3 >
	      <textarea name="txtObservacion"  type="text" id="txtObservacion" style="width: 465px; height: 45px"></textarea>
	    </td>
	 </tr>
	 
	 <tr>
	    <td valign="top"><button onclick="Generar_Clave();">Generar Clave >> </button> </td>
	    <td align="left"  colspan=3 >
	      <input name="txtClave"  type="text" id="txtClave" style="width: 180px;">
	    </td>
	 </tr>
	 
  
</table><br>
<center>
<button name="Solicitar" onclick="Guardar_Solicitud();">Solicitar Servicio</button>
</center>