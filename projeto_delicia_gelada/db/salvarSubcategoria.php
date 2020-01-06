<?php

  //Arquivo para atualização de edição de subcategoria 
  //referente aos produtos no Controle de Conteúdo

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
      
    //Abre a conexão com BD
    $conexao = conexaoMysql();

    if($_POST['modo'] == "salvarSubcategoria"){
      
      $idSubcategoria = $_POST['codigo'];
      $txtNomeSubcategoria = $_POST['nome_subcategoria'];
      
      $sql = "UPDATE tbl_subcategorias SET nome_subcategoria = '".$txtNomeSubcategoria."' WHERE id_subcategoria = ".$idSubcategoria;
      
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
                  <a href="javascript:void(0);" class="excluir_categoria" id="<?= $subcategoria['id_subcategoria']; ?>">
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