<?php
/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 * 
 * ALTER TABLE `td_personas` ADD `banco` VARCHAR( 255 ) NOT NULL ,
ADD `tbanco` VARCHAR( 255 ) NOT NULL ,
ADD `ncuenta` VARCHAR( 255 ) NOT NULL 
 * 
 */

class MPersona extends CI_Model {

	/**
	 * Tabla del Usuario
	 * @var string
	 */
	var $tbl = "td_personas";

	/**
	 * Identificador autoincremen
	 * @var int
	 */
	var $oid = null;

	/**
	 * Nacionalidad (V-; E-; D-)
	 * @var string
	 */
	var $nacionalidad;

	/**
	 * Documenteo de identificacion
	 * @var string
	 */
	var $cedula;

	/**
	 * Apellidos y Nombres Completo compuestos por una coma
	 * @var string
	 */
	var $nombre;

	/**
	 * Fecha de Nacimiento
	 * @var date
	 */
	var $fecha;

	/**
	 * Identificacion del Genero
	 * @var int
	 */
	var $sexo;

	/**
	 * @var string
	 */
	var $estadocivil;

	/**
	 * @var string
	 */
	var $tiposangre;

	/**
	 * @var string
	 */
	var $direccion;

	/**
	 * @var string
	 */
	var $telefono;

	/**
	 * @var string
	 */
	var $celular;

	/**
	 * @var string
	 */
	var $banco;
	
	/**
	 * @var string
	 */
	var $tbanco;
	
	/**
	 * @var string
	 */
	var $nbanco;
	/**
	 * En caso de no ser titular quien lo es...
	 * @var array
	 */
	var $lstdependede = array();

	/**
	 * Lista de Muchos Pagos
	 *
	 */
	var $lstpagos = array();

	//Cargar Persona
	function Cargar($id) {
		$Consulta = $this -> db -> query("SELECT * FROM " . $this -> tbl . " WHERE cedula=" . $id . " LIMIT 1");
		if ($Consulta -> num_rows() != 0) {
			$obj = $Consulta -> result();
			foreach ($obj as $sClave) {
				foreach ($sClave as $sC => $sV) {
					if ($sC != "edad") {
						$this -> $sC = $sV;
					}
				}
			}
		}
		return true;
	}

	/**
	 * Salvar especificos del Objeto en un Array para base de datos
	 */
	function Salvar() {

	}

	/**
	 * Iniciar Una Persona
	 * @return Persona : json
	 */
	function jsPersona($id = null) {
		$jsP = array();
		//Una Persona Json
		$jsD = array();
		//Dependientes
		$this -> load -> model("grupo/mdependiente", "MDependiente");
		$this -> load -> model("grupo/mafiliacion", "MAfiliacion");
		$Consulta = $this -> db -> query("SELECT *,(YEAR(CURDATE())-YEAR(td_personas.fecha)) - (RIGHT(CURDATE(),5)<RIGHT(td_personas.fecha,5)) AS edad  
		FROM " . $this -> tbl . " 
		LEFT JOIN td_personascontratantes ON td_personas.cedula=td_personascontratantes.oid
		LEFT JOIN td_personasubicacion ON td_personas.cedula=td_personasubicacion.cedula 
		WHERE td_personas.cedula=" . $id . " LIMIT 1");

		$obj = $Consulta -> result();
		foreach ($obj as $Campo) {
			foreach ($Campo as $sC => $sV) {
				$jsP[$sC] = $sV;
			}
		}
		$this -> MDependiente -> titular = $id;
		$this -> MDependiente -> Cargar();
		$this -> MAfiliacion -> cedula = $id;

		$jsP["titular"] = $this -> MAfiliacion -> getTitular();

		$Afiliacion = $this -> MAfiliacion -> Buscar();
		$jsP["afiliacion"] = $Afiliacion['php'];
		$jsP["dependiente"] = $this -> MDependiente -> lstdependiente;
		$jsP["depende"] = $this -> MDependiente -> lstdepende;

		//$this->lstdependede = array('nacionalidad' => '', 'cedula' => '');
		//$jsP["dependede"] = $this -> lstdepende;
		$valor['php'] = $jsP;
		$valor['json'] = json_encode($jsP);
		return $valor;
	}

	function getEdad() {		
		list($ano, $mes, $dia) = explode("-", $this->fecha);
		$ano_dif = date("Y") - $ano;
		$mes_dif = date("m") - $mes;
		$dia_dif = date("d") - $dia;
		if ($dia_dif < 0 || $mes_dif < 0)
			$ano_dif--;
			
		return $ano_dif;

	}

}
?>