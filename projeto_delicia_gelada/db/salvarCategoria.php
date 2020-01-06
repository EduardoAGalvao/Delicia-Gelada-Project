<?php

  //Arquivo para atualização de edição de categoria 
  //referente aos produtos no Controle de Conteúdo

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
      
    //Abre a conexão com BD
    $conexao = conexaoMysql();

    if($_POST['modo'] == "salvarCategoria"){
      
      $idCategoria = $_POST['codigo'];
      $txtNomeCategoria = $_POST['nome_categoria'];
      
      $sql = "UPDATE tbl_categorias SET nome_categoria = '".$txtNomeCategoria."' WHERE id_categoria = ".$idCategoria;
      
      if(!mysqli_query($conexao, $sql)){
        echo($sql);
      }
      
    }
    
  }

?>

<html>
<head></head>
<body>
<div class="div_tabela_categorias">
  <table class="tabela_categorias">
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
        <a class="editar_categoria" id="<?= $categoria['id_categoria']; ?>" href="javascript:void(0);">
          <div class="btn_editar"></div>
        </a>
        <a href="javascript:void(0);" class="excluir_categoria" id="<?= $categoria['id_categoria']; ?>">
          <div class="btn_excluir"></div>
        </a>
      </td>
    </tr>

    <?php

      }
    }

    ?>
  </table>
  </div>

  <div class="edicao_categorias_modal">
    <h3>Selecione um elemento para edição e utilize a caixa de texto abaixo:</h3>
    <div class="ipt_edicao_categoria">
      <input class="txt_edicao_categoria" type="text" name="txt_edicao_categoria" readonly Ex: Vitaminas/>
      <input type="button" class="btnSalvarCategoria" name="btnSalvarCategoria" value="SALVAR">
    </div>
  </div>  
</body>
</html>