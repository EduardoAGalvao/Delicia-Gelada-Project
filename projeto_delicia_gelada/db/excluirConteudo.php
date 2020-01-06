<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "remocao"){
      
      //Abre a conexão com BD
      $conexao = conexaoMysql();
      
      //Coletando informações enviadas
      $idSecao = $_POST['codigoConteudo'];
      $codigoPagina = $_POST['codigoPagina'];
      $nomeFoto = $_POST['nomeFoto'];
      $data = date('Y-m-d');
      
      //A remoção do conteúdo é feito conforme a página, especificamente
      //Página 1 -> Curiosidades
      //Página 4 -> Produtos
      //Página 5 -> Promoções
      //Página 6 -> Mensalistic (Produto do mês)
      switch($codigoPagina){
          
        case 1:
          $sql = "UPDATE tbl_secao_curiosidades SET data_remocao = '".$data."' WHERE id_secao = ".$idSecao.";";
          break;
          
        case 4:
          $sql = "UPDATE tbl_produtos SET data_remocao = '".$data."' WHERE id_produto = ".$idSecao.";";
          
        case 5:
          $sql = "UPDATE tbl_promocoes SET data_remocao = '".$data."' WHERE id_promocao = ".$idSecao.";";
          break;
          
        default:
          break;
      }
            
      if(mysqli_query($conexao, $sql)){
        
        //Apagando imagem da pasta de arquivos
        unlink('arquivos/'.$nomeFoto);
          
      }else{
        echo('Erro na atualização de remoção no banco.');
      }
      
    }
    
  }

?>
