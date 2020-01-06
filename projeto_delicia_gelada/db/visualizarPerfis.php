<?php

  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Trata a existência da variável modo
  if(isset($_POST['modo'])){
    
    //Verifica se modo é para visualizar
    if($_POST['modo'] == "gerenciar_perfis"){
      
      //Abre a conexão com BD
      $conexao = conexaoMysql();
      
      $sql = "SELECT * FROM tbl_perfil";
      
    }
    
  }

?>

<html>
  <head>
    <script>
            
      $(document).ready(function(){
          
        $(document).on('click', '.msg_err', function(){
            $('.msg_err_perfil').hide();
            $('.msg_err').hide();
        });
        
        //Atualiza ativação do Usuário
        $(document).on('change', '.toggle_ativacao', function(){
          
          $identificador = $(this).attr('id').split("_");
          $id = $identificador[1];
          $tipo = $identificador[0];
                    
          $.ajax({
                type: "POST",
                url: "../db/atualizaAtivacao.php",
                data: {modo: 'ativacao', tipo: $tipo, codigo: $id},
                success: function(dados){
                  
                  $('#mensagem_alteracao').html(dados);

                }
              });
          
        });
        
        function limparPerfil(){
          
          //Traz ao padrão inicial
          $('#txt_perfil').val('');
          $('#txt_perfil').attr('value', '');
          $('#txt_perfil').attr('name', '');
          $('#txt_perfil').prop('readonly', false);
          $('.checkbox_perfil').prop('checked', false);
          $('.checkbox_perfil').prop('disabled', false);
          $('#btnCadastroPerfil').css({visibility: "visible", transition: "0.5s"}).animate({opacity: 1}, 200);
          $('#btnCadastroPerfil').val('CADASTRAR');
          
        }
        
        $('#btnLimparPerfil').click(function(){
          
          limparPerfil();
          
        });
        
        $('#btnCadastroPerfil').click(function(){
          
          let txtPerfil = $('#txt_perfil').val();  
          let numCheck = $('.checkbox_perfil').length;
          let checks = [];
          let modo = '';
          let id = '';
          
          if($('#btnCadastroPerfil').val() == 'ATUALIZAR'){
            modo = 'edicao';
            id = $('#txt_perfil').attr('name');
          }else{
            modo = 'cadastro';
          }
          
          //Coletando os valores (ids) dos checkboxes checados
          for($cont = 0; $cont<=numCheck; $cont++){
            if ($('#chk' + $cont).is(":checked")){
              checks[$cont] = $('#chk' + $cont).val();
            }  
          }
          
          $.ajax({
            type: "POST",
            url: "../db/salvarPerfil.php",
            data: {modo: modo, nome: txtPerfil, checks: checks, codigo: id},
            success: function(dados){

              $('#tabela_perfis').html(dados);
              
              limparPerfil();

            }
          });
          
        });
        
        $(document).on('click', '.excluir_perfil', function(){
          
          let $idPerfil = $(this).attr('id');
          
          $.ajax({
            type: "POST",
            url: "../db/excluirPerfil.php",
            data: {modo: 'remocao', codigo: $idPerfil},
            success: function(dados){

              $('#tabela_perfis').html(dados);

            }
          });
          
        });
        
        $(document).on('click', '.visualizar_perfil', function(){
          
          let $idPerfil = $(this).attr('id');
          
          $.ajax({
            type: "POST",
            url: "../db/carregarPerfil.php",
            data: {modo: 'visualizarPerfil', codigo: $idPerfil},
            success: function(dados){

              $('#novo_perfil_modal').html(dados);
              $('#btnCadastroPerfil').css({visibility: "hidden", transition: "0.5s"}).animate({opacity: 0}, 200);
              $('#txt_perfil').prop('readonly', true);
              $('.checkbox_perfil').prop('disabled', true);

            }
          });
          
        });
        
        $(document).on('click', '.editar_perfil', function(){
          
          let $idPerfil = $(this).attr('id');
          
          console.log($idPerfil);
          
          $.ajax({
            type: "POST",
            url: "../db/carregarPerfil.php",
            data: {modo: 'editarPerfil', codigo: $idPerfil},
            success: function(dados){

             $('#novo_perfil_modal').html(dados);
              
             $('#btnCadastroPerfil').val('ATUALIZAR');

            }
          });
          
        });
        
      });        
      
    </script>
  </head>
  <body>
    <div id="conteudo_perfis">
      <h1>Gerenciador de Perfis de Acesso</h1>

        <div class="item_cadastro_perfil" id="novo_perfil_modal">
            <label>Novo Perfil:
              <span class="item_obrigatorio">*</span>
            </label>
            <input type="text" name="" id="txt_perfil" placeholder="Ex: Admin">
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

              ?>

                <input type="checkbox" id="<?= 'chk' . $cont ?>" class="checkbox_perfil" name="<?= 'chk' . $cont ?>" value="<?= $idSetor ?>"> <span> <?= $nomeSetor ?></span>

              <?php

                  $cont++;

                }

              ?>
            </div>
        </div>

       <div id="div_cadastro_perfil_btn">
          <input type="submit" name="btnCadastrar" id="btnCadastroPerfil" value="CADASTRAR">

          <input class="botao botaoLimpar" type="reset" id="btnLimparPerfil" name="btnLimpar" value="LIMPAR"/>
        </div>
        <div class="div_tabela_perfis">
        <table id="tabela_perfis">
          <tr>
            <th>Perfil</th>
            <th>Ativação</th>
            <th>Opções</th>
          </tr>
          
          <?php

            $sql = "SELECT * FROM tbl_perfil WHERE data_remocao IS NULL ORDER BY id_perfil DESC";

            $select = mysqli_query($conexao, $sql);
          
            if($select){
              
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
          }

          ?>
        </table>
        </div>
      </div>
    
  </body>
</html>