<?php
/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */

class MEstados extends CI_Model {

	/**
	 * Tabla del Usuario
	 * @var string
	 */
	var $tbl = "td_proveedores";

	var $oid = null;

	var $nombre;

	var $lst = array();
	
	var $lstEstados = array();
	
	var $lstCiudad = array();

	function __construct() {

	}

	/**
	 * Cargar nombre consultar
	 * @param string
	 * @return true
	 */
	function Listar() {
		$lstEsp = array();
		$sCon = 'SELECT oid, estado FROM ' . $this -> tbl . ' GROUP BY estado;';
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
				$this -> lstEstados[$sCl -> oid] = $sCl -> estado;

		}
		return true;
	}

	/**
	 * Listar Todos los elementos
	 * @return array
	 */
	function Buscar($sCod) {
		$sCon = 'SELECT oid,ciudad FROM ' . $this -> tbl . ' WHERE estado LIKE \'' . $sCod . '%\' GROUP BY ciudad';
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
			$this -> lstCiudad[$sCl -> oid] = $sCl -> ciudad;
		}
		return true;
	}
	
		/**
	 * Listar Todos los elementos
	 * @return array
	 */
	function Proveedores($sEstado, $sCiudad) {
		$arr = array();
		$sCon = "SELECT nombre FROM td_proveedores WHERE estado LIKE '" . $sEstado . "%' AND ciudad LIKE '" . $sCiudad . "%' AND estatus='ACTIVO'";
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
			$arr[] = $sCl -> nombre;
		}
		return $arr;
	}
	
	/**
	 * lISTAR ESTADOS ACTIVOS DESDE ORGANISMOS
	 */

	function LActivos(){
		$arr = array();
		$sCon = "SELECT estado FROM td_organismos GROUP BY estado";
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
			$arr[] = $sCl -> estado;
		}
		return $arr;
	}
	/**
	 *	LISTAR ESTADOS ACTIVOS DESDE PROVEEDORES	 
	 */
	function LActivosP(){
		$arr = array();
		$sCon = "SELECT estado FROM td_proveedores GROUP BY estado";
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
			$arr[] = $sCl -> estado;
		}
		return $arr;
	}

	function LOrganismos($sEstado){
		$arr = array();
		if($sEstado == '0'){
			$sCon = "SELECT nombre FROM td_organismos GROUP BY nombre";
		}else{
			$sCon = "SELECT nombre FROM td_organismos WHERE estado='" . trim($sEstado) . "'";
		}
		
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
			$arr[] = $sCl -> nombre;
		}
		return $arr;
	}	
	
}
?>