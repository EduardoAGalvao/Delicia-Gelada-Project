<?php

  //Arquivo para carregar dados de uma categoria para edição/visualização

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){

    //Abre a conexão com BD
    $conexao = conexaoMysql();

    $idCategoria = $_POST['codigo'];

    $sqlGeral = "SELECT * FROM tbl_categorias WHERE id_categoria = " .$idCategoria;

    $select = mysqli_query($conexao, $sqlGeral);

    while($rs = mysqli_fetch_assoc($select)){
      $categoria = $rs['nome_categoria'];
    }
    
  }

?>

<html>
<head></head>
<body>
  <h3>Selecione um elemento para edição e utilize a caixa de texto abaixo:</h3>
  <div class="ipt_edicao_categoria">
    <input class="txt_edicao_categoria" type="text" name="txt_edicao_categoria" value="<?= $categoria ?>"/>
    <input type="button" class="btnSalvarCategoria" id="<?= $idCategoria ?>" name="btnSalvarCategoria" value="SALVAR">
  </div>  
</body>
</html>