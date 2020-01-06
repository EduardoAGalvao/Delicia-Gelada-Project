<?php

  //Arquivo para carregar dados de uma categoria para edição/visualização

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){

    //Abre a conexão com BD
    $conexao = conexaoMysql();

    $idSubcategoria = $_POST['codigo'];

    $sqlGeral = "SELECT * FROM tbl_subcategorias WHERE id_subcategoria = " .$idSubcategoria;

    $select = mysqli_query($conexao, $sqlGeral);

    while($rs = mysqli_fetch_assoc($select)){
      $subcategoria = $rs['nome_subcategoria'];
    }
    
  }

?>

<html>
<head></head>
<body>
  <h3>Selecione um elemento para edição e utilize a caixa de texto abaixo:</h3>
  <div class="ipt_edicao_categoria">
    <input class="txt_edicao_categoria" type="text" name="txt_edicao_categoria" value="<?= $subcategoria ?>" Ex: Vitaminas/>
    <input type="button" class="btnSalvarCategoria" id="<?= $idSubcategoria ?>" name="btnSalvarCategoria" value="SALVAR">
  </div>  
</body>
</html>