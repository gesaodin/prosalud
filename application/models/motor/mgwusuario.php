<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por: 
 * Fecha:09/07/2012.
 *
 */
class MGWUsuario extends CI_Model {
  
  public $nombre;
  public $descripcion;
  public $oid;
  public $login;
  public $PalabraClave;
  public $NuevaPalabraClave;
  public $confirmacion;
  

  function __construct() {
    parent::Model();
  }

}
?>