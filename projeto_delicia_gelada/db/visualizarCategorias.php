<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "gerenciar_categorias"){
      
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
        
        $(document).on('click', '.excluir_categoria', function(){
          
          let $idCategoria = $(this).attr('id');
          
          $.ajax({
            type: "POST",
            url: "../db/excluirCategoria.php",
            data: {modo: 'remocao', codigo: $idCategoria},
            success: function(dados){

              $('.tabela_categorias').html(dados);
              
            }
          });
          
        });
        
        $(document).on('click', '.editar_categoria', function(){
          
          let $idCategoria = $(this).attr('id');
          
          $.ajax({
            type: "POST",
            url: "../db/carregarCategoria.php",
            data: {modo: 'editarCategoria', codigo: $idCategoria},
            success: function(dados){

             $('.edicao_categorias_modal').html(dados);
              
            }
          });
          
        });
        
        $(document).on('click', '.btnSalvarCategoria', function(){
          
          let $idCategoria = $(this).attr('id');
          let $txtCategoria = $('.txt_edicao_categoria').val();
          
          $.ajax({
            type: "POST",
            url: "../db/salvarCategoria.php",
            data: {modo: 'salvarCategoria', codigo: $idCategoria, nome_categoria: $txtCategoria},
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
      <h1>Gerenciador de Categorias</h1>
        
        <div class="div_cadastro_categoria_modal">
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
        </div>
        
    </div>
    
  </body>
</html>