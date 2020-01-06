<?php

  //Arquivo para a remoção de uma subcategoria que é utilizada para
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
      
      $idSubcategoria = $_POST['codigo'];
      $data = date('Y-m-d');
        
      $sql = "SELECT * FROM tbl_produtos WHERE id_subcategoria = ".$idSubcategoria." AND data_remocao IS NULL;";
        
      $select = mysqli_query($conexao, $sql);
      
      //Somente há exclusão se não estiver sendo usado por um usuário
      if(mysqli_num_rows($select) > 0){
        
        //Ação caso esteja sendo utilizado
          echo('<p class="msg_err_perfil">A subcategoria não pode ser removida, pois está sendo utilizada por algum produto no momento. Para excluí-la, por gentileza remova os produtos primeiro.</p><button class="msg_err">Ok</button>');  
          
      }else{
          
         $sql = "UPDATE tbl_subcategorias SET data_remocao = '".$data."' WHERE id_subcategoria = ".$idSubcategoria.";";
        
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
    <th>Subcategoria</th>
    <th>Categoria</th>
    <th>Opções</th>
  </tr>

  <?php

    $sql = "SELECT * FROM tbl_subcategorias s JOIN tbl_categorias c ON s.id_categoria = c.id_categoria WHERE s.data_remocao IS NULL";

    $select = mysqli_query($conexao, $sql);

    if($select){

      while($subcategoria = mysqli_fetch_assoc($select)){          

  ?>

  <tr>

    <td><?= $subcategoria['nome_subcategoria']; ?></td>
    <td><?= $subcategoria['nome_categoria']; ?></td>

    <td class="usuario_acoes">
        <a class="editar_subcategoria" id="<?= $subcategoria['id_subcategoria']; ?>" href="javascript:void(0);">
          <div class="btn_editar"></div>
        </a>
        <a href="javascript:void(0);" class="excluir_subcategoria" id="<?= $subcategoria['id_subcategoria']; ?>">
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