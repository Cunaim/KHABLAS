<?php 
  require_once('Conexion.php');
  /*Comprobar que el usuario esta registrado*/
  session_start();
  session_destroy();
  header("Location: ../Index.php");
?>