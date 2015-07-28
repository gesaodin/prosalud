<?php

class MContratante extends CI_Model {

	var $tbl = "td_contratantes";

	var $oid = null;

	var $rif;
	var $codigo;
	var $cobertura;
	var $basico;
	var $exceso;
	var $contratada;
	var $familiar;
	var $directivo;
	var $consultas;
	var $examenes;
	var $renovacion;
	var $responsable;
	var $activo;

	function Guardar() {

	}

	function Listar() {
		$oFil = array();
		$oCabezera[1] = array("titulo" => "RIF", "atributos" => "width:80px");
		$oCabezera[2] = array("titulo" => "NOMBRE", "atributos" => "width:80px");
		$oCabezera[3] = array("titulo" => "COBERTURA", "atributos" => "width:150px");
		$oCabezera[4] = array("titulo" => "BASICO", "atributos" => "width:250px");
		$oCabezera[5] = array("titulo" => "EXCESO", "atributos" => "width:250px");
		$oCabezera[6] = array("titulo" => "CONTRATADA", "atributos" => "width:250px");
		$oCabezera[7] = array("titulo" => "FAMILIAR", "atributos" => "width:250px");
		$oCabezera[8] = array("titulo" => "DIRECTIVO", "atributos" => "width:250px");
		$oCabezera[9] = array("titulo" => "CONSULTAS", "atributos" => "width:250px");
		$oCabezera[10] = array("titulo" => "EXAMENES", "atributos" => "width:250px");
		$oCabezera[11] = array("titulo" => "RENOVACION", "atributos" => "width:250px");
		$oCabezera[12] = array("titulo" => "RESPONSABLE", "atributos" => "width:250px");
		$oCabezera[13] = array("titulo" => "ESTATUS", "atributos" => "width:250px");

		$sConsulta = "SELECT * FROM " . $this -> tbl;
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		$titulo = "Listado de Contratantes En General...";
		if ($rs -> num_rows() != 0) {
			$i = 0;
			foreach ($rsC as $row) {
				$oFil[$i++] = array('1' => $row -> rif, '2' => $row -> codigo, '3' => $row -> cobertura, '4' => $row -> basico, '5' => $row -> exceso, '6' => $row -> contratada, '7' => $row -> familiar, '8' => $row -> directivo, '9' => $row -> consultas, '10' => $row -> examenes, '11' => $row -> renovacion, '12' => $row -> responsable, '13' => $row -> activo);
			}
		}

		$oTable = array("Cabezera" => $oCabezera, "Cuerpo" => $oFil, "Origen" => 'json', "titulo" => $titulo);
		$oValor['php'] = $oTable;
		$oValor['json'] = json_encode($oTable);
		return $oValor;
	}

	function Listar_Organismos() {
		$arr = array();
		$sCon = "SELECT * FROM td_organismos GROUP BY nombre";
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
			$arr[] = $sCl -> nombre;
		}
		return $arr;
	}

}
?>
