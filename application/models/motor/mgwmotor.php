<?php
/**
 * Descripcion Modelo de la Red
 * Creado Por:
 * Fecha:09/07/2012.
 * @package application.models.motor
 */
class MGWMotor extends CI_Model {

  /**
   * @var MGUsuario
   */
  public $usuario;

  /**
   * @var MGWDoc
   */
  public $documento;

  /**
   * @var MGWRed
   */
  public $red;

  /**
   * @var MGWEstado
   */
  public $estadoActual;

  /**
   * @var MGWDependencia
   */
  public $dependenciaActual;

  /**
   * @var MGWTransicion
   */
  public $lstTransiciones;

  /**
   * @var MGWDocBase
   */
  public $documentoActivo;

  function __construct() {
    parent::Model();
  }

  /**
   * Crear Proceso
   * @param tipoDoc MWGDocTipo
   * @return boolean
   */
  function CrearProceso($tipoDoc) {

  }

  /**
   * Crear Instancia de Ejecucion
   * @param $parametro MDocBase
   * @return boolean
   */
  function InstanciarEjecucion($parametro) {
  }

  /**
   * Estado de Red
   * @return boolean
   */
  function EstadoRed() {
  }

  /**
   * Transiciones Posibles
   * @return boolean
   */
  function TransicionesPosibles() {

  }

  /**
   * Disparar Transiciones
   * @param transicion MGWTransicion
   * @return boolean
   */
  function DispararTransicion($transicion) {

  }

  /**
   * Definir Usuario
   * @return boolean
   */
  function DefinirUsuario() {

  }

  /**
   * Definir Departamento
   * @return boolean
   */
  private function DefinirDepartamento() {

  }

  /**
   * Busca Documentos Activos
   * @param MGWDocBase
   * @return boolean
   */
  function BuscarDocumentosActivos() {

  }

  /**
   * Salvar Estado Actual
   * @return boolean
   */
  function SalvarEstadoActual() {

  }
  /**
   * Al Finalizar Clase
   */
  function destruct(){
    
  }

}
?>

