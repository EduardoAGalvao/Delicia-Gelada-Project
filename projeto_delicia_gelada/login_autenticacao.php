<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Eduardo Galvão">
    <meta name="copyright" content="Delícia Gelada © 2019 Eduardo Galvão"/>
    <meta name="description" content="Página para autenticação de acesso ao sistma interno."/>

    <title>CMS - Autenticação Interna</title>
    <link rel="icon" href="./img/logo_favicon.png">

    <!--JS-->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery.form.js"></script>
    <script src="./js/action.js"></script>
    <script src="./js/validacao.js"></script>  
    
    <!-- CSS -->
    <link href="./css/style.css" rel="stylesheet">

  </head>
  <body>
      
      <div class="autenticacao_interna">

          <!--CONTEÚDO-->
          <div id="container_principal" class="center">
              <div id="div_autenticacao">
                  <h1>Acesse. Cadastre. Venda.</h1>
                  <h1>Você no <span id="palavra">controle</span> ^^</h1>
                  <p>Aqui você pode cadastrar os melhores produtos e as promoções mais incríveis aos clientes</p>
                  <form name="frm_autenticacao_interna" id="frm_autenticacao_interna" method="post" action="./db/autenticacao.php?tipo=produtos" >
                      <div class="preenchimento_autenticacao_interna">
                        <label id="lbl_usuario" for="txt_usuario">Usuário</label>
                        <input id="txt_usuario" name="txt_usuario" type="text"/>
                      </div>
                      <div class="preenchimento_autenticacao_interna">
                        <label id="lbl_senha" for="txt_senha">Senha</label>
                        <input id="txt_senha" name="txt_senha" type="password"/>
                      </div>
                      <input id="btnSubmitAutenticacaoInterna" class="btn_submit" type="submit" name="btnSubmitAutenticacao" value="ENTRAR"/>
                  </form>
                  <div id="autenticacao_links">
                    <a href="index.php">Voltar</a>
                    <a href="#">Esqueci o usuário ou senha</a>
                  </div>
              </div>      
          </div>
          
      </div>
      
  </body>
</html>