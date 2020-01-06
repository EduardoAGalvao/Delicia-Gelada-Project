<?php

  //O arquivo recarrega o select com todas as categorias
  //vigentes no banco de dados, ou seja, com data de remoção nula
  
  //Recebe dados de conexão com o banco
  require_once("../db/conexao.php");
  $conexao = conexaoMysql();

  $modo = $_POST['modo'];
  
  if(!isset($modo)){
    
    echo("O modo não foi inicializado");
    
  }
  

?>

<html>
  <head></head>
  <body>
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
  </body>
</html>


