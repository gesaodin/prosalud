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
			font-size: 12px;
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
						Recepci&oacute;n de Facturas Para Reembolsos</p></td>
						<td style="width: 130px"></td>
						<td valign="top"><b>N&uacute;mero de Solicitud: 
						</b><?php echo 						
						$reembolso[0]['codigo'];
						?><br>
						<b>Solicitud: </b><?php echo $reembolso[0]['fechar'];?></b>
					</td>
				</tr>
			</table>	
		</td>
	</tr>
	<tr >
		<td colspan="3" class="titulo">
			Datos Usuarios Titular
			</td>
	</tr>
	<tr style="height: 30px">
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
	
	<tr style="height: 30px">
	<td>
		<b>Contratante</b><br>
		<?php echo $reembolso[0]['contratantes'];?>
	</td>
	<td colspan="2">
		<b>Estado</b><br>
		<?php echo $reembolso[0]['estado'];?>
		</td>
	</tr>
	
	<tr style="height: 30px">
		<td colspan="3">
			<table style="width:100%; height: 100%" border=1 cellpadding="0" cellspacing="0">
				<tr>
					<td><b>Titular de la Cuenta: </b><br>
						<?php echo $reembolso[0]['titularc'];?>						
					</td>
					<td><b>&nbsp;N&uacute;mero de Cuenta:</b><br>
						<?php echo $reembolso[0]['numeroc'];?>
					</td>
					<td><b>&nbsp;Tipo:</b><br>
						<?php echo $reembolso[0]['tipoc'];?>
					</td>
					<td><b>&nbsp;Banco:</b><br>
						<?php echo $reembolso[0]['banco'];?>
					</td>
				</tr>
			</table>
		</td>
	</tr>	
	
	<tr>
		<td colspan="3"  class="titulo">
			Datos del Reclamo
			</td>
	</tr>
	<tr valign="top">
		<td colspan="3">
				
				<table cellpadding="0" cellspacing="0" style="width: 100%" border="1">
					<tr bgcolor="#CCCCCC">
						
						<td>&nbsp;Num. Factura</td>
						<td>&nbsp;Fecha Emision</td>
						<td align="center">Concepto</td>
						<td align="center">Monto</td>
						<td align="center">Tipo</td>
					</tr>
					<?php
						$sum = 0;
						foreach ($reembolso as $sC) {

							echo "<tr>
								
								<td align='right'>" . $sC['numero'] . "&nbsp;</td>
								<td>&nbsp;" . $sC['fechaf'] . "&nbsp;</td>
								<td>&nbsp;" . $sC['concepto'] . "</td>
								<td align='right'>" . number_format($sC['monto'],2,".",",") . " Bs. </td>
								<td align='center'>" . $sC['tipo'] . "</td>
							</tr>";
							$sum += $sC['monto'];
						}
					?>

					<tr>
						<td colspan="3" align="right">Monto total Solicitado: &nbsp;&nbsp;&nbsp;</td>
						<td align="right"><?php echo number_format($sum,2,".",",") . " Bs. ";?></td>
						<td>&nbsp;</td>
					</tr>					
				</table>
				
				
		</td>
	</tr>

	<tr >
		<td colspan="3"  class="titulo">
			Observaci&oacute;n
		</td>
	</tr>
	<tr style="height: 30px">
		<td colspan="3" >
			&nbsp;<?php echo  $reembolso[0]['observacion'];?>
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="top">
			<table width="100%; height: 100%;" border="0">
				<tr>
					<td style="height: 60px" valign="top">Recepci&oacute;n Por <br><?php echo $reembolso[0]['responsable'];?><br>Firma</td>
					<td align="right" valign="top">Solictado Por<br><?php echo $reembolso[0]['nm'];?><br>Firma</td>
				</tr>
			</table>
			<br><br><br><br>
		</td>
	</tr>

</table>
</center>
</body>
</html>