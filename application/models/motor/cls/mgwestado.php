<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por: 
 * Fecha:09/07/2012.
 *
 */
class MGWEstado extends CI_Model {
  
  public $nombre;
  public $descripcion;
  public $oid;
  public $ClaseAsignacionUsuario;
  public $MetodoAsignacion;

  function __construct() {
    parent::Model();
  }

}
?>