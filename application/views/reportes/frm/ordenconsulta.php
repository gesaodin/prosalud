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
					Orden de Consulta</p></td>
					<td style="width: 150px"></td>
				<td valign="bottom"><b>N&uacute;mero de Solicitud: </b><?php echo $solicitud['codigo'];?><br>
					<b>Fecha Emisi&oacute;n: </b><?php echo date("d/m/Y", strtotime($solicitud['fecha']));?></b>
				</td>
			</tr></table>	
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Datos Usuarios Titular / Beneficiario / Paciente</td>
	</tr>
	<tr>
		<td><b>Usuatio Titular: &nbsp;</b><?php echo $solicitud['nombre'];?></p></td>
		<td><b>C&eacute;dula: &nbsp;</b>V-<?php echo $solicitud['cedula'];?></p></td>
		<td><b>Tel&eacute;fono: &nbsp;</b><?php echo $solicitud['telefono'];?></p></td>
	</tr>
	<tr>
		<td><b>Nombre Beneficiario: &nbsp;</b><?php echo $solicitud['nombre_dependiente'];?></td>
		<td><b>Beneficiario: &nbsp;</b>V-<?php echo $solicitud['cedula_beneficiario'];?></p></td>
		<td><b>Parentesco: &nbsp;</b><?php echo "";?></p></td>
	</tr>
	<tr>
		<td><b>Contratante</b><?php echo $solicitud['contratantes'];?></td>
		<td colspan="2"><b>Estado</b><?php echo $solicitud['e'];?></td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Datos del Centro de Salud y Profesional de la Salud</td>
	</tr>
	<tr>
		<td valign="top"><?php echo $solicitud['centro'] . ': ' . $solicitud['direccioncentro'];?></td><br>
		<td colspan="2" valign="top"><b>Dr(a): <?php echo $solicitud['analista'];?>&nbsp;</b></td>
	</tr>
	
	<tr>
		<td valign="top"><b>Especialidad:</b>&nbsp;<?php echo $solicitud['especialidad'];?>.<br><br><br>	</td>
		<td valign="top"><b>C&eacute;dula:</b>&nbsp;</td>
		<td valign="top"><b>M.P.P.S</b>&nbsp;</td>
	</tr>

	<tr>
		<td colspan="2">
			<p><b>Ejecuci&oacute;n de la Consulta</b><br><br>
				En _________________, a los ________, d&iacute;as del mes de _________________. de _______
			</p>
		</td>
		<td valign="top">
			Firma del Medico
		</td>
	</tr>
	
		<tr>
	<td colspan="3">
		<p id="titulo">Declaraci&oacute;n de Servicio</p>
	</td>
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
				- La presente orden ampara los gastos s&oacute;lo los gastos por concepto de honorarios profesionales generados por consultas especializadas, no ampara
				gastos por estudios ni procedimientos especializados dentro de las consultas.<br>
				- El usuario tiene s&oacute;lo diez (10) d&iacute;as h&aacute;biles para asistir a la consulta autorizada, de los contrario &eacute;sta caducar&aacute;,
				perder&acute; el derecho a la misma y ser&aacute; descontada del n&uacute;mero de consultas anuales.
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
		<br><br><br><br>
		<b>Autorizada Por:</b> <br>
		Abg. Anais T. Biaggi.</p>
		</td>
	<td colspan="2" valign="top" align="center">
		<img src="<?php echo __IMG__;?>firma_sello1.png" alt="logo" /><br>
		Firma Autorizada
		</td>
	</tr>
	
	
		<tr>
		<td><b><i>Para ser llenado por el Centro M&eacute;dico</i></b><br>
			Fecha de aprobaci&oacute;n de la Consulta<br>
			Nombre y Apellido<br>
			Aceptar &eacute;sta planilla sin tachaduras ni enmendaduras<br>
		</td>
		<td colspan="2" valign="top">
		Observaci&oacute;n
		</td>
	</tr>
	<tr>
	

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