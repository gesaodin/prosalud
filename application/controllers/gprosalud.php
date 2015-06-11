<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

date_default_timezone_set ( 'America/Caracas' );

session_start ();
class GProsalud extends CI_Controller {
	/**
	 *
	 * @see http://www.grupoprosalud.com.ve
	 */
	function __construct() {
		parent::__construct ();
		$this->load->database ();
		$this->load->helper ( 'url' );
		// $this -> load -> library('session');
		$this->load->model ( "grupo/mestados", "MEstados" );
		$this->load->model ( "chat/cusuarios", "CUsuarios" );
		$this->load->model ( "menu/cmenu", "CMenu" );
		$this->load->model ( 'usuario/musuario', 'MUsuario' );
	}
	function index() {
		$this->load->view ( 'login' );
		// phpinfo();
	}
	function verificacion() {
		$gbl = $this->MUsuario->Validar ( $_POST ['txtUsuario'], $_POST ['txtClave'] );
		if ($gbl->activo == true) {
			
			$_SESSION ['usuario'] = $gbl->valor;
			$_SESSION ['nombre'] = $gbl->nombre;
			$strQuery = "UPDATE ts_usuario SET conectado=1 WHERE seudonimo='" . $gbl->valor . "'";
			$this->db->query ( $strQuery );
			$this->principal ();
		} else {
			session_destroy ();
			$this->index ();
		}
	}
	function getUsrConnect() {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$sArr = array (
				'cant' => $this->WFDOC->Cantidad () 
		);
		echo json_encode ( $sArr );
	}
	function principal() {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'principal', $data );
		} else {
			$this->logout ();
		}
	}
	function buzon() {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'buzon', $data );
		} else {
			$this->logout ();
		}
	}
	function cirugiaelectiva() {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'cirugiaelectiva', $data );
		} else {
			$this->logout ();
		}
	}
	function reembolsosh($sMarca) {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'preembolsoh', $data );
		} else {
			$this->logout ();
		}
	}
	function reembolsosl($sMarca) {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'preembolsol', $data );
		} else {
			$this->logout ();
		}
	}
	
	// Hcm Dependientes
	function Listar_Casos() {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$r = $this->WFDOC->Listar_Casos ( $_POST ['id'] );
		print_r ( $r ['json'] );
	}
	function laboratorio() {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'laboratorio', $data );
		} else {
			$this->logout ();
		}
	}
	function consulta() {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'consulta', $data );
		} else {
			$this->logout ();
		}
	}
	function registrar_usr() {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['estados'] = '';
			$data ['menu'] = $this->CMenu->Generar ();
			$data ['estados'] = $this->MEstados->LActivos ();
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			
			$this->load->view ( 'usuario/registrar', $data );
		}else{
			
		}
	}
	function consultar_usuario() {
		$this->MEstados->Listar ();
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'usuario/consultar', $data );
	}
	function solicitud_usr($v = null) {
		$this->MEstados->Listar ();
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['menu'] = $this->CMenu->Generar ();
		
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['quien'] = $v;
		$this->load->view ( 'usuario/solicitud_hcm', $data );
	}
	function solicitud_remh() {
		$this->MEstados->Listar ();
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'usuario/solicitud_reembolso', $data );
	}
	function solicitud_reml() {
		
		$this->MEstados->Listar ();
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'usuario/solicitud_reembolsol', $data );
	}
	function solicitud_con() {
		$this->load->model ( "grupo/mespecialidades", "MEspecialidades" );
		$this->MEspecialidades->Listar ();
		$this->MEstados->Listar ();
		$data ['especialidades'] = $this->MEspecialidades->lstEsp;
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'usuario/solicitud_con', $data );
	}
	function odontologia() {
		$this->load->model ( "grupo/mespecialidades", "MEspecialidades" );
		$this->MEspecialidades->Listar ();
		$this->MEstados->Listar ();
		$data ['especialidades'] = $this->MEspecialidades->lstEsp;
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'usuario/odontologia', $data );
	}
	
	/**
	 * Solicitud de Laboratorio
	 */
	function solicitud_lab() {
		$this->load->model ( "grupo/mperfilexamenes", "MPerfilExamenes" );
		$this->load->model ( "grupo/mespecialidades", "MEspecialidades" );
		$this->MEspecialidades->Listar ();
		$this->MEstados->Listar ();
		$data ['especialidades'] = $this->MEspecialidades->lstEsp;
		$data ['estados'] = $this->MEstados->lstEstados;
		$val = $this->MPerfilExamenes->Listar ();
		$categoria = $this->MPerfilExamenes->ListarCategoria ();
		$data ['perfiles'] = $val ['php'];
		$data ['categoria'] = $categoria ['php'];
		
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'usuario/solicitud_lab', $data );
	}
	function Consultar_Perfil() {
		$this->load->model ( "grupo/mperfilexamenes", "MPerfilExamenes" );
		$val = $this->MPerfilExamenes->Perfil_Examenes ( $_POST ['id'] );
		echo json_encode ( $val );
	}
	function Consultar_Categoria() {
		$this->load->model ( "grupo/mperfilexamenes", "MPerfilExamenes" );
		$val = $this->MPerfilExamenes->Categorias_Examenes ( $_POST ['id'] );
		echo json_encode ( $val );
	}
	function Renovar() {
		$this->MEstados->Listar ();
		$data ['estados'] = $this->MEstados->LActivos ();
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'configurar/renovar', $data );
	}
	function Nuevo_Convenio() {
		$this->MEstados->Listar ();
		$data ['estados'] = $this->MEstados->LActivos ();
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
		$this->load->view ( 'configurar/nuevo_plan', $data );
	}
	
	/**
	 * Se inician los planes y cobertura a su estado inicial
	 */
	function Renovar_Cobertura() {
		$this->load->model ( 'grupo/mcontratacion', 'MContratacion' );
		$this->MContratacion->RCobertura ( $_POST );
		echo "Proceso Exitoso Felicitaciones...<br> !Cobertura Renovada..¡";
	}
	function Consutlar_Cobertura() {
		$this->load->model ( 'grupo/mcontratacion', 'MContratacion' );
		$lst = $this->MContratacion->BCobertura ( $_POST );
		echo $lst ['json'];
	}
	function Listar_Ciudades() {
		$this->MEstados->Buscar ( $_POST ['oid'] );
		$lst ['ciudad'] = $this->MEstados->lstCiudad;
		echo json_encode ( $lst );
	}
	function Listar_Proveedores() {
		$arreglo = $this->MEstados->Proveedores ( $_POST ['estado'], $_POST ['ciudad'] );
		
		$value = array (
				"resultado" => 0,
				"nombres" => $arreglo 
		);
		echo json_encode ( $value );
	}
	function Listar_Contratantes() {
		$this->load->model ( "grupo/mcontratante", "MContratante" );
		$arreglo = $this->MContratante->Listar_Organismos ();
		
		$value = array (
				"resultado" => 0,
				"nombres" => $arreglo 
		);
		echo json_encode ( $value );
	}
	function Consultar_Persona() {
		if (isset ( $_POST ['id'] )) {
			$this->load->model ( "grupo/mpersona", "MPersona" );
			$valor = $this->MPersona->jsPersona ( $_POST ['id'] );
			print_r ( $valor ['json'] );
		} else {
			$this->load->model ( "grupo/mpersona", "MPersona" );
			$valor = $this->MPersona->jsPersona ( '3578175' );
			print_r ( $valor ['json'] );
		}
	}
	function reembolsos_pendientes() {
		$data ['estados'] = '';
		$data ['menu'] = $this->CMenu->Generar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$this->load->view ( 'r_pendientes', $data );
	}
	function ObtenerPendientesTentativos() {
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$lst = $this->MReembolso->ObtenerPendientesTentativos ();
		print_r ( $lst ['json'] );
	}
	function dependiente($iT = null, $iD = null) {
		$this->load->model ( "grupo/mpersona", "MPersona" );
		
		$data ['cedula'] = "";
		$data ['nombre'] = "";
		$data ['nombred'] = "";
		$data ['edad'] = "";
		$data ['cobd'] = "";
		$data ['reted'] = "";
		$data ['estatus'] = "";
		$data ['sexod'] = "";
		$data ['edod'] = "";
		$data ['telefonod'] = "";
		$data ['dependiente'] = "";
		$data ['ano'] = "A&ntilde;o";
		$data ['mes'] = "Mes";
		$data ['dia'] = "Dia";
		$data ['anoi'] = "A&ntilde;o";
		$data ['mesi'] = "Mes";
		$data ['diai'] = "Dia";
		
		$data ['estatus'] = '';
		$data ['act'] = 'Activo';
		$data ['teled'] = '';
		$data ['celd'] = '';
		$data ['parentescod'] = 'Hijo';
		$data ['sexd'] = 'Masculino';
		$valor = $this->MPersona->jsPersona ( $iT );
		$data ['cedula'] = $valor ['php'] ['cedula'];
		$data ['nombre'] = $valor ['php'] ['nombre'];
		$titular = $valor ['php'] ['afiliacion'];
		$data ['titular'] = $titular;
		$data ['Nuevo'] = "X";
		if ($iD != "N") {
			if ($iT != "" && $iD != "") {
				$this->load->model ( "grupo/mdependiente", "MDepende" );
				$depe = $this->MDepende->Cobertura ( $iD );
				$fch = explode ( "-", $depe ['fecha'] );
				$data ['ano'] = $fch [0];
				$data ['mes'] = $fch [1];
				$data ['dia'] = $fch [2];
				
				$fchi = explode ( "-", $depe ['fechai'] );
				$data ['anoi'] = $fchi [0];
				$data ['mesi'] = $fchi [1];
				$data ['diai'] = $fchi [2];
				
				
				$data ['dependiente'] = $iD;
				$data ['nombred'] = $depe ['nombre'];
				$data ['sexd'] = $depe ['sexo'];
				$data ['edad'] = $depe ['edad'];
				$data ['teled'] = $depe ['telefono'];
				$data ['celd'] = $depe ['celular'];
				$data ['direccion'] = $depe ['direccion'];
				$data ['parentescod'] = $depe ['parentesco'];
				$data ['cobd'] = $depe ['monto'];
				$data ['reted'] = $depe ['retenido'];
				$act = "Inactivo";
				if ($depe ['estatus'] == 1) {
					$act = "Activo";
				}
				$data ['estatus'] = $depe ['estatus'];
				$data ['act'] = $act;
			} elseif ($iT != "") {
				$valor = $this->MPersona->jsPersona ( $iT );
				$data ['cedula'] = $valor ['php'] ['cedula'];
				$data ['nombre'] = $valor ['php'] ['nombre'];
			}
		} else {
			/**
			 * Nuevo Afiliado
			 */
			$data ['Nuevo'] = "N";
		}
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$this->load->view ( 'usuario/dependientes', $data );
	}
	function dependientesconsultar($iT = null, $iD = null) {
		$this->load->model ( "grupo/mpersona", "MPersona" );
		
		$data ['cedula'] = "";
		$data ['nombre'] = "";
		$data ['nombred'] = "";
		$data ['cobd'] = "";
		$data ['reted'] = "";
		$data ['estatus'] = "";
		$data ['sexod'] = "";
		$data ['edod'] = "";
		$data ['edad'] = "";
		$data ['telefonod'] = "";
		$data ['dependiente'] = "";
		$data ['ano'] = "A&ntilde;o";
		$data ['mes'] = "Mes";
		$data ['dia'] = "Dia";
		$data ['estatus'] = '';
		$data ['act'] = 'Activo';
		$data ['teled'] = '';
		$data ['celd'] = '';
		
		if ($iT != "" && $iD != "") {
			$this->load->model ( "grupo/mdependiente", "MDepende" );
			$depe = $this->MDepende->Cobertura ( $iD );
			$valor = $this->MPersona->jsPersona ( $iT );
			
			$data ['cedula'] = $valor ['php'] ['cedula'];
			$data ['nombre'] = $valor ['php'] ['nombre'];
			
			$fch = explode ( "-", $depe ['fecha'] );			
			$data ['ano'] = $fch [0];
			$data ['mes'] = $fch [1];
			$data ['dia'] = $fch [2];
			
			$fchi = explode ( "-", $depe ['fechai'] );
			$data ['anoi'] = $fchi [0];
			$data ['mesi'] = $fchi [1];
			$data ['diai'] = $fchi [2];
			
			
			$data ['dependiente'] = $iD;
			$data ['nombred'] = $depe ['nombre'];
			$data ['edad'] = $depe ['edad'];
			$data ['sexd'] = $depe ['sexo'];
			$data ['teled'] = $depe ['telefono'];
			$data ['celd'] = $depe ['celular'];
			$data ['direccion'] = $depe ['direccion'];
			$data ['parentescod'] = $depe ['parentesco'];
			$data ['cobd'] = $depe ['monto'];
			$data ['reted'] = $depe ['retenido'];
			$act = "Inactivo";
			if ($depe ['estatus'] == 1) {
				$act = "Activo";
			}
			$data ['estatus'] = $depe ['estatus'];
			$data ['act'] = $act;
		} elseif ($iT != "") {
			$valor = $this->MPersona->jsPersona ( $iT );
			$data ['cedula'] = $valor ['php'] ['cedula'];
			$data ['nombre'] = $valor ['php'] ['nombre'];
		}
		
		$this->load->view ( 'usuario/dependientesconsultar', $data );
	}
	function Registrar_Titular() {
		$cedula = $_POST ['ced'];
		$afiliacion = array ();
		$titular = array ();
		// print_r($_POST);
		$titular ['nombre'] = $_POST ['nom'];
		$titular ['fecha'] = $_POST ['fecha'];
		$titular ['sexo'] = $_POST ['sex'];
		$titular ['estadocivil'] = $_POST ['edo'];
		$titular ['direccion'] = $_POST ['dir'];
		$titular ['telefono'] = $_POST ['tel'];
		$titular ['obs'] = $_POST ['obs'];
		$titular ['ciud'] = $_POST ['ciudadp'];
		$titular ['esta'] = $_POST ['estadop'];
		$titular ['banco'] = $_POST ['banco'];
		$titular ['cuenta'] = $_POST ['cuenta'];
		$titular ['tcue'] = $_POST ['tcue'];
		$titular ['corr'] = $_POST ['correo'];
		$titular ['domi'] = $_POST ['domi'];
		
		$sC = 'SELECT * FROM td_personas WHERE cedula=' . $cedula . ';';
		$rs = $this->db->query ( $sC );
		if ($rs->num_rows () == 0) {
			$titular ['nacionalidad'] = 'V';
			$titular ['cedula'] = $_POST ['ced'];
			$titular ['nombre'] = $_POST ['nom'];
			$titular ['fecha'] = $_POST ['fecha'];
			$titular ['sexo'] = $_POST ['sex'];
			$titular ['estadocivil'] = $_POST ['edo'];
			$titular ['direccion'] = $_POST ['dir'];
			$titular ['telefono'] = $_POST ['tel'];
			$this->db->insert ( 'td_personas', $titular );
		} else {
			$this->db->where ( 'cedula', $cedula );
			$this->db->update ( 'td_personas', $titular );
		}
		
		// Persona Ubicacion
		$ubicacion ['estado'] = $_POST ['estado'];
		$ubicacion ['ciudad'] = $_POST ['ciudad'];
		$ubicacion ['profesion'] = $_POST ['profesion'];
		$ubicacion ['cargo'] = $_POST ['cargo'];
		$ubicacion ["estatus"] = $_POST ['activo'];
		$sC = 'SELECT * FROM td_personasubicacion WHERE cedula=' . $cedula . ';';
		$rs = $this->db->query ( $sC );
		if ($rs->num_rows () == 0) {
			$ubicacion ['cedula'] = $_POST ['ced'];
			$ubicacion ['ubicacion'] = $_POST ['dirtraba'];
			$ubicacion ['estatus'] = 1;
			$this->db->insert ( 'td_personasubicacion', $ubicacion );
		} else {
			$this->db->where ( 'cedula', $cedula );
			$this->db->update ( 'td_personasubicacion', $ubicacion );
		}
		
		// Personas Contratantes
		$contratante ['contratantes'] = $_POST ['contratantes'];
		$sC = 'SELECT * FROM td_personascontratantes WHERE oid=' . $cedula . ';';
		$rs = $this->db->query ( $sC );
		if ($rs->num_rows () == 0) {
			$contratante ['oid'] = $_POST ['ced'];
			$this->db->insert ( 'td_personascontratantes', $contratante );
		} else {
			$this->db->where ( 'oid', $cedula );
			$this->db->update ( 'td_personascontratantes', $contratante );
		}
		
		$afiliacion ["cobertura"] = $_POST ['ccobertura'];
		$afiliacion ["cobertura_disponible"] = $_POST ['disponible'];
		$afiliacion ["retencion"] = $_POST ['retencion'];
		$afiliacion ["consultas"] = $_POST ['consultad'];
		$afiliacion ["laboratorio"] = $_POST ['examend'];
		$afiliacion ["fecha_activacion"] = $_POST ['activacionf'];
		$afiliacion ["activo"] = $_POST ['activo'];
		$sC = 'SELECT * FROM td_afiliacion WHERE cedula=' . $cedula . ';';
		$rs = $this->db->query ( $sC );
		if ($rs->num_rows () == 0) {
			$afiliacion ["cedula"] = $_POST ['ced'];
			$afiliacion ["tipo_servicio"] = $_POST ['cplan'];
			// Realizar actualizacion Activacion define cuando se inicio un servicio
			$afiliacion ["fecha_activacion"] = $_POST ['crenovacion'];
			$afiliacion ["cobertura"] = $_POST ['ccobertura'];
			$afiliacion ["cobertura_disponible"] = $_POST ['ccobertura'];
			$afiliacion ["retencion"] = 0;
			$afiliacion ["consultas"] = $_POST ['cconsultas'];
			$afiliacion ["consultas_usadas"] = 0;
			$afiliacion ["laboratorio"] = $_POST ['cexamenes'];
			$afiliacion ["laboratorio_usado"] = 0;
			$afiliacion ["monto_familiar"] = $_POST ['cmonto_dependiente'];
			
			$afiliacion ["MT"] = $_POST ['cMT'];
			$afiliacion ["MC"] = $_POST ['cMC'];
			$afiliacion ["LD"] = $_POST ['cLD'];
			$afiliacion ["OR"] = $_POST ['cOR'];
			$afiliacion ["ES"] = $_POST ['cES'];
			$afiliacion ["EE"] = $_POST ['cEE'];
			$afiliacion ["G1"] = $_POST ['cG1'];
			$afiliacion ["G2"] = $_POST ['cG2'];
			$afiliacion ["G3"] = $_POST ['cG3'];
			$afiliacion ["G4"] = $_POST ['cG4'];
			$afiliacion ["consultas_usadas"] = 0;
			$afiliacion ["laboratorio_usado"] = 0;
			$this->db->insert ( 'td_afiliacion', $afiliacion );
		} else {
			$this->db->where ( 'cedula', $cedula );
			$this->db->update ( 'td_afiliacion', $afiliacion );
		}
		
		echo $_POST ['consultad'] . "Proceso Exitoso Felicitaciones...<br> !En hora buena excelente..¡";
	}
	function Registrar_Dependiente() {
		$cedula = $_POST ['ced'];
		$cedula2 = $_POST ['ced2'];
		$afiliacion = array ();
		$titular = array ();
		
		$titular ['nombre'] = $_POST ['nom'];
		$titular ['fecha'] = $_POST ['fec'];
		$titular ['sexo'] = $_POST ['sex'];
		$titular ['telefono'] = $_POST ['tel'];
		$titular ['celular'] = $_POST ['cel'];
		$dependiente ['monto'] = $_POST ['cob'];
		$dependiente ['retenido'] = $_POST ['ret'];
		$dependiente ['estatus'] = $_POST ['act'];
		$dependiente ['parentesco'] = $_POST ['par'];
		$dependiente ['fechai'] = $_POST ['feci'];
		
		
		$sCon = 'SELECT * FROM td_personas WHERE cedula=\'' . $cedula . '\' LIMIT 1';
		
		$rs = $this->db->query ( $sCon );
		
		if ($rs->num_rows () != 0) {
			$this->db->where ( 'cedula', $cedula );
			$this->db->update ( 'td_personas', $titular );
			
			$this->db->where ( 'cedula', $cedula );
			$this->db->update ( 'td_dependientes', $dependiente );
			if ($cedula != $cedula2) {
				// $cambio = array('cedula' => $cedula);
				// $this -> db -> where('cedula', $cedula2);
				// $this -> db -> update('td_dependientes', $cambio);
				// $this -> db -> where('cedula', $cedula2);
				// $this -> db -> update('td_personas', $cambio);
			}
			$sCons = 'SELECT * FROM td_dependientes WHERE titular=\'' . $_POST ['titular'] . '\' AND cedula=\'' . $cedula . '\' LIMIT 1';
			$rss = $this->db->query ( $sCons );
			if ($rss->num_rows () != 0) {
			} else {
				$dependiente ['estatus'] = 1;
				$dependiente ['titular'] = $_POST ['titular'];
				$dependiente ['cedula'] = $_POST ['ced'];
				
				$this->db->insert ( 'td_dependientes', $dependiente );
			}
		} else {
			$titular ['cedula'] = $_POST ['ced'];
			$titular ['nacionalidad'] = 'V';
			$this->db->insert ( 'td_personas', $titular );
			$dependiente ['estatus'] = 1;
			$dependiente ['titular'] = $_POST ['titular'];
			$dependiente ['cedula'] = $_POST ['ced'];
			$this->db->insert ( 'td_dependientes', $dependiente );
		}
		
		echo "Proceso Exitoso Felicitaciones. !En hora buena sos excelente..¡";
	}
	function Listar_Cobertura_Dependiente() {
		$this->load->model ( "grupo/mdependiente", "MDepende" );
		echo json_encode ( $this->MDepende->Cobertura ( $_POST ['oid'] ) );
	}
	function Consultar_Afiliado() {
		if (isset ( $_POST ['id'] )) {
			$this->load->model ( "grupo/mafiliacion", "MAfiliado" );
			$this->MAfiliado->cedula = $_POST ['id'];
			$valor = $this->MAfiliado->Buscar ();
			echo $valor ['json'];
		} else {
			$this->load->model ( "grupo/mafiliacion", "MAfiliado" );
			$this->MAfiliado->cedula = '14811542';
			echo "<pre>";
			$valor = $this->MAfiliado->Buscar ();
			print_r ( $valor ['json'] );
			echo "</pre>";
		}
	}
	function Listar_Especialidades() {
		$this->load->model ( 'grupo/mespecialidades', 'MEspecialidades' );
		$this->MEspecialidades->Buscar ();
		echo "<pre>";
		print_r ( $this->MEspecialidades->lst );
		echo "</pre>";
	}
	function Imprimir_Carnet($id) {
		$this->load->model ( "grupo/mpersona", "MPersona" );
		
		$valor = $this->MPersona->jsPersona ( $id );
		$this->load->view ( 'reportes/carnet', $valor );
	}
	function Estado_Cuenta() {
		if (isset ( $_POST ['id'] )) {
			$this->load->model ( 'grupo/mnomina', 'MNomina' );
			$this->MNomina->cedula = $_POST ['id'];
			$valor = $this->MNomina->Buscar ();
			print_r ( $valor ['json'] );
		} else {
			$this->load->model ( 'grupo/mnomina', 'MNomina' );
			$this->MNomina->cedula = '13325233';
			$valor = $this->MNomina->Buscar ();
			print_r ( $valor ['json'] );
		}
	}
	function Contratantes() {
		$data ['menu'] = $this->CMenu->Generar ();
		$this->load->view ( 'contratante/index', $data );
	}
	function Contratantes_Listar() {
		$this->load->model ( 'grupo/mcontratante', 'MContratante' );
		$lst = $this->MContratante->Listar ();
		print_r ( $lst ['json'] );
	}
	function Proveedores_Listar() {
		$this->load->model ( 'grupo/mproveedor', 'MProveedor' );
		$lst = $this->MProveedor->Listar ( $_POST );
		print_r ( $lst ['json'] );
	}
	function Nominas_Listar_Titulares() {
		$this->load->model ( 'grupo/mnomina', 'MNomina' );
		
		$lst = $this->MNomina->Listar_Titulares ( $_POST );
		print_r ( $lst ['json'] );
	}
	function NL_Dependientes() {
		if (isset ( $_POST ['objeto'] )) {
			$this->load->model ( 'grupo/mnomina', 'MNomina' );
			$arr = json_decode ( $_POST ['objeto'], true );
			$lst = $this->MNomina->Listar_Dependientes ( $arr );
			print_r ( $lst ['json'] );
		} else {
			$this->load->model ( 'grupo/mnomina', 'MNomina' );
			$arr [0] = "10012093";
			$lst = $this->MNomina->Listar_Dependientes ( $arr );
			print_r ( $lst ['json'] );
		}
	}
	function NL_Reembolso() {
		if (isset ( $_POST ['objeto'] )) {
			$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
			$arr = json_decode ( $_POST ['objeto'], true );
			$lst = $this->MReembolso->Obtener_Finales ( $arr );
			print_r ( $lst ['json'] );
		}
	}
	function NL_ReembolsoP() {
		if (isset ( $_POST ['objeto'] )) {
			$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
			$arr = json_decode ( $_POST ['objeto'], true );
			$lst = $this->MReembolso->Obtener_FinalesP ( $arr );
			print_r ( $lst ['json'] );
		} else {
			
			$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
			$arr [0] = "1097322664";
			$lst = $this->MReembolso->Obtener_FinalesP ( $arr );
			print_r ( $lst ['json'] );
		}
	}
	function Centros() {
		if (isset ( $_SESSION ['usuario'] )) {
			// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
			$data ['menu'] = $this->CMenu->Generar ();
			$data ['estados'] = $this->MEstados->LActivosP ();
			$this->load->view ( 'centro/index', $data );
		}
	}
	
	/**
	 * @Guardar Proveedores
	 */
	function Guardar_Proveedor() {
		$this->db->insert ( 'td_proveedores', $_POST );
		echo "Proceso Finalizado";
	}
	function Organismos() {
		$data ['menu'] = $this->CMenu->Generar ();
		$this->load->view ( 'organismo/index', $data );
	}
	function Profesionales() {
		$data ['menu'] = $this->CMenu->Generar ();
		$this->load->view ( 'profesion/index', $data );
	}
	function Reportes() {
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['estados'] = $this->MEstados->LActivos ();
		$data ['estadosP'] = $this->MEstados->LActivosP ();
		$this->load->view ( 'reportes/index', $data );
	}
	function LOrganismos($sEstados) {
		echo json_encode ( $this->MEstados->LOrganismos ( $sEstados ) );
	}
	
	/**
	 * Solicitud de Servicio
	 */
	function Generar_Clave() {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->WFDOC->setCodigo ( rand () );
		echo $this->WFDOC->getCodigo ();
	}
	function Guardar_Solicitud() {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		
		$Doc = new $this->WFDOC ();
		$Doc->codigo = $_POST ['codigo'];
		$Doc->cedula_titular = $_POST ['cedula_titular'];
		$Doc->cedula_beneficiario = $_POST ['cedula_beneficiario'];
		$Doc->centro = $_POST ['centro'];
		$Doc->analista = $_POST ['analista'];
		$Doc->motivo = $_POST ['motivo'];
		$Doc->tratamiento = $_POST ['tratamiento'];
		$Doc->observacion = $_POST ['observacion'];
		$Doc->tipo_ingreso = 1;
		$Doc->estado = $_POST ['estado'];
		$Doc->ciudad = $_POST ['ciudad'];
		$Doc->fecha = $_POST ['fecha'];
		
		$Doc->hora = $_POST ['hora'];
		$Doc->responsable = $_SESSION ['nombre'];
		
		$Doc->tipos = $_POST ['tipos'];
		$Doc->tipoi = $_POST ['tipoi'];
		$Doc->tipot = $_POST ['tipot'];
		$Doc->diagnostico = $_POST ['diag'];
		$Doc->modulo = $_POST ['modulo'];
		$Doc->fechae = $_POST ['fechae'];
		
		$this->db->insert ( 'wt_doc', $Doc );
		$this->load->model ( 'motor/prc/mgwestadoejecucion', 'WFESTADO' );
		$Estado = new $this->WFESTADO ();
		$Estado->codigo = $Doc->codigo;
		$Estado->estado = 0;
		$this->db->insert ( 'wt_estadoejecucion', $Estado );
		
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Solicitud/" . $Doc->codigo . "/" . $Doc->modulo . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $Doc->codigo . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	
	/**
	 * Verificar
	 */
	function Guardar_Consultas() {
		$this->load->model ( 'motor/cls/mgwdoclab', 'WFDOCLAB' );
		
		$Doc = $_POST;
		$Doc ['responsable'] = $_SESSION ['nombre'];
		$Doc ['estatus'] = 0;
		$this->db->insert ( 'wt_doccon', $Doc );
		$this->db->query ( "UPDATE td_afiliacion SET consultas=consultas-" . $Doc ['consultas'] . " WHERE cedula='" . $Doc ['cedula_titular'] . "';" );
		
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_OrdenCon/" . $Doc ['codigo'] . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $Doc ['codigo'] . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	function Quitar_Consultas() {
		$json = json_decode ( $_POST ['objeto'], true );
		
		$codigo = $json [0];
		$titular = $json [1];
		$cantidad = $json [3];
		$dependiente = $json [2];
		
		$sConsulta = 'UPDATE td_afiliacion SET consultas=consultas+' . $cantidad . '  WHERE cedula=\'' . $titular . '\'';
		$rs = $this->db->query ( $sConsulta );
		$sConsulta = 'DELETE FROM wt_doclab  WHERE codigo=\'' . $codigo . '\' LIMIT 1;';
		$rs = $this->db->query ( $sConsulta );
		
		echo "<br><center>En hora buena... Â¡Porceso Exitoso! <br> Titular (" . $json [1] . ")<br>
		
		</center>";
	}
	
	/**
	 * Verificar 2
	 */
	function Verificar_Especialidad() {
		$sCon = "SELECT count(oid) AS cantidad FROM wt_doccon WHERE cedula_titular='" . $_POST ['cedula_titular'] . "' AND especialidad='" . $_POST ['especialidad'] . "';";
		$rs = $this->db->query ( $sCon );
		$rsC = $rs->result ();
		echo $rsC [0]->cantidad;
		// echo "$sCon";
	}
	
	/**
	 * Verificar
	 */
	function Guardar_Laboratorio() {
		$this->load->model ( 'motor/cls/mgwdoclab', 'WFDOCLAB' );
		
		$Doc = new $this->WFDOCLAB ();
		$Doc->codigo = $_POST ['codigo'];
		$Doc->cedula_titular = $_POST ['cedula_titular'];
		$Doc->cedula_beneficiario = $_POST ['cedula_beneficiario'];
		$Doc->centro = $_POST ['centro'];
		
		$Doc->estado = $_POST ['estado'];
		$Doc->ciudad = $_POST ['ciudad'];
		$Doc->fecha = $_POST ['fecha'];
		$Doc->hora = $_POST ['hora'];
		$Doc->observacion = $_POST ['observacion'];
		$Doc->responsable = $_SESSION ['nombre'];
		$Doc->costo = $_POST ['costoe'];
		$Doc->examenes = $_POST ['examenes'];
		$Doc->cantidad = $_POST ['cantidad'];
		$Doc->estatus = 0;
		
		$this->db->insert ( 'wt_doclab', $Doc );
		$this->db->query ( "UPDATE td_afiliacion SET laboratorio=laboratorio-" . $Doc->cantidad . " WHERE cedula='" . $Doc->cedula_titular . "';" );
		
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_OrdenLab/" . $Doc->codigo . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $Doc->codigo . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	function Quitar_Laboratorio() {
		$json = json_decode ( $_POST ['objeto'], true );
		
		$codigo = $json [0];
		$titular = $json [1];
		$cantidad = $json [3];
		$dependiente = $json [2];
		
		$sConsulta = 'UPDATE td_afiliacion SET laboratorio=laboratorio+' . $cantidad . '  WHERE cedula=\'' . $titular . '\'';
		$rs = $this->db->query ( $sConsulta );
		$sConsulta = 'DELETE FROM wt_doclab  WHERE codigo=\'' . $codigo . '\' LIMIT 1;';
		$rs = $this->db->query ( $sConsulta );
		
		echo "<br><center>En hora buena... Â¡Porceso Exitoso! <br> Titular (" . $json [1] . ")<br>
		
		</center>";
	}
	function Guardar_Odontologia() {
		$Doc ['codigo'] = $_POST ['codigo'];
		$Doc ['cedula'] = $_POST ['cedula'];
		$Doc ['beneficiario'] = $_POST ['beneficiario'];
		$Doc ['LD'] = $_POST ['LD'];
		$Doc ['OR'] = $_POST ['OR'];
		$Doc ['ES'] = $_POST ['ES'];
		$Doc ['observacion'] = $_POST ['observacion'];
		$Doc ['responsable'] = $_SESSION ['nombre'];
		
		$this->db->insert ( 'td_odontologia', $Doc );
		$sC = "UPDATE td_afiliacion SET LD=LD-" . $Doc ['LD'] . ",`OR`=`OR`-" . $Doc ['OR'] . ",ES=ES-" . $Doc ['ES'] . " WHERE cedula='" . $Doc ['cedula'] . "';";
		$this->db->query ( $sC );
		
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Odontologia/" . $Doc ['codigo'] . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $Doc ['codigo'] . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	
	/**
	 * Define una marca para Guardar dos tipos
	 * Lab : En caso del departamente de Laboratorio y Consulta
	 * Hcm : En caso de Hopitalizacion y Cirugia
	 */
	function Guardar_Reembolso($marca) {
		$arr = array ();
		
		$lista = explode ( ",", $_POST ['facturas'] );
		foreach ( $lista as $sC ) {
			$sCadena = explode ( "|", $sC );
			$arr ['titular'] = $_POST ['titular'];
			$arr ['codigo'] = $_POST ['codigo'];
			$arr ['fechar'] = $_POST ['fechar'];
			$arr ['numero'] = $sCadena [0];
			$arr ['fechaf'] = $sCadena [1];
			$arr ['concepto'] = $sCadena [2];
			$arr ['monto'] = $sCadena [3];
			$arr ['tipo'] = $sCadena [4];
			$arr ['tipou'] = $sCadena [4];
			
			$arr ['observacion'] = $_POST ['obs'];
			$arr ['titularc'] = $_POST ['titularc'];
			$arr ['numeroc'] = $_POST ['numeroc'];
			$arr ['banco'] = $_POST ['banco'];
			$arr ['tipoc'] = $_POST ['tipoc'];
			$arr ['porcentaje'] = 100;
			$arr ['responsable'] = $_SESSION ['nombre'];
			$arr ['marca'] = $marca;
			$this->db->insert ( "td_reembolso", $arr );
		}
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Reembolso/" . $_POST ['codigo'] . "/" . $marca . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $_POST ['codigo'] . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	function Actualizar_HCM() {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$arr ['codigo'] = $_POST ['codigo'];
		$arr ['tipos'] = $_POST ['tipos'];
		$arr ['tipot'] = $_POST ['tipot'];
		$arr ['tipoi'] = $_POST ['tipoi'];
		$arr ['diagnostico'] = $_POST ['diagnostico'];
		$arr ['tratamiento'] = $_POST ['tratamiento'];
		$arr ['motivo'] = $_POST ['motivo'];
		$arr ['fecha'] = $_POST ['fecha'];
		$arr ['fechae'] = $_POST ['fechae'];
		$arr ['centro'] = $_POST ['centro'];
		$arr ['analista'] = $_POST ['analista'];
		$arr ['estado'] = $_POST ['estado'];
		$arr ['ciudad'] = $_POST ['ciudad'];
		$arr ['responsable'] = $_SESSION ['nombre'];
		
		$this->db->where ( 'codigo', $arr ['codigo'] );
		$this->db->update ( 'wt_doc', $arr );
		
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Solicitud/" . $arr ['codigo'] . "/" . $_POST ['modulo'] . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $arr ['codigo'] . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	function Registrar_Ingreso() {
		$this->load->model ( 'motor/cls/mgwdocingreso', 'WFDOCINGRESO' );
		$this->WFDOCINGRESO->codigo = $_POST ['codigo'];
		$this->WFDOCINGRESO->tipos = $_POST ['tipos'];
		$this->WFDOCINGRESO->tipot = $_POST ['tipot'];
		$this->WFDOCINGRESO->tipoi = $_POST ['tipoi'];
		$this->WFDOCINGRESO->diagnostico = $_POST ['diagnostico'];
		$this->WFDOCINGRESO->factura = $_POST ['factura'];
		$this->WFDOCINGRESO->fechaf = $_POST ['fechaf'];
		$this->WFDOCINGRESO->montos = $_POST ['montos'];
		$this->WFDOCINGRESO->montoc = $_POST ['montoc'];
		$this->WFDOCINGRESO->fechas = $_POST ['fechas'];
		$this->WFDOCINGRESO->fechac = $_POST ['fechae'];
		$this->WFDOCINGRESO->monton = $_POST ['monton'];
		$this->WFDOCINGRESO->tipoc = $_POST ['tipoc'];
		$this->WFDOCINGRESO->tipof = $_POST ['tipof'];
		$this->WFDOCINGRESO->tratamiento = $_POST ['tratamiento'];
		$this->WFDOCINGRESO->observacion = $_POST ['observacion'];
		$this->WFDOCINGRESO->titular = $_POST ['titular'];
		$this->WFDOCINGRESO->beneficiario = $_POST ['dependiente'];
		$this->WFDOCINGRESO->centro = $_POST ['centro'];
		$this->WFDOCINGRESO->analista = $_POST ['analista'];
		$this->WFDOCINGRESO->motivo = $_POST ['motivo'];
		$this->WFDOCINGRESO->estado = $_POST ['estado'];
		$this->WFDOCINGRESO->ciudad = $_POST ['ciudad'];
		$this->WFDOCINGRESO->descuento = $_POST ['descuento'];
		
		$this->WFDOCINGRESO->responsable = $_SESSION ['nombre'];
		
		$sConsulta = 'SELECT codigo,montoc FROM wt_docingreso WHERE codigo=\'' . $_POST ['codigo'] . '\' LIMIT 1';
		$rs = $this->db->query ( $sConsulta );
		$rsC = $rs->result ();
		if ($rs->num_rows () != 0) {
			$arr ['tipos'] = $_POST ['tipos'];
			$arr ['tipot'] = $_POST ['tipot'];
			$arr ['tipoi'] = $_POST ['tipoi'];
			$arr ['diagnostico'] = $_POST ['diagnostico'];
			
			$arr ['fechac'] = $_POST ['fechae'];
			$arr ['tipoc'] = $_POST ['tipoc'];
			$arr ['tipof'] = $_POST ['tipof'];
			$arr ['tratamiento'] = $_POST ['tratamiento'];
			$arr ['observacion'] = $_POST ['observacion'];
			$arr ['titular'] = $_POST ['titular'];
			$arr ['beneficiario'] = $_POST ['dependiente'];
			$arr ['centro'] = $_POST ['centro'];
			$arr ['analista'] = $_POST ['analista'];
			$arr ['motivo'] = $_POST ['motivo'];
			$arr ['estado'] = $_POST ['estado'];
			$arr ['ciudad'] = $_POST ['ciudad'];
			$arr ['descuento'] = $_POST ['descuento'];
			// **** No esta evaluado el cambio de grupo
			
			if ($_SESSION ['usuario'] == "luisany" || $_SESSION ['usuario'] == "Crash") {
				$arr ['factura'] = $_POST ['factura'];
				$arr ['fechaf'] = $_POST ['fechaf'];
				$arr ['montos'] = $_POST ['montos'];
				$arr ['montoc'] = $_POST ['montoc'];
				$arr ['monton'] = $_POST ['monton'];
				$arr ['fechas'] = $_POST ['fechas'];
				$montoi = $rsC [0]->montoc;
				$sConsulta = 'SELECT codigo,montoc FROM wt_docegreso WHERE codigo=\'' . $_POST ['codigo'] . '\' LIMIT 1';
				
				$rsE = $this->db->query ( $sConsulta );
				$rsCE = $rs->result ();
				if ($rsE->num_rows () == 0) {
					if ($this->WFDOCINGRESO->titular == $this->WFDOCINGRESO->beneficiario) {
						/**
						 * En el Caso de HCM != Carabobo
						 */
						if ($this->WFDOCINGRESO->descuento == 'HCM') {
							
							// inicializar todo el servicion en caso de venir por actualizacion y el monto sea diferente
							// aseguramos que el monto anterios sea cero y introduzco los nuevos datos
							$sConsulta = "UPDATE td_afiliacion SET retencion=retencion-" . $montoi . ",
							cobertura_disponible=cobertura_disponible+" . $montoi . "
							WHERE cedula='" . $this->WFDOCINGRESO->titular . "'";
							$this->db->query ( $sConsulta );
							// Actualiza cobertura y retenio a Cero sin este caso
							$retencion = $this->WFDOCINGRESO->montoc;
							$sConsulta = "UPDATE td_afiliacion SET retencion=retencion+" . $retencion . ",
							cobertura_disponible=cobertura_disponible-" . $retencion . "
							WHERE cedula='" . $this->WFDOCINGRESO->titular . "'";
							$this->db->query ( $sConsulta );
						} else {
							/**
							 * En el Caso de Grupos
							 */
							$r = $this->WFDOCINGRESO->descuento;
							// inicializar todo el servicion en caso de venir por actualizacion y el monto sea diferente
							// aseguramos que el monto anterios sea cero y introduzco los nuevos datos
							$sConsulta = "UPDATE td_afiliacion SET " . $r . "R=" . $r . "R-" . $montoi . ",
							" . $r . "=" . $r . "+" . $montoi . "
							WHERE cedula='" . $this->WFDOCINGRESO->titular . "'";
							$this->db->query ( $sConsulta );
							// Actualiza cobertura y retenio a Cero sin este caso
							$retencion = $this->WFDOCINGRESO->montoc;
							$sConsulta = "UPDATE td_afiliacion SET " . $r . "R=" . $r . "R+" . $retencion . ",
							" . $r . "=" . $r . "-" . $retencion . "
							WHERE cedula='" . $this->WFDOCINGRESO->titular . "'";
							$this->db->query ( $sConsulta );
						}
					} else {
						/**
						 * En el Caso de HCM != Carabobo
						 */
						if ($this->WFDOCINGRESO->descuento == 'HCM') {
							$sConsulta = "UPDATE td_dependientes SET retenido=retenido-" . $montoi . ",
							monto=monto+" . $montoi . " WHERE cedula='" . $this->WFDOCINGRESO->beneficiario . "'";
							$this->db->query ( $sConsulta );
							// Actualiza cobertura y retenio a Cero sin este caso
							$retencion = $this->WFDOCINGRESO->montoc;
							$sConsulta = "UPDATE td_dependientes SET retenido=retenido+" . $retencion . ",
							monto=monto-" . $retencion . " WHERE 
							cedula='" . $this->WFDOCINGRESO->beneficiario . "'";
							$this->db->query ( $sConsulta );
						} else {
							/**
							 * En el Caso de Grupos
							 */
							$r = $this->WFDOCINGRESO->descuento;
							$sConsulta = "UPDATE td_dependientes SET  " . $r . "R= " . $r . "R-" . $montoi . ",
							 " . $r . "= " . $r . "+" . $montoi . " WHERE cedula='" . $this->WFDOCINGRESO->beneficiario . "'";
							$this->db->query ( $sConsulta );
							// Actualiza cobertura y retenio a Cero sin este caso
							$retencion = $this->WFDOCINGRESO->montoc;
							$sConsulta = "UPDATE td_dependientes SET  " . $r . "R= " . $r . "R+" . $retencion . ",
							 " . $r . "= " . $r . "-" . $retencion . " WHERE 
							cedula='" . $this->WFDOCINGRESO->beneficiario . "'";
							$this->db->query ( $sConsulta );
						}
					}
				} // Previo carga del El Egreso no actualiza cobertura
			} // En caso de ser autoridades superiores.
			  // Por ultimo actualizo los datos al sistema
			$this->db->where ( 'codigo', $this->WFDOCINGRESO->codigo );
			$this->db->update ( 'wt_docingreso', $arr );
		} else { // Primer Registro Insertando Todos los elementos para el ingreso
			$this->db->insert ( 'wt_docingreso', $this->WFDOCINGRESO );
			$codigo = $this->WFDOCINGRESO->codigo;
			$Estado ['estado'] = 1;
			$this->db->where ( 'codigo', $codigo );
			$this->db->update ( 'wt_estadoejecucion', $Estado );
			if ($this->WFDOCINGRESO->titular == $this->WFDOCINGRESO->beneficiario) {
				/**
				 * En el Caso de HCM != Carabobo
				 */
				if ($this->WFDOCINGRESO->descuento == 'HCM') {
					$retencion = $this->WFDOCINGRESO->montoc;
					$sConsulta = "UPDATE td_afiliacion SET retencion=retencion+" . $retencion . ",
						cobertura_disponible=cobertura_disponible-" . $retencion . "
						WHERE cedula='" . $this->WFDOCINGRESO->titular . "'";
					$this->db->query ( $sConsulta );
				} else {
					/**
					 * En el Caso de Grupos
					 */
					$r = $this->WFDOCINGRESO->descuento;
					$retencion = $this->WFDOCINGRESO->montoc;
					$sConsulta = "UPDATE td_afiliacion SET  " . $r . "R= " . $r . "R+" . $retencion . ",
						 " . $r . "= " . $r . "-" . $retencion . "
						WHERE cedula='" . $this->WFDOCINGRESO->titular . "'";
					$this->db->query ( $sConsulta );
				}
			} else {
				/**
				 * En el Caso de HCM != Carabobo
				 */
				if ($this->WFDOCINGRESO->descuento == 'HCM') {
					$retencion = $this->WFDOCINGRESO->montoc;
					$sConsulta = "UPDATE td_dependientes SET retenido=retenido+" . $retencion . ",
						monto=monto-" . $retencion . " WHERE cedula='" . $this->WFDOCINGRESO->beneficiario . "'";
					$this->db->query ( $sConsulta );
				} else {
					/**
					 * En el Caso de Grupos
					 */
					$r = $this->WFDOCINGRESO->descuento;
					$retencion = $this->WFDOCINGRESO->montoc;
					$sConsulta = "UPDATE td_dependientes SET " . $r . "R=" . $r . "R+" . $retencion . ",
						" . $r . "=" . $r . "-" . $retencion . " WHERE cedula='" . $this->WFDOCINGRESO->beneficiario . "'";
					$this->db->query ( $sConsulta );
				}
			}
		}
		
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Ingreso/" . $this->WFDOCINGRESO->codigo . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $this->WFDOCINGRESO->codigo . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	function Registrar_Egreso() {
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOCEGRESO' );
		$this->WFDOCEGRESO->codigo = $_POST ['codigo'];
		$this->WFDOCEGRESO->tipos = $_POST ['tipos'];
		$this->WFDOCEGRESO->tipot = $_POST ['tipot'];
		$this->WFDOCEGRESO->tipoi = $_POST ['tipoi'];
		$this->WFDOCEGRESO->diagnostico = $_POST ['diagnostico'];
		$this->WFDOCEGRESO->factura = $_POST ['factura'];
		$this->WFDOCEGRESO->fechaf = $_POST ['fechaf'];
		$this->WFDOCEGRESO->montos = $_POST ['montos'];
		$this->WFDOCEGRESO->montoc = $_POST ['montoc'];
		$this->WFDOCEGRESO->fechas = $_POST ['fechas'];
		$this->WFDOCEGRESO->fechae = $_POST ['fechae'];
		$this->WFDOCEGRESO->monton = $_POST ['monton'];
		$this->WFDOCEGRESO->tipoc = $_POST ['tipoc'];
		$this->WFDOCEGRESO->tipof = $_POST ['tipof'];
		$this->WFDOCEGRESO->tratamiento = $_POST ['tratamiento'];
		$this->WFDOCEGRESO->observacion = $_POST ['observacion'];
		$this->WFDOCEGRESO->titular = $_POST ['titular'];
		$this->WFDOCEGRESO->beneficiario = $_POST ['dependiente'];
		$this->WFDOCEGRESO->centro = $_POST ['centro'];
		$this->WFDOCEGRESO->analista = $_POST ['analista'];
		$this->WFDOCEGRESO->estado = $_POST ['estado'];
		$this->WFDOCEGRESO->ciudad = $_POST ['ciudad'];
		
		$this->WFDOCEGRESO->responsable = $_SESSION ['nombre'];
		$this->WFDOCEGRESO->fechaingreso = $_POST ['fechaingreso'];
		$montoe = 0;
		$sConsulta = 'SELECT codigo,montoc FROM wt_docegreso WHERE codigo=\'' . $_POST ['codigo'] . '\'';
		$rs = $this->db->query ( $sConsulta );
		$rsC = $rs->result ();
		if ($rs->num_rows () != 0) {
			$arr ['tipos'] = $_POST ['tipos'];
			$arr ['tipot'] = $_POST ['tipot'];
			$arr ['tipoi'] = $_POST ['tipoi'];
			$arr ['diagnostico'] = $_POST ['diagnostico'];
			
			$arr ['fechas'] = $_POST ['fechas'];
			$arr ['fechae'] = $_POST ['fechae'];
			$arr ['fechaingreso'] = $_POST ['fechaingreso'];
			$arr ['tipoc'] = $_POST ['tipoc'];
			$arr ['tipof'] = $_POST ['tipof'];
			$arr ['tratamiento'] = $_POST ['tratamiento'];
			$arr ['observacion'] = $_POST ['observacion'];
			$arr ['titular'] = $_POST ['titular'];
			$arr ['beneficiario'] = $_POST ['dependiente'];
			$arr ['centro'] = $_POST ['centro'];
			$arr ['analista'] = $_POST ['analista'];
			$arr ['estado'] = $_POST ['estado'];
			$arr ['ciudad'] = $_POST ['ciudad'];
			if ($_SESSION ['usuario'] == "luisany" || $_SESSION ['usuario'] == "Crash") {
				$arr ['factura'] = $_POST ['factura'];
				$arr ['fechaf'] = $_POST ['fechaf'];
				$arr ['montos'] = $_POST ['montos'];
				$arr ['montoc'] = $_POST ['montoc'];
				$arr ['monton'] = $_POST ['monton'];
				$montoe = $rsC [0]->montoc;
				// Monto de Egreso Guardado
				if ($montoe != $this->WFDOCEGRESO->montoc) {
					if ($this->WFDOCEGRESO->titular == $this->WFDOCEGRESO->beneficiario) {
						$sConsulta = "UPDATE td_afiliacion SET retencion=retencion-" . $montoe . ",
						cobertura_disponible=cobertura_disponible+" . $montoe . "
						WHERE cedula='" . $this->WFDOCEGRESO->titular . "'";
						$this->db->query ( $sConsulta );
						// Actualiza cobertura y retenio a Cero sin este caso
						$retencion = $this->WFDOCEGRESO->montoc;
						$sConsulta = "UPDATE td_afiliacion SET retencion=retencion+" . $retencion . ",
						cobertura_disponible=cobertura_disponible-" . $retencion . "
						WHERE cedula='" . $this->WFDOCEGRESO->titular . "'";
						$this->db->query ( $sConsulta );
					} else {
						$sConsulta = "UPDATE td_dependientes SET retenido=retenido-" . $montoe . ",
					monto=monto+" . $montoe . " WHERE cedula='" . $this->WFDOCEGRESO->beneficiario . "'";
						$this->db->query ( $sConsulta );
						// Actualiza cobertura y retenio a Cero sin este caso
						$retencion = $this->WFDOCEGRESO->montoc;
						$sConsulta = "UPDATE td_dependientes SET retenido=retenido+" . $retencion . ",
					monto=monto-" . $retencion . " WHERE 
					cedula='" . $this->WFDOCEGRESO->beneficiario . "'";
						$this->db->query ( $sConsulta );
					} // Fin de Familiar o UD
				}
			} // Fin del usuario autor
			$this->db->where ( 'codigo', $_POST ['codigo'] );
			$this->db->update ( 'wt_docegreso', $arr );
		} else {
			$montoi = 0;
			$sConsulta = 'SELECT codigo,montoc FROM wt_docingreso WHERE codigo=\'' . $_POST ['codigo'] . '\'';
			$rs = $this->db->query ( $sConsulta );
			$rsC = $rs->result ();
			if ($rs->num_rows () != 0) {
				$montoi = $rsC [0]->montoc;
			}
			if ($montoi != $_POST ['montoc']) { // Primera Vez... Cambio El Egreso el monto al del ingreso
				if ($this->WFDOCEGRESO->titular == $this->WFDOCEGRESO->beneficiario) {
					$sConsulta = "UPDATE td_afiliacion SET retencion=retencion-" . $montoi . ",
					cobertura_disponible=cobertura_disponible+" . $montoi . "
					WHERE cedula='" . $this->WFDOCEGRESO->titular . "'";
					$this->db->query ( $sConsulta );
					// Actualiza cobertura y retenio a Cero sin este caso
					$retencion = $this->WFDOCEGRESO->montoc;
					$sConsulta = "UPDATE td_afiliacion SET retencion=retencion+" . $retencion . ",
					cobertura_disponible=cobertura_disponible-" . $retencion . "
					WHERE cedula='" . $this->WFDOCEGRESO->titular . "'";
					$this->db->query ( $sConsulta );
				} else {
					$sConsulta = "UPDATE td_dependientes SET retenido=retenido-" . $montoi . ",
					monto=monto+" . $montoi . " WHERE cedula='" . $this->WFDOCEGRESO->beneficiario . "'";
					$this->db->query ( $sConsulta );
					// Actualiza cobertura y retenio a Cero sin este caso
					$retencion = $this->WFDOCEGRESO->montoc;
					$sConsulta = "UPDATE td_dependientes SET retenido=retenido+" . $retencion . ",
					monto=monto-" . $retencion . " WHERE cedula='" . $this->WFDOCEGRESO->beneficiario . "'";
					$this->db->query ( $sConsulta );
					// echo $sConsulta;
				}
			}
			$this->db->insert ( 'wt_docegreso', $this->WFDOCEGRESO );
		}
		$codigo = $this->WFDOCEGRESO->codigo;
		$Estado ['estado'] = 2;
		$this->db->where ( 'codigo', $codigo );
		$this->db->update ( 'wt_estadoejecucion', $Estado );
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Egreso/" . $this->WFDOCEGRESO->codigo . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $this->WFDOCEGRESO->codigo . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	function Verificacion_Usuario() {
		$json = json_decode ( $_POST ['objeto'], true );
		$doc ['modulo'] = 1;
		$this->db->where ( 'codigo', $json [0] );
		$this->db->update ( 'wt_doc', $doc );
		echo "<br><center>En hora buena... ¡Porceso Exitoso! <br> Traslado por (" . $json [0] . ")<br></a></center>";
	}
	function Registrar_Pendientes_Egresos() {
		$Estado ['estado'] = 3;
		$this->db->where ( 'codigo', $_POST ['codigo'] );
		$this->db->update ( 'wt_estadoejecucion', $Estado );
		echo "<br><center>En hora buena... ¡Porceso Exitoso! <br> Clave (" . $_POST ['codigo'] . ")<br>
		Caso enviado a pendientes</center>";
	}
	function Registrar_EgresoConfirmar() {
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOCEGRESO' );
		$this->WFDOCEGRESO->codigo = $_POST ['codigo'];
		$this->WFDOCEGRESO->tipos = $_POST ['tipos'];
		$this->WFDOCEGRESO->tipot = $_POST ['tipot'];
		$this->WFDOCEGRESO->tipoi = $_POST ['tipoi'];
		$this->WFDOCEGRESO->diagnostico = $_POST ['diagnostico'];
		$this->WFDOCEGRESO->factura = $_POST ['factura'];
		$this->WFDOCEGRESO->fechaf = $_POST ['fechaf'];
		$this->WFDOCEGRESO->montos = $_POST ['montos'];
		$this->WFDOCEGRESO->montoc = $_POST ['montoc'];
		$this->WFDOCEGRESO->fechas = $_POST ['fechas'];
		$this->WFDOCEGRESO->monton = $_POST ['monton'];
		$this->WFDOCEGRESO->tipoc = $_POST ['tipoc'];
		$this->WFDOCEGRESO->tipof = $_POST ['tipof'];
		$this->WFDOCEGRESO->tratamiento = $_POST ['tratamiento'];
		$this->WFDOCEGRESO->observacion = $_POST ['observacion'];
		$this->WFDOCEGRESO->titular = $_POST ['titular'];
		$this->WFDOCEGRESO->beneficiario = $_POST ['dependiente'];
		$this->WFDOCEGRESO->centro = $_POST ['centro'];
		$this->WFDOCEGRESO->analista = $_POST ['analista'];
		$this->WFDOCEGRESO->estado = $_POST ['estado'];
		$this->WFDOCEGRESO->ciudad = $_POST ['ciudad'];
		$this->WFDOCEGRESO->responsable = $_SESSION ['nombre'];
		
		$codigo = $this->WFDOCEGRESO->codigo;
		$this->db->where ( 'codigo', $codigo );
		$this->db->update ( 'wt_docegreso', $this->WFDOCEGRESO );
		
		if ($this->WFDOCEGRESO->titular == $this->WFDOCEGRESO->beneficiario) {
			$retencion ['retencion'] = $this->WFDOCEGRESO->montoc;
			$sConsulta = "UPDATE td_afiliacion SET retencion=retencion-" . $retencion ['retenido'] . "
						WHERE cedula='" . $this->WFDOCEGRESO->titular . "'";
			$this->db->query ( $sConsulta );
		} else {
			$retencion ['retenido'] = $this->WFDOCEGRESO->montoc;
			$sConsulta = "UPDATE td_dependientes SET retenido=retenido-" . $retencion ['retenido'] . "
			 		WHERE cedula='" . $this->WFDOCEGRESO->beneficiario . "'";
			$this->db->query ( $sConsulta );
		}
		
		$Estado ['estado'] = 4;
		$this->db->where ( 'codigo', $codigo );
		$this->db->update ( 'wt_estadoejecucion', $Estado );
		echo "<br><center><a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Egreso/" . $this->WFDOCEGRESO->codigo . "' target='top'>
		En hora buena... ¡Porceso Exitoso! <br> Clave (" . $this->WFDOCEGRESO->codigo . ")<br>
		Imprimir tu solicitud</a></center>";
	}
	function Modificar_HCM($sClave, $sTitular, $sBeneficio) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->MEstados->Listar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['estados'] = $this->MEstados->lstEstados;
		
		$data ['ingreso'] = $this->WFDOC->ObtenerDoc ( $sClave );
		
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['titular'] = $sTitular;
		$data ['dependiente'] = $sBeneficio;
		$data ['codigo'] = $sClave;
		
		if ($sBeneficio == $sTitular) {
			$this->load->model ( 'grupo/mafiliacion', 'MAfilician' );
			$this->load->model ( 'grupo/mpersona', 'MPersona' );
			$this->MPersona->Cargar ( $sTitular );
			$this->MAfilician->cedula = $sTitular;
			$lst = $this->MAfilician->Buscar ();
			$data ['nombre'] = $this->MPersona->nombre;
			$data ['retenido'] = $lst ['php'] ['retencion'];
			$data ['tipo'] = "U.T";
			$data ['cobertura'] = $lst ['php'] ['cobertura_disponible'];
		} else {
			$this->load->model ( 'grupo/mdependiente', 'MDependiente' );
			$data ['tipo'] = "U.D";
			$lst = $this->MDependiente->Cobertura ( $sBeneficio );
			$data ['retenido'] = $lst ['retenido'];
			$data ['nombre'] = $lst ['nombre'];
			$data ['cobertura'] = $lst ['monto'];
		}
		
		$this->load->view ( 'solicitud/frm/modificar_hcm', $data );
	}
	function Ingreso($sClave, $sTitular, $sBeneficio, $tipo = null) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		if ($tipo == "Ambulatorio") {
			$this->Egreso ( $sClave, $sTitular, $sBeneficio );
		} else {
			$this->MEstados->Listar ();
			// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
			$data ['menu'] = $this->CMenu->Generar ();
			$data ['estados'] = $this->MEstados->lstEstados;
			$sConsulta = 'SELECT codigo FROM wt_docingreso WHERE codigo=\'' . $sClave . '\'';
			$rs = $this->db->query ( $sConsulta );
			$rsC = $rs->result ();
			if ($rs->num_rows () != 0) {
				$this->load->model ( 'motor/cls/mgwdocingreso', 'WFDOINGRESO' );
				$data ['ingreso'] = $this->WFDOINGRESO->Buscar ( $sClave );
			} else {
				$data ['ingreso'] ['tipof'] = '';
				$data ['ingreso'] ['facturas'] = '';
				$data ['ingreso'] ['factura'] = '';
				$data ['ingreso'] ['fechaf'] = '';
				$data ['ingreso'] ['montos'] = '';
				$data ['ingreso'] ['montoc'] = '';
				$data ['ingreso'] ['monton'] = '';
				
				$data ['ingreso'] = $this->WFDOC->ObtenerDoc ( $sClave );
			}
			
			$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
			$data ['titular'] = $sTitular;
			$data ['dependiente'] = $sBeneficio;
			$data ['codigo'] = $sClave;
			$this->load->model ( 'grupo/mpersona', 'MPersona' );
			$prs = $this->MPersona->jsPersona ( $sTitular );
			// print_r($prs['php']['estado']);
			/**
			 * *
			 * ALTER TABLE `wt_docingreso` ADD `descuento` VARCHAR( 32 ) NOT NULL COMMENT 'Descontar Por HCM/G1,2,3,4'
			 */
			if ($prs ['php'] ['estado'] == 'Carabobo') {
				$data ['descuento'] = array (
						'G1' => 'Grupo 1',
						'G2' => 'Grupo 2',
						'G3' => 'Grupo 3',
						'G4' => 'Grupo 4' 
				);
			} else {
				$data ['descuento'] = array (
						'HCM' => 'HCM' 
				);
			}
			if ($sBeneficio == $sTitular) {
				$this->load->model ( 'grupo/mafiliacion', 'MAfilician' );
				$this->load->model ( 'grupo/mpersona', 'MPersona' );
				$this->MPersona->Cargar ( $sTitular );
				$this->MAfilician->cedula = $sTitular;
				$lst = $this->MAfilician->Buscar ();
				$data ['nombre'] = $this->MPersona->nombre;
				$data ['retenido'] = $lst ['php'] ['retencion'];
				$data ['tipo'] = "U.T";
				$data ['cobertura'] = $lst ['php'] ['cobertura_disponible'];
			} else {
				$this->load->model ( 'grupo/mdependiente', 'MDependiente' );
				$data ['tipo'] = "U.D";
				$lst = $this->MDependiente->Cobertura ( $sBeneficio );
				$data ['retenido'] = $lst ['retenido'];
				$data ['nombre'] = $lst ['nombre'];
				$data ['cobertura'] = $lst ['monto'];
			}
			$this->load->view ( 'solicitud/frm/ingreso', $data );
		}
	}
	function Egreso($sClave, $sTitular, $sBeneficio) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->load->model ( 'motor/cls/mgwdocingreso', 'WFDOINGRESO' );
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOEGRESO' );
		$this->MEstados->Listar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['ingreso'] = $this->WFDOINGRESO->Buscar ( $sClave );
		$data ['egreso'] = $this->WFDOEGRESO->Buscar ( $sClave );
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['titular'] = $sTitular;
		
		$data ['dependiente'] = $sBeneficio;
		$data ['codigo'] = $sClave;
		$data ['modulo'] = "Egreso";
		$this->load->model ( 'grupo/mpersona', 'MPersona' );
		$prs = $this->MPersona->jsPersona ( $sTitular );
		
		/**
		 * *
		 * ALTER TABLE `wt_docingreso` ADD `descuento` VARCHAR( 32 ) NOT NULL COMMENT 'Descontar Por HCM/G1,2,3,4'
		 */
		if ($prs ['php'] ['estado'] == 'Carabobo') {
			$data ['descuento'] = array (
					'G1' => 'Grupo 1',
					'G2' => 'Grupo 2',
					'G3' => 'Grupo 3',
					'G4' => 'Grupo 4' 
			);
		} else {
			$data ['descuento'] = array (
					'HCM' => 'HCM' 
			);
		}
		if ($sBeneficio == $sTitular) {
			$this->load->model ( 'grupo/mafiliacion', 'MAfilician' );
			$this->load->model ( 'grupo/mpersona', 'MPersona' );
			$this->MPersona->Cargar ( $sTitular );
			$lst = $this->MAfilician->Buscar ( $sTitular );
			$data ['nombre'] = $this->MPersona->nombre;
			$data ['retenido'] = $lst ['php'] ['retencion'];
			$data ['tipo'] = "U.T";
			$data ['cobertura'] = $lst ['php'] ['cobertura_disponible'];
		} else {
			$this->load->model ( 'grupo/mdependiente', 'MDependiente' );
			$data ['tipo'] = "U.D";
			$lst = $this->MDependiente->Cobertura ( $sBeneficio );
			$data ['retenido'] = $lst ['retenido'];
			$data ['nombre'] = $lst ['nombre'];
			$data ['cobertura'] = $lst ['monto'];
		}
		$this->load->view ( 'solicitud/frm/egreso', $data );
	}
	function Egresos_Pendientes($sClave, $sTitular, $sBeneficio) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOEGRESO' );
		$this->MEstados->Listar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['ingreso'] = $this->WFDOEGRESO->Buscar ( $sClave );
		
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['titular'] = $sTitular;
		
		$data ['dependiente'] = $sBeneficio;
		$data ['codigo'] = $sClave;
		$data ['modulo'] = "Pendientes";
		
		if ($sBeneficio == $sTitular) {
			$this->load->model ( 'grupo/mafiliacion', 'MAfilician' );
			$this->load->model ( 'grupo/mpersona', 'MPersona' );
			$this->MPersona->Cargar ( $sTitular );
			$lst = $this->MAfilician->Buscar ( $sTitular );
			$data ['nombre'] = $this->MPersona->nombre;
			$data ['retenido'] = $lst ['php'] ['retencion'];
			$data ['tipo'] = "U.T";
			$data ['cobertura'] = $lst ['php'] ['cobertura_disponible'];
		} else {
			$this->load->model ( 'grupo/mdependiente', 'MDependiente' );
			$data ['tipo'] = "U.D";
			$lst = $this->MDependiente->Cobertura ( $sBeneficio );
			$data ['retenido'] = $lst ['retenido'];
			$data ['nombre'] = $lst ['nombre'];
			$data ['cobertura'] = $lst ['monto'];
		}
		$this->load->view ( 'solicitud/frm/egreso', $data );
	}
	function Egresos_Confirmar($sClave, $sTitular, $sBeneficio) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOEGRESO' );
		$this->MEstados->Listar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['ingreso'] = $this->WFDOEGRESO->Buscar ( $sClave );
		
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['titular'] = $sTitular;
		
		$data ['dependiente'] = $sBeneficio;
		$data ['codigo'] = $sClave;
		$data ['modulo'] = "Confirmar";
		
		if ($sBeneficio == $sTitular) {
			$this->load->model ( 'grupo/mafiliacion', 'MAfilician' );
			$this->load->model ( 'grupo/mpersona', 'MPersona' );
			$this->MPersona->Cargar ( $sTitular );
			$lst = $this->MAfilician->Buscar ( $sTitular );
			$data ['nombre'] = $this->MPersona->nombre;
			$data ['retenido'] = $lst ['php'] ['retencion'];
			$data ['tipo'] = "U.T";
			$data ['cobertura'] = $lst ['php'] ['cobertura_disponible'];
		} else {
			$this->load->model ( 'grupo/mdependiente', 'MDependiente' );
			$data ['tipo'] = "U.D";
			$lst = $this->MDependiente->Cobertura ( $sBeneficio );
			$data ['retenido'] = $lst ['retenido'];
			$data ['nombre'] = $lst ['nombre'];
			$data ['cobertura'] = $lst ['monto'];
		}
		$this->load->view ( 'solicitud/frm/egreso', $data );
	}
	function Confirmar($sClave, $sTitular, $sBeneficio) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOCEGRESO' );
		$this->MEstados->Listar ();
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['ingreso'] = $this->WFDOCEGRESO->Buscar ( $sClave );
		
		$data ['estados'] = $this->MEstados->lstEstados;
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['titular'] = $sTitular;
		
		$data ['dependiente'] = $sBeneficio;
		$data ['codigo'] = $sClave;
		
		if ($sBeneficio == $sTitular) {
			$this->load->model ( 'grupo/mafiliacion', 'MAfilician' );
			$this->load->model ( 'grupo/mpersona', 'MPersona' );
			$this->MPersona->Cargar ( $sTitular );
			$lst = $this->MAfilician->Buscar ( $sTitular );
			$data ['nombre'] = $this->MPersona->nombre;
			$data ['retencion'] = $this->MAfilician->retencion;
			$data ['tipo'] = "U.T";
			
			$data ['cobertura'] = $lst ['cobertura_disponible'];
		} else {
			$this->load->model ( 'grupo/mdependiente', 'MDependiente' );
			$data ['tipo'] = "U.D";
			$lst = $this->MDependiente->Cobertura ( $sBeneficio );
			$data ['retenido'] = $lst ['retenido'];
			$data ['nombre'] = $lst ['nombre'];
			$data ['cobertura'] = $lst ['monto'];
		}
		$this->load->view ( 'solicitud/frm/confirmar', $data );
	}
	function Confirmar_Egreso() {
		$arr ['codigo'] = $_POST ['codigo'];
		$arr ['factura'] = $_POST ['factura'];
		$arr ['fechaf'] = $_POST ['fechaf'];
		$arr ['montos'] = $_POST ['montos'];
		$arr ['montoc'] = $_POST ['montoc'];
		$arr ['monton'] = $_POST ['monton'];
		$arr ['titular'] = $_POST ['titular'];
		$arr ['beneficiario'] = $_POST ['dependiente'];
		
		if ($arr ['titular'] == $arr ['beneficiario']) {
			$this->load->model ( 'grupo/mafiliacion', 'MAfilician' );
			$this->MAfilician->Actualizar ( $arr );
		} else {
			$this->load->model ( 'grupo/mdependiente', 'MDependiente' );
			$this->MDependiente->Actualizar ( $arr );
		}
		$this->db->insert ( 'wt_docconfirmar', $arr );
		$codigo = $arr ['codigo'];
		$Estado ['estado'] = 3;
		$this->db->where ( 'codigo', $codigo );
		$this->db->update ( 'wt_estadoejecucion', $Estado );
		echo "<br><center>En hora buena te felicito... <br>¡Porceso Exitoso! <br> Clave (" . $arr ['codigo'] . ")<br></a></center>";
	}
	function Confirmar_HCM() {
		$json = json_decode ( $_POST ['objeto'], true );
		$titular = $json [1];
		$beneficiario = $json [2];
		$sConsulta = 'SELECT codigo,montoc FROM wt_docegreso WHERE codigo=\'' . $json [0] . '\'';
		$rs = $this->db->query ( $sConsulta );
		$rsC = $rs->result ();
		if ($rs->num_rows () != 0) {
			
			if ($titular == $beneficiario) {
				$sConsulta = "UPDATE td_afiliacion SET retencion=retencion-" . $rsC [0]->montoc . "
				WHERE cedula='" . $titular . "'";
				$this->db->query ( $sConsulta );
			} else {
				$sConsulta = "UPDATE td_dependientes SET retenido=retenido-" . $rsC [0]->montoc . "
				WHERE cedula='" . $beneficiario . "'";
				$this->db->query ( $sConsulta );
			}
		}
		$Estado ['estado'] = 4;
		$this->db->where ( 'codigo', $json [0] );
		$this->db->update ( 'wt_estadoejecucion', $Estado );
		echo "<br><center>En hora buena te felicito... <br>¡Porceso Exitoso! <br> Clave (" . $json [0] . ") Confirmado.<br></a></center>";
	}
	function Imprimir_OrdenLab($sClave = null) {
		$this->load->model ( 'motor/cls/mgwdoclab', 'WFDOCLAB' );
		$data ['solicitud'] = $this->WFDOCLAB->Buscar ( $sClave );
		$this->load->view ( 'reportes/frm/ordenlaboratorio', $data );
	}
	function Imprimir_Odontologia($sClave = null) {
		$this->load->model ( 'motor/cls/mgwdoclab', 'WFDOCLAB' );
		$data ['solicitud'] = $this->WFDOCLAB->BuscarOdontologia ( $sClave );
		$this->load->view ( 'reportes/frm/odontologia', $data );
	}
	function Imprimir_OrdenCon($sClave = null) {
		$this->load->model ( 'motor/cls/mgwdoccon', 'WFDOCCON' );
		$data ['solicitud'] = $this->WFDOCCON->Buscar ( $sClave );
		$this->load->view ( 'reportes/frm/ordenconsulta', $data );
	}
	function Imprimir_Todos($sClave = null, $tipo = null, $val = null) {
		$t = 'Imprimir_' . $tipo;
		if ($tipo == 'Solicitud') {
			$this->$t ( $sClave, $val );
		} elseif ($tipo == 'Por%20Confirmar') {
			$t = 'Imprimir_Egreso';
			$this->$t ( $sClave );
		} elseif ($tipo == 'Pagado') {
			$t = 'Imprimir_Egreso';
			$this->$t ( $sClave );
		} else {
			$this->$t ( $sClave );
		}
	}
	function Imprimir_Solicitud($sClave = null, $val = null) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['modulo'] = $val;
		$this->load->view ( 'reportes/frm/solicitudes', $data );
	}
	function Imprimir_Ingreso($sClave = null) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->load->model ( 'motor/cls/mgwdocingreso', 'WFDOCINGRESO' );
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['ingreso'] = $this->WFDOCINGRESO->Buscar ( $sClave );
		
		$this->load->view ( 'reportes/frm/ingresos', $data );
	}
	function Imprimir_Egreso($sClave = null) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOCEGRESO' );
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['ingreso'] = $this->WFDOCEGRESO->Buscar ( $sClave );
		$this->load->view ( 'reportes/frm/egreso', $data );
	}
	function Imprimir_Confirmar($sClave = null) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$this->load->model ( 'motor/cls/mgwdocegreso', 'WFDOCEGRESO' );
		$data ['solicitud'] = $this->WFDOC->Buscar ( $sClave );
		$data ['ingreso'] = $this->WFDOCEGRESO->Buscar ( $sClave );
		$this->load->view ( 'reportes/frm/egreso', $data );
	}
	function Imprimir_Reembolso($sClave = "", $sMarca = "") {
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$data ['reembolso'] = $this->MReembolso->Buscar ( $sClave, $sMarca );
		$this->load->view ( 'reportes/frm/reembolso', $data );
	}
	function Imprimir_ReembolsoF($sClave = "", $sMarca = "") {
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$data ['reembolso'] = $this->MReembolso->Buscar ( $sClave, $sMarca );
		$data ['marcador'] = $sMarca;
		$this->load->view ( 'reportes/frm/reembolsof', $data );
	}
	function Actualizar_Cobertura() {
		$json = json_decode ( $_POST ['objeto'], true );
		$afiliacion ["cobertura"] = $json [1];
		$afiliacion ["cobertura_disponible"] = $json [2];
		$afiliacion ["retencion"] = $json [3];
		$afiliacion ["consultas"] = $json [4];
		$afiliacion ["laboratorio"] = $json [5];
		$afiliacion ["activo"] = $json [6];
		$this->db->where ( 'cedula', $json [0] );
		$this->db->update ( 'td_afiliacion', $afiliacion );
		echo "<br><center>En hora buena te felicito... <br>¡Porceso Exitoso! <br> Cobertura Actualizada Titular(" . $json [0] . ")<br></a></center>";
	}
	function Actualizar_Dependientes() {
		$json = json_decode ( $_POST ['objeto'], true );
		$dependientes ["monto"] = $json [1];
		$dependientes ["retenido"] = $json [2];
		$dependientes ["estatus"] = $json [3];
		$this->db->where ( 'cedula', $json [0] );
		$this->db->update ( 'td_dependientes', $dependientes );
		echo "<br><center>En hora buena te felicito... <br>¡Porceso Exitoso! <br> Cobertura Actualizada Dependiente (" . $json [0] . ")<br></a></center>";
	}
	function Actualizar_Proveedores() {
		$this->load->model ( 'grupo/mproveedor', 'MProveedor' );
		$json = json_decode ( $_POST ['objeto'], TRUE );
		
		$mod = array (
				"ciudad" => $json [1], //
				"tipo" => $json [2], //
				"nombre" => $json [3], //
				"rif" => $json [4], //
				"direccion" => $json [5], //
				"telefono" => $json [6], //
				"fax" => $json [7], //
				"correo" => $json [8], //
				"banco" => $json [9], //
				"cuenta" => $json [10], //
				"personacontacto" => $json [11], //
				"estatus" => $json [12] 
		);
		
		$this->MProveedor->Actualizar ( $mod, $json [0] );
		echo "Proceso Finalizado Actualizando rif (" . $json [4] . ")";
		$json = null;
	}
	function Eliminar_Proveedor() {
		$json = json_decode ( $_POST ['objeto'], true );
		$this->db->query ( "DELETE FROM td_proveedores WHERE oid=" . $json [0] );
		echo "Eliminacion Satisfactoria";
	}
	function Actualizar_Reembolso() {
		$json = json_decode ( $_POST ['objeto'], true );
		// "1,5,7,8,9,10,11,12"
		$reembolso ["concepto"] = $json [1];
		$reembolso ["cubierto"] = $json [2];
		$reembolso ["ncubierto"] = $json [3];
		$reembolso ["tipou"] = $json [4];
		$reembolso ["cant"] = $json [5];
		
		$val = explode ( "|", $json [6] );
		if (count ( $val ) > 1) {
			$reembolso ["dependiente"] = $val [0];
			$reembolso ["nombre"] = $val [1];
			$reembolso ["porcentaje"] = $json [7];
			$this->db->where ( 'oid', $json [0] );
			$this->db->update ( 'td_reembolso', $reembolso );
			echo "<br><center>En hora buena te felicito... <br>¡Porceso Exitoso! <br> Reembolso Actualizada Codigo (" . $json [0] . ")<br></a></center>";
		} else {
			echo "<br><center>Debe seleccionar un beneficiario<br></a></center>";
		}
	}
	function Actualizar_Reem() {
		$json = json_decode ( $_POST ['objeto'], true );
		$reembolso ["observacion"] = $json [1];
		$this->db->where ( 'codigo', $json [0] );
		$this->db->update ( 'td_reembolso', $reembolso );
		
		echo "<br><center>En hora buena te felicito... <br>¡Porceso Exitoso! <br> Reembolso Actualizada Codigo (" . $json [0] . ")<br></a></center>";
	}
	function Listar_Laboratorio() {
		$this->load->model ( 'motor/cls/mgwdoclab', 'WFDOCLAB' );
		$lst = $this->WFDOCLAB->Obtener ();
		echo $lst ['json'];
	}
	function Listar_Consulta() {
		$this->load->model ( 'motor/cls/mgwdoccon', 'WFDOCCON' );
		$lst = $this->WFDOCCON->Obtener ();
		echo $lst ['json'];
	}
	function Listar_ReembolsoPersonal() {
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$valor = $this->MReembolso->Listar ( $_POST ['id'] );
		echo $valor ['json'];
	}
	function Listar_Pendientes($sC, $sMarca = null) {
		if ($sC != 4) {
			$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
			$lst = $this->WFDOC->Obtener ( $sC, $sMarca );
		} else {
			$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
			$lst = $this->MReembolso->Obtener ( $sC, $sMarca );
		}
		echo $lst ['json'];
	}
	function Listar_PendientesCE($sC, $sMarca = null) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$lst = $this->WFDOC->ObtenerCE ( $sC, $sMarca );
		
		echo $lst ['json'];
	}
	function Listar_Compromiso($val = null) {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$lst = $this->WFDOC->Obtener_Finales ( 2, $val );
		echo $lst ['json'];
	}
	function Retener_Reembolso($sClave = null, $sCedula = null) {
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$data ['reembolso'] = $this->MReembolso->Retener ( $sClave, $sCedula );
		echo $data ['reembolso'];
	}
	function Confirmar_Reembolso() {
		$sClave = $_POST ['cod'];
		$sCedula = $_POST ['ced'];
		
		$cnf ['codigo'] = $_POST ['cod'];
		$cnf ['clase'] = "Reembolso";
		$cnf ['dep'] = $_POST ['dep'];
		$cnf ['monto'] = $_POST ['mnt'];
		$cnf ['fecha'] = $_POST ['fecha'];
		$cnf ['banco'] = $_POST ['banco'];
		$cnf ['tipo'] = $_POST ['tipo'];
		$cnf ['origen'] = $_POST ['origen'];
		
		$this->db->insert ( "t_rconfirmar", $cnf );
		
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$data ['reembolso'] = $this->MReembolso->Confirmar ( $sClave, $sCedula );
		
		echo $data ['reembolso'];
	}
	function Improcedente($sClave = null) {
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$data ['reembolso'] = $this->MReembolso->Improcedente ( $sClave );
		echo $data ['reembolso'];
	}
	function Recepcion_HCM() {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$lst = $this->WFDOC->Recepcion_HCM ( $_POST ['id'] );
		echo $lst ['json'];
	}
	function Cuentas_Por_Pagar() {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$lst = $this->WFDOC->Cuentas_Por_Pagar ( $_POST ['id'], 0 );
		
		echo $lst ['json'];
	}
	function recepcionfactura() {
		// $data['usr'] = $this -> CUsuarios -> Usuarios_Conectados_Chat($_SESSION['usuario']);
		$data ['menu'] = $this->CMenu->Generar ();
		$data ['estados'] = $this->MEstados->LActivos ();
		$data ['estadosP'] = $this->MEstados->LActivosP ();
		$this->load->view ( 'administracion/index', $data );
	}
	function Imprimir_Relacion_Cheque($sBnc = "", $sFrec = "", $sNche = "") {
		$this->load->model ( 'motor/cls/mgwdoc', 'WFDOC' );
		$data ['relacion'] = $this->WFDOC->Listar_Relacion_Cheque ( $sBnc, $sFrec, $sNche );
		$this->load->view ( 'reportes/frm/relacion_cheque', $data );
	}
	function Guardar_Recepcion() {
		$sConsulta = 'SELECT * FROM td_rfactura WHERE clav=\'' . $_POST ['clav'] . '\'';
		$rs = $this->db->query ( $sConsulta );
		if ($rs->num_rows () != 0) {
			$this->db->where ( "clav", $_POST ['clav'] );
			$this->db->update ( "td_rfactura", $_POST );
		} else {
			$this->db->insert ( "td_rfactura", $_POST );
		}
		echo "<br><center>En hora buena te felicito... <br>¡Porceso Exitoso! <br></a></center>";
	}
	
	/**
	 * Numero de Cheques...
	 */
	function Guardar_Cheques() {
		$this->db->where ( "frec", $_POST ['frec'] );
		$this->db->where ( "ciud", $_POST ['ciud'] );
		$this->db->where ( "esta", $_POST ['esta'] );
		$this->db->where ( "clin", $_POST ['clin'] );
		$arr = $_POST;
		$arr ['autor'] = $_SESSION ['nombre'];
		
		$this->db->update ( "td_rfactura", $arr );
		echo "<center>En hora buena te felicito... <br>¡Porceso Exitoso!<br><br>
		<a href='" . __LOCALWWW__ . "/index.php/gprosalud/Imprimir_Relacion_Cheque/" . $_POST ['bnc'] . "/" . $_POST ['frec'] . "/" . $_POST ['nche'] . "' target='top'>
		Imprimir Relaci&oacute;n de Cheque </a></center>";
	}
	function Consultar_Recepcion() {
		$factura = array ();
		$sConsulta = 'SELECT * FROM td_rfactura WHERE clav=\'' . $_POST ['id'] . '\'';
		$rs = $this->db->query ( $sConsulta );
		if ($rs->num_rows () != 0) {
			foreach ( $rs->result () as $sCla ) {
				$obj = $sCla;
				foreach ( $obj as $sC => $sV ) {
					$factura [$sC] = $sV;
				}
			}
		} else {
			$factura ['mcom'] = "NA";
		}
		print_r ( json_encode ( $factura ) );
	}
	function Reversar_Reembolso($sClave = null, $sCedula = null) {
		$this->load->model ( 'grupo/mreembolso', 'MReembolso' );
		$data ['reembolso'] = $this->MReembolso->Reversar ( $sClave, $sCedula );
		echo $data ['reembolso'];
	}
	function pppagar() {
		if (isset ( $_SESSION ['usuario'] )) {
			$data ['usr'] = $this->CUsuarios->Usuarios_Conectados_Chat ( $_SESSION ['usuario'] );
			$data ['menu'] = $this->CMenu->Generar ();
			$this->load->view ( 'pppagar', $data );
		} else {
			$this->logout ();
		}
	}
	
	/**
	 *
	 * @param
	 *        	0 Consultas | 1 Laboratorio
	 */
	function Listar_PPPP($Cod = null) {
		$this->load->model ( 'motor/cls/mgwdoccon', 'WFDOCCON' );
		$lst = $this->WFDOCCON->PPP ( $sC );
		
		echo $lst ['json'];
	}
	
	/**
	 * Fin de la session
	 */
	function logout() {
		if (isset ( $_SESSION ['usuario'] )) {
			$strQuery = "UPDATE ts_usuario SET conectado=0 WHERE seudonimo='" . $_SESSION ['usuario'] . "'";
			$this->db->query ( $strQuery );
		}
		// $this -> load -> view('login');
		redirect ( base_url () );
		session_destroy ();
	}
	
	/**
	 * Chat de Conversaciones
	 * 
	 * @param
	 *        	string
	 * @return bool
	 */
	function Chat($estado) {
		$this->load->model ( 'chat/cchat', 'CChat' );
		if ($estado == "chatheartbeat") {
			$this->CChat->chatHeartbeat ();
		}
		if ($estado == "sendchat") {
			$this->CChat->sendChat ();
		}
		if ($estado == "closechat") {
			$this->CChat->closeChat ();
		}
		if ($estado == "startchatsession") {
			$this->CChat->startChatSession ();
		}
		if (! isset ( $_SESSION ['chatHistory'] )) {
			$_SESSION ['chatHistory'] = array ();
		}
		if (! isset ( $_SESSION ['openChatBoxes'] )) {
			$_SESSION ['openChatBoxes'] = array ();
		}
	}
	function EstadisticasServicios() {
		$this->load->model ( 'grupo/mnomina', 'MNomina' );
		$lst = $this->MNomina->EstadisticasServicios ( $_POST );
		print_r ( $lst ['json'] );
	}
	function ejecuta() {
		exec ( "system/exec/prueba", $val, $rc );
		print_r ( $val );
		echo "<br>Primera Vez<br>";
		print_r ( $rc );
		echo "<br>Segunda Vez";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>

