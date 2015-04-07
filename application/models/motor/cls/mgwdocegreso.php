<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por:
 * Fecha:09/07/2012.
 *
 */
class MGWDocEgreso extends CI_Model {

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
	
	var $fechae;

	var $observacion;

	var $responsable;
  
  var $titular;
  
  var $beneficiario;
  
  var $centro;
  
  var $analista;
  
  var $estado;
  
  var $ciudad;
	
	var $fechaingreso;
	

	function Buscar($sCod) {
		
		$lst['fechaingreso'] = '';
		$lst['fechas'] = '';
		$lst['fechae'] = '';
		$lst = array();
		$sConsulta = "SELECT * FROM wt_docegreso WHERE codigo=" . $sCod . " LIMIT 1";
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