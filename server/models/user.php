<?php
include("conexion.php");

class User{
    private $name;
    private $password;
    private $id;
    private $conexion;

    /*function __construct($name, $id, $password){
        $this->name = $name;
        $this->id = $id;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }*/

    function initConexion(){
        $this->conexion = new ConectorBD("localhost", "root", "root");
        $this->conexion->initConexion("serempre");
    }

    function save($data){
        if(isset($data["name"]) && isset($data["pass"])){
            $data["pass"] = password_hash($data["pass"], PASSWORD_DEFAULT);
            $this->initConexion();
            if($this->conexion){
                if($res = $this->conexion->insertData("users", $data)){
                    $this->conexion->cerrarConexion();
                    return true;
                }
                $this->conexion->cerrarConexion();
            }
        }
        return false;
    }

    function findByName($name){
        if($name!=""){
            $this->initConexion();
            if($this->conexion){
                $table=["users"];
                $attributes =  ["name", "pass", "id"];
                $condition = "WHERE name LIKE '".$name."'";
                if($res = $this->conexion->consultar($table,$attributes, $condition)){
                    $res = $res->fetch_assoc();
                    $this->name = $res["name"];
                    $this->id = $res["id"];
                    $this->password = $res["pass"];
                    $this->conexion->cerrarConexion();
                    return true;
                }
                $this->conexion->cerrarConexion();
            }
        }
        return false;
    }

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function getPassword(){
        return $this->password;
    }

    function setName($name){
        $this->name = $name;
    }

    function getName(){
        return $this->name;
    }


  }

 ?>
