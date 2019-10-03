<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eduardo Galvão">
    <meta name="copyright" content="Delícia Gelada © 2019 Eduardo Galvão"/>
    <meta name="description" content="Página que apresenta a história da empresa e seu histórico no processo de fabricação e vendas do Delícia Gelada"/>

    <title>Delícia Gelada - A Empresa</title>
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
        
        <!--EMPRESA-->
        <div id="background_empresa" class="center"></div>

        <div id="container_empresa">
          
          <!--HISTÓRIA-->
          <div id="empresa_historia">
            <section>
              <h1>Nossa História</h1>
              
              <div id="explicacao_historia">
                <div class="historia">
                  <p>A Delícia Gelada nasceu de um desejo de um pequeno produtor que em 2010 resolveu se aventurar no ramo empresarial formal. Sua família era conhecida na região do interior de São Paulo pelas famosas colheitas com diversas frutas, e disso Fernando Pereira enxergou um grande negócio. </p>
                  <img src="img/empresa_fazenda_frutas.jpg" alt="Imagem de fazenda de frutas em SP" title="Fazenda de frutas em SP, fornecedores do Delícia Gelada">  
                </div>
              
                <div class="historia">
                  <img src="img/empresa_fazenda_frutas2.jpg" alt="Imagem de fazenda de frutas em SP" title="Fazenda de frutas em SP, fornecedores do Delícia Gelada">
                  <p>Aos poucos, aumentou sua produção em larga escala e iniciou uma venda regional com um diferencial: os sucos deveriam ser vendidos em garrafas, para preservar a qualidade das frutas e serem vendidos em um mercado mais amplo além dos mercados. A ideia funcionou e hoje é uma das maiores redes do país.</p>
                </div>
              </div>
              
            </section>

          </div>
          
          <!--BANNER - HISTÓRIA-->
          <div id="banner_historia"></div>
          
          <!--TÓPICOS - EMPRESA-->
          <div id="empresa_topicos">
            <ul class="center">
              <li><span class="numero">10</span> milhões de consumidores</li>
              <li><span class="numero">50</span> sabores de sucos</li>
              <li><span class="numero">6</span> pontos de venda em São Paulo</li>
              <li><span class="numero">1</span> missão</li>
            </ul>
          </div>
          
          <!--MISSÃO, VISÃO E VALORES-->
          <div id="container_missao_visao_valores">      
            
            <div class="missao_visao_valores">
              <div id="missao" class="missao_visao_valores_icon"></div>
              <div class="missao_visao_valores_descricao">
                <h2>Missão</h2>
                <p>Entregar ao consumidor final sucos ricos em qualidade e que tenham uma marca sólida com características particulares, sendo acessível para todos</p>
              </div>
            </div>
            
            <div class="missao_visao_valores">
              <div id="visao" class="missao_visao_valores_icon"></div>
              <div class="missao_visao_valores_descricao">
                <h2>Visão</h2>
                <p>Ser a maior produtora e distribuidora de sucos do Brasil, utilizando agricultura orgânica, preservando a integridade do ambiente e impressionando pela variedade de sabores</p>
              </div>
            </div>
            
            <div class="missao_visao_valores">
              <div id="valores" class="missao_visao_valores_icon"></div>
              <div class="missao_visao_valores_descricao">
                <h2>Valores</h2>
                <p>Empreender com muita garra e critério no fechamento de negócios, garantindo que a natureza não sofra os efeitos da produção, trazendo bem ao consumidor e ao mundo</p>
              </div>
            </div>
            
          </div>
          
          <!--PONTOS DE VENDA-->
          <div id="pontos_venda">
            
            <div class="ponto_venda">
              <img class="img_ponto_venda" alt="Vendedor oferecendo sucos do Delícia Gelada em ponto de venda em lanchonete de SP." title="Vendedor oferecendo sucos do Delícia Gelada em ponto de venda em lanchonete de SP." src="./img/empresa_vendedor2.jpg">
              <p>Nossos sucos podem ser encontrados em bares e lanchonetes de luxo, sendo consumidos puros ou misturados a coquetéis</p>
            </div>
            
            <div class="ponto_venda">
              <img class="img_ponto_venda" alt="Barman fazendo drinques com os sucos do Delícia Gelada" title="Barman fazendo drinques com os sucos do Delícia Gelada" src="./img/empresa_vendedor.jpg">
              <p>Também podem ser encontrados em lojas específicas para o público geral, sendo consumidos preparados em misturas ou prontos para consumo em nossas belas garrafas</p>
            </div>
            
          </div>
          
          <!--BANNER 2 - HISTÓRIA-->
          <div id="banner_historia2"></div>

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
