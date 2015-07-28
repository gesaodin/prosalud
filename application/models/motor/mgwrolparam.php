<?php

/**
 * Descripcion Modelo de la Red
 * Creado Por: 
 * Fecha:09/07/2012.
 *
 */
class MGWRolParam extends CI_Model {
  
  public $nombre;
  public $descripcion;
  public $oid;
  public $atributodelDoc;
  public $propiedad;
  public $atributo;
  

  function __construct() {
    parent::Model();
  }

}
?>