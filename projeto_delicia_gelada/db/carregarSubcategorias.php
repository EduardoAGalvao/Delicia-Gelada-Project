<?php

  if(isset($_POST['modo']) && $_POST['modo'] == 'carregamento'){
    
    //Importa o arquivo de conexão com BD
    require_once('conexao.php');
    
    //Abre a conexão com BD
    $conexao = conexaoMysql();
    
    //Coleta o código da categoria escolhida
    $codigoCategoria = $_POST['categoria'];
    
  }

?>

<html>
  <head></head>
  <body>
    <label>Subcategoria:</label>
    <div id="opcoes_subcategoria">
      <input type="radio" name="rdo_subcategoria" value="existente" checked><span> Existente</span>
      <input type="radio" name="rdo_subcategoria" value="novo">
      <span> Novo</span>
    </div>
    <select required name="slt_subcategoria" id="slt_subcategoria">
      <option selected value="">Selecione:</option>
      <?php

        $sql = "SELECT * FROM tbl_subcategorias WHERE data_remocao IS NULL AND id_categoria = ".$codigoCategoria;

        $select = mysqli_query($conexao, $sql);

        while($rs = mysqli_fetch_assoc($select)){

      ?>
      <option <?= isset($idCategoria) ? 'selected' : ''; ?> value="<?= $rs['id_subcategoria']; ?>"><?= $rs['nome_subcategoria']; ?>
      </option>

      <?php

        }

      ?>
    </select>
  </body>
</html>