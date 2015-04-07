<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por: 
 * Fecha:09/07/2012.
 *
 */
class MGWRed extends CI_Model {
  
  public $nombre;
  public $descripcion;
  public $oid;
  public $transicion ="MGWTransicion";
  public $estado="MGWEstado";

  function __construct() {
    parent::Model();
  }

}
?>