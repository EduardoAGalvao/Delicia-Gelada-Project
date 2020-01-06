<?php

  require_once('header.php');

  //Checando se o botão editar foi clicado e o modo foi setado
  //Valida se a ação de modo é para editar
  if((isset($_GET['modo'])) && $_GET['modo'] == 'editar'){

    //Código do item a ser selecionado
    $codigo = $_GET['codigo'];

    //Guardando em variável de sessão o código do registro
    $_SESSION['id'] = $codigo;

    //Script a ser executado no BD
    $sql = "SELECT * FROM tbl_usuarios u JOIN tbl_perfil i ON u.id_perfil = i.id_perfil WHERE id_usuario = $codigo";

    //Executa o script no BD
    $select = mysqli_query($conexao, $sql);

    //Converte os dados do BD em array associativo
    if($usuario = mysqli_fetch_assoc($select)){

      //Resgatando dados do BD e colocando em variáveis locais
      $nome = $usuario['nome'];
      $cpf = $usuario['cpf'];
      $email = $usuario['email'];
      $celular = $usuario['celular'];
      $username = $usuario['username'];
      $idPerfil = $usuario['id_perfil'];                 
    }

  };

?>

      <!--CONTEÚDO-->
      <div id="container_principal" class="center">
        
        <div id="div_cadastro_usuario" class="center">
          
          <div id="mensagem_alteracao">
          </div>
          
          <div id="titulo_link_usuarios">
            <h1>Cadastro de Usuários</h1>
            <a id="btn_gerenciar_perfis" href="#">Gerenciar Perfis de Acesso</a>
          </div>
          
          <span class="item_obrigatorio">* - Campo com preenchimento obrigatório</span>
          
          <form method="post" name="frm_usuario" id="frm_usuario" action="../db/salvarUsuario.php">
              
            <div class="item_cadastro_usuario" id="div_cadastro_nome">
              <label for="txt_nome">Nome:
                <span class="item_obrigatorio">*</span>
              </label>
              <input type="text" name="txt_nome" id="txt_nome" pattern="[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ ]*" maxlength="50" placeholder="Ex: Ronaldo Ribeiro" required value="<?= isset($nome) ? $nome : '' ?>">
            </div>
              
            <div class="item_cadastro_usuario" id="div_cadastro_cpf">
              <label for="txt_cpf">CPF: 
                <span class="item_obrigatorio">*</span>
              </label>
              <input type="text" name="txt_cpf" id="txt_cpf" maxlength="14" placeholder="Ex: 234.123.123-45" pattern="[0-9\-.]*" required value="<?= isset($cpf) ? $cpf : '' ?>">
            </div>
            
            <div class="item_cadastro_usuario" id="div_cadastro_celular">
              <label for="txt_celular">Celular:
                <span class="item_obrigatorio">*</span>
              </label>
              <input type="text" name="txt_celular" id="txt_celular" placeholder="Ex: 11 987899876" maxlength="14" value="<?= isset($celular) ? $celular : '' ?>" required>
            </div>
              
            <div class="item_cadastro_usuario" id="div_cadastro_email">
              <label for="txt_email">Email:
                <span class="item_obrigatorio">*</span>
              </label>
              <input type="email" name="txt_email" id="txt_email" placeholder="Ex: ronaldo@email.com" pattern="[0-9A-Za-z\-_.@]*" maxlength="50" value="<?= isset($email) ? $email : '' ?>" required>
            </div>
            
            <div class="item_cadastro_usuario" id="div_cadastro_perfil">
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
            </div>
            
            <div class="item_cadastro_usuario" id="novo_perfil">
                <label>Novo Perfil:
                  <span class="item_obrigatorio">*</span>
                </label>
                <input type="text" name="txt_nome_perfil" pattern="[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ0-9 ]*" maxlength="50" placeholder="Ex: Admin">
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
                
                    <input type="checkbox" name="<?= 'chk' . $cont ?>" value="<?= $idSetor ?>"> <span> <?= $nomeSetor ?></span>
              
                  <?php
                    
                      $cont++;
                
                    }
                
                  ?>
                </div>
            </div>
            
            <div class="item_cadastro_usuario" id="div_cadastro_username">
              <label for="txt_username">Username:
                <span class="item_obrigatorio">*</span>
              </label>
              <input type="text" name="txt_username" id="txt_username" pattern="[A-Za-zÀ-ÿ0-9]*" maxlength="50" placeholder="Ex: ronaldo2019" required value="<?= isset($username) ? $username : '' ?>">
            </div>
            
            <div class="item_cadastro_usuario" id="div_cadastro_senha">
              <label for="txt_senha">Senha:
                <span class="item_obrigatorio">*</span>
              </label>
              <input type="password" name="txt_senha" id="txt_senha" pattern="[A-Za-zÀ-ÿ0-9]*" maxlength="50" placeholder="Somente letras e números" required value="" <?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'readonly' : '' ?>>
            </div>
            
            <div class="item_cadastro_usuario" id="div_confirmacao_senha">
              <label for="txt_confsenha">Confirme a senha:
                <span class="item_obrigatorio">*</span>
              </label>
              <input type="password" id="txt_confsenha" pattern="[A-Za-zÀ-ÿ0-9]*" maxlength="50" placeholder="Somente letras e números" <?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'readonly' : '' ?> required>
            </div>
                                  
            <div id="div_cadastro_usuario_btn">
              <input type="submit" name="btnCadastrar" id="btnCadastrarUsuario" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? "ATUALIZAR" : "CADASTRAR" ?>">
              
              <input class="botao botaoLimpar" type="reset" name="btnLimpar" value="<?= isset($_GET['modo']) && $_GET['modo'] == 'editar' ? 'CANCELAR' : 'LIMPAR' ?>"/>
            </div>
              
          </form>
        </div>
        
        <table id="tabela_usuarios">
          <tr>
            <th>Nome</th>
            <th>CPF</th> 
            <th>Usuário</th>
            <th>Celular</th>
            <th>Ativação</th>
            <th>Opções</th>
          </tr>
          
          <?php

            $sql = "SELECT * FROM tbl_usuarios WHERE data_remocao IS NULL ORDER BY id_usuario DESC";

            $select = mysqli_query($conexao, $sql);

            while($usuario = mysqli_fetch_assoc($select)){
        
          ?>
          
          <tr>
            
            <td><?= $usuario['nome']; ?></td>
            <td><?= $usuario['cpf']; ?></td>
            <td><?= $usuario['username']; ?></td>
            <td><?= $usuario['celular'] ?></td>
            <td>
              <label class="switch">
                <input type="checkbox" class="toggle_ativacao" id="usuario_<?= $usuario['id_usuario'];?>" <?= $usuario['ativado'] == '0' ? '' : 'checked' ?> >
                <span class="slider round"></span>
              </label>
            </td>
            <td class="usuario_acoes">
              <a class="visualizar_usuario" id="visualizar_<?= $usuario['id_usuario']; ?>" href="#">
                <div class="btn_visualizar"></div>
              </a>
              <a class="editar_usuario" href="controle_usuarios.php?modo=editar&codigo=<?= $usuario['id_usuario']; ?>">
                <div class="btn_editar"></div>
              </a>
              <a class="excluir_usuario" href="../db/excluirUsuario.php?modo=excluir&codigo=<?= $usuario['id_usuario']; ?>">
                <div class="btn_excluir"></div>
              </a>
            </td>
          </tr>
          
          <?php
          
            }
              
          ?>
        </table>
        
      </div>

      <!--RODAPÉ-->
      <footer class="center">
        
        <div class="conteudo">
        
          <p>Desenvolvido por Eduardo A. Galvão | SENAI Prof Vicente Amato | 2019</p>
        
        </div>
        
      </footer>

    </div>
  </body>
</html>
