<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por:
 * Fecha:09/07/2012.
 *
 */
class MGWDocCon extends CI_Model {

	var $oid = null;

	/**
	 *
	 */
	var $codigo;

	var $cedula_titular;

	var $cedula_beneficiario;

	var $estado;

	var $ciudad;

	var $centro;

	var $fecha;

	var $hora;

	var $creado;

	var $responsable;

	var $observacion;

	var $costo;

	var $examenes;
	
	var $estatus;

	function Buscar($sClave) {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$arr = array();
		$tit = "";
		$Pregunta = "SELECT codigo,td_personas.cedula,telefono,nombre,cedula_beneficiario,wt_doccon.estado,wt_doccon.ciudad,wt_doccon.centro,
		wt_doccon.fecha,hora,creado,responsable,analista,observacion,especialidad,contratantes,td_personasubicacion.estado AS e FROM	wt_doccon	
		INNER JOIN td_personas ON wt_doccon.cedula_titular=td_personas.cedula
		INNER JOIN td_personascontratantes ON  td_personas.cedula=td_personascontratantes.oid
		INNER JOIN td_personasubicacion ON  td_personas.cedula=td_personasubicacion.cedula
		WHERE wt_doccon.codigo='" . $sClave . "';";
		$rs = $this -> db -> query($Pregunta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);
				foreach ($row as $sC => $sV) {
					$lst[$sC] = $sV;
				}
				$lst['nombre_dependiente'] = $this->MPersona->nombre;
				$estado = $row -> estado;
				$ciudad = $row -> ciudad;
				$centro = $row -> centro;
			}
		}
		
		$sCon = "SELECT direccion FROM td_proveedores WHERE estado='" . $estado . "' AND ciudad='" . $ciudad . "' AND nombre='" . $centro . "';";
		$rs = $this -> db -> query($sCon);
		$rsC = $rs -> result();
		$lst['direccioncentro'] = $rsC[0]->direccion;
		//print_r($sCon	);
		
		
		
		return $lst;
	}
	
	function Obtener() {
		/**
		 * ALTER TABLE `wt_doclab` ADD `estatus` INT NOT NULL;
			ALTER TABLE `wt_doccon` ADD `estatus` INT NOT NULL;		
		 */
		$this -> load -> model("grupo/mpersona", "MPersona");
		$oFil = array();
		$sConsulta = '
		SELECT wt_doccon.codigo, cedula_titular,td_personas.nombre, cedula_beneficiario,consultas, especialidad , wt_doccon.fecha, wt_doccon.responsable
		FROM wt_doccon INNER JOIN td_personas ON wt_doccon.cedula_titular = td_personas.cedula WHERE wt_doccon.estatus=0;';

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:60px", "buscar" => 1);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:60px", "buscar" => 1);
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:120px");
		$oCabezera[4] = array("titulo" => "BENEF.", "atributos" => "width:60px");
		$oCabezera[5] = array("titulo" => "#", "atributos" => "width:12px");
		$oCabezera[6] = array("titulo" => "ESPECIALIDAD", "atributos" => "width:150px");
		$oCabezera[7] = array("titulo" => "EMISION", "atributos" => "width:40px");
		$oCabezera[8] = array("titulo" => "RESPONSABLE", "atributos" => "width:40px");
		
		if ($_SESSION['usuario'] == "luisany" || $_SESSION['usuario'] == "Crash" || $_SESSION['usuario'] == "anaisbiaggi") {
		$oCabezera[9] = array(
			"titulo" => " ", //
			"tipo" => "bimagen", //
			"ruta" => __IMG__ . "botones/quitar.png", // 
			"atributos" => "width:10px", //
			"funcion" => "Quitar_Consultas", // 
			"parametro" => "1,2,4,5", //
		);

		}else{
			$oCabezera[9] = array(
			"oculto" => 1	);
		}
		$oCabezera[10] = array(
			"titulo" => " ", //
			"tipo" => "enlace", //
			"metodo"=> 2, //
			"ruta" => __IMG__ . "botones/print.png", // 
			"atributos" => "width:10px", //
			"funcion" => 'Imprimir_OrdenCon', // 
			"parametro" => "1", //
			"target" => "_blank" 
		);


		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				$oFil[$i++] = array(
					'1' => $row -> codigo, // 
					'2' => $row -> cedula_titular, // 
					'3' => $row->nombre, //
					'4' => $row -> cedula_beneficiario, // 
					'5' => $row -> consultas, // 
					'6' => $row -> especialidad, //
					'7' => date("d/m/Y", strtotime($row -> fecha)), //
					'8' => $row -> responsable,
					'9' => "",
					'10' => "",
				);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}


	function ObtenerDoc($sCod) {
		$sConsulta = "SELECT * FROM wt_doccon WHERE codigo=" . $sCod . " LIMIT 1";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				foreach ($row as $sC => $sV) {
					$lst[$sC] = $sV;
				}
			}
		}
		return $lst;
	}

	/**
	 * Pendientes Por Pagar
	 */
	function PPP() {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$arr = array();
		$tit = "";
		$Pregunta = "SELECT codigo,td_personas.cedula,telefono,nombre,cedula_beneficiario,wt_doccon.estado,wt_doccon.ciudad,wt_doccon.centro,
		wt_doccon.fecha,hora,creado,responsable,analista,observacion,especialidad,contratantes,td_personasubicacion.estado AS e, SUM(costo) FROM	wt_doccon	
		INNER JOIN td_personas ON wt_doccon.cedula_titular=td_personas.cedula
		INNER JOIN td_personascontratantes ON  td_personas.cedula=td_personascontratantes.oid
		INNER JOIN td_personasubicacion ON  td_personas.cedula=td_personasubicacion.cedula
		GROUP BY wt_doccon.estado,wt_doccon.ciudad,wt_doccon.centro;";
		$rs = $this -> db -> query($Pregunta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);
				foreach ($row as $sC => $sV) {
					$lst[$sC] = $sV;
				}
				$lst['nombre_dependiente'] = $this->MPersona->nombre;
				$estado = $row -> estado;
				$ciudad = $row -> ciudad;
				$centro = $row -> centro;
			}
		}
		
		$sCon = "SELECT direccion FROM td_proveedores WHERE estado='" . $estado . "' AND ciudad='" . $ciudad . "' AND nombre='" . $centro . "';";
		$rs = $this -> db -> query($sCon);
		$rsC = $rs -> result();
		$lst['direccioncentro'] = $rsC[0]->direccion;
		
		
		
		return $lst;
	}



}
?>