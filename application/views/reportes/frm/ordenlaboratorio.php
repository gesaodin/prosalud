<html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8" />
	<style type="text/css">
		table{
			background-color: transparent;
			width:700px;
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
					Orden de Laboratorio</p></td>
					<td style="width: 150px"></td>
				<td valign="bottom"><b>N&uacute;mero de Solicitud: </b><?php echo $solicitud['codigo'];?><br>
					<b>Fecha Emisi&oacute;n: </b><?php echo date("d/m/Y");?></b>
				</td>
			</tr></table>	
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Datos Usuarios Titular / Beneficiario / Paciente
			</td>
	</tr>
	<tr>
	<td>
		<b>Usuatio Titular</b><br>
		<?php echo $solicitud['nombre'];?></p>
	</td>
	<td>
		<b>C&eacute;dula</b><br>
		V-<?php echo $solicitud['cedula'];?></p>
	</td>
	<td>
		<b>Tel&eacute;fono</b><br>
		<?php echo $solicitud['telefono'];?></p>
		</td>
	</tr>
	<tr>
	<td>
		<b>Beneficiario</b><br>
		<?php echo $solicitud['nombre_dependiente'];?>
	</td>
	<td>
		<b>C&eacute;dula Beneficiario</b><br>
		V-<?php echo $solicitud['cedula_beneficiario'];?></p>
	</td>
	<td>
		<b>Parentesco</b><br>
		<?php echo "";?></p>
	</td>
	</tr>
	<tr>
	<td>
		<b>Contratante</b><br>
		<?php echo $solicitud['contratantes'];?>
	</td>
	<td colspan="2">
		<b>Estado</b><br>
		<?php echo $solicitud['e'];?>
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Datos del Centro de Salud o Prestador Del Servicio</td>
	</tr>
	<tr>
	<td>
		
		<?php echo $solicitud['centro'];?>
	<td>
		<b>Estado</b><br>
		<?php echo $solicitud['estado'];?>
	</td>
	<td>
		<b>Ciudad</b><br>
		<?php echo $solicitud['ciudad'];?>
	</td>
	</tr>
	
	<tr>
		<td colspan="3" class="titulo">Ex&aacute;menes del Laboratorio Autorizados</td>
	</tr>
	<tr>
		<td colspan="3">
			<p><?php echo $solicitud['examenes'];?>.</p><br>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p><b>Ejecuci&oacute;n de lo ex&aacute;menes de laboratorio</b><br><br>
				En ______________________________, a los ________, d&iacute;as del mes de _________________. de ____________
			</p>
		</td>
		
	</tr>
	
	<tr>
		<td colspan="3" class="titulo">Declaraci&oacute;n de Servicio</td>
	</tr>
	<tr>
		<td colspan="2"><br>
			<p><b>Yo, ______________________________________________________, C.I: _______________, </b><br>
				declaro que he recibido los servicios aqu&iacute; descritos
			</p>
		</td>
		<td valign="top">
			Firma del Usuario
		</td>
	</tr>
		<tr>
		<td colspan="3">
			<p><b>Importante</b><br>
				- La presente orden ampara los gastos por concepto de laboratorio autorizados.<br>
				- El usuario tiene solo cinco (5) d&iacute;as h&aacute;biles para realizarse los examenes autorizados, de los contrario &eacute;sta caducar&aacute;.
				y ser&aacute; descontada del n&uacute;mero de solicitudes anuales.
				<br>
				
			</p>
		</td>
	</tr>
	
	
	
	<tr>
		<td>
			<p><b>Elaborada Por:</b><br>
			<?php //print_r($solicitud);
		echo $solicitud['responsable'];
		?>
		<br><br><br>
		<b>Autorizada Por:</b> <br>
		Abg. Anais T. Biaggi.</p>
		</td>
	<td colspan="2" valign="top" align="center">
		
		<img src="<?php echo __IMG__;?>firma_sello1.png" alt="logo" /><br>
		Firma Autorizada
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p id="letra">Obsercaciones:</p><br><br>
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