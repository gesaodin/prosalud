<?php

class CMenu extends CI_Model {

	function Generar() {
		$item = "";
		$configurar = "";
		$ingresar = "";
		$reembolso = "";
		$laboratorio = "";
		$consulta = "";
		$hcm = "";
		$serviciorl = '';
		$serviciorh = '';

		$reembolsol = '';
		$reembolsoh = '';
		$proveedores = '';
		$she = '';

		$sh = '';
		$sl = '';
		$sc = '';
		$ppp = '';
		$ce = '';
		//Reembolsos Pendientes (HCM/Con/Lab)
		//Define Que tipo es... Cedula|nombre|tipo|Fecha Tentativa|Estatus|Solicitud

		$rp = '';
		$od = '';
		$recepcion = '';
		if ($_SESSION['usuario'] == "luisany" || $_SESSION['usuario'] == "Abel") {
			$configurar = '	<li  id="mconfigurar"><a href="#"><span>Configurar</span></a>
			   		<ul>	
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Renovar"><span>Renovaci&oacute;n de Cobertura</span></a></li>
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Ampliacion"><span>Ampliaci&oacute;n de Cobertura</span></a></li>
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Cargar_Nomina"><span>Cargar Nomina</span></a></li>			   			
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Nuevo_Convenio"><span>Nuevo Convenio</span></a></li>
			   		</ul>	
			   	</li>';
			$ce = '<li class="active" id="smhcm"><a href="' . base_url() . 'index.php/gprosalud/cirugiaelectiva"><span id="iContador">Cirugia Electiva</span></a></li>';
			$ingresar = '<li class="active" id="smingresar"><a href="' . base_url() . 'index.php/gprosalud/registrar_usr"><span>Ingresar/Actualizar Usuario</span></a></li>';
			$ppp = '<li class="active" id="pppagar"><a href="' . base_url() . 'index.php/gprosalud/pppagar"><span>Cuentas Por Pagar</span></a></li>';

			/** ------ **/
			$hcm = '<li class="active" id="smhcm"><a href="' . base_url() . 'index.php/gprosalud/buzon"><span id="iContador">Hcm Emergencia (0)</span></a></li>';
			$reembolsol = '<li class="active" id="smreembolsol"><a href="' . base_url() . 'index.php/gprosalud/reembolsosl/Lab"><span>Reembolsos Laboratorio Consulta</span></a></li>';
			$reembolsoh = '<li class="active" id="smreembolsoh"><a href="' . base_url() . 'index.php/gprosalud/reembolsosh/Hcm"><span>Reembolsos (HCM)</span></a></li>';

			$serviciorh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_remh"><span> + Recepcion Reembolso (HCM)</span></a></li>';
			$serviciorl = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_reml"><span> + Recepcion Reembolso (Lab/Con)</span></a></li>';

			$laboratorio = '<li class="active" id="smlaboratorio"><a href="' . base_url() . 'index.php/gprosalud/laboratorio"><span>Ordenes de Laboratorio</span></a></li>';
			$consulta = '<li class="active" id="smconsulta"><a href="' . base_url() . 'index.php/gprosalud/consulta"><span>Consultas</span></a></li>	';

			$rp = '<li class="active" id="rpendientes"><a href="' . base_url() . 'index.php/gprosalud/reembolsos_pendientes"><span>Reembolsos Pendientes</span></a></li>	';

			$proveedores = '<li  id="mvarios" ><a href="#"><span>Registrar</span></a>		   		
			   		<ul>
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Centros"><span>Centros o Proveedores</span></a></li>
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Contratantes"><span>Contratantes</span></a></li>
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Organismos"><span>Organismos</span></a></li>
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Profesionales"><span>Profesionales</span></a></li>
			   		</ul>
			   </li>';

			$sh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/h"><span>Solicitud (HCM)</span></a></li>';
			$she = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/ce"><span> + Recepcion Cirugia Electiva</span></a></li>';
			$sl = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_con"><span>Solicitud de Consultas</span></a></li>';
			$sc = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_lab"><span>Solicitud de Examenes Laboratorio</span></a></li>';
			$od = '<li class="active" >
			<a href="' . base_url() . 'index.php/gprosalud/odontologia"><span>Solicitud de Odontologia</span></a>
			</li>';
			$recepcion = '<li class="active" id="smingresar"><a href="' . base_url() . 'index.php/gprosalud/recepcionfactura"><span>Recepcion Facturas</span></a></li>';

		} elseif ($_SESSION['usuario'] == "anaisbiaggi" || $_SESSION['usuario'] == "emma" || $_SESSION['usuario'] == "luis" || $_SESSION['usuario'] == "franklin") {
			$ingresar = '<li class="active" id="smingresar"><a href="' . base_url() . 'index.php/gprosalud/registrar_usr"><span>Ingresar/Actualizar Usuario</span></a></li>';	
			$proveedores = '<li  id="mvarios" ><a href="#"><span>Registrar</span></a>		   		
		   		<ul>
		   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Centros"><span>Centros o Proveedores</span></a></li>
		   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Contratantes"><span>Contratantes</span></a></li>
		   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Organismos"><span>Organismos</span></a></li>
		   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/Profesionales"><span>Profesionales</span></a></li>
		   		</ul>
		   </li>';
			/** ------ **/

			$reembolsol = '<li class="active" id="smreembolsol"><a href="' . base_url() . 'index.php/gprosalud/reembolsosl/Lab"><span>Reembolsos Laboratorio Consulta</span></a></li>';

			$od = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/odontologia"><span>Solicitud de Odontologia</span></a></li>';

			$laboratorio = '<li class="active" id="smlaboratorio"><a href="' . base_url() . 'index.php/gprosalud/laboratorio"><span>Ordenes de Laboratorio</span></a></li>';
			$consulta = '<li class="active" id="smconsulta"><a href="' . base_url() . 'index.php/gprosalud/consulta"><span>Consultas</span></a></li>	';

			$sh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/h"><span>Solicitud (HCM)</span></a></li>';

			$sl = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_con"><span>Solicitud de Consultas</span></a></li>';
			$sc = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_lab"><span>Solicitud de Examenes Laboratorio</span></a></li>';
			$serviciorh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_remh"><span> + Recepcion Reembolso (HCM)</span></a></li>';
			$serviciorl = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_reml"><span> + Recepcion Reembolso (Lab/Con)</span></a></li>';

		}

		if ($_SESSION['usuario'] == "anaisbiaggi" || $_SESSION['usuario'] == "luis" || $_SESSION['usuario'] == "emma" || $_SESSION['usuario'] == "franklin") {
			//$ingresar = '<li class="active" id="smingresar"><a href="' . base_url() . 'index.php/gprosalud/registrar_usr"><span>Actualizar Usuario</span></a></li>';
			$hcm = '<li class="active" id="smhcm"><a href="' . base_url() . 'index.php/gprosalud/buzon"><span id="iContador">Hcm Emergencia (0)</span></a></li>';
			$ce = '<li class="active" id="smhcm"><a href="' . base_url() . 'index.php/gprosalud/cirugiaelectiva"><span id="iContador">Hcm Cirugia Electiva</span></a></li>';
			$reembolsoh = '<li class="active" id="smreembolsoh"><a href="' . base_url() . 'index.php/gprosalud/reembolsosh/Hcm"><span>Reembolsos (HCM)</span></a></li>';

			$she = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/ce"><span> + Recepcion Cirugia Electiva</span></a></li>';

		}

		if ($_SESSION['usuario'] == "yuliseth"  || $_SESSION['usuario'] == "aleida") {
			$rp = '<li class="active" id="rpendientes"><a href="' . base_url() . 'index.php/gprosalud/reembolsos_pendientes"><span>Reembolsos Pendientes</span></a></li>	';
			$sh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/h"><span>Solicitud (HCM)</span></a></li>';
			$serviciorh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_remh"><span> + Recepcion Reembolso (HCM)</span></a></li>';
			$serviciorl = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_reml"><span> + Recepcion Reembolso (Lab/Con)</span></a></li>';
			$she = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/ce"><span> + Recepcion Cirugia Electiva</span></a></li>';
			$serviciorh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_remh"><span> + Recepcion Reembolso (HCM)</span></a></li>';
			$ingresar = '<li class="active" id="smingresar"><a href="' . base_url() . 'index.php/gprosalud/registrar_usr"><span>Ingresar/Actualizar Usuario</span></a></li>';
			$recepcion = '<li class="active" id="smingresar"><a href="' . base_url() . 'index.php/gprosalud/recepcionfactura"><span>Recepcion Facturas</span></a></li>';

		}
		if ($_SESSION['usuario'] == "franklin" || $_SESSION['usuario'] == "aleida") {
			$sh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/h"><span>Solicitud (HCM)</span></a></li>';
			$ingresar = '<li class="active" id="smingresar"><a href="' . base_url() . 'index.php/gprosalud/registrar_usr"><span>Ingresar/Actualizar Usuario</span></a></li>';

		}
		if ($_SESSION['usuario'] == "maicepadilla" || $_SESSION['usuario'] == "hectorleon" || $_SESSION['usuario'] == "Andy") {
		
			$sl = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_con"><span>Solicitud de Consultas</span></a></li>';
			$sc = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_lab"><span>Solicitud de Examenes Laboratorio</span></a></li>';
			$serviciorh = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_remh"><span> + Recepcion Reembolso (HCM)</span></a></li>';
			$serviciorl = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_reml"><span> + Recepcion Reembolso (Lab/Con)</span></a></li>';
			$she = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/solicitud_usr/ce"><span> + Recepcion Cirugia Electiva</span></a></li>';
			$od = '<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/odontologia"><span>Solicitud de Odontologia</span></a></li>';
		}

		$mnu = '<div class="cssmenu">
			<ul>
			   <li class="active" id="mbuzon"><span><a href="#">Lo Nuevo</span></a>
			   		<ul>
			   			' . $hcm . $ce . $consulta . $laboratorio . $reembolsoh . $reembolsol . $rp . $recepcion .'		   			
			   			   			
			   		</ul>
			   </li>		
			   <li  id="mcliente"><a href="#"><span>Usuario</span></a>			   		
			   		<ul>
			   			<li class="active" ><a href="' . base_url() . 'index.php/gprosalud/consultar_usuario"><span>Consultar Usuario</span></a></li>			   			
			   			' . $ingresar . '	   			
			   		</ul>
			   </li>
			   <li  id="msolicitud"><a href="#"><span>Servicios</span></a>
			   		<ul>	
			   			' . $sc . $sl . $sh . $od . $serviciorh . $serviciorl . $she . '
			   		</ul>	
			   	</li>
			   ' . $proveedores . '		     
			   <li id="mreporte"><a href="' . base_url() . 'index.php/gprosalud/Reportes"><span>Reportes</span></a>
			   	<ul>
			   	' . $ppp . '
			   	</ul>
			   </li>
			   ' . $configurar . '
			   <li id="msalir"><a href="' . base_url() . 'index.php/gprosalud/logout"><span>Cerrar Session</span></a></li>
			</ul>
			</div>';

		return $mnu;
	}

}
?>