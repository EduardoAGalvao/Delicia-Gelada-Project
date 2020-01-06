<?php

//Inclusão da conexão
require_once("../db/conexao.php");

$conexao = conexaoMysql();

//Verifica se já existe uma sessão, senão abre a mesma
if(!isset($_SESSION)) {
  session_start();
}

//Checagem para garantia de autenticação, caso não tenha sido feita, retorna para index
if($_SESSION['logado'] != true){
    echo('
        <script>
        
            window.location.href = "../index.php";
        
        </script>
    
    ');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eduardo Galvão">
    <meta name="copyright" content="Delícia Gelada © 2019 Eduardo Galvão"/>
    <meta name="description" content="Página para controle de componentes internos."/>

    <title>CMS - Central de Controle</title>
    <link rel="icon" href="../img/logo_favicon.png">

    <!--JS-->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery.form.js"></script>
    <script src="./js/validacao.js"></script> 
    <script src="./js/action.js"></script> 
    
    <!-- CSS -->
    <link href="./css/style.css" rel="stylesheet">

  </head>
  <body>
    
    <!--MODAL-->
    <div id="container_modal" class="center">
      <div id="modal">
        <div id="btn_fechar_modal">
          <a id="fechar_modal">X</a>
        </div>
        <div id="conteudo_modal"></div>
      </div>
    </div>
    
    <div class="container center">

      <!-- CABEÇALHO -->
      <header class="background center">

        <!--LOGO, AUTENTICAÇÃO E MENU-->
        <div id="div_cabecalho" class="center">
          
          <!--TITULO-->
          <div id="cabecalho_titulo">
            <h1>CMS - Sistema de Gerenciamento do Site</h1>
          </div>
          
          <!--LOGO-->
          <div id="logo">
            
          </div>

        </div>
        
        <!-- MENU DE CONTROLE -->
        <div id="operacoes_controle">
          
          <?php
            
            $idUsuario = $_SESSION['id_logado'];
          
            $sql = "SELECT * FROM tbl_setor s JOIN tbl_acesso_setor_perfil asp ON s.id_setor_cms = asp.id_setor_cms JOIN tbl_usuarios u ON u.id_perfil = asp.id_perfil WHERE u.id_usuario = ".$idUsuario.";";
          
            $select = mysqli_query($conexao, $sql);
          
            $nomeUsuario = '';  
          
            while($rs = mysqli_fetch_assoc($select)){
          
              $nomeUsuario = $rs['nome'];
          ?>
          <!-- Operação de Controle -->
          <a href="<?= $rs['url'] ?>">
            <div class="div_operacao">
              <img src="<?= $rs['link_logo'] ?>">
              <h3><?= $rs['nome_setor_cms'] ?></h3>
            </div>
          </a>
          
          <?php
            
            }
          
          ?>
          
          <!-- Boas vindas e logout -->
          <div class="div_operacao">
            <p>Bem vindo, <?= $nomeUsuario ?></p>
            <button class="btn_submit" id="logout_operacoes">Logout</button>
          </div>
          
        </div>

      </header>
