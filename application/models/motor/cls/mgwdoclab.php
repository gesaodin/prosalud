<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por:
 * Fecha:09/07/2012.
 *
 */
class MGWDocLab extends CI_Model {

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
		$Pregunta = "SELECT codigo,td_personas.cedula,telefono,nombre,cedula_beneficiario,wt_doclab.estado,wt_doclab.ciudad,wt_doclab.centro,
		wt_doclab.fecha,hora,creado,responsable,observacion,costo,examenes,contratantes,td_personasubicacion.estado AS e FROM	wt_doclab	
		INNER JOIN td_personas ON wt_doclab.cedula_titular=td_personas.cedula
		INNER JOIN td_personascontratantes ON  td_personas.cedula=td_personascontratantes.oid
		INNER JOIN td_personasubicacion ON  td_personas.cedula=td_personasubicacion.cedula
		WHERE wt_doclab.codigo='" . $sClave . "';";
		$rs = $this -> db -> query($Pregunta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);
				foreach ($row as $sC => $sV) {
					$lst[$sC] = $sV;
				}
				$lst['nombre_dependiente'] = $this->MPersona->nombre;
			}
		}
		return $lst;
	}
	
	function Obtener() {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$oFil = array();
		$sConsulta = '
		SELECT wt_doclab.codigo, cedula_titular,td_personas.nombre, cedula_beneficiario,cantidad, costo, examenes, creado,responsable
		FROM wt_doclab INNER JOIN td_personas ON wt_doclab.cedula_titular = td_personas.cedula  where creado > \'2015-01-01\' ORDER BY creado DESC;';

		$oCabezera[1] = array("titulo" => "CODIGO", "atributos" => "width:70px", "buscar" => 1);
		$oCabezera[2] = array("titulo" => "TITULAR", "atributos" => "width:70px", "buscar" => 1);
		$oCabezera[3] = array("titulo" => "NOMBRE", "atributos" => "width:200px");
		$oCabezera[4] = array("titulo" => "DEPENDIENTE", "atributos" => "width:70px");
		$oCabezera[5] = array("titulo" => "CANTIDAD", "atributos" => "width:20px");
		$oCabezera[6] = array("titulo" => "COSTO", "atributos" => "width:20px");
		$oCabezera[7] = array("titulo" => "EXAMENES", "atributos" => "width:340px", "buscar" => 1);
		$oCabezera[8] = array("titulo" => "FECHA", "atributos" => "width:340px");
		$oCabezera[9] = array("titulo" => "RESPONSABLE", "atributos" => "width:340px");
		
		$oCabezera[10] = array(
			"titulo" => "ACCION", //
			"tipo" => "bimagen", //
			"ruta" => __IMG__ . "botones/quitar.png", // 
			"atributos" => "width:20px", //
			"funcion" => 'Quitar_Laboratorio', // 
			"parametro" => "1,2,4,5", //
		);

		$oCabezera[11] = array(
			"titulo" => " ", //
			"tipo" => "enlace", //
			"metodo"=> 2, //
			"ruta" => __IMG__ . "botones/print.png", // 
			"atributos" => "width:20px", //
			"funcion" => 'Imprimir_OrdenLab', // 
			"parametro" => "1", //
			"target" => "_blank" 
		);	

		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			$i = 1;
			foreach ($rsC as $row) {
				//$this->MPersona->Cargar($row -> cedula_beneficiario);
				$oFil[$i++] = array(
					'1' => $row -> codigo, // 
					'2' => $row -> cedula_titular, // 
					'3' => $row->nombre, //
					'4' => $row -> cedula_beneficiario, // 
					'5' => $row -> cantidad, // 
					'6' => $row -> costo, //
					'7' => $row -> examenes, //
					'8' => $row -> creado, //
					'9' => $row -> responsable, //
					'10' => "", //
					'11' => ""
					);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json');
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}


	function ObtenerDoc($sCod) {
		$sConsulta = "SELECT * FROM wt_doclab WHERE codigo=" . $sCod . " LIMIT 1";
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


	function BuscarOdontologia($sClave) {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$arr = array();
		$tit = "";
		$Pregunta = "SELECT codigo,td_personas.cedula,telefono,nombre,beneficiario AS cedula_beneficiario	,
		responsable,observacion,contratantes,td_personasubicacion.estado AS e, LD,`OR`,ES FROM	td_odontologia	
		INNER JOIN td_personas ON td_odontologia.cedula=td_personas.cedula
		INNER JOIN td_personascontratantes ON  td_personas.cedula=td_personascontratantes.oid
		INNER JOIN td_personasubicacion ON  td_personas.cedula=td_personasubicacion.cedula
		WHERE td_odontologia.codigo='" . $sClave . "';";
		$rs = $this -> db -> query($Pregunta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				$this -> MPersona -> Cargar($row -> cedula_beneficiario);
				foreach ($row as $sC => $sV) {
					$lst[$sC] = $sV;
				}
				$lst['nombre_dependiente'] = $this->MPersona->nombre;
			}
		}
		return $lst;
	}
	
}
?>