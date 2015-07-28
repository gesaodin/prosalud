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
			font-size: 14px;
			color: #000;
		}
		tr{
			font-size: 13px;
		}

		.titulo{
			background:#c0d2ed;
			font-size: 13px;
			font-weight: bold;
			color: #000;
			text-align: center;
			height: 20px;
			text-transform: uppercase;
		}
		#letra{
			font-size: 13.5px;
			font-weight: bold;
			color: #000;
		}
		#letra-pie{
			text-align: center;
			font-size: 12.5px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<center>
	
<table width="750px" border="1" style="">
	<tr>
		<td colspan="3">
			<table><tr>
				<td> <img src="<?php echo __IMG__;?>reportes/prosalud.jpg" alt="logo" /></td>
				<td style="width: 200px" valign="bottom"><p style="font-size: 18px;font-weight: bold;color: #000;text-align: center;">
					Compromiso de Egreso</p></td>
					<td style="width: 40px"></td>
				<td valign="top" style="width: 180px"><b>N&uacute;mero de Solicitud: 
					</b><br><?php echo 
						
						$solicitud['codigo'];
					?><br>
					<b>Fecha Emisi&oacute;n: </b><br><?php echo date("d/m/Y",strtotime($ingreso['fechae']));?></b>
				</td>
			</tr></table>	
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Datos Usuarios Titular / Beneficiario / Paciente	</td>
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
	<tr>
		<td colspan="3" class="titulo">Datos del Centro de Salud Prestador Del Servicio</td>
	</tr>
	<tr>
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
	<tr>
	<td colspan="3">
		<b>Analista Del Centro de Salud</b><br>
		<?php echo $solicitud['analista'];?>
	</td>
	</tr>
	<tr>
	<td colspan="3" class="titulo">Datos del Servicio Solicitado</td>
	</tr>
	<tr>
	<td>
		<b>Fecha de Ingreso</b><br>
		 <?php echo date("d/m/Y",strtotime($ingreso['fechaingreso']));?>
		</td>
	<td colspan="2">
		<b>Fecha de Egreso</b><br>
		<?php //print_r($solicitud);
		echo date("d/m/Y",strtotime($ingreso['fechas']));
		?>
	</td>
	<tr>
		<td colspan="3">
			<b>Diagnostico:<b><br>
				<?php echo $ingreso['diagnostico'];?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<b>Tratamiento:<b><br>
				<?php echo $ingreso['tratamiento'];?>
		</td>
	</tr>


	<tr>
	<td colspan="3" class="titulo">Movimiento de Cuenta</td>
	<tr>
	<td>
		<b><?php echo $ingreso['tipof'];?>  Nº </b>
		<?php echo $ingreso['factura'];?>
		</td>
	<td colspan="2">
		<b>Fecha de Emisi&oacute;n</b>	
		<?php echo date("d/m/Y",strtotime($ingreso['fechaf']));?>	
	</td>
	</tr>
	<tr>
	<td>
		<b>Monto Solicitado:&nbsp;</b><?php echo number_format($ingreso['montos'], 2, ",", ".") . ' Bs.';?>
	</td>
		
	<td colspan="2">
		<b>Monto Cubierto: &nbsp;</b> <?php echo  number_format($ingreso['montoc'], 2, ",", ".") . ' Bs.';?><br>
		<b>Monto No Cubierto: &nbsp;</b><?php echo number_format($ingreso['monton'], 2, ",", ".") . ' Bs.';?>
	</td>
	</tr>
	<tr>
		<td colspan="3">
			 <b>Observaciones:</b>
			 <?php echo $ingreso['observacion'];?>
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Grupo Prosalud C.A</p>
		</td>
	</tr>
	<tr>
		<td colspan="3"><font style="font-size:12px ">
			
	<?php 
			
			
			
			$compromiso = 'El presente compromiso tiene una validez de quince (15) d&iacute;as continuos a partir 
				 de su fecha de emisi&oacute;n y';
			if($ingreso['tipoi']=='Emergencia'){$compromiso = 'El presente compromiso';}
			if($ingreso['tipoi']=='Servicio Electivo'){$compromiso = 'El presente compromiso';}
			if($ingreso['tipoc']=='Basico'){
				echo $compromiso .' ampara los gastos hasta por el monto cubierto antes 
				 mencionado, cualquier modificaci&oacute;n que altere alguno de los terminos del informe medico
				 facturaci&oacute;n y gastos presentados para conceder &eacute;ste compromiso de pago, debe ser notificado a <strong>
				 Grupo Prosalud C.A - Departamento de Servicios</strong>, de lo contrario este 
				 compromiso queda nulo y sin efecto. As&iacute; mismo, agradecemos notificar el ingreso 
				 del beneficiario al Centro de Salud para la activaci&oacute;n del ingreso por los 
				 tel&eacute;fonos de la empresa.<br /> Los recaudos para la cancelaci&oacute;n de este compromiso son los 
				 siguientes:<br /> <span><span class="style18">
				 <span id="Recaudos" style="font-weight:normal;">1.- Expediente original que contenga: Facturaci&oacute;n final, desglose de gastos de 
				 material m&eacute;dico - quir&uacute;rgico y medicamentos, informe m&eacute;dico de ingreso y egreso, ex&aacute;menes de laboratorio e 
				 informe de estudios realizados. <br>2.- Factura por el monto a cancelar a nombre de Grupo Prosalud C.A, R.I.F. J-29692106-7. Direcci&oacute;n 
				 fiscal: Calle 25 entre Av. 3 y 4. Edif. "Don Carlos", piso 3, apartamento 3-d. M&eacute;rida - Edo. M&eacute;rida. <br>
				 3.- Planilla de Declaraci&oacute;n de los Servicios de Salud.</span>
				 <br />
				 <strong>Contactos:</strong><br /> Tel&eacute;fonos: 0274-5114641. Fax: 0274-2521284. 
				 Celular: 0416-9845785 / 0414-0938804<br /> Correo electr&oacute;nico: 
				 grupoprosalud.servicios.merida@gmail.com</span></span></font>';
			}else{
				echo $compromiso . 'ampara los gastos hasta por el monto cubierto antes 
				 mencionado, cualquier modificaci&oacute;n que altere alguno de los terminos del informe medico
				 facturaci&oacute;n y gastos presentados para conceder &eacute;ste compromiso de pago, debe ser notificado a <strong>
						 Grupo Prosalud C.A - Departamento de Servicios</strong>, de lo contrario este 
						 compromiso queda nulo y sin efecto. As&iacute; mismo, agradecemos notificar el ingreso 
						 del beneficiario al Centro de Salud para la activaci&oacute;n del ingreso por los 
						 tel&eacute;fonos de la empresa.<br /> Los recaudos para la cancelaci&oacute;n de este compromiso son los 
						 siguientes:<br /> <span><span class="style18">
						 <span id="Recaudos" style="font-weight:normal;">1.- Expediente certificado que contenga: Facturaci&oacute;n final, 
						 desglose de gastos de material m&eacute;dico - quir&uacute;rgico y medicamentos, informe m&eacute;dico de ingreso y egreso, 
						 ex&aacute;menes de laboratorio e informe de estudios realizados. <br>2.- Factura por el monto a cancelar a nombre de 
						 Grupo Prosalud C.A, R.I.F. J-29692106-7. Direcci&oacute;n fiscal: Calle 25 entre Av. 3 y 4. Edif. "Don Carlos", piso 3, 
						 apartamento 3-d. M&eacute;rida - Edo. M&eacute;rida. <br>3.- Planilla de Declaraci&oacute;n de los Servicios de Salud.<br> 
						 4.- Finiquito de seguro primario donde indique el monto cancelado por ellos.</span>
						 <br />
						 <strong>Contactos:</strong><br /> Tel&eacute;fonos: 0274-5114641. Fax: 0274-2521284. 
						 Celular: 0416-9845785 / 0414-0938804<br /> Correo electr&oacute;nico: 
						 grupoprosalud.servicios.merida@gmail.com</span></span>';				
			}?>
		</td>
	</tr>

	<tr>
		<td colspan="3"><center>
			Aprobado por
			<table width="100%">
				<tr>
					<td style="height: 60px" valign="bottom">Abg. Luisany D&iacute;az Biaggi<br>Directora Administrativa</td>
					<td align="right" valign="bottom">Abog. Anais Tibisay Biaggi<br>Coord. General Dpto. Servicios</td>
				</tr>
			</table>
			</center>
		</td>
	</tr>

</table>
</center>
</body>
</html>