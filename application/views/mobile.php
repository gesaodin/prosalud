<?php ?>

<html>
	<head>
		<title> Prosalud Control</title>
		<link href="<?php echo __CSS__ ?>estilo.css" rel="stylesheet" type="text/css">   
		
		<script type="text/javascript" src="<?php echo __JSVIEW__ ?>jquery/jquery-min.js"></script>
		<script type="text/javascript" src="<?php echo __JSVIEW__ ?>general/Global.js"></script>
		<script type="text/javascript" src="<?php echo __JSVIEW__ ?>view/mobile.js"></script> 
	</head>
	<body style="margin: 0 0 0 0">

		<table style="width: 100%" cellpadding="0" cellspacing="0">
		  <tr bgcolor="#045B8E" style="height: 40px">
		    <td align="right"><h1 style="color: #ffffff; font-size: 1.4em">Buscar &nbsp; </h1></td>
		    <td align="right"><input type="text" id="txtConsultar" name="txtConsultar" style="width: 100%;height: 27px"/></td>
		    <td align="left"><button name="btnConsulta" style="height: 27px" onclick="Consultar()">Consultar</button></td>
		  </tr>
		  <tr>
		    <td colspan="3" >
		      <div id="Resultado" name="Resultado" style="padding-left: 5px;"></div>
		      
		    </td>
		  </tr>
		</table>
	</body>

</html>