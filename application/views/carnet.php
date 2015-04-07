<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="charset=utf-8" />
<title><?php echo __TITLE__ ?></title>
<table border="0">
	<tr>
		<td valign="top"  background='<?php echo __IMG__ ?>frontal_web.jpg' style='width:200px; height:293px'>
	
			
			<table border="0">
				<tr style="height: 60px"><td valign="top"></td></tr>
				<tr style="height: 150px"><td valign="top">
						<font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif">
						<b>Usuario Titular</b><br>
						<?php 
							echo $php['nacionalidad'], '-', $php['oid'], '<br>'; 
							echo $php['nombre'], '<br><br><br><br><b>Organismo</b><center><i>';
							echo $php['contratantes'], '</i></center><br>';
							echo '<b>Estado ', $php['estado'], '</b><br>'
						?>	
            		
						</font>
					
				</td></tr>
				<tr style="height: 83px">
					<td valign="top">
							<font style="font-size: 10px; font-family: Arial, Helvetica, sans-serif">
							<B>Tel&eacute;fonos de Emergencia</B><br>
							0416-9845785 / 0414-0938804<br><BR>
							<B>Tel&eacute;fonos de la Oficina Central</B><br>
							0274-5114641 / 0274-2521284
							
							</font>
					</td>
					
				</tr>
			</table>


		</td>
		<td valign="top" background='<?php echo __IMG__ ?>anterior_web.jpg' style='width:200px; height:293px'>

				<table border="0">
					<tr style="height: 60px"><td valign="top"></td></tr>
				<tr style="height: 150px"><td valign="top">
					<font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif">
					<b>Usuarios Dependientes</b><br><br>
					<!--  -->
					<?php 
					if($php['estado'] == "Amazonas"){
						echo 'Conyuge, Padre, Madre e Hijos menores de 25 A&ntilde;os';
					}else{
						$val = $php['dependiente'];
							
						if(count($val)>3){
							echo '</font><font style="font-size: 9px; font-family: Arial, Helvetica, sans-serif"><br>';					
							foreach ($val as $sC) {				
									echo $sC['nombre'], ' (', $sC['parentesco'][0],  ')<br>';								
							}
							}else{
								foreach ($val as $sC) {				
									echo $sC['nombre'], '<br>', $sC['parentesco'],  '<br><br>';	
								
							}
						}
					}
					?>
					
					</font>
					
				</td></tr>
				<tr style="height: 83px">
					<td align="center"  valign="top">
							<font style="font-size: 10px; font-family: Arial, Helvetica, sans-serif">
							El Uso de este carnet esta sujeto a las condiciones establecidas en el contrato
							celebrado entre las partes.
							
							</font><br><br><b>
							<font style="font-size: 11px; font-family: Arial, Helvetica, sans-serif" >
								Tranquilidad Y Servicio Para Su Vida
							</font></b>
					</td>
					
				</tr>
			</table>
			
		</td>
	</tr>
</table>
