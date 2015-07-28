<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por: 
 * Fecha:09/07/2012.
 *
 */
class MGWEjecucion extends CI_Model {
  
  public $nombre;
  public $descripcion;
  public $oid;
  public $actividad ="MGWActividad";
  public $fechaCreacion;

  function __construct() {
    parent::Model();
  }

}
?>