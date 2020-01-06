<?php

//Arquivo que realiza a atualização da data de remoção de uma mensagem 
//de contato pelo Fale Conosco.
//Essa atualização permite que a mensagem não apareça mais no feed.

if(isset($_GET['modo'])){
    
    if($_GET['modo'] == "excluir"){
      
      //Recebe o id enviado via URL enviado pelo link do HTML
      $idContato = $_GET['codigo'];
      
      require_once("conexao.php");

      $conexao = conexaoMysql();

      $dataExclusao = date("Y-m-d");

      $sql = "UPDATE tbl_contato SET data_exclusao = '" . $dataExclusao . "' WHERE id_contato = " . $idContato;

      if(mysqli_query($conexao, $sql)){
        echo("
          <script>
            alert('Contato e mensagem removidos com sucesso!');
            window.location.href='../cms/controle_fale_conosco.php';
          </script>
        ");
      }else{
        echo("
          <script>
            alert('Erro na execução do banco!');
          </script>
        ");
      }

    }
}

?>