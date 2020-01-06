<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  session_start();

  //Abre a conexão com BD
  $conexao = conexaoMysql();
  
  //Coletando o ID do conteúdo específico
  $idConteudo = $_POST['codigo'];

  //Coletando o ID da página específica
  $idPagina = $_POST['pagina'];

  //Inicializando o modo de leitura
  $modo = 'leitura';

  //Declaração de variáveis gerais
  $sqlGeral = null;
  $nome_imagem = null;
  
  //Ao verificar o ID da página, determina quais variáveis base serão utilizadas,
  //realiza select no banco e obtém as informações necessárias
  //Página 1 -> Curiosidades
  //Página 4 -> Produtos
  //Página 5 -> Promoções
  //Página 6 -> Mensalistic (Produto do mês)
  switch($idPagina){
    
    //Curiosidades  
    case 1:
    
      $texto = null;
      $nome_imagem = null;
      $posicao_imagem = null;
      $formato_imagem = null;
      
      $sqlGeral = "SELECT * FROM tbl_secao_curiosidades WHERE id_secao = " .$idConteudo;

      $select = mysqli_query($conexao, $sqlGeral);

      while($rs = mysqli_fetch_assoc($select)){
        $texto = $rs['texto'];
        $nome_imagem = $rs['imagem'];
        $posicao_imagem = $rs['posicao_imagem'];
        $formato_imagem = $rs['formato_imagem'];
      }
      
      break;
    
    //Produtos  
    case 4:
      
      $nome_produto = null;
      $nome_imagem = null;
      $descricao = null;
      $preco = null;
      $idCategoria = null;
      $idSubcategoria = null;
      
      $sqlGeral = "SELECT * FROM tbl_produtos WHERE id_produto = " .$idConteudo;

      $select = mysqli_query($conexao, $sqlGeral);

      while($rs = mysqli_fetch_assoc($select)){
        $nome_produto = $rs['nome_produto'];
        $nome_imagem = $rs['imagem'];
        $descricao = $rs['descricao'];
        $preco = $rs['preco'];
        $idCategoria = $rs['id_categoria'];
        $idSubcategoria = $rs['id_subcategoria'];
      }
      
      break;
    
    //Promoções  
    case 5:
      
      $idProduto = null;
      $desconto = null;
      
      $sqlGeral = "SELECT * FROM tbl_promocoes WHERE id_promocao = " .$idConteudo;

      $select = mysqli_query($conexao, $sqlGeral);

      while($rs = mysqli_fetch_assoc($select)){
        $idProduto = $rs['id_produto'];
        $desconto = $rs['desconto'];
      }
      
      break;
      
      //Mensalistic
    case 6:

      $sltProdutoMes = (int) null;
      $txtTitulo = (string) null;
      $txtInicio = (string) null;
      $txtMeio1  = (string) null;
      $txtMeio2 = (string) null;
      $foto1 = (string) null;
      $foto2 = (string) null;
      $foto3 = (string) null;
      $foto4 = (string) null;

      $sqlGeral = "SELECT * FROM tbl_mensalistic WHERE id_produto_mes = " .$idConteudo;

      $select = mysqli_query($conexao, $sqlGeral);

      while($rs = mysqli_fetch_assoc($select)){
        $sltProdutoMes = $rs['id_produto'];
        $txtTitulo = $rs['titulo'];
        $txtInicio = $rs['texto_inicio'];
        $txtMeio1  = $rs['texto1_meio'];
        $txtMeio2 = $rs['texto2_meio'];
        $foto1 = $rs['imagem1_inicio'];
        $foto2 = $rs['imagem2_inicio'];
        $foto3 = $rs['imagem_meio'];
        $foto4 = $rs['imagem_final'];

        for($cont = 1; $cont <= 4; $cont++){
          $nomesImagens[$cont - 1] = ${'foto'.$cont};   
        }

      }
      
      break;
      
    default:
      break;
  }

  //Verifica se modo é para visualizar
  if($_POST['modo'] == "editarConteudo"){
    $modo = 'editar';
    $_SESSION['idConteudoEdicao'] = $idConteudo;
  }
  
?>

