<html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	<style type="text/css">
		table{
			background-color: transparent;
			width:750px;
			margin-top:0px;
			margin-left:0px;
			font-family: Arial, Trebuchet MS, Tahoma, Verdana, sans-serif;
			font-size: 12px;
			color: #000;
		}

		.titulo{
			background:#c0d2ed;
			font-size: 11px;
			font-weight: bold;
			color: #000;
			text-align: center;
			height: 20px;
			text-transform: uppercase;
		}
		#letra{
			font-size: 11.5px;
			font-weight: bold;
			color: #000;
		}
		#letra-pie{
			text-align: center;
			font-size: 10px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<center>
<table width="750px" border="1">
		<tr>
		<td colspan="3">
			<table><tr>
				<td> <img src="<?php echo __IMG__;?>reportes/prosalud.jpg" alt="logo" /></td>
				<td style="width: 250px" valign="bottom"><p style="font-size: 18px;font-weight: bold;color: #000;text-align: center;">
					<?php 
					if($modulo == 1){
						echo "Solicitud de Servicio HCM";
						$val = '';
					}else{
						echo "Solicitud de Servicio (Cirugia Electiva)";
						$val = 'style="display: none;"';
					}
					
					
				?></p></td>
					<td style="width: 150px"></td>
				<td valign="bottom"><b>N&uacute;mero Solicitud: </b><br><?php echo $solicitud['codigo'];?><br>
					<b>Fecha Emisi&oacute;n: </b><?php echo date("d/m/Y",strtotime($solicitud['fecha']));?></b>
				</td>
			</tr></table>	
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Datos Usuarios Titular / Beneficiario / Paciente</td>
	</tr>
	<tr>
	<td>
		<b>Usuatio Titular</b><br>
		<?php echo $solicitud['nm'];?></p>
	</td>
	<td>
		<b>C&eacute;dula</b><br>
		V-<?php echo $solicitud['ced'];?></p>
	</td>
	<td>
		<b>Tel&eacute;fono</b><br>
		<?php echo $solicitud['telefono'];?></p>
		</td>
	</tr>
	<tr>
	<td>
		<b>Beneficiario</b><br>
		<?php echo $solicitud['ndep'];?>
	</td>
	<td>
		<b>C&eacute;dula Beneficiario</b><br>
		V-<?php echo $solicitud['cedula_beneficiario'];?></p>
	</td>
	<td>
		<b>Parentesco</b><br>
		<?php echo $solicitud['vinculo'];?></p>
	</td>
	</tr>
	<tr>
	<td>
		<b>Contratante</b><br>
		<?php echo $solicitud['contratantes'];?>
	</td>
	<td colspan="2">
		<b>Estado</b><br>
		<?php echo $solicitud['estado'];?>
		</td>
	</tr>
	<tr <?php echo $val?>>
		<td colspan="3" class="titulo">Datos del Centro de Salud o Prestador Del Servicio</td>
	</tr>
	<tr <?php echo $val?>>
	<td>
		
		<?php echo $solicitud['centro'];?>
	<td>
		<b>Estado</b><br>
		<?php echo $solicitud['e'];?>
	</td>
	<td>
		<b>Ciudad</b><br>
		<?php echo $solicitud['c'];?>
	</td>
	</tr>
	<tr <?php echo $val?>>
	<td colspan="3">
		<b>Analista Del Centro de Salud</b><br>
		<?php echo $solicitud['analista'];?>
	</td>
	</tr>
	<tr>
	<td colspan="3" class="titulo">Datos del Servicio Solicitado</td>
	</tr>
	<tr  <?php echo $val?>>
	<td>
		<b>Fecha de Solicitud</b><br>
		<?php echo date("d/m/Y",strtotime($solicitud['fechae']));?>
		</td>
	<td colspan="2">
		<b>Motivo de Consulta</b><br>
		<?php //print_r($solicitud);
		echo $solicitud['motivo'];
		?>
	</td>
	</tr>
	
	<tr  <?php echo $val?>>
	<td>
		<b>Tipo de Servicio</b><br>
		<?php echo $solicitud['tipos'];?></p>
	</td>
	<td>
		<b>Tipo Tratamiento</b><br>
		<?php echo $solicitud['tipot'];?></p>
	</td>
	<td>
		<b>Tipo Ingreso<br>
		<?php echo $solicitud['tipoi'];?></b>
			
		</td>
	</tr>
<tr>
	<td colspan="3">
		<b>Tratamiento</b><br>
		<?php echo $solicitud['tratamiento'];?>
	</td>
	</tr>

	<tr>
		
		<td colspan="3">
			<?php 
					if($modulo == 1){
						echo "<p>Nosotros, Grupo Prosalud C.A, nos hacemos responsables de los gastos generados por la atenci&oacute;n m&eacute;dica
							prestada al mencionado beneficiario del servicio. La cancelaci&oacute;n de dicho servicio estar&aacute; sujeta al
							presupuesto que emita el Centro de Salud y las pol&iacute;ticas establecidas por la empresa tales como:
							Baremos o convenios con los Centros de Salud y cobertura del usuario.</p>";
					}else{
						echo "<br> 
						<input type='checkbox' />&nbsp;1.- Presupuesto.<br>
						<input type='checkbox' />&nbsp;2.- Informe medico detallado.<br>
						<input type='checkbox' />&nbsp;3.- Examenes de Laboratorio.<br>
						<input type='checkbox' />&nbsp;4.- Estudios.<br>
						<input type='checkbox' />&nbsp;5.- Cedula de Identidad Titula y Beneficiario.<br>
						<input type='checkbox' />&nbsp;6.- En caso de ameritar Otros Documentos (Partida de nacimiento, Carta de Concuvinato, Acta de Matrimonio).<br>
						<input type='checkbox' />&nbsp;7.- Otros.. <input type='text' style='width:450px'>
						";
					}	
		?>
		
		</td>
	</tr>
	<tr>
		<td>
			<?php 
					if($modulo == 1){
						echo '<b></b>Verificado Por:</b><br>';
						echo $solicitud['responsable'];
					}else{
						echo '<b></b>Solicitado Por:</b><br>';
						echo '<b>Cedula:</b> V-' . $solicitud['ced'] . ' <b>Nombre:</b> ' . $solicitud['nm'] . '</p><br>';
						echo '<b></b>Recepcionado Por:</b><br>';
						echo $solicitud['responsable'];
					}	
		?>

		</td>
	<td colspan="2">
		sello...
		<br><br><br><br><br>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p id="letra">Obsercaciones:</p>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p id="letra-pie">
				Calle 25 entre Av. 3 y 4. Edif. Don Carlos, piso 3, apartamento 3 - d. M&eacute;rida - Edo. M&eacute;rida.
			<br>
			RIF: J-29692106-7. Tel&eacute;fonos: 0274- 5114641 / 0416- 9845785. Fax: 0274- 5251284. Correo: 
			<br>
			grupoprosalud.servicios.merida@gmail.com / grupoprosalud@hotmail.com
			</p>
			</td>
	</tr>
</table>
</center>
</body>
</html>