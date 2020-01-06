<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');
      
  //Abre a conexão com BD
  $conexao = conexaoMysql();

  //Na identificação pode ser enviado um id se for uma página
  //ou as palavras 'produtos' ou 'promocoes'
  $identificacao = $_POST['identificacao'];
  
  //O carregamento do conteúdo do formulário é feito conforme a página, especificamente
  //Página 1 -> Curiosidades
  //Página 4 -> Produtos
  //Página 5 -> Promoções
  //Página 6 -> Mensalistic (Produto do mês)
  switch($identificacao){
      
    case 1:

?>

<html>
  <head></head>
  <body>
    
  <form id="frm_sessao" name="frm_sessao" action="../db/salvarSecao.php?codigoPagina=<?=$identificacao?>" method="POST" enctype="multipart/form-data">
      <div id="frm_sessao_dados">
          <div id="form_sessao_esquerda">
            <div class="item_cadastro_secao" id="div_cadastro_secao_imagem">
              <label>Imagem:</label>
              <div class="div_secao_imagem">
                <img id="secao_imagem" src="">
              </div>  
            </div>
            <div class="item_cadastro_secao" id="div_cadastro_secao_file">
              <input type="file" name="fle_imagem" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="fle_imagem" multiple>
            </div>
            <div class="item_cadastro_secao" id="div_cadastro_secao_posicao">
              <label>Posição da imagem:</label>
              <input type="radio" name="rdo_posicao" checked id="rdo_posicao_esquerda" value="esquerda">
              <label>Esquerda</label>
              <input type="radio" name="rdo_posicao" id="rdo_posicao_direita" value="direita">
              <label>Direita</label>
            </div>
            <div class="item_cadastro_secao" id="div_cadastro_secao_formato">
              <label>Formato da Imagem:</label>
              <input type="radio" name="rdo_formato" checked id="rdo_formato_comum" value="comum">
              <label>Comum</label>
              <input type="radio" name="rdo_formato" id="rdo_formato_circular" value="circular">
              <label>Circular</label>
            </div>
          </div>
          <div id="form_sessao_direita">
              <div class="item_cadastro_secao" id="div_cadastro_secao_texto">
                <label for="txt_texto">Texto:</label>
                <textarea name="txt_texto_conteudo" id="txt_texto_conteudo" maxlength="250" required></textarea>
                <p><span id="quantidade_restante">250</span> caracteres restantes</p>
              </div>
          </div>
      </div>
      <div id="div_cadastro_secao_btn">
        <input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecao_<?=$identificacao?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

        <input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?= $identificacao ?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
      </div>
  </form>

  <div id="div_tabela_secoes">    
    <table id="tabela_secoes_pagina">
      <tr>
        <th>Data de Cadastro</th>
        <th>Imagem</th> 
        <th>Ativação</th>
        <th>Opções</th>
      </tr>

      <?php

        $sql = "SELECT * FROM tbl_secao_curiosidades WHERE data_remocao IS NULL;";

        $select = mysqli_query($conexao, $sql);

        while($secao = mysqli_fetch_assoc($select)){

      ?>

      <tr>

        <?php

          $dataInsercao = explode("-", $secao['data_insercao']);
          $dataInsercao = $dataInsercao[2] . "/" . $dataInsercao[1] . "/" . $dataInsercao[0];

        ?>

        <td><?= $dataInsercao; ?></td>
        <td><img id="imgSecaoGravada" src="../db/arquivos/<?= $secao['imagem']; ?>"/></td>
        <td>
          <label class="switch">
            <input type="checkbox" class="toggle_ativacao" id="curiosidade_<?= $secao['id_secao'];?>" <?= $secao['ativado'] == '0' ? '' : 'checked' ?> >
            <span class="slider round"></span>
          </label>
        </td>
        <td class="secao_acoes">
          <a href="javascript:void(0);">
            <div class="btn_visualizar visualizar_conteudo" id="<?=$secao['id_secao'].'_'.$identificacao ?>"></div>
          </a>
          <a href="javascript:void(0);">
            <div class="btn_editar editar_conteudo" id="<?=$secao['id_secao'].'_'.$identificacao ?>"></div>
          </a>
          <a id="link_excluir" href="javascript:void(0);" onclick="return confirm('Deseja realmente excluir esse conteúdo?');">
            <div class="btn_excluir_conteudo" id="<?= $secao['id_secao'].'_'.$secao['imagem'].'_'.$identificacao ?>"></div>
          </a>
        </td>
      </tr>

      <?php

        }

      ?>

    </table>
  </div>
  </body>

</html>

<?php
      break;
    case 4:
      
?>

<html>
  <head></head>
  <body>
    
  <form id="frm_sessao" name="frm_sessao" action="../db/salvarSecao.php?codigoPagina=<?=$identificacao?>" method="POST" enctype="multipart/form-data">
      <div id="frm_sessao_dados">
          <div id="form_sessao_esquerda">
            <div class="item_cadastro_secao" id="div_cadastro_secao_nome_produto">
              <label>Nome do Produto:</label>
              <input type="text" name="txt_nome_produto" placeholder="Ex: Morango com Ameixa 1L"/>
            </div>
            <div class="item_cadastro_secao" id="div_cadastro_secao_imagem">
              <label>Imagem:</label>
              <div class="div_secao_imagem">
                <img id="secao_imagem" src="">
              </div>  
            </div>
            <div class="item_cadastro_secao" id="div_cadastro_secao_file">
              <input type="file" name="fle_imagem" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="fle_imagem" multiple>
            </div>
          </div>
          <div id="form_sessao_direita">
              <div class="item_cadastro_secao" id="div_cadastro_secao_preco_produto">
                <label>Preço:</label>
                <input type="text" name="txt_preco_produto" id="txt_preco_produto" maxlength="5" placeholder="Ex: 24,90"/>
              </div>
              <div class="item_cadastro_secao" id="div_cadastro_secao_descricao">
                <label for="txt_texto">Descrição:</label>
                <textarea name="txt_descricao_produto" id="txt_texto_conteudo" maxlength="250"><?= isset($texto) ? $texto : '' ?></textarea>
                <p><span id="quantidade_restante">250</span> caracteres restantes</p>
              </div>
          </div>
      </div>
    
      <div id="gerenciador_categorias">
        <a href="javascript:void(0);">Gerenciar categorias</a>
      </div>
    
      <div id="gerenciador_subcategorias">
        <a href="javascript:void(0);">Gerenciar subcategorias</a>
      </div>
    
      <!--Seleção de Categoria-->
      <div class="div_cadastro_categoria">
        <div class="item_cadastro_secao" id="div_cadastro_categoria">
          <label>Categoria:</label>
          <div id="opcoes_categoria">
            <input type="radio" name="rdo_categoria" value="existente" checked><span> Existente</span>
            <input type="radio" name="rdo_categoria" value="novo">
            <span> Novo</span>
          </div>
          <select required name="slt_categoria" id="slt_categoria">
            <option selected value="">Selecione:</option>
            <?php

              $sql = "SELECT * FROM tbl_categorias WHERE data_remocao IS NULL ORDER BY id_categoria DESC";

              $select = mysqli_query($conexao, $sql);

              while($rs = mysqli_fetch_assoc($select)){

            ?>
            <option <?= isset($idCategoria) ? 'selected' : ''; ?> value="<?= $rs['id_categoria']; ?>"><?= $rs['nome_categoria']; ?>
            </option>

            <?php

              }

            ?>
          </select>
        </div>
        <div class="item_cadastro_secao" id="nova_categoria">
          <label>Nova Categoria:</label>
          <input type="text" name="txt_nome_categoria" pattern="[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ0-9 ]*" maxlength="50" placeholder="Ex: Sucos com Leite">
        </div>
      </div>
    
      <!--Seleção de Subcategoria-->
      <div class="div_cadastro_subcategoria">
        <div class="item_cadastro_secao" id="div_cadastro_subcategoria">
          <label>Subcategoria:</label>
          <div id="opcoes_subcategoria">
            <input type="radio" name="rdo_subcategoria" disabled value="existente" checked id="rdo_subcategoria_existente"><span> Existente</span>
            <input type="radio" name="rdo_subcategoria" disabled value="novo" id="rdo_nova_subcategoria">
            <span> Novo</span>
          </div>
          <select required name="slt_subcategoria" id="slt_subcategoria" disabled>
            <option selected value="">Selecione:</option>
            <?php

              $sql = "SELECT * FROM tbl_subcategorias WHERE data_remocao IS NULL ORDER BY id_categoria DESC";

              $select = mysqli_query($conexao, $sql);

              while($rs = mysqli_fetch_assoc($select)){

            ?>
            <option <?= isset($idCategoria) ? 'selected' : ''; ?> value="<?= $rs['id_subcategoria']; ?>"><?= $rs['nome_subcategoria']; ?>
            </option>

            <?php

              }

            ?>
          </select>
        </div>
        <div class="item_cadastro_secao" id="nova_subcategoria">
          <label>Nova Subcategoria:</label>
          <input type="text" name="txt_nome_subcategoria" pattern="[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ0-9 ]*" maxlength="50" placeholder="Ex: Sucos com Leite">
        </div>
      </div>
      <div id="div_cadastro_secao_btn">
        <input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecao_<?=$identificacao?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

        <input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?=$identificacao?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
      </div>
  </form>

  <div id="div_tabela_secoes">    
    <table id="tabela_secoes_pagina">
      <tr>
        <th>Nome</th>
        <th>Imagem</th>
        <th>Preço</th>
        <th>Ativação</th>
        <th>Opções</th>
      </tr>

      <?php

        $sql = "SELECT * FROM tbl_produtos WHERE data_remocao IS NULL;";

        $select = mysqli_query($conexao, $sql);

        while($secao = mysqli_fetch_assoc($select)){

      ?>

      <tr>
        <td><?= $secao['nome_produto']; ?></td>
        <td><img id="imgSecaoGravada" src="../db/arquivos/<?= $secao['imagem']; ?>"/></td>
        <td>R$ <?= $secao['preco']; ?></td>
        <td>
          <label class="switch">
            <input type="checkbox" class="toggle_ativacao" id="produto_<?= $secao['id_produto'];?>" <?= $secao['ativado'] == '0' ? '' : 'checked' ?> >
            <span class="slider round"></span>
          </label>
        </td>
        <td class="secao_acoes">
          <a href="javascript:void(0);">
            <div class="btn_visualizar visualizar_conteudo" id="<?=$secao['id_produto'].'_'.$identificacao ?>"></div>
          </a>
          <a href="javascript:void(0);">
            <div class="btn_editar editar_conteudo" id="<?=$secao['id_produto'].'_'.$identificacao ?>"></div>
          </a>
          <a id="link_excluir" href="javascript:void(0);" onclick="return confirm('Deseja realmente excluir esse conteúdo?');">
            <div class="btn_excluir_conteudo" id="<?= $secao['id_produto'].'_'.$secao['imagem'].'_'.$identificacao ?>"></div>
          </a>
        </td>
      </tr>

      <?php

        }

      ?>

    </table>
  </div>
  </body>

</html>
  
<?php
      break;
    case 5:
?>

<html>
  <head></head>
  <body>
  <h1>Escolha um produto e um valor de desconto para uma promoção fantástica!</h1>
  <form id="frm_sessao" name="frm_sessao" action="../db/salvarSecao.php?codigoPagina=<?=$identificacao?>" method="POST" enctype="multipart/form-data">
      <div id="frm_sessao_dados">
          <div id="form_sessao_esquerda">
              <div class="item_cadastro_secao" id="div_cadastro_produto_promocao">
                <label>Produto:</label>
                <select required name="slt_produtos" id="slt_produtos">
                  <option selected value="">Selecione:</option>
                  <?php

                    $sql = "SELECT * FROM tbl_produtos WHERE data_remocao IS NULL ORDER BY id_produto DESC";

                    $select = mysqli_query($conexao, $sql);

                    while($rs = mysqli_fetch_assoc($select)){

                  ?>
                  <option <?= isset($idProduto) ? 'selected' : ''; ?> value="<?= $rs['id_produto']; ?>"><?= $rs['nome_produto']; ?>
                  </option>

                  <?php

                    }

                  ?>
                </select>
              </div>
          </div>
          <div id="form_sessao_direita">
              <div class="item_cadastro_secao" id="div_cadastro_secao_desconto_promocoes">
                <label>Desconto:</label>
                <input type="text" name="txt_desconto_promocoes" pattern="[0-9]*" maxlength="2" placeholder="Ex: 15%"/>
              </div>
              
          </div>
      </div>
      <div id="div_cadastro_secao_btn">
        <input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecaoPromocoes_<?=$identificacao?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

        <input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?=$identificacao?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
      </div>
  </form>

  <div id="div_tabela_secoes">    
    <table id="tabela_secoes_pagina">
      <tr>
        <th>Produto</th>
        <th>Preço</th> 
        <th>Desconto</th>
        <th>Valor Final</th>
        <th>Opções</th>
      </tr>

      <?php

        $sql = "SELECT * FROM tbl_promocoes promo JOIN tbl_produtos prod ON promo.id_produto = prod.id_produto WHERE promo.data_remocao IS NULL;";

        $select = mysqli_query($conexao, $sql);

        while($rs = mysqli_fetch_assoc($select)){

      ?>

      <tr>
        <td><?= $rs['nome_produto'] ?></td>
        <td><?= "R$ ". $rs['preco'] ?></td>
        <td><?= $rs['desconto'] ."% | R$ ". round($rs['preco']*$rs['desconto']/100, 2) ?></td>
        <td><?= "R$ ". round($rs['preco'] - ($rs['preco']*$rs['desconto']/100), 2) ?></td>
        <td class="secao_acoes">
          <a href="javascript:void(0);">
            <div class="btn_visualizar visualizar_conteudo" id="<?=$rs['id_promocao'].'_'.$identificacao ?>"></div>
          </a>
          <a href="javascript:void(0);">
            <div class="btn_editar editar_conteudo" id="<?=$rs['id_promocao'].'_'.$identificacao ?>"></div>
          </a>
          <a id="link_excluir" href="javascript:void(0);" onclick="return confirm('Deseja realmente excluir esse conteúdo?');">
            <div class="btn_excluir_conteudo" id="<?= $rs['id_promocao'].'_'.$rs['imagem'].'_'.$identificacao ?>"></div>
          </a>
        </td>
      </tr>

      <?php

        }

      ?>

    </table>
  </div>
  </body>

</html>

<?php
      break;
    case 6:
?>

<html>
  <head></head>
  <body>
  <h1>Escolha um produto do mês e as imagens e texto que farão parte de sua apresentação! ^^</h1>
  <ul id="lista_observacoes_mensalistic">
    <li>O layout abaixo simula o layout original da página</li>  
    <li>Ao adicionar um novo produto do mês, o anterior é automaticamente desativado</li>
  </ul>  
  <form id="frm_sessao" name="frm_sessao" action="../db/salvarSecao.php?codigoPagina=<?=$identificacao?>" method="POST" enctype="multipart/form-data">
      <div id="frm_sessao_dados_mensalistic">
        <div class="item_cadastro_secao" id="div_cadastro_produto_mes">
          <label>Produto do Mês:</label>
          <select required name="slt_produto_mes" id="slt_produto_mes">
            <option selected value="">Selecione:</option>
            <?php

              $sql = "SELECT * FROM tbl_produtos WHERE data_remocao IS NULL ORDER BY id_produto DESC";

              $select = mysqli_query($conexao, $sql);

              while($rs = mysqli_fetch_assoc($select)){

            ?>
            <option <?= isset($idProduto) ? 'selected' : ''; ?> value="<?= $rs['id_produto']; ?>"><?= $rs['nome_produto']; ?>
            </option>

            <?php

              }

            ?>
          </select>
        </div>
        
        <div id="cadastro_mensalistic_inicio">
          
          <h2>Superior</h2>
          
          <div class="item_cadastro_secao" id="mensalistic_inicio_titulo">
            <label>Título:</label>
            <input type="text" name="txt_titulo_mensalistic" pattern="[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ0-9 ]*" maxlength="30" placeholder="Ex: A melhor fruta cítrica">
          </div>
          
          <div class="mensalistic_dados">
            
            <div class="item_cadastro_secao imagem_mensalistic">
              <label>Imagem 1:</label>
              <div class="div_secao_imagem">
                <img id="secao_imagem1" src="">
              </div>
              <div class="item_cadastro_secao" id="div_cadastro_secao_file">
                <input type="file" name="fle_imagem_1" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="ipt_1" class="fle_imagem" multiple>
              </div>
            </div>
            
            <div class="item_cadastro_secao" id="div_cadastro_secao_texto">
              <label for="txt_texto">Conteúdo 1:</label>
              <textarea name="txt_conteudo1" class="txt_texto_conteudo" id="1" maxlength="165"><?= isset($texto) ? $texto : '' ?></textarea>
              <p><span id="quantidade_restante1">165</span> caracteres restantes</p>
            </div>
            
            <div class="item_cadastro_secao imagem_mensalistic">
              <label>Imagem 2:</label>
              <div class="div_secao_imagem">
                <img id="secao_imagem2" src="">
              </div>
              <div class="item_cadastro_secao" id="div_cadastro_secao_file">
                <input type="file" name="fle_imagem_2" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="ipt_2" class="fle_imagem" multiple>
              </div>
            </div>
            
          </div>
        
        </div>  
        
        <div id="cadastro_mensalistic_meio">
          <div>
            <h2>Meio</h2>
          </div>
          
          <div class="mensalistic_dados">
            <div class="item_cadastro_secao" id="div_cadastro_secao_texto">
              <label for="txt_texto">Conteúdo 2:</label>
              <textarea name="txt_conteudo2" class="txt_texto_conteudo" id="2" maxlength="250"></textarea>
              <p><span id="quantidade_restante2">250</span> caracteres restantes</p>
            </div>

            <div class="item_cadastro_secao imagem_mensalistic">
              <label>Imagem 3:</label>
              <div class="div_secao_imagem">
                <img id="secao_imagem3" src="">
              </div>
              <div class="item_cadastro_secao" id="div_cadastro_secao_file">
                <input type="file" name="fle_imagem_3" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="ipt_3" class="fle_imagem" multiple>
              </div>
            </div>

            <div class="item_cadastro_secao" id="div_cadastro_secao_texto">
              <label for="txt_texto">Conteúdo 3:</label>
              <textarea name="txt_conteudo3" class="txt_texto_conteudo" id="3" maxlength="180"><?= isset($texto) ? $texto : '' ?></textarea>
              <p><span id="quantidade_restante3">180</span> caracteres restantes</p>
            </div>
          </div>  
          
        </div>
        
        <div id="cadastro_mensalistic_final">
          <div>
            <h2>Inferior</h2>
          </div>
          <div class="item_cadastro_secao imagem_mensalistic">
            <label>Imagem 4:</label>
            <div class="div_secao_imagem">
              <img id="secao_imagem4" src="">
            </div>
            <div class="item_cadastro_secao" id="div_cadastro_secao_file">
              <input type="file" name="fle_imagem_4" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="ipt_4" class="fle_imagem" multiple>
            </div>
          </div>
        </div>
        
      </div>
      <div id="div_cadastro_secao_btn">
        <input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecaoMensalistic_<?=$identificacao?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

        <input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?=$identificacao?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
      </div>
  </form>
  
  <div id="div_tabela_secoes">    
    <table id="tabela_secoes_pagina">
      <tr>
        <th>Produto</th>
        <th>Foto</th> 
        <th>Preco</th>
        <th>Opções</th>
      </tr>

      <?php

        $sql = "SELECT * FROM tbl_mensalistic m JOIN tbl_produtos prod ON m.id_produto = prod.id_produto WHERE m.data_exclusao IS NULL;";

        $select = mysqli_query($conexao, $sql);

        while($rs = mysqli_fetch_assoc($select)){

      ?>

      <tr>
        <td><?= $rs['nome_produto'] ?></td>
        <td><img id="foto_produto_mes" src="../db/arquivos/<?= $rs['imagem'] ?>"></td>
        <td><?= 'R$ '.$rs['preco'] ?></td>
        <td class="secao_acoes">
          <a href="javascript:void(0);">
            <div class="btn_visualizar visualizar_conteudo" id="<?=$rs['id_produto_mes'].'_'.$identificacao ?>"></div>
          </a>
          <a href="javascript:void(0);">
            <div class="btn_editar editar_conteudo" id="<?=$rs['id_produto_mes'].'_'.$identificacao ?>"></div>
          </a>
        </td>
      </tr>

      <?php

        }

      ?>

    </table>
  </div>
  </body>

</html>


<?php
      break;
    default:
      
?>

<html>
  <head></head>
  <body>
    <h1>Em construção!</h1>
  </body>
</html>

<?php      
      break;
                    }

?>

