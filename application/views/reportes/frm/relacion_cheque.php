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
	<center><BR>
	<b>GRUPO PROSALUD, C.A<BR>
	COMPROBANTE DE CHEQUE</b>
<table width="750px" border="1" style="">
	
	<tr class="titulo">
		<td>CONCEPTO</td>
		<td style="width:200px">MONTO</td>
	</tr>
	<tr>
		<?php 
			$suma = 0;
			$nche = $relacion['php'][0]['nche'];
			$fchq = $relacion['php'][0]['fchq'];
			$clin = $relacion['php'][0]['clin'];
			$esta = $relacion['php'][0]['esta'];
			$ciud = $relacion['php'][0]['ciud'];
			$bnc = $relacion['php'][0]['bnc'];
			$autor = $relacion['php'][0]['autor'];
			
			foreach ($relacion as $key => $value) {				
				foreach ($value as $k => $v) {
						echo "<tr><td> FACTURA: <b>" . $v['nfac'] . "</b> POR <b>" . strtoupper($v['caso']) . "</b> A BENEFICIARIO: <B> " . strtoupper($v['bnf']) . "</B>
						
						</td><td align='right'>" . number_format($v['mtot'], 2, ",", ".") . " Bs.</td></tr>";
						$suma += $v['mtot'];
				}
			}
		?>
	</tr>
	<tr bgcolor="#CCCCCC">
			<td>
				<B>MONTO TOTAL A CANCELAR:</B>				
			</td>
			<td align='right'><b>
					<?php 
						echo number_format($suma, 2, ",", ".") . ' Bs.';
					?>
					</b>
			</td>
	</tr>
</table>
<br>

<table width="750px" border="1" style="">
	<tr >
		<td style="width: 120px"><b>NUMERO CHEQUE: </b></td>		
		<td style="text-align: left;"><?php echo $nche; ?></td>				
		<td style="width: 60px"><b>BANCO:</b> </td><td text-align: left;><?php echo $bnc; ?></td>
		<td style="width: 160px"><b>FECHA ELABORACI&Oacute;N:</b> </td><td text-align: left;><?php echo date("d/m/Y", strtotime($fchq)); ?></td>
</table>

<br>
<table width="750px" border="1" style="">
	<tr class="titulo">
		<td style="text-align: center;"><b>PREPARADO: </b></td>			
		<td style="text-align: center;"><b>REVISADO: </b></td>				
		<td style="text-align: center;"><b>APROBADO: </b></td>		
		<td style="text-align: center;"><b>CONTABILIZADO:</b> </td>
	</tr>
	
	<tr>
		<td style="text-align: center;"><?php echo strtoupper($autor); ?></td>				
		<td style="text-align: center;">JUAN C. ESPINOZA.</td>				
		<td style="text-align: center;">JOS&Eacute; ABEL SIERRA.</td>
		<td style="text-align: center;">M.M.Y</td>			
	</tr>
	
	<tr class="titulo">
		<td colspan="2"><b>A FAVOR DE:</b> </td>
		<td colspan="2"><b>RECIBIDO POR:</b> </td>
	</tr>
	
	<tr>
		
		<td colspan="2" valign="top"><?php echo $clin; ?></td>
		<td colspan="2" valign="top"><br><b>FIRMA:</b>&nbsp;&nbsp;&nbsp; ____________________________<BR><BR>
			<b>NOMBRE:</b> ____________________________
			
		</td>
	</tr>
</table>

</body>
</html>