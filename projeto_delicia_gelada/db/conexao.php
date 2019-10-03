<?php

function conexaoMysql(){

  define("SERVER", "localhost"); //Local onde o BD está instalado
  define("USER", "root"); //Usuário do BD
  define("PASSWORD", ""); 
  define("DATABASE", "db_deliciagelada");

  $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
  
  return $conexao;

}

?>