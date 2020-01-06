<?php

//Permite configurar os padrões de regionalidade
setLocale(LC_ALL, 'pt-br');
  
//Declaração das variáveis
$txtUsuario = (string) null;
$txtSenha = (string) null;

//Importa o arquivo de conexão com BD
require_once('conexao.php');

//Abre a conexão com BD
$conexao = conexaoMysql();

if(isset($_POST['btnSubmitAutenticacao'])){
  
  $txtUsuario = $_POST['txt_usuario'];
  $txtSenha = $_POST['txt_senha'];
  
  //Validações para a autenticação
  //Usuário e senha devem estar em uma mesma linha do banco
  //O usuário deve estar ativado
  //Seu perfil deve estar ativado
  $sql = "SELECT * FROM tbl_usuarios u JOIN tbl_perfil p ON u.id_perfil = p.id_perfil WHERE u.username = '".$txtUsuario."' AND u.password = '".$txtSenha."' AND u.ativado = '1' AND p.ativado = '1';";
  
  $select = mysqli_query($conexao, $sql);
  
  if(mysqli_num_rows($select)){
    
    session_start();
    
    while($usuario = mysqli_fetch_assoc($select)){
      
      $_SESSION['id_logado'] = $usuario['id_usuario'];
      $_SESSION['logado'] = true;
      
      //Se houver um tipo na URL e for produtos, significa que o login
      //está sendo realizado na Autenticação Interna, 
      //que leva à toda a administração referente a produtos
      //permitindo seu acesso no controle de conteúdo
      if(isset($_GET['tipo']) && $_GET['tipo'] == 'produtos'){
          
          $_SESSION['edicao_produtos'] = true;
          
      }
          
      echo("
        <script>
          window.location.href='../cms/central_controle.php';
        </script>
      ");
      
      
    }
    
  }else{
    
    echo("
            <script>
              alert('Usuário não autenticado, por gentileza checar informações');
              window.location.href='../index.php';
            </script>
        ");  
      
  }
  
}
