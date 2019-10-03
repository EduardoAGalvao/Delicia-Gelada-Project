<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eduardo Galvão">
    <meta name="copyright" content="Delícia Gelada © 2019 Eduardo Galvão"/>
    <meta name="description" content="Página que apresenta o especial Mensalistic do Delícia Gelada, onde um sabor é apresentado por mês."/>

    <title>Delícia Gelada - Mensalistic</title>
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
        
        <!--MENSALISTIC-->
        <div id="background_mensalistic" class="center"></div>

        <!--INTRODUÇÃO-->
        <div id="mensalistic_introducao" class="center">
          <p><span>MENSALISTIC</span> é o especial do mês da Delícia Gelada, onde apresentamos
            mais sobre os sabores favoritos dos nossos clientes
          </p>
        </div>

        <section id="container_mensalistic">

          <h1>Meu limão, meu limoeiro</h1>

          <!--SOBRE A FRUTA-->
          <div id="mensalistic_sobre_fruta" class="center">
            <div id="img_fruta_descascada"></div>
            <div id="sobre_fruta_descricao">
              <p>O limão é a fruta cítrica predileta dos sabores da Delícia Gelada, todos os limões ganham um incrível cuidado no momento da colheita, direto à produção dos sucos
              </p>
            </div>
            <div id="mensalistic_garrafa"></div>
          </div>

          <!--BANNER LIMOEIRO-->
          <div id="banner_mensalistic_meio" class="background"></div>

          <!--TOPICOS - MENSALISTIC-->
          <div id="mensalistic_indicadores">
            <ul>
              <li><span>5 milhões</span> de limões colhidos por mês</li>
              <li><span>Top 3</span> dos sabores mais vendidos</li>
              <li>Versão <span>Deluxe</span> exclusiva</li>
              <li><span>3 mil</span> fazendas com limoeiros</li>
            </ul>
            <div id="img_mensalistic_indicadores"></div>
          </div>

          <!--MENSALISTIC - CLIENTE-->
          <div id="mensalistic_cliente">
            <div>
              <p>Cada garrafa do Delícia Gelada no sabor Limão possui 4 limões em sua composição, misturados de forma balanceada com os melhores ingredientes para preservar o sabor e refrescância
              </p>
            </div>
            <div id="img_mensalistic_cliente"></div>
            <div>
              <p>A versão Deluxe do sabor ressalta a acidez dos melhores limões, apesar de ser lançamento já é considerado um dos TOP vendas de 2019
              </p>
            </div>
          </div>
          
          <!--BANNER FINAL-->
          <div id="banner_mensalistic_final" class="center"></div>
          
        </section>
            
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
