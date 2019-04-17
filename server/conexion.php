<?php
require('../config.php');

class ConectorBD
  {
    private $host;
    private $user;
    private $password;
    private $conexion;

    function __construct(){
      $this->host = DB_HOST;
      $this->user = DB_USER;
      $this->password = DB_PASSWORD;
    }

    function initConexion(){
      $this->conexion = new mysqli($this->host, $this->user, $this->password, DB_NAME);
      if ($this->conexion->connect_error) {
          return "Error:" . $this->conexion->connect_error;
      }else {
          return "OK";
      }
  }

    function ejecutarQuery($query){
        return $this->conexion->query($query);
    }
  
    function cerrarConexion(){
        $this->conexion->close();
    }

    function getConexion(){
        return $this->conexion;
    }

    function insertData($tabla, $data){
      $sql = 'INSERT INTO '.DB_NAME.'.'.$tabla.' (';
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= $key;
        if ($i<count($data)) {
          $sql .= ', ';
        }else $sql .= ')';
        $i++;
      }
      $sql .= " VALUES (";
      $i = 1;
      foreach ($data as $key => $value) {
        $sql .= "'".$value."'";
        if ($i<count($data)) {
          $sql .= ", ";
        }else $sql .= ");";
        $i++;
      }
      //return $sql;
      return $this->ejecutarQuery($sql);

    }

    function actualizarRegistro($tabla, $data, $condicion){
      $sql = 'UPDATE '.DB_NAME.'.'.$tabla.' SET ';
      $i=1;
      foreach ($data as $key => $value) {
        $sql .= $key.'='.$value;
        if ($i<sizeof($data)) {
          $sql .= ', ';
        }else $sql .= ' WHERE '.$condicion.';';
        $i++;
      }
      return $this->ejecutarQuery($sql);
    }

    function eliminarRegistro($tabla, $condicion){
      $sql = "DELETE FROM ".DB_NAME.".".$tabla." WHERE ".$condicion.";";
      return $this->ejecutarQuery($sql);
    }

    function consultar($tablas, $campos, $condicion = ""){
      $sql = "SELECT ";
      $a=array_keys($campos);
      $ultima_key = end($a);
      foreach ($campos as $key => $value) {
        $sql .= $value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .=" FROM ";
      }

      $b = array_keys($tablas);
      $ultima_key = end($b);
      foreach ($tablas as $key => $value) {
        $sql .= DB_NAME.".".$value;
        if ($key!=$ultima_key) {
          $sql.=", ";
        }else $sql .= " ";
      }

      if ($condicion == "") {
        $sql .= ";";
      }else {
        $sql .= $condicion.";";
      }
      return $this->ejecutarQuery($sql);
    }


  }





 ?>
