<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "visualizar"){
      
      //Resgata o ID do registro
      $codigo = $_POST['codigo'];
      
      //Abre a conexão com BD
      $conexao = conexaoMysql();
      
      //Script para buscar o registro no BD
      $sql = "SELECT * FROM tbl_usuarios u JOIN tbl_perfil i ON u.id_perfil = i.id_perfil JOIN tbl_acesso_setor_perfil asp ON i.id_perfil = asp.id_perfil JOIN tbl_setor st ON asp.id_setor_cms = st.id_setor_cms WHERE u.id_usuario = " . $codigo;
      
      //Executa o script no banco
      $select = mysqli_query($conexao, $sql);
      
      //Se existir algum registro no BD, converte em array associativo
      //e armazena na variável $rsVisualizar
      while($rsVisualizar = mysqli_fetch_assoc($select)){
        
        $nome = $rsVisualizar['nome'];
        $email = $rsVisualizar['email'];
        $cpf = $rsVisualizar['cpf'];
        $celular = $rsVisualizar['celular'];
        $username = $rsVisualizar['username'];
        $perfil = $rsVisualizar['nome_perfil'];
        $data = explode("-",$rsVisualizar['data_insercao']);
        $data = $data[2] . "/" . $data[1] . "/" . $data[0];
        
        //Caso o perfil possua mais de um setor, os mesmos deverão ser inseridos
        //no vetor $setores
        if(mysqli_num_rows($select) > 1){
          $setores[] = $rsVisualizar['nome_setor_cms'];    
        }else{
          $setor = $rsVisualizar['nome_setor_cms'];  
        }
        
      }
      
    }
  }

?>

<html>
  <head></head>
  <body>
    <div id="informacoes_modal">
      
      <h2>Usuário <?= $nome . " - " . $perfil ?> </h2>
      <p> <?= "Data de Cadastro: " . $data ?> </p>
      <p> <?= "Nome: " . $nome ?> </p>
      <p> <?= "CPF: " . $cpf ?></p>
      <p> <?= "Cel.: " . $celular ?></p>
      <p> <?= "Email.: " . $email ?></p>
      <p> <?= "Username: " . $username ?> </p>
      <p>Acesso ao(s) setor(es): </p>
      <ul>
        <?php
          if(isset($setor)){
        ?>
            
          <li><?= $setor ?></li>
        
        <?php
          }else{ 
            
            foreach($setores as $setor){
        ?>
          
          <li><?= $setor ?></li>
        
        <?php
            }
          }
        ?>
      </ul>
      
    </div>
  </body>
</html>
