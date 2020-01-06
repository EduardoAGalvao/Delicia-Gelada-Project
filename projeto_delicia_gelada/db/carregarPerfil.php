<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  $sqlGeral = null;
  $setores = [];
  $nome = null;
  $modo = 'leitura';

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){

    //Abre a conexão com BD
    $conexao = conexaoMysql();

    $idPerfil = $_POST['codigo'];

    $sqlGeral = "SELECT * FROM tbl_perfil p JOIN tbl_acesso_setor_perfil asp ON p.id_perfil = asp.id_perfil WHERE p.id_perfil = " .$idPerfil;

    $select = mysqli_query($conexao, $sqlGeral);

    while($rs = mysqli_fetch_assoc($select)){
      $setores[] = $rs['id_setor_cms'];
      $nome = $rs['nome_perfil'];
    }
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "editarPerfil"){
      $modo = 'editar';
      $idPerfil = $_POST['codigo'];
    }
    
  }

?>

<html>
<head></head>
<body>
  <label>Novo Perfil:
    <span class="item_obrigatorio">*</span>
  </label>
  <input type="text" name="<?= $idPerfil ?>" id="txt_perfil" value="<?= isset($nome) ? $nome : '' ?>" placeholder="Ex: Admin">
  <div class="checkboxes_perfil">
    <span id="aviso_perfil_novo">Acesso permitido aos setores:</span>
    <?php

      $sql = "SELECT * FROM tbl_setor";

      $select = mysqli_query($conexao, $sql);

      // INICIA O CONTADOR EM 0
      $cont = 0;

      while($rs = mysqli_fetch_assoc($select)){

        $idSetor = $rs['id_setor_cms']; 
        $nomeSetor = $rs['nome_setor_cms'];
        
        if(in_array($idSetor, $setores)){
          
    ?>

      <input type="checkbox" <?= $modo == 'leitura' || 'editar' ? 'checked' : '' ?> id="<?= 'chk' . $cont ?>" class="checkbox_perfil" name="<?= 'chk' . $cont ?>" value="<?= $idSetor ?>"> <span><?= $nomeSetor ?></span>

    <?php
      
        }else{
    ?>
          <input type="checkbox" id="<?= 'chk' . $cont ?>" class="checkbox_perfil" name="<?= 'chk' . $cont ?>" value="<?= $idSetor ?>"> <span><?= $nomeSetor ?></span>
    <?php
          
        }

        $cont++;

      }

    ?>
</div>
</body>
</html>