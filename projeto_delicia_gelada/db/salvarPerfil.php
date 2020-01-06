<?php

//Arquivo para salvar informações de perfil no Controle de Usuários
//sendo para cadastro ou edição
//retornando a tabela com exibição dos perfis preenchida com os perfis vigentes

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
      
      //Abre a conexão com BD
      $conexao = conexaoMysql();
      
      $nome = $_POST['nome'];
      $checks = $_POST['checks'];
      $data = date('Y-m-d');

    if($_POST['modo'] == "cadastro"){
      
      $sql = "INSERT INTO tbl_perfil VALUES(null, '".$nome."', '1', '".$data."', null);";
      
      if(mysqli_query($conexao, $sql)){
        
        $idPerfil = mysqli_insert_id($conexao);
        
        foreach($checks as $check){
          $sql = "INSERT INTO tbl_acesso_setor_perfil VALUES(null, ".$idPerfil.", ".$check.");";
          
          mysqli_query($conexao, $sql);
        }
        
      }
      
    }else if($_POST['modo'] == "edicao"){
      
      $idPerfil = $_POST['codigo'];
      
      $sql = "DELETE FROM tbl_acesso_setor_perfil WHERE id_perfil = " . $idPerfil;
      
      if(mysqli_query($conexao, $sql)){
        
        $sql = "UPDATE tbl_perfil SET nome_perfil = '" .$nome."' WHERE id_perfil = ".$idPerfil;
        
        if(mysqli_query($conexao, $sql)){
          
          foreach($checks as $check){
            $sql = "INSERT INTO tbl_acesso_setor_perfil VALUES(null, ".$idPerfil.", ".$check.");";
          
          mysqli_query($conexao, $sql);
            
          
        }
        
      }
      
    }
    
  }
    
}

?>

<html>
<head>
</head>
<body>
  <tr>
    <th>Perfil</th>
    <th>Ativação</th>
    <th>Opções</th>
  </tr>

  <?php

    $sql = "SELECT * FROM tbl_perfil WHERE data_remocao IS NULL ORDER BY id_perfil DESC";

    $select = mysqli_query($conexao, $sql);

    while($perfil = mysqli_fetch_assoc($select)){

  ?>

  <tr>

    <td><?= $perfil['nome_perfil']; ?></td>
    <td>
      <label class="switch">
        <input type="checkbox" class="toggle_ativacao" id="perfil_<?= $perfil['id_perfil'];?>" <?= $perfil['ativado'] == '0' ? '' : 'checked' ?> >
        <span class="slider round"></span>
      </label>
    </td>
    <td class="usuario_acoes">
      <a class="visualizar_perfil" id="<?= $perfil['id_perfil']; ?>" href="#">
        <div class="btn_visualizar"></div>
      </a>
      <a class="editar_perfil" id="<?= $perfil['id_perfil']; ?>" href="#">
        <div class="btn_editar"></div>
      </a>
      <a class="excluir_perfil" id="<?= $perfil['id_perfil']; ?>" href="#">
        <div class="btn_excluir"></div>
      </a>
    </td>
  </tr>

  <?php

    }

  ?>
</body>
</html>