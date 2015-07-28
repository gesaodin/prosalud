<form method="POST" id="frmBuscar" action="<?php echo __LOCALWWW__ ?>/index.php/cooperativa/procesar" name="frmBuscar">
<table border="0" cellpadding="0" cellspacing="0" width="400px" ><tr>
	<td style="width:20px"></td>
	<td  valign="middel"><h1>Grupo ProSalud</h1></td><td style="width:30px"></td>
	<td valign="top">
	<input name="txtBuscar" type="text" value="" 
		onclick="this.value='';" style="width:250px;height:27px" \></td><td valign="top">
	<select name="lstOpcion" style="width:250px;height:27px">
		<option value="Reembolso">Reembolso</option>
		<option value="Hcm">Hcm</option>
		<option value="Laboratorio">Laboratorio</option>
		<option value="Consulta">Consulta</option>
	</select>								
	<button id="buscar"  style="height:27px" onclick="">Consultar</button>								
	</td></tr>
</table>
</form><br>