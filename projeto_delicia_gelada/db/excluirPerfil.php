<?php

  $mensagem = false;

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "remocao"){
      
      //Abre a conexão com BD
      $conexao = conexaoMysql();
      
      $idPerfil = $_POST['codigo'];
      $data = date('Y-m-d');
        
      $sql = "SELECT * FROM tbl_usuarios WHERE id_perfil = ".$idPerfil." AND data_remocao IS NULL;";
        
      $select = mysqli_query($conexao, $sql);
      
      //Somente há exclusão se não estiver sendo usado por um usuário
      if(mysqli_num_rows($select)){
        
        //Ação caso esteja sendo utilizado
          echo('<p class="msg_err_perfil">O perfil não pode ser removido, pois está sendo utilizado por um usuário no momento.</p> <button class="msg_err">Ok</button>');  
          
      }else{
          
         $sql = "UPDATE tbl_perfil SET data_remocao = '".$data."' WHERE id_perfil = ".$idPerfil.";";
        
         if(mysqli_query($conexao, $sql)){
         //Ação ao ser removido

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
      <a href="#" class="excluir_perfil" id="<?= $perfil['id_perfil']; ?>">
        <div class="btn_excluir"></div>
      </a>
    </td>
  </tr>

  <?php

    }

  ?>
</body>
</html>