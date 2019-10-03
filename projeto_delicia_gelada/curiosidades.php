<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eduardo Galvão">
    <meta name="copyright" content="Delícia Gelada © 2019 Eduardo Galvão"/>
    <meta name="description" content="Página que apresenta curiosidades sobre a empresa e processo de fabricação do Delícia Gelada."/>

    <title>Delícia Gelada - Curiosidades</title>
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
                  <a href="index.html">HOME</a>
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
            <form name="frm_autenticacao" method="post" >
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
        
        <!--CURIOSIDADES-->
        <div id="background_curiosidades" class="center"></div>

        <div id="container_curiosidades">
          
          <div class="curiosidade">
            <div class="curiosidade_imagem">
              <img src="./img/curiosidades_tampas.png" alt="Tampas retrô personalizadas da Delícia Gelada" title="Tampas retrô personalizadas da Delícia Gelada">
            </div>
            <div class="curiosidade_descricao">
              <p>Todo o design da Delícia Gelada é pensado para valorizar a qualidade dos nossos sucos, incluindo as tampinhas que fazem parte desse visual retrô. Já foram desenvolvidas mais de 200 modelos de tampinhas, colecione!
              </p>
            </div>
          </div>

          <div class="curiosidade">
            <div class="curiosidade_descricao">
              <p>A Delícia Gelada se importa com a vida do pequeno produtor e os belos frutos
                que podem ser colhidos por ele. A seleção dos melhores alimentos é fundamental
                para um suco de qualidade aos melhores clientes.
              </p>
            </div>
            <div class="curiosidade_imagem">
              <img class="img_curiosidade_sombra" src="./img/curiosidades_colheita.png" alt="Colheita de uvas dos pequenos produtores para os sucos da Delícia Gelada" title="Colheita de uvas dos pequenos produtores para os sucos da Delícia Gelada">
            </div>
          </div>

          <div class="curiosidade">
              <div class="curiosidade_imagem">
                <img class="img_curiosidade_circulo" src="./img/curiosidades_agrotoxicos.png" alt="Morangos da colheita dos pequenos produtores da Delícia Gelada" title="Morangos da colheita dos pequenos produtores da Delícia Gelada">
              </div>
              <div class="curiosidade_descricao">
                <p>As frutas utilizadas para os sucos são livres de agrotóxicos e transgênicos, trazendo o máximo de naturalidade e frescor de uma fruta colhida com todo o amor e carinho.
                </p>
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
