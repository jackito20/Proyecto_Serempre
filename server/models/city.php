<?php
include("conexion.php");

class City{
    private $name;
    private $code;
    private $id;
    private $conexion;

    function initConexion(){
        $this->conexion = new ConectorBD("localhost", "root", "root");
        $this->conexion->initConexion("serempre");
    }

    function findById($id){
        if($id!=""){
            $this->initConexion();
            if($this->conexion){
                $table=["cities"];
                $attributes =  ["name", "cod", "id"];
                $condition = "WHERE id LIKE '".$id."'";
                if($res = $this->conexion->consultar($table,$attributes, $condition)){
                    $res = $res->fetch_assoc();
                    $this->name = $res["name"];
                    $this->id = $res["id"];
                    $this->code = $res["code"];
                    $this->conexion->cerrarConexion();
                    return true;
                }
                $this->conexion->cerrarConexion();
            }
        }
        return false;
    }

    function findAll(){
        $this->initConexion();
        if($this->conexion){
            $table=["cities"];
            $attributes =  ["name", "cod", "id"];
            if($res = $this->conexion->consultar($table,$attributes)){
                $i=0;
                $cities = [];
                while($fila = $res->fetch_assoc()){
                    $city = [
                        "id" => $fila["id"],
                        "code" => $fila["cod"],
                        "name" => $fila["name"]
                    ];
                    
                    array_push($cities, $city);
                    $i++;
                }
                $this->conexion->cerrarConexion();
                return $cities;
            }
            $this->conexion->cerrarConexion();
        }
        return false;
    }

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setCode($code){
        $this->code = $code;
    }

    function getCode(){
        return $this->code;
    }

    function setName($name){
        $this->name = $name;
    }

    function getName(){
        return $this->name;
    }


  }

 ?>
