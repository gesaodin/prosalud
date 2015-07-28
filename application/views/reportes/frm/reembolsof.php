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
	
<table width="750px" border="1" style="">
	<tr  style="height: 100px">
		<td colspan="3">
			<table style="height: 100px">
				<tr>
					<td> <img src="<?php echo __IMG__;?>reportes/prosalud.jpg" alt="logo" /></td>
					<td style="width: 200px" valign="bottom"><p style="font-size: 16px;font-weight: bold;color: #000;text-align: center;">
						Solicitud de Reembolsos</p></td>
						<td style="width: 130px"></td>
						<td valign="top"><b>N&uacute;mero de Solicitud: 
						</b><?php echo 						
						$reembolso[0]['codigo'];
						?><br>
						<b>Solicitud: </b><?php echo date("d/m/Y",strtotime($reembolso[0]['fechar']));?></b>
					</td>
				</tr>
			</table>	
		</td>
	</tr>
	<tr>
		<td colspan="3" class="titulo">
			Datos Usuarios Titular
			</td>
	</tr>
	<tr>
	<td>
		<b>Usuatio Titular</b><br>
		<?php echo $reembolso[0]['nm'];?></p>
	</td>
	<td>
		<b>C&eacute;dula</b><br>
		V-<?php echo $reembolso[0]['cedula'];?></p>
	</td>
	<td>
		<b>Tel&eacute;fono</b><br>
		<?php echo $reembolso[0]['telefono'];?></p>
		</td>
	</tr>
	
	<tr>
	<td>
		<b>Contratante</b><br>
		<?php echo $reembolso[0]['contratantes'];?>
	</td>
	<td colspan="2">
		<b>Estado</b><br>
		<?php echo $reembolso[0]['estado'];?>
		</td>
	</tr>
		<tr>
		<td colspan="3">
			<table width="100%" border=1 cellpadding="0" cellspacing="0">
				<tr>
					<td><b>&nbsp;Titular de la Cuenta</b>
						<?php echo $reembolso[0]['titularc'];?>						
					</td>
					<td><b>&nbsp;N&uacute;mero de Cuenta</b>
						<?php echo $reembolso[0]['numeroc'];?>
					</td>
					<td><b>&nbsp;Tipo</b>
						<?php echo $reembolso[0]['tipoc'];?>
					</td>
					<td><b>&nbsp;Banco</b>
						<?php echo $reembolso[0]['banco'];?>
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td colspan="3" class="titulo">
			Datos de Recepcion
			</td>
	</tr>
	<tr>
		<td colspan="3">
				
				<table cellpadding="0" cellspacing="0" style="width: 100%" border="1">
					<tr bgcolor="#CCCCCC">
						<td>Num. Factura</td>
						<td>Fecha Emision</td>
						<td>Concepto</td>
						<td>Monto Solicitado</td>
						<td>Monto Cancelar</td>
						<td>Tipo</td>
					</tr>
					<?php
						$mnt = 0;
						$cub = 0;
						$cubp = 0;
						$exc = 0;
						//$mntDescuento = ;
						foreach ($reembolso as $sC) {

							echo "<tr>
								<td align='right'>" . $sC['numero'] . "</td>
								<td>&nbsp;" . date("d/m/Y",strtotime($sC['fechaf'])) . "</td>
								<td>&nbsp;" . $sC['concepto'] . "</td>
								<td>&nbsp;" . number_format($sC['monto'],2,".",",") . " Bs.</td>
								<td>&nbsp;" . number_format(($sC['cubierto'] * $sC['porcentaje'])/100,2,".",",") . " Bs.</td>
								<td>&nbsp;" . $sC['tipou'][0] . "</td>
							</tr>";
							$exc += $sC['ncubierto'];
							$mnt += $sC['monto'];
							$cub += $sC['cubierto'];
							$cubp += ($sC['cubierto'] * $sC['porcentaje'])/100;
						}
					?>					
				</table>				
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<b>Quien recibe el servicio:</b> <br>
			<b>C&eacute;dula:</b> <?php echo  $reembolso[0]['dependiente'];?>, <b>Nombre del Beneficiario:</b> <?php echo  $reembolso[0]['nmdep'];?> 
		</td>
	</tr>
	
	<tr>		
		<td colspan="3">
			<table cellpadding="0" cellspacing="0" style="width: 100%" border="1">
				<tr class="titulo">
					<td>Total Facturas</td>
					<td>No Cubierto Por Falta de Cobertura</td>
					<td>No Cubierto Por Exclusi&oacute;n</td>
					<td>Monto Cubierto</td>
					<td>Monto A Cancelar</td>
				</tr>
				<tr>					
					<td align="center"><b><?php echo number_format($mnt,2,".",",") . " Bs.";?></b></td>
					<td align="center"><b>
					<?php 
						
						if($mnt > $reembolso[0]['monto_familiar']){
							$ncubierto = $mnt - $reembolso[0]['cubierto'];					
							echo number_format($ncubierto,2,".",",") . " Bs.";
						}else{
							echo "0.00 Bs.";
						}
					
					?></b></td>
					<td align="center"><b><?php echo number_format($exc,2,".",",") . " Bs."?></b></td>
					<td align="center"><b><?php echo number_format($cub,2,".",",") . " Bs."?></b></td>
					<td align="center"><b><?php echo number_format($cubp,2,".",",") . " Bs."?></b></td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	<tr >		

		<td colspan="3">
				<?php 
			
				if($marcador == 'Hcm'){
					echo "<div style='display:none;'>";		
				}else {
					echo "<div>";
				}
			?>
			<table cellpadding="0" cellspacing="0" style="width: 100%" border="1">
					<tr class="titulo">
						<td>Consultas Disponibles</td>
						<!-- <td>Consultas Retenido</td> -->
						<td>Examenes Disponibles</td>
						<!-- <td>Examenes Retenidos</td> -->
					</tr>
					<tr>
						<!-- <td align="center"><?php //echo $reembolso[0]['consultas'] - $reembolso[0]['consultas_usadas'];?></td>	
						<td align="center"><?php //echo $reembolso[0]['consultas_usadas'];?></td>
						<td align="center"><?php //echo $reembolso[0]['laboratorio']- $reembolso[0]['laboratorio_usado'];?></td>
						<td align="center"><?php //echo $reembolso[0]['laboratorio_usado'];?></td> -->
						<td align="center"><?php echo $reembolso[0]['consultas'];?></td>	
						<td align="center"><?php echo $reembolso[0]['laboratorio'];?></td>
					</tr>
					
		</table>			
		</div>
		</td>
	</tr>
	
		<tr>
		<td colspan="3"  class="titulo">
			Observaci&oacute;n
		</td>
	</tr>
	<tr>
		<td colspan="3" >
			&nbsp;<?php echo  $reembolso[0]['observacion'];?>
		</td>
	</tr>
	<tr>
		<td colspan="3"><center>
			<table width="100%">
				<tr>					
					<td align="left" valign="bottom" style="width: 50%" >Procesado Por:<br><br><br><br>
						<?php 
							if($marcador == 'Hcm'){
								echo "Abog. Anais Tibisay Biaggi.<br>Coord. General Dpto. Servicios";	
							}else{
								echo "Abog. Anais Tibisay Biaggi.<br>Coord. General Dpto. Proveedores de Salud<br>En Fecha: " . date("d/m/Y h:m:s");
							}							
						?>
					</td>
					<td style="height: 60px;width: 50%" valign="bottom" align="right">Aprobado Por:<br><br><br><br>
						Abog. Luisany D&iacute;az Biaggi<br>Directora Administrativa</td>
				</tr>
			</table>
			</center>
		</td>
	</tr>

</table>
</center>
</body>
</html>