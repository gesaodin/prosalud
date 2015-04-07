<?php
/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */

class MDependiente extends CI_Model {

	/**
	 * Tabla del Usuario
	 * @var string
	 */
	var $tbl = "td_dependientes";

	var $oid;

	var $cedula;

	var $titular;

	var $parentesco;
  
  var $monto;
  
  /**
   * 1: Activo |  0: Inactivo 
   */
  var $estatus;
  
  
  var $retencion;

	/**
	 * DTD: Cedula | Parentesco
	 */
	var $lstdependiente = array();

	/**
	 * Soy titutlar o No De quien dependo
	 * DTD: Cedula | Parentesco
	 */
	var $lstdepende = array();

	/**
	 * Guardar Relacion de Dependientes
	 */
	function Agregar() {

	}

	/**
	 * Buscar lista de dependientes
	 * @return array
	 */
	function Cargar() {
		$lstdpd = array();
		$sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE titular =" . $this -> titular . " ORDER BY cedula";
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() == 0) {
			//Persona sin dependientes
		} else {
			$i = 0;
			foreach ($rs->result() as $rw) {
				$this -> MPersona -> Cargar($rw -> cedula);
				$lstdpd['nombre'] = $this -> MPersona -> nombre;
				foreach (get_object_vars($rw) as $sC => $sV) {
					$lstdpd[$sC] = $sV;
				}
				$this -> lstdependiente[++$i] = $lstdpd;
			}
		}
		$this->Dependo();
		return true;
	}

	/**
	 * Quien me manda
	 *
	 */
	function Dependo() {
		$this -> load -> model("grupo/mpersona", "MPersona");
		$lstdpd = array();
		$sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE cedula =" . $this -> titular . " ORDER BY titular";
		$rs = $this -> db -> query($sConsulta);
		if ($rs -> num_rows() == 0) {
			//Persona sin dependientes
		} else {
			$i = 0;
			foreach ($rs->result() as $rw) {
				$this -> MPersona -> Cargar($rw -> titular);
				$lstdpd['nombre'] = $this -> MPersona -> nombre;
				$lstdpd['titular'] = $rw -> titular;
				$lstdpd['parentesco'] = $rw -> parentesco;
				$this -> lstdepende[++$i] = $lstdpd;
			}
		}
		return $lstdpd;
	}
	

	
	function Cobertura($sCedula){
		$lst = array();
		$sConsulta = "SELECT *,(YEAR(CURDATE())-YEAR(td_personas.fecha)) - (RIGHT(CURDATE(),5)<RIGHT(td_personas.fecha,5)) AS edad FROM " . $this -> tbl . " 
		LEFT JOIN td_personas ON " . $this -> tbl . ".cedula=td_personas.cedula
		WHERE td_personas.cedula =" . $sCedula . " LIMIT 1";
		$rs = $this -> db -> query($sConsulta);
		foreach ($rs->result() as $rw) {
			$lst['nombre'] = $rw->nombre;
			$lst['parentesco'] = $rw->parentesco;
			$lst['monto'] = $rw->monto;
			$lst['fecha'] = $rw->fecha;
			$lst['telefono'] = $rw->telefono;
			$lst['sexo'] = $rw->sexo;
			$lst['celular'] = $rw->celular;
			$lst['direccion'] = $rw->direccion;
			$lst['estatus'] = $rw->estatus;
			$lst['retenido'] = $rw->retenido;
			$lst['edad'] = $rw->edad;
			
		}
		
		return $lst;
	}


	function Actualizar($arr){
		$lst = $this->Cobertura($arr['beneficiario']);
		$dValor = $lst['monto'];
		$dResultado = $dValor - $arr['montoc'];
		$data['monto'] = $dResultado;
		$data['retenido'] = 0;
		$this->db->where('cedula', $arr['beneficiario']);
		$this->db->update($this -> tbl, $data);		
	}
}
?>