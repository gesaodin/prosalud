<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	
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
	
<table width="750px" border="1" style="">
	<tr>
		<td colspan="3">
			<table><tr>
				<td> <img src="<?php echo __IMG__;?>reportes/prosalud.jpg" alt="logo" /></td>
				<td style="width: 250px" valign="bottom"><p style="font-size: 18px;font-weight: bold;color: #000;text-align: center;">
					Compromiso de Ingreso</p></td>
					<td style="width: 150px"></td>
				<td valign="top" style="width: 150px"><b>N&uacute;mero de Solicitud: 
					</b><?php echo 
						
						$solicitud['codigo'];
					?><br>
					<b>Fecha Emisi&oacute;n: </b>
					<?php 
						if(!isset($ingreso['fechac'])){
							echo "";
						}else{							
							echo date("d/m/Y",strtotime($ingreso['fechac']));
						}
					?></b>
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
	<tr>
		<td colspan="3" class="titulo">Datos del Centro de Salud Prestador Del Servicio</td>
	</tr>
	<tr>
	<td>
		<b>Centro</b><br>
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
		<b><?php 
    	if(($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo') || ($ingreso['tipos'] == 'Maternidad' && $ingreso['tipoi'] == 'Servicio Electivo')){
    		echo '';
    	}else{
    		echo 'Analista Del Centro de Salud';
    	}
    	?>
			
			</b><br>
			<?php 
    	if(($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo') || ($ingreso['tipos'] == 'Maternidad' && $ingreso['tipoi'] == 'Servicio Electivo')){
    		echo '';
    	}else{
    		echo $solicitud['analista'];
    	}
    	?>
		
	</td>
	</tr>
	<tr>
	<td colspan="3" class="titulo">Datos del Servicio Solicitado</td>
	</tr>
	<tr>
	
	<td>
		<b>Fecha de <?php 
    	if(($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo') || ($ingreso['tipos'] == 'Maternidad' && $ingreso['tipoi'] == 'Servicio Electivo')){
    		echo 'Activacion';
    	}else{
    		echo 'Solicitud';
    	}
    	?>:</b><br>
		<?php 
			if(!isset($ingreso['fechas'])){
				echo "";
			}else{							
				if($ingreso['fechas'] != ''){	
					echo date("d/m/Y",strtotime($ingreso['fechas']));
				}else{
					echo "";
				}					
			}		
		?>
		</td>
	<td colspan="2">
		<b><?php
			if(($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo') || ($ingreso['tipos'] == 'Maternidad' && $ingreso['tipoi'] == 'Servicio Electivo')){
    		echo 'Responsable';
    	}else{
    		echo 'Motivo de Consulta';
    	}
			?>
			</b><br>
		<?php 
			if(($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo') || ($ingreso['tipos'] == 'Maternidad' && $ingreso['tipoi'] == 'Servicio Electivo')){
    		echo $solicitud['analista'];
    	}else{    		
				echo $solicitud['motivo'];
    	}		
		?>
	</td>

	</tr>
	
	<tr>
	<td>
		<b>Tipo de Servicio: </b>	<?php 
				if(!isset($ingreso['tipos'])){
					echo "";
				}else{						
							
					echo $ingreso['tipos'];
				}
		?>
		</td>
	<td colspan="2">
		<b>
			
			<?php 
		
		

    	if(($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo') || ($ingreso['tipos'] == 'Maternidad' && $ingreso['tipoi'] == 'Servicio Electivo')){
					echo "Tipo de Ingreso:";
				}else{						
							
					echo 'Tipo Tratamiento:';
				}
	    	
		
		?>
			 
			
			
			</b><?php 
		
    	if(($ingreso['tipos'] == 'Cirugia' && $ingreso['tipoi'] == 'Servicio Electivo') || ($ingreso['tipos'] == 'Maternidad' && $ingreso['tipoi'] == 'Servicio Electivo')){
    		echo $ingreso['tipoi'];
    	}else{
		
				if(!isset($ingreso['tipot'])){
					echo "";
				}else{						
							
					echo $ingreso['tipot'];
				}
		 	}
    	
		
		?>
	</td>
	</tr>
	<tr>
		<td colspan="3">
			<b>Diagnostico:<b><br>
				<?php 
					if(!isset($ingreso['diagnostico'])){
					echo "";
				}else{						
							
					echo $ingreso['diagnostico'];
				}
		
				?>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<b>Tratamiento:<b><br>
				<?php 
			 
					if(!isset($ingreso['tratamiento'])){
					 	if(!isset($solicitud['tratamiento'])){
							echo "";							
						}else{
						 $solicitud['tratamiento'];							
						}
				}else{
					echo $ingreso['tratamiento'];
				}
		?>
		</td>
	</tr>


	<tr>
	<td colspan="3" class="titulo">Movimiento de Cuenta</td>
	<tr>
	<td>
		<b>Presupuesto N°</b>
		<?php 
			 
				if(!isset($ingreso['factura'])){
					echo "";
				}else{						
							
					echo $ingreso['factura'];
				}	
		
		?>
		</td>
	<td colspan="2">
		<b>Fecha de Emisi&oacute;n</b>	
			<?php 
				if(!isset($ingreso['fechaf'])){
					echo "";
				}else{
					echo date("d/m/Y",strtotime($ingreso['fechaf']));											
					
				}	
		?>	
	</td>
	</tr>
	<tr>
	<td>
		<b>Monto Solicitado:&nbsp;</b><?php 
		if(!isset($ingreso['montos'])){
					echo "";
				}else{										
					echo  number_format($ingreso['montos'], 2, ",", ".") . ' Bs.';;
				}	
		?> 
	</td>
		
	<td colspan="2">
		<b>Monto Cubierto:&nbsp;<?php 
		if(!isset($ingreso['montoc'])){
					echo "";
				}else{										
					echo  number_format($ingreso['montoc'], 2, ",", ".") . ' Bs.';;
				}	
		?></b>
		<br>
		<b>Monto No Cubierto:&nbsp;</b><?php 
			if(!isset($ingreso['monton'])){
					echo "";
				}else{										
					echo number_format($ingreso['monton'], 2, ",", ".") . ' Bs.';
				}			
		?>
	</td>
	</tr>
	<tr>
		<td colspan="3">
			 <b>Observaciones:</b>
			 <?php 
			 	if(!isset($ingreso['observacion'])){
					echo "";
				}else{										
					
			 		echo $ingreso['observacion'];
				}	
			 
			 ?>
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">Grupo Prosalud C.A</td>
	</tr>
	<tr>
		<td colspan="3"><font style="font-size:11px ">
			
			<?php 
			$compromiso = 'El presente compromiso tiene una validez de quince (15) d&iacute;as continuos a partir 
				 de su fecha de emisi&oacute;n y';
			if($ingreso['tipoi']=='Emergencia'){$compromiso = 'El presente compromiso';}
			if($ingreso['tipoc']=='Basico'){
				echo $compromiso .' ampara los gastos hasta por el monto cubierto antes 
				 mencionado, cualquier modificaci&oacute;n del plan o tratamiento, facturaci&oacute;n y gastos 
				 presentados para conceder este compromiso de pago, debe ser notificado a <strong>
				 Grupo Prosalud C.A - Departamento de Servicios</strong>, de lo contrario este 
				 compromiso queda nulo y sin efecto. As&iacute; mismo, agradecemos notificar el ingreso 
				 del beneficiario al Centro de Salud para la activaci&oacute;n del ingreso por los 
				 tel&eacute;fonos de la empresa.<br /> Los recaudos para la cancelaci&oacute;n de este compromiso son los 
				 siguientes:<br /> <span><span class="style18">
				 <span id="Recaudos" style="font-weight:normal;">1.- Expediente original que contenga: Facturaci&oacute;n final, desglose de gastos de material m&eacute;dico - quir&uacute;rgico y medicamentos, informe m&eacute;dico de ingreso y egreso, ex&aacute;menes de laboratorio e informe de estudios realizados. <br>2.- Factura por el monto a cancelar a nombre de Grupo Prosalud C.A, R.I.F. J-29692106-7. Direcci&oacute;n fiscal: Calle 25 entre Av. 3 y 4. Edif. "Don Carlos", piso 3, apartamento 3-d. M&eacute;rida - Edo. M&eacute;rida. <br>3.- Planilla de Declaraci&oacute;n de los Servicios de Salud.</span>
				 <br />
				 <strong>Contactos:</strong><br /> Tel&eacute;fonos: 0274-5114641. Fax: 0274-2521284. 
				 Celular: 0416-9845785 / 0414-0938804<br /> Correo electr&oacute;nico: 
				 grupoprosalud.servicios.merida@gmail.com</span></span></font>';
			}else{
				echo $compromiso . ' ampara los gastos hasta por el monto cubierto antes 
						 mencionado, cualquier modificaci&oacute;n del plan o tratamiento, facturaci&oacute;n y gastos 
						 presentados para conceder este compromiso de pago, debe ser notificado a <strong>
						 Grupo Prosalud C.A - Departamento de Servicios</strong>, de lo contrario este 
						 compromiso queda nulo y sin efecto. As&iacute; mismo, agradecemos notificar el ingreso 
						 del beneficiario al Centro de Salud para la activaci&oacute;n del ingreso por los 
						 tel&eacute;fonos de la empresa.<br /> Los recaudos para la cancelaci&oacute;n de este compromiso son los 
						 siguientes:<br /> <span><span class="style18">
						 <span id="Recaudos" style="font-weight:normal;">1.- Expediente certificado que contenga: Facturaci&oacute;n final, desglose de gastos de material m&eacute;dico - quir&uacute;rgico y medicamentos, informe m&eacute;dico de ingreso y egreso, ex&aacute;menes de laboratorio e informe de estudios realizados. <br>2.- Factura por el monto a cancelar a nombre de Grupo Prosalud C.A, R.I.F. J-29692106-7. Direcci&oacute;n fiscal: Calle 25 entre Av. 3 y 4. Edif. "Don Carlos", piso 3, apartamento 3-d. M&eacute;rida - Edo. M&eacute;rida. <br>3.- Planilla de Declaraci&oacute;n de los Servicios de Salud.<br> 4.- Finiquito de seguro primario donde indique el monto cancelado por ellos.</span>
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