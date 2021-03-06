<?php

session_start();

require_once("./db/conexao.php");

$conexao = conexaoMysql();

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eduardo Galvão">
    <meta name="copyright" content="Delícia Gelada © 2019 Eduardo Galvão"/>
    <meta name="description" content="Página com produtos em promoção do Delícia Gelada, apresentando os decontos e novos valores."/>

    <title>Delícia Gelada - Promoções</title>
    <link rel="icon" href="./img/logo_favicon.png">

    <!--JS-->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/action.js"></script>

    <!-- CSS -->
    <link href="./css/style.css" rel="stylesheet">

  </head>
  <body>
    <div class="container center">

      <!-- CABEÇALHO -->
      <header class="background center">

        <!--LOGO, AUTENTICAÇÃO E MENU-->
        <div id="div_cabecalho" class="center">

          <!--LOGO-->
          <div id="logo">

          </div>

          <!--MENU-->
          <div id="caixa_menu">
            <nav>
              <ul id="menu">
                <li class="menu_item">
                  <a href="index.php">HOME</a>
                </li>
                <li class="menu_item">
                  <a href="empresa.php">A EMPRESA</a>
                </li>
                <li class="menu_item">
                  <a href="curiosidades.php">CURIOSIDADES</a>
                </li>
                <li class="menu_item">
                  <a href="promocoes.php">PROMOÇÕES</a>
                </li>
                <li class="menu_item">
                  <a href="lojas.php">LOJAS</a>
                </li>
                <li class="menu_item">
                  <a href="mensalistic.php">MENSALISTIC</a>
                </li>
                <li class="menu_item">
                  <a href="contato.php">CONTATO</a>
                </li>
              </ul>
            </nav>
          </div>

          <!--AUTENTICAÇÃO-->
          <div id="autenticacao_cms">
            <form name="frm_autenticacao" method="post" action="./db/autenticacao.php" >
              <div class="preenchimento_autenticacao">
                <label id="lbl_usuario" for="txt_usuario">Usuário</label>
                <input id="txt_usuario" name="txt_usuario" type="text"/>
              </div>
              <div class="preenchimento_autenticacao">
                <label id="lbl_senha" for="txt_senha">Senha</label>
                <input id="txt_senha" name="txt_senha" type="password"/>
              </div>
              <input id="btnSubmitAutenticacao" class="btn_submit" type="submit" name="btnSubmitAutenticacao" value="Ok"/>
            </form>
          </div>

        </div>

      </header>

      <!--CONTEÚDO-->
      <div id="container_principal" class="center">

        <!--SOCIAL MEDIA-->
        <div id="div_socialmedia">
          <a href="https://facebook.com.br"><img src="./icons/logo_facebook.png" alt="Logo Facebook" title="Logo Facebook"></a>
          <a href="https://instagram.com.br"><img src="./icons/logo_instagram.png" alt="Logo Instagram" title="Logo Instagram"></a>
          <a href="https://twitter.com.br"><img src="./icons/logo_twitter.png" alt="Logo Twitter" title="Logo Twitter"></a>
        </div>

        <div id="background_promocoes"></div>

        <div id="container_promocoes">

          <!--PRODUTOS-->
          <div id="conteudo_produtos">
            <div class="conteudo center">
              <div id="section">

                <div id="container_produtos">
                  
                  <?php
                  
                    $sql = "SELECT * FROM tbl_promocoes promo JOIN tbl_produtos prod ON promo.id_produto = prod.id_produto WHERE promo.data_remocao IS NULL;";

                    $select = mysqli_query($conexao, $sql);

                    while($rs = mysqli_fetch_assoc($select)){
                  
                  ?>
                  
                  <div class="produto">
                    <div class="produto_imagem">
                      <img src="./db/arquivos/<?= $rs['imagem'] ?>" alt="Garrafa de 1L - Sabor <?= $rs['nome_produto'] ?>" title="Garrafa de 1L - Sabor <?= $rs['nome_produto'] ?>"/>
                    </div>
                    <div class="produto_informacoes">
                      <h2><?= $rs['nome_produto'] ?></h2>
                      <div class="produto_descricao">
                        <p><?= substr($rs['descricao'], 0, 45) . "..." ?></p>
                      </div>
                      <p class="info_preco">R$ <?= $rs['preco'] ?></p>
                      <p class="info_preco_promocao"><?= "R$ ". round($rs['preco'] - ($rs['preco']*$rs['desconto']/100), 2) ?></p>
                    </div>
                    <div class="produto_detalhes center">
                      <p>DETALHES</p>
                    </div>
                  </div>
                  
                  <?php
                  
                    }
                  
                  ?>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!--RODAPÉ-->
      <footer>
        <div class="section">
          <div class="conteudo center">
            <div id="footer_autenticacao_interna">
              <div id="botao_autenticacao_interna">
                Sistema Interno
              </div>
            </div>
            <div id="footer_localizacao">
              <p> Av. Luis Carlos Berrini, nº 666</p>
              <p>Bairro Aleatório</p>
              <p>Itapevi - SP</p>
            </div>
            <div id="footer_app">
              <div id="app_logo">
                <a href=""><img src="./img/logo_android.png" title="Logo Android para baixar o App do Delícia Gelada" alt="Logo Android para baixar o App do Delícia Gelada"></a>
              </div>
              <div id="app_descricao">
                <p>Acesse nosso App exclusivo!</p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>
  </body>
</html>
