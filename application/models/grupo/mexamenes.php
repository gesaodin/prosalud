<?php

/**
 * Modelo de Usuario Afiliado Para Clientes
 *
 * @author Carlos Enrique Penaa Albarran
 * @package prosalud.application.model.grupo
 * @version 1.0.0
 */
class MExamenes extends CI_Model {

  /**
   * Tabla del Usuario
   * @var string
   */
  var $tbl = "td_examenes";

  /**
   * @var string
   */
  var $cedula;
  
 
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
  } 
  
  
  function Listar(){
  	$sConsulta = "SELECT * FROM td_examenen_lista INNER JOIN td_proveedores ON td_examenen_lista.prov=td_proveedores.oid";
  }
	
	
	
	
}
?>