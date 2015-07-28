<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por: 
 * Fecha:09/07/2012.
 *
 */
class MGWActividad extends CI_Model {
  
  public $nombre;
  
  public $descripcion;
  
  public $oid;
  
  public $actividad;
  
  public $fechaEjecucion;
  

  function __construct() {
    parent::Model();
  }

}
?>