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
      $sql = "SELECT * FROM tbl_contato WHERE id_contato = " . $codigo;
      
      //Executa o script no banco
      $select = mysqli_query($conexao, $sql);
      
      //Se existir algum registro no BD, converte em array associativo
      //e armazena na variável $rsVisualizar
      if($rsVisualizar = mysqli_fetch_assoc($select)){
        
        $nome = $rsVisualizar['nome'];
        $email = $rsVisualizar['email'];
        $homepage = $rsVisualizar['home_page'];
        $facebook = $rsVisualizar['facebook'];
        $celular = $rsVisualizar['celular'];
        $telefone = $rsVisualizar['telefone'];
        $motivo_contato = $rsVisualizar['motivo_contato'];
        $mensagem = $rsVisualizar['mensagem'];
        $data = explode("-",$rsVisualizar['data_insercao']);
        $data = $data[2] . "/" . $data[1] . "/" . $data[0];
      }
      
    }
  }

?>

<html>
  <head></head>
  <body>
    <div id="informacoes_modal">
      <h2>Mensagem de <?= $motivo_contato == "criticas" ? "Crítica" : "Sugestão" ?> </h2>
      <p> <?= "Data do Contato: " . $data ?> </p>
      <p> <?= "Nome: " . $nome ?> </p>
      <p> <?= "Cel.: " . $celular ?> <?= $telefone != "" ? " | Tel.: " . $telefone : "" ?> </p>
      <p> <?= "Email.: " . $email ?></p>
      <p> <?= $homepage != "" ? " Homepage.: " . $homepage : "" ?> </p>
      <p> <?= $facebook != "" ? " Facebook.: " . $facebook : "" ?> </p>
      <textarea readonly> <?= $mensagem != "" ? $mensagem : "Mensagem vazia." ?> </textarea>
    </div>
  </body>
</html>
