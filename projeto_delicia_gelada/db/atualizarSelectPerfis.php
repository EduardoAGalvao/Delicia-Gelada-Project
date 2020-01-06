<?php 

  //O arquivo recarrega o select com todos os perfis
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
    <label>Perfil de Acesso:
      <span class="item_obrigatorio">*</span>
    </label>
    <div id="opcoes_perfil">
      <input type="radio" name="rdo_perfil" value="existente" checked><span> Existente</span>
      <input type="radio" name="rdo_perfil" value="novo">
      <span> Novo</span>
    </div>
    <select required name="slt_perfil" id="slt_perfil">
      <option selected value="">Selecione:</option>
      <?php

        $sql = "SELECT * FROM tbl_perfil WHERE data_remocao IS NULL ORDER BY id_perfil DESC";

        $select = mysqli_query($conexao, $sql);

        while($rs = mysqli_fetch_assoc($select)){

      ?>
      <option <?= isset($idPerfil) ? 'selected' : ''; ?> value="<?= $rs['id_perfil']; ?>"><?= $rs['nome_perfil']; ?>
      </option>

      <?php

        }

      ?>
    </select>
  </body>
</html>


