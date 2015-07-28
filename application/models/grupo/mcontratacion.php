<?php

/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */
class MContratacion extends CI_Model {

  /**
   * Tabla del Usuario
   * @var string
   */
  var $tbl = "td_afiliacion";

  /**
   * @var string
   */
  var $cedula;
  
  /**
   * @var int
   */
  var $cobertura;
  
  /**
   * @var decimal(10,2)
   */
  var $cobertura_disponible;
  
  /**
   * @var decimal(10,2)
   */ 
  var $retencion;
  
  /**
   * @var decimal(10,2)
   */ 
  var $tipo_servicio;
  
  /**
   * @var decimal(10,2)
   */ 
  var $consultas;
  
  /**
   * @var decimal(10,2)
   */ 
  var $consultas_usadas;
  
  /**
   * @var decimal(10,2)
   */ 
  var $laboratorio;
  
  /**
   * @var decimal(10,2)
   */ 
  var $laboratorio_usado;
  
  /**
   * @var decimal(10,2)
   */ 
  var $modo;
  
  
  /**
   * @var muchos pago
   */
  var $lstafiliacion = array();
  
  function Cargar() {
  } 

  /**
   * Detalles de los monto
   */
  function Buscar(){
    $oFil = array();  
    $sConsulta = "SELECT * FROM " . $this -> tbl . " WHERE cedula='" . $this -> cedula . "' LIMIT 1";
    $rs = $this -> db -> query($sConsulta);
    $rsC = $rs->result();
    $oTable['cobertura'] = $rsC[0]->cobertura;
    $oTable['cobertura_disponible'] = $rsC[0]->cobertura_disponibles;
    $oTable['consultas'] = $rsC[0]->consultas;
    $oTable['cu'] = $rsC[0]->consultas_usadas;
    $oTable['laboratorio'] = $rsC[0]->laboratorio;
    $oTable['lu'] = $rsC[0]->laboratorio_usado;
    $oTable['retencion'] = $rsC[0]->modo;
    $oTable['modo'] = $rsC[0]->modo;
    $oTable['tipo_servicio'] = $rsC[0]->tipo_servicio;
    
    $oValor['php'] = $oTable;
    $oValor['json'] = json_encode($oTable);
    return $oValor;
  } 
	
	  /**
   * Detalles de los monto
   */
  function BCobertura($arr){
    $Cobertura = array();  
    $sConsulta = "SELECT * FROM td_contratantes INNER JOIN td_organismos ON 
    td_contratantes.codigo = td_organismos.oid WHERE estado='" . $arr['est'] . "' AND nombre='" . $arr['con'] . "'";
    $rs = $this -> db -> query($sConsulta);		
    if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
				$obj = $sCla;
				foreach ($obj as $sC => $sV) {
					$Cobertura[$sC] = $sV;	
				}				
			}	
		}
    $valor['php'] = $Cobertura;
		$valor['json'] = json_encode($Cobertura);
		return $valor;
  } 
	function RCobertura($arr){
		$contratacion['plan'] = $arr['plan'];
		$contratacion['cobertura'] = $arr['cobertura'];
		$contratacion['directivo'] = $arr['directivo'];
		$contratacion['consultas'] = $arr['consultas'];
		$contratacion['examenes'] = $arr['examenes'];
		$contratacion['MT'] = $arr['MT'];
		$contratacion['MC'] = $arr['MC'];
		$contratacion['LD'] = $arr['LD'];
		$contratacion['OR'] = $arr['OR'];
		$contratacion['ES'] = $arr['ES'];
		$contratacion['EE'] = $arr['EE'];
		$contratacion['G1'] = $arr['G1'];
		$contratacion['G2'] = $arr['G2'];
		$contratacion['G3'] = $arr['G3'];
		$contratacion['G4'] = $arr['G4'];
		$this -> db -> where('codigo', $arr['codigo']);
		$this -> db -> update('td_contratantes', $contratacion);

		$organismo['monto'] = $arr['cobertura'];
		$organismo['monto_dependiente'] = $arr['dependientes'];
		$this -> db -> where('oid', $arr['codigo']);
		$this -> db -> update('td_organismos', $organismo);
		
		$sConsulta = 'UPDATE td_personas
		RIGHT JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_afiliacion ON td_personas.cedula = td_afiliacion.cedula
		LEFT JOIN td_personascontratantes ON td_personasubicacion.cedula = td_personascontratantes.oid
		SET td_afiliacion.cobertura=' . $contratacion['cobertura'] . ', td_afiliacion.cobertura_disponible=' . $contratacion['cobertura'] . ',
		td_afiliacion.consultas=' . $contratacion['consultas'] . ',td_afiliacion.laboratorio=' . $contratacion['examenes'] . ',
		td_afiliacion.monto_directivo=' . $contratacion['directivo'] . ',td_afiliacion.monto_familiar=' . $organismo['monto_dependiente'] . ',
		td_afiliacion.consultas_usadas=0, td_afiliacion.laboratorio_usado=0,
		td_afiliacion.MT=' . $contratacion['MT'] . ',td_afiliacion.MC=' . $contratacion['MC'] . ',
		td_afiliacion.LD=' . $contratacion['LD'] . ',td_afiliacion.OR=' . $contratacion['OR'] . ',
		td_afiliacion.ES=' . $contratacion['ES'] . ',td_afiliacion.EE=' . $contratacion['EE'] . ',		
		td_afiliacion.G1=' . $contratacion['G1'] . ',td_afiliacion.G2=' . $contratacion['G2'] . ',
		td_afiliacion.G3=' . $contratacion['G3'] . ',td_afiliacion.G4=' . $contratacion['G4'] . ',
		td_afiliacion.G1R=0,td_afiliacion.G2R=0,td_afiliacion.G3R=0,td_afiliacion.G4R=0				
		WHERE estado LIKE \'' .  $arr['estado'] . '\'	AND contratantes = \'' .  $arr['contratante'] . '\' AND
		td_afiliacion.retencion = 0';
		$this->db->query($sConsulta);
		
		$sConsulta = 'SELECT td_personas.cedula	FROM td_personas
		RIGHT JOIN td_personasubicacion ON td_personas.cedula = td_personasubicacion.cedula
		JOIN td_afiliacion ON td_personas.cedula = td_afiliacion.cedula
		LEFT JOIN td_personascontratantes ON td_personasubicacion.cedula = td_personascontratantes.oid
		WHERE estado LIKE \'' .  $arr['estado'] . '\'	AND contratantes = \'' .  $arr['contratante'] . '\'';		
		
		$rs = $this -> db -> query($sConsulta);		
    if ($rs -> num_rows() != 0){
			foreach ($rs->result() as $sCla) {
				$update = 'UPDATE td_dependientes SET monto='	. 
				$organismo['monto_dependiente'] .',
				G1=' . $contratacion['G1'] . ',G2=' . $contratacion['G2'] . ',
				G3=' . $contratacion['G3'] . ',G4=' . $contratacion['G4'] . ',
				G1R=0,G2R=0,G3R=0,G4R=0 WHERE titular=\'' . $sCla->cedula . '\' AND retenido = 0';
				$this->db->query($update);
			}	
		}
		
				
		
		
	}
	
}
?>