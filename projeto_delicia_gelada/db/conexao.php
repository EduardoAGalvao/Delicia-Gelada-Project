<?php

function conexaoMysql(){
    
  //HOST    
  define("SERVER", "localhost"); //Local onde o BD está instalado
  //define("SERVER", "192.168.0.2"); //Host do servidor   
    
  //USER    
  define("USER", "root"); //Usuário do BD
  //define("USER", "pc3120192"); //Usuário do servidor
  
  //PASSWORD    
  define("PASSWORD", ""); //Conexão para casa
  //define("PASSWORD", "bcd127"); //Conexão para aulas de segunda-feira e sexta-feira
  //define("PASSWORD", "senai127"); //Conexão para servidor
    
  //DATABASE    
  define("DATABASE", "db_deliciagelada"); //Conexão para aulas de segunda-feira e sexta-feira 
  //define("DATABASE", "dbpc3120192");  //Conexão para o banco do servidor

  $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
    
  mysqli_set_charset($conexao, 'utf8');
  
  return $conexao;

}

?>