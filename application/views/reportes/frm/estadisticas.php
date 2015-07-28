<table>
	<tr> 	
		
		<td style='width:90px;'>Estado: </td>
		<td style="width: 100px;" align="left" colspan="5">
			
			<select name="txtEstadoEs"	id="txtEstadoEs"style="" onblur="Organismos('Es')">				
				<option value='0'>Todos</option>
				<?php
					foreach ($estados as $key => $value) {
						echo "<option value='$value'>" . $value . "</option>";
					}
				?>				
			</select>
		</td>		
	</tr>
	<tr>
		<td>Organismo :</td>
		<td>
			<select name="txtContratanteEs"	id="txtContratanteEs" style="width: 400px;">
				<option value='-----------'>-----------</option>
				
				
			</select>
		</td>
	</tr>
		<tr>
		<td>Estatus :</td>
		<td>
			<select name="txtTipoEs"	id="txtTipoEs" style="width: 400px;">
				
				<option value=0>HCM</option>
				<option value=1>Consultas</option>
				<option value=2>Laboratorios</option>				
				<option value=3>Reembolsos</option>
			</select>
		</td>
	</tr>
	

		<tr>
		<td>Fecha Desde :</td>
		<td>
			<input type='text' id="fecha_desde" style="width: 380px;">
			
		</td>
	</tr>
	
		<tr>
		<td>Fecha Hasta :</td>
		<td>
			<input type='text' id="fecha_hasta" style="width: 380px;">
			
		</td>
	</tr>
	
	
	</table>



		<?php
				/**
				 * Amazonas
				 * FETRAENSEÑANZA
				 */
				 
				 /**
				 * Bolivar
				 * FETRAENSEÑANZA
				 * Sindicato de Trabajadores de la Enseñanza
				 */
				 

				 /**
				 * Carabobo
				 * FETRAENSEÑANZA
				 */
		
			 
				 /**
				 * Guarico
				 * FETRAENSEÑANZA
				 */
				
				/**
				 * Cojedes
				 * FETRAENSEÑANZA
				 * Sindicato de Trabajadores de la Enseñanza
				 * 
				 * 
				 * 
				 * 
				 * 
				 * 				<option value='Todas'>Todas</option>
								<option value='Gobernación de Apure'>Gobernación de Apure</option>
								<option value='Sindicato Único de Trabajadores de la Salud'>Sindicato Único de Trabajadores de la Salud</option>
								<option value='Sindicato de Trabajadores de la Enseñanza'>Sindicato de Trabajadores de la Enseñanza</option>
								<option value='Instituto Autónomo de Infraestructura del Estado Apure'>Instituto Autónomo de Infraestructura del Estado Apure</option>
								<option value='Concejo Municipal de Biruaca'>Concejo Municipal de Biruaca</option>
								<option value='Contraloría Municipal de Biruaca'>Contraloría Municipal de Biruaca</option>
								<option value='Fundación El Niño Simón Biruaca'>Fundación El Niño Simón Biruaca</option>
								<option value='Sindicato de Obreros Educacionales'>Sindicato de Obreros Educacionales</option>
								<option value='FETRAENSEÑANZA'>FETRAENSEÑANZA</option>
				 * 
				 * 
				 */
				 
				 				 
			?>