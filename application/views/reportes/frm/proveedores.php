<table>
	<tr> 	
		
		<td style='width:90px;'>Estado: </td>
		<td style="width: 100px;" align="left" colspan="5">
			
			<select name="txtEstadoP"	id="txtEstadoP"style="">				
				<option value='0'>TODOS</option>
				<?php
					foreach ($estadosP as $key => $value) {
						echo "<option value='$value'>" . $value . "</option>";
					}
				?>				
			</select>
		</td>		
	</tr>
	<tr>
		<td>Estatus :</td>
		<td>
			<select name="txtTipoP"	id="txtTipoP" style="width: 400px;">
				<option value='TODOS'>TODOS</option>
				<option value='INACTIVO'>INACTIVOS</option>
				<option value='ACTIVO'>ACTIVOS</option>			
				
			</select>
		</td>
	</tr>
	
</table>