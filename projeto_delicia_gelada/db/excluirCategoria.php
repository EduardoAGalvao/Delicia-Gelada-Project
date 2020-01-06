<?php

  //Arquivo para a remoção de uma categoria que é utilizada para
  //classificar Produtos no Controle de Conteúdo

  $mensagem = false;

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "remocao"){
      
      //Abre a conexão com BD
      $conexao = conexaoMysql();
      
      $idCategoria = $_POST['codigo'];
      $data = date('Y-m-d');
        
      $sql = "SELECT * FROM tbl_produtos WHERE id_categoria = ".$idCategoria." AND data_remocao IS NULL;";
        
      $select = mysqli_query($conexao, $sql);
      
      //Somente há exclusão se não estiver sendo usado por um usuário
      if(mysqli_num_rows($select) > 0){
        
        //Ação caso esteja sendo utilizado
          echo('<p class="msg_err_perfil">A categoria não pode ser removida, pois está sendo utilizada por algum produto ou subcategoria no momento. Para excluí-la, por gentileza remova os produtos e as subcategorias da mesma.</p><button class="msg_err">Ok</button>');  
          
      }else{
          
         $sql = "UPDATE tbl_categorias SET data_remocao = '".$data."' WHERE id_categoria = ".$idCategoria.";";
        
         if(mysqli_query($conexao, $sql)){
         //Ação ao ser removido

        }
          
      }
      
    }
    
  }

?>

<html>
<head>
</head>
<body>
  <tr>
    <th>Categoria</th>
    <th>Opções</th>
  </tr>

  <?php

    $sql = "SELECT * FROM tbl_categorias WHERE data_remocao IS NULL";

    $select = mysqli_query($conexao, $sql);

    if($select){

      while($categoria = mysqli_fetch_assoc($select)){          

  ?>

  <tr>

    <td><?= $categoria['nome_categoria']; ?></td>

    <td class="usuario_acoes">
      <a class="editar_categoria" id="<?= $categoria['id_categoria']; ?>" href="#">
        <div class="btn_editar"></div>
      </a>
      <a href="#" class="excluir_categoria" id="<?= $categoria['id_categoria']; ?>">
        <div class="btn_excluir"></div>
      </a>
    </td>
  </tr>

  <?php

    }
  }

  ?>
</body>
</html>