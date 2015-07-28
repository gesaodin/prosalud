<?php
/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */

class MEspecialidades extends CI_Model {

	/**
	 * Tabla del Usuario
	 * @var string
	 */
	var $tbl = "td_especialidadesmedicas";

	var $oid = null;

	var $nombre;

	var $lstEsp = array();


	/**
	 * Cargar nombre consultar
	 * @param string
	 * @return true
	 */
	function Listar() {		
		$sCon = 'SELECT oid, nombre FROM ' . $this -> tbl . ' GROUP BY nombre;';
		$rS = $this -> db -> query($sCon);
		$i = 0;
		foreach ($rS->result() as $sCl) {
			$this -> lstEsp[$sCl -> oid] = $sCl -> nombre;
		}
		return true;
	}

}
?>
