<?php

if(isset($_GET['modo'])){
    
    if($_GET['modo'] == "excluir"){
      
      //Recebe o id enviado via URL enviado pelo link do HTML
      $idUsuario = $_GET['codigo'];
      
      require_once("conexao.php");

      $conexao = conexaoMysql();

      $dataExclusao = date("Y-m-d");
      
      //O usuário é removido tendo sua data de remoção atualizada e 
      //sendo obrigatoriamente desativado
      $sql = "UPDATE tbl_usuarios SET data_remocao = '" . $dataExclusao . "', ativado = '0' WHERE id_usuario = " . $idUsuario;

      if(mysqli_query($conexao, $sql)){
        echo("
          <script>
            alert('Usuário removido com sucesso!');
            window.location.href='../cms/controle_usuarios.php';
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