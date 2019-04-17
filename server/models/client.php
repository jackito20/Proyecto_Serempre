<?php
include_once("conexion.php");
include_once("city.php");

class Client{
    private $name;
    private $cod;
    private $id;
    private $city;
    private $conexion;

    function initConexion(){
        $this->conexion = new ConectorBD();
        $this->conexion->initConexion();
    }

    function save($data){
        if(isset($data["name"]) && isset($data["cod"]) && isset($data["city_id"])){
            $this->initConexion();
            if($this->conexion){
                if($res = $this->conexion->insertData("clients", $data)){
                    $this->conexion->cerrarConexion();
                    return true;
                }
                $this->conexion->cerrarConexion();
            }
        }
        return false;
    }

    function update($data){
        if(isset($data["name"]) && isset($data["cod"]) && isset($data["city_id"])){
            $this->initConexion();
            if($this->conexion){
                $condition = "id LIKE ".$data["id"];
                if($res = $this->conexion->actualizarRegistro("clients", $data, $condition)){
                    $this->conexion->cerrarConexion();
                    return $res;
                }
                $this->conexion->cerrarConexion();
            }
        }
        return false;
    }

    function delete($id){
        if($id!=""){
            $this->initConexion();
            if($this->conexion){
                $condition = "id LIKE ".$id;
                if($res = $this->conexion->eliminarRegistro("clients", $condition)){
                    $this->conexion->cerrarConexion();
                    return $res;
                }
                $this->conexion->cerrarConexion();
            }
        }
        return false;
    }

    function getCount(){
        $this->initConexion();
        if($this->conexion){
            $table=["clients"];
            $attributes =  ["COUNT(*) as cant"];
            if($res = $this->conexion->consultar($table,$attributes)){
                if($fila = $res->fetch_assoc()){
                    $count = $fila["cant"];
                    $this->conexion->cerrarConexion();
                    return $count;
                }
            }
            $this->conexion->cerrarConexion();
        }
        return false;
    }

    function findFromTo($from, $to){
        $this->initConexion();
        if($this->conexion){
            $table=["clients"];
            $attributes =  ["name", "cod", "city_id", "id"];
            $condition = 'LIMIT '.$from.', '.$to;
            if($res = $this->conexion->consultar($table,$attributes, $condition)){
                $i=0;
                $clients = [];
                while($fila = $res->fetch_assoc()){
                    $city = new City();
                    $city->findById($fila["city_id"]);
                    $client = [
                        "id" => $fila["id"],
                        "code" => $fila["cod"],
                        "name" => $fila["name"], 
                        "city" => [
                            "id" => $city->getId(),
                            "cod" => $city->getCode(),
                            "name" => $city->getName()
                        ]
                    ];
                    
                    array_push($clients, $client);
                    $i++;
                }
                $this->conexion->cerrarConexion();
                return $clients;
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

    function setCod($cod){
        $this->cod = $cod;
    }

    function getCod(){
        return $this->cod;
    }

    function setName($name){
        $this->name = $name;
    }

    function getName(){
        return $this->name;
    }

    
    function setCity($city){
        $this->city = $city;
    }

    function getCity(){
        return $this->city;
    }


  }

 ?>
