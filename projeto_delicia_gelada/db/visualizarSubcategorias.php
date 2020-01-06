<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "gerenciar_subcategorias"){
      
      //Abre a conexão com BD
      $conexao = conexaoMysql();
      
    }
    
  }

?>

<html>
  <head>
    <script>
            
      $(document).ready(function(){
          
        $(document).on('click', '.msg_err', function(){
            $('.msg_err_perfil').hide();
            $('.msg_err').hide();
        });
        
        $(document).on('click', '.excluir_subcategoria', function(){
          
          let $idSubcategoria = $(this).attr('id');
          
          $.ajax({
            type: "POST",
            url: "../db/excluirSubcategoria.php",
            data: {modo: 'remocao', codigo: $idSubcategoria},
            success: function(dados){

              $('.tabela_categorias').html(dados);
              
            }
          });
          
        });
        
        $(document).on('click', '.editar_subcategoria', function(){
          
          let $idSubcategoria = $(this).attr('id');
          
          $.ajax({
            type: "POST",
            url: "../db/carregarSubcategoria.php",
            data: {modo: 'editarCategoria', codigo: $idSubcategoria},
            success: function(dados){

             $('.edicao_categorias_modal').html(dados);
              
            }
          });
          
        });
        
        $(document).on('click', '.btnSalvarCategoria', function(){
          
          let $idSubcategoria = $(this).attr('id');
          let $txtSubcategoria = $('.txt_edicao_categoria').val();
          
          $.ajax({
            type: "POST",
            url: "../db/salvarSubcategoria.php",
            data: {modo: 'salvarSubcategoria', codigo: $idSubcategoria, nome_subcategoria: $txtSubcategoria},
            success: function(dados){

             $('.div_cadastro_categoria_modal').html(dados);
              
            }
          });
          
        });
        
      });
      
    </script>
  </head>
  <body>
    <div id="conteudo_perfis">
      <h1>Gerenciador de Subcategorias</h1>
        
      <div class="div_cadastro_categoria_modal">
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
                  <a href="javascript:void(0);" class="excluir_subcategoria" id="<?= $subcategoria['id_subcategoria']; ?>">
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
        </div>
        
    </div>
    
  </body>
</html>