<html>
<head></head>
<body>
  <?php
  
  //O carregamento do conteúdo do formulário é feito conforme a página, especificamente
  //Página 1 -> Curiosidades
  //Página 4 -> Produtos
  //Página 5 -> Promoções
  //Página 6 -> Mensalistic (Produto do mês)
  switch($idPagina){
      
    case 1:
  
  ?>
  <div id="frm_sessao_dados">
    <div id="form_sessao_esquerda">
      <div class="item_cadastro_secao" id="div_cadastro_secao_imagem">
        <label>Imagem:</label>
        <div class="div_secao_imagem">
          <img id="secao_imagem" src="../db/arquivos/<?= isset($nome_imagem) ? $nome_imagem : '' ?>">
        </div>  
      </div>
      <div class="item_cadastro_secao" id="div_cadastro_secao_file">
        <input type="file" required name="fle_imagem" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="fle_imagem" multiple>
      </div>
      <div class="item_cadastro_secao" id="div_cadastro_secao_posicao">
        <label>Posição da imagem:</label>
        <input type="radio" name="rdo_posicao" <?= $posicao_imagem == 'esquerda' ? 'checked' : '' ?> id="rdo_posicao_esquerda" value="esquerda">
        <label>Esquerda</label>
        <input type="radio" name="rdo_posicao" <?= $posicao_imagem == 'direita' ? 'checked' : '' ?> id="rdo_posicao_direita" value="direita">
        <label>Direita</label>
      </div>
      <div class="item_cadastro_secao" id="div_cadastro_secao_formato">
        <label>Formato da Imagem:</label>
        <input type="radio" name="rdo_formato" <?= $formato_imagem == 'comum' ? 'checked' : '' ?> id="rdo_formato_comum" value="comum">
        <label>Comum</label>
        <input type="radio" name="rdo_formato" <?= $formato_imagem == 'circular' ? 'checked' : '' ?> id="rdo_formato_circular" value="circular">
        <label>Circular</label>
      </div>
    </div>
    <div id="form_sessao_direita">
        <div class="item_cadastro_secao" id="div_cadastro_secao_texto">
          <label for="txt_texto">Texto:</label>
          <textarea name="txt_texto_conteudo" required id="txt_texto_conteudo" maxlength="250"><?= isset($texto) ? $texto : '' ?></textarea>
          <p><span id="quantidade_restante">250</span> caracteres restantes</p>
        </div>
    </div>
</div>
<div id="div_cadastro_secao_btn">
  <input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecaoCuriosidades_<?= $idPagina ?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

  <input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?= $idPagina ?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
</div>
  
<?php
    break;
    
    case 4:
?>
<div id="frm_sessao_dados">
  <div id="form_sessao_esquerda">
    <div class="item_cadastro_secao" id="div_cadastro_secao_nome_produto">
      <label>Nome do Produto:</label>
      <input type="text" name="txt_nome_produto" value="<?= $nome_produto ?>" placeholder="Ex: Morango com Ameixa 1L"/>
    </div>
    <div class="item_cadastro_secao" id="div_cadastro_secao_imagem">
      <label>Imagem:</label>
      <div class="div_secao_imagem">
        <img id="secao_imagem" src="../db/arquivos/<?= $nome_imagem ?>">
      </div>  
    </div>
    <div class="item_cadastro_secao" id="div_cadastro_secao_file">
      <input type="file" name="fle_imagem" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="fle_imagem" multiple>
    </div>
  </div>
  <div id="form_sessao_direita">
      <div class="item_cadastro_secao" id="div_cadastro_secao_preco_produto">
        <label>Preço:</label>
        <input type="text" name="txt_preco_produto" maxlength="5" id="txt_preco_produto" value="<?= $preco ?>" placeholder="Ex: 24,90"/>
      </div>
      <div class="item_cadastro_secao" id="div_cadastro_secao_descricao">
        <label for="txt_texto">Descrição:</label>
        <textarea name="txt_descricao_produto" id="txt_texto_conteudo" maxlength="250"><?= isset($descricao) ? $descricao : '' ?></textarea>
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
      
    <option <?= $idCategoria == $rs['id_categoria'] ? 'selected' : ''; ?> value="<?= $rs['id_categoria']; ?>"><?= $rs['nome_categoria']; ?>
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
    <input type="radio" name="rdo_subcategoria" <?= $_POST['modo'] == "editarConteudo" ? '' : 'disabled' ?> value="existente" checked id="rdo_subcategoria_existente"><span> Existente</span>
    <input type="radio" name="rdo_subcategoria" <?= $_POST['modo'] == "editarConteudo" ? '' : 'disabled' ?> value="novo" id="rdo_nova_subcategoria">
    <span> Novo</span>
  </div>
  <select required name="slt_subcategoria" id="slt_subcategoria" <?= $_POST['modo'] == "editarConteudo" ? '' : 'disabled' ?>>
    <option selected value="">Selecione:</option>
    <?php

      $sql = "SELECT * FROM tbl_subcategorias WHERE data_remocao IS NULL ORDER BY id_categoria DESC";

      $select = mysqli_query($conexao, $sql);

      while($rs = mysqli_fetch_assoc($select)){

    ?>
    <option <?= $idSubcategoria == $rs['id_subcategoria'] ? 'selected' : ''; ?> value="<?= $rs['id_subcategoria']; ?>"><?= $rs['nome_subcategoria']; ?>
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
  <input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecao_<?=$idPagina?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

  <input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?= $idPagina ?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
</div>
  
<?php
      break;
      
    case 5:
      
?>
  
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
          <option <?= $idProduto == $rs['id_produto'] ? 'selected' : '' ?> value="<?= $rs['id_produto']; ?>"><?= $rs['nome_produto']; ?>
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
        <input type="text" required name="txt_desconto_promocoes" placeholder="Ex: 15%" pattern="[0-9]*" maxlength="2" value="<?= $desconto ?>"/>
      </div>

  </div>
</div>
<div id="div_cadastro_secao_btn">
<input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecaoPromocoes_<?= $idPagina ?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

<input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?= $idPagina ?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
</div>
  
<?php
            
    break;
      
    case 6:
?>
  
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
      <option <?= $sltProdutoMes == $rs['id_produto'] ? 'selected' : ''; ?> value="<?= $rs['id_produto']; ?>"><?= $rs['nome_produto']; ?>
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
      <input type="text" name="txt_titulo_mensalistic" pattern="[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ0-9 ]*" maxlength="30" placeholder="Ex: A melhor fruta cítrica" value="<?= $txtTitulo ?>">
    </div>

    <div class="mensalistic_dados">

      <div class="item_cadastro_secao imagem_mensalistic">
        <label>Imagem 1:</label>
        <div class="div_secao_imagem">
          <img id="secao_imagem1" src="../db/arquivos/<?= $foto1 ?>">
        </div>
        <div class="item_cadastro_secao" id="div_cadastro_secao_file">
          <input type="file" name="fle_imagem_1" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="ipt_1" class="fle_imagem" multiple>
        </div>
      </div>

      <div class="item_cadastro_secao" id="div_cadastro_secao_texto">
        <label for="txt_texto">Conteúdo 1:</label>
        <textarea name="txt_conteudo1" class="txt_texto_conteudo" id="1" maxlength="165"><?= $txtInicio ?></textarea>
        <p><span id="quantidade_restante1">165</span> caracteres restantes</p>
      </div>

      <div class="item_cadastro_secao imagem_mensalistic">
        <label>Imagem 2:</label>
        <div class="div_secao_imagem">
          <img id="secao_imagem2" src="../db/arquivos/<?= $foto2 ?>">
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
        <textarea name="txt_conteudo2" class="txt_texto_conteudo" id="2" maxlength="250"><?= $txtMeio1 ?></textarea>
        <p><span id="quantidade_restante2">250</span> caracteres restantes</p>
      </div>

      <div class="item_cadastro_secao imagem_mensalistic">
        <label>Imagem 3:</label>
        <div class="div_secao_imagem">
          <img id="secao_imagem3" src="../db/arquivos/<?= $foto3 ?>">
        </div>
        <div class="item_cadastro_secao" id="div_cadastro_secao_file">
          <input type="file" name="fle_imagem_3" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="ipt_3" class="fle_imagem" multiple>
        </div>
      </div>

      <div class="item_cadastro_secao" id="div_cadastro_secao_texto">
        <label for="txt_texto">Conteúdo 3:</label>
        <textarea name="txt_conteudo3" class="txt_texto_conteudo" id="3" maxlength="180"><?= $txtMeio2 ?></textarea>
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
        <img id="secao_imagem4" src="../db/arquivos/<?= $foto4 ?>">
      </div>
      <div class="item_cadastro_secao" id="div_cadastro_secao_file">
        <input type="file" name="fle_imagem_4" accept="IMAGE/JPG, IMAGE/JPEG, IMAGE/PNG" id="ipt_4" class="fle_imagem" multiple>
      </div>
    </div>
  </div>

</div>
<div id="div_cadastro_secao_btn">
  <input type="button" class="btnCadastrarSecao" name="btnCadastrarSecao" id="btnCadastrarSecaoMensalistic_<?=$idPagina?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">

  <input class="botao botaoLimpar" type="reset" name="btnLimpar" id="btnLimparSecao_<?=$idPagina?>" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
</div>
  
<?php
      break;
      
    default:
      break;
      
  }
?>
  
</body>
</html>