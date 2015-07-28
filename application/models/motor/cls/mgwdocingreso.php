<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por:
 * Fecha:09/07/2012.
 *
 */
class MGWDocIngreso extends CI_Model {

	var $oid = null;

	/**
	 *
	 */
	var $codigo;

	var $tipos;

	var $tipot;

	var $tipoi;
	/**
	 * Basico | Exceso
	 */
	var $tipoc;
	
	
	var $tipof;

	var $diagnostico;

	var $factura;

	var $fechaf;

	var $montos;

	var $montoc;
  
	var $monton;
  
	var $tratamiento;
	
	
	/**
	 * Fecha de Solicitud
	 */
	var $fechas;
	
	var $fechac;

	var $observacion;

	var $responsable;
  
  var $titular;
  
  var $beneficiario;
  
  var $centro;
  
  var $analista;
  
  var $estado;
  
  var $ciudad;
  
  var $descuento;

	function Buscar($sCod) {
		$lst = array();
		$sConsulta = "SELECT * FROM wt_docingreso WHERE codigo=" . $sCod . " LIMIT 1";
		$rs = $this -> db -> query($sConsulta);
		$rsC = $rs -> result();
		if ($rs -> num_rows() != 0) {
			foreach ($rsC as $row) {
				foreach ($row as $sC => $sV) {
					$this->$sC = $sV;
					$lst[$sC] = $sV;
				}
			}
		}
		return $lst;
	}

}
?>