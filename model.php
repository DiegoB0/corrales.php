<?php

class Model
{
  var $id;
  var $usuario;
  var $clave;

  function __construct()
  {

  }

  function Logear()
  {

    $cadenaCnx = "sqlsrv: Server=KIM\SQLEXPRESS;Database=corrales_db";
    $user = "diegob";
    $password = "password";

    $conexion = new PDO($cadenaCnx, $user, $password);

    try {
      $consulta = $conexion->prepare("SELECT * FROM usuario WHERE username=:parametro1 AND clave=(SELECT dbo.fun_encriptar(:parametro2))");

      $consulta->bindValue(':parametro1', $this->usuario);
      $consulta->bindValue(':parametro2', $this->clave);

      $consulta->execute();

      $fila = $consulta->fetch();

      return $fila;
    } catch (PDOException $e) {
      echo "Error en la conexion->" . $e;
    }
  }

}