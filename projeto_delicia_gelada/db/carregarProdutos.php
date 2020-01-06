<?php

//Arquivo utilizado na página Home para carregar produtos conforme a seleção 
//do filtro pelo usuário

//Permite configurar os padrões de regionalidade
setLocale(LC_ALL, 'pt-br');
  
//Importa o arquivo de conexão com BD
require_once('conexao.php');

//Abre a conexão com BD
$conexao = conexaoMysql();

$modo = $_POST['modo'];
$codigoCategoria = $_POST['codigoCategoria'];

if($modo == 'filtrarCategoria'){
  
  $sql = "SELECT * FROM tbl_produtos WHERE id_categoria = ".$codigoCategoria;
  
}elseif($modo == 'filtrarSubcategoria'){
  
  $sql = "SELECT * FROM tbl_produtos WHERE id_subcategoria = ".$codigoCategoria;
  
}

?>

<html>
<head></head>
<body>
  <?php
  
    $select = mysqli_query($conexao, $sql);
    
    while($rs = mysqli_fetch_assoc($select)){
  
  ?>
  <div class="produto">
    <div class="produto_imagem">
      <img src="./db/arquivos/<?= $rs['imagem'] ?>" alt="Garrafa de Suco do Delícia Gelada - Sabor <?= $rs['nome_produto'] ?>" title="Garrafa de Suco do Delícia Gelada - Sabor <?= $rs['nome_produto'] ?>"/>
    </div>
    <div class="produto_informacoes">
      <h2><?= $rs['nome_produto'] ?></h2>
      <div class="produto_descricao">
        <p><?= substr($rs['descricao'], 0, 45) . "..." ?></p>
      </div>
      <p class="info_preco">R$ <?= $rs['preco'] ?></p>
    </div>
    <div class="produto_detalhes center">
      <p>DETALHES</p>
    </div>
  </div>
  <?php
    }
  ?>
</body>
</html>