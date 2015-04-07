<?php
/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */

class MAfiliacion extends CI_Model {

	/**
	 * Tabla del Usuario
	 * @var string
	 */
	var $tbl = "td_afiliacion";

	var $oid;

	var $cedula;
	
	var $cobertura;
	
	var $cobertura_disponible;
	
	var $retencion;
	
	var $tipo_servicio;
	
	var $consultas;
	
	var $consultas_usadas;
	
	var $laboratorio;
	
	var $laboratorio_usadas;
	
	var $modo;
	
	var $fecha_activacion;
	
	var $activo;
	
	var $estatus;
	
	var $monto_directivo;
	
	var $monto_familiar;
	
	var $estudiose;
	
	var $estudiosec;
	
	
	function Cargar() {

	}
	
	/**
	 * Si es Titular o dependiente
	 */
	function getTitular() {
		$sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE cedula='" . $this -> cedula . "' LIMIT 1";
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() != 0){
			return "Titular (U.T)";	
		}
		return "Dependiente (U.D)";
	}
	
	/**
	 * Detalle del Afiliado
	 */
	function Buscar($sId = null){											
		$Afiliacion = array();
		if($sId == ""){
			$sId = $this->cedula;
		}
		$sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE cedula='" . $sId . "' LIMIT 1";
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
				$obj = $sCla;
				foreach ($obj as $sC => $sV) {
					$Afiliacion[$sC] = $sV;	
				}				
			}	
		}
		$valor['php'] = $Afiliacion;
		$valor['json'] = json_encode($Afiliacion);
		return $valor;
	}
	
	function Actualizar($arr){
		$lst = $this->Buscar($arr['titular']);
		$dValor = $lst['php']['cobertura_disponible'];
		$dResultado = $dValor - $arr['montoc'];
		$data['cobertura_disponible'] = $dResultado;
		$data['retencion'] = 0;
		$this->db->where('cedula', $arr['titular']);
		$this->db->update($this -> tbl, $data);		
	}
	
}
?>