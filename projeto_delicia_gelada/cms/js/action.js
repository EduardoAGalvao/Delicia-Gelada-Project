'use strict';

$(document).ready(function(){
  
  //Função utilizada para atualizar os perfis disponíveis para escolha assim que o modal de gerenciamento é fechado no CMS no Controle de Usuários
  function atualizarSelectPerfis(){
    $.ajax({
        type: "POST",
        url: "../db/atualizarSelectPerfis.php",
        data: {modo: 'atualizacao'},
        success: function(dados){

          $('#div_cadastro_perfil').html(dados);

        }
      });
  }
  
  //Função utilizada para atualizar as categorias disponíveis para escolha assim que o modal de gerenciamento é fechado no CMS no Controle de Usuários
  function atualizarSelectCategorias(){
    $.ajax({
        type: "POST",
        url: "../db/atualizarSelectCategorias.php",
        data: {modo: 'atualizacao'},
        success: function(dados){

          $('#div_cadastro_categoria').html(dados);

        }
      });
  }
  
  //Função para abertura de Modal
  $(".btn_visualizar").click(function(){
    $("#container_modal").fadeIn(1000);
  });

  //Função para fechamento de modal no CMS no Controle de Usuários
  $("#btn_fechar_modal").click(function(){
    atualizarSelectPerfis();
    atualizarSelectCategorias();
    $("#container_modal").fadeOut(1000);
  });
  
  //Evento que realiza o filtro de visualização de envio de mensagens no
  //CMS em Fale Conosco, filtrando por sugestões ou críticas
  $('#slt_mensagem').on('change', function() {

    let $motivo_contato = this.value;

    switch($motivo_contato){
      case "sugestoes":
        $('.motivo_criticas').css('display', 'none');
        $('.motivo_sugestoes').css('display', 'table-row');
        break;

      case "criticas":
        $('.motivo_criticas').css('display', 'table-row');
        $('.motivo_sugestoes').css('display', 'none');
        break;

      default:
        $('.motivo_criticas').css('display', 'table-row');
        $('.motivo_sugestoes').css('display', 'table-row');
        break;
    }

  });
  
  //Evento que realiza o filtro de visualização de perfis 
  //pelo radio button entre um novo ou existente, no CMS no controle de Usuários
  $(document).on('change', 'input[name="rdo_perfil"]', function(){
    if (this.value == 'existente') {
      $('#slt_perfil').css('background', 'none');
      $('#slt_perfil').css('pointer-events', 'all');
      $('#slt_perfil').prop('required', true);
      $('#novo_perfil').css('visibility', 'hidden').animate({opacity: 0}, 200);
    }
    else if (this.value == 'novo') {
      $('#slt_perfil').css('background', '#eee');
      $('#slt_perfil').css('pointer-events', 'none');
      $('#slt_perfil').prop('required', false);
      $('#novo_perfil').css({visibility: "visible", transition: "0.5s"}).animate({opacity: 1}, 200);
    }
  });

  //Evento que atualiza alterações de ativação no sistema CMS
  //O botão toggle de ativação deve possuir em seu id dois identificadores
  //O tipo de elemento, como usuário, perfil ou curiosidade, e o número de ID do elemento
  $(document).on('change','.toggle_ativacao', function(){

    let $identificador = $(this).attr('id').split("_");
    let $id = $identificador[1];
    let $tipo = $identificador[0];

    $.ajax({
          type: "POST",
          url: "../db/atualizaAtivacao.php",
          data: {modo: 'ativacao', tipo: $tipo, codigo: $id},
          success: function(dados){

            alert("Mudança na ativação realizada com sucesso!");

          }
        });
  });

  //Função para confirmação de exclusão de usuário
  $('.excluir_usuario').click(function(){
    return confirm('Deseja realmente excluir?');
  });

  //Função que envia a solicitação de visualização de um usuário ao PHP
  //enviando seu ID e tipo
  $('.visualizar_usuario').click(function(){

    let $identificador = $(this).attr('id').split("_");
    let $id = $identificador[1];
    
    $.ajax({
          type: "POST",
          url: "../db/visualizarUsuario.php",
          data: {modo: 'visualizar', codigo: $id},
          success: function(dados){

            $('#conteudo_modal').html(dados);

          }
        });
  });

  //Setando evento para limpar URL caso queira cancelar a edição
  $('document').on('click', '.botaoLimpar', function(){
        if($botaoLimpar.val() == "CANCELAR"){

          //window.location.pathname ignora os atributos GET na URL, retornando 
          //para o caminho original
          window.location.href = window.location.pathname;

        }
    });

  //Evento para abrir o modal com o gerenciador de perfis no Controle de Usuários
  $("#btn_gerenciar_perfis").click(function(){

    $("#container_modal").fadeIn(1000);

    $.ajax({
          type: "POST",
          url: "../db/visualizarPerfis.php",
          data: {modo: 'gerenciar_perfis'},
          success: function(dados){

            $('#conteudo_modal').html(dados);

          }
    });
  });
  
  //Função para carregar o CRUD de uma respectiva página escolhida no CMS
  //assim como as seções já existentes na mesma
  function carregarSecoesPagina(idPagina){

    $.ajax({
      type: "POST",
      url: "../db/carregarSecoesPagina.php",
      data: {modo: 'visualizar', identificacao: idPagina},
      success: function(dados){
        
        $("#conteudo_crud").html(dados); 
        
      }
    }); 
    
  }
  
  //Evento que permite exibir o CRUD específico de cada página no CMS
  //passando o ID da mesma
  $(document).on('click', '.btnPagina', function(){
    
    let identificacao = $(this).val();
    
    $('.btnPagina').removeClass('btnPaginaSelecionada');
    $('.btnPagina').addClass('btnPaginaComum');
    
    $(this).removeClass('btnPaginaComum');
    $(this).addClass('btnPaginaSelecionada');
    
    carregarSecoesPagina(identificacao);
    
  });
  
  //Função para limpar formulário de seções
  function limparSecao($idPagina){
    
    carregarSecoesPagina($idPagina);
    
  }
  
  //Evento que realiza a limpeza das seções de uma determinada página em seu formulário
  $(document).on('click', '.botaoLimpar', function(){
    
    let $identificador = $(this).attr('id').split("_");
    let $idPagina = $identificador[1];

    limparSecao($idPagina);

  });
  
  //Função para validação utilizada na tentativa de cadastro ou edição
  //de uma seção em alguma página através do CMS, avaliando o preenchimento 
  //de cada elemento
  function validacaoCamposSecao(){
    
    let validacao = true;
    
    $('textarea').each(function(index, elem){
      
      if($(elem).val() == ''){
        validacao = false;
        console.log($(elem).val());
      }
    
    });
    
    $('input[type="file"]').each(function(index, elem){
      
      //No caso de inputs do tipo file, quando o caso for de atualização,
      //não é necessário que o input tenha uma imagem selecionada
      if($(elem).val() == '' && $('.btnCadastrarSecao').val() != 'ATUALIZAR'){
        validacao = false;
        console.log($(elem).val());
      }

    });
    
    $('input[type="text"]').each(function(index, elem){
      
      //Se um dos inputs estiver vazio, for visível e não estiver desabilitado
      //a validação é falsa, pois falta a o preenchimento de algum deles
      if(($(elem).val() == '') && ($(elem).css('visibility') != 'hidden') && ($(elem).attr('disabled') == false)){
          
        validacao = false;  
  
      }

    });
    
    $('select').each(function(index, elem){
      
      if($(elem).val() == ''){
        validacao = false;
        console.log($(elem).val());
      }

    });
      
    return validacao;
  }
  
  //Evento para o cadastro ou edição de uma seção em uma página no Controle de Conteúdo do CMS
  $(document).on('click', '.btnCadastrarSecao', function(e){
    
    if(validacaoCamposSecao()){
      
      //Obtenção do código referente à página
      let codigoPagina = $(this).attr('id').split("_");
      codigoPagina = codigoPagina[1];
      
      //Obtenção do formulário em que estão os campos
      let frm = document.getElementById("frm_sessao");
      
      //Criação de objetos XMLHttpRequest() e FormData() passando o formulário a ser utilizado
      const xhr = new XMLHttpRequest();
      const formData = new FormData(frm);
      
      //Se as páginas forem diferente de Promoções ou Mensalistic,
      //5 ou 6, respectivamente, possuem apenas 1 imagem em seu CRUD
      //Considerar que a página 5, Promoções, não possui imagens em seu CRUD
      if(codigoPagina != 5 && codigoPagina != 6){

        let fileInput = document.getElementById("fle_imagem");
        formData.append('fle_imagem', fileInput.files);
      
      //A página de produto do mês, Mensalistic, possui 4 imagens
      //para cadastro ou atualização
      //Sendo assim, será realizada uma requisição POST 
      //com cada input que será chamado fle_imagem_ + número da imagem
      }else if(codigoPagina == 6){

        for(let cont = 1; cont<= 4; cont++){
          let fileInput = $("#ipt_" + cont)[0];
          formData.append('fle_imagem_' + cont, fileInput.files);
        }

      }

      if($('.btnCadastrarSecao').val() == 'CADASTRAR'){
        formData.append('btnCadastrarSecao', 'CADASTRAR');   
      }else{
        formData.append('btnCadastrarSecao', 'ATUALIZAR');             
      }
      
      //Objeto XMLHTTPRequest abre requisição POST para página php
      //e também envia o formulário com tudo que foi adicionado
      xhr.open('post', "../db/salvarSecao.php?codigoPagina="+codigoPagina);
      xhr.send(formData);

      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            
            //Caso haja sucesso no status da operação, as seções
            //da respectiva página são recarregadas
            if (xhr.status === 200) {
              
               carregarSecoesPagina(codigoPagina);
               
               if($('.btnCadastrarSecao').val() == 'CADASTRAR'){
                 alert('Cadastro realizado com sucesso!');
               }else{
                 alert('Edição realizada com sucesso!');
               }
                 
            } else {
               
              alert('Falha ao salvar operação, consulte o suporte!');
            }
        }
      }
     
    }else{
      e.preventDefault();
      alert('Por gentileza, preencha todos os campos');  
    }
  
  });
  
  //Evento que realiza o logout de um usuário logado no sistema CMS,
  //enviando a solicitação para o PHP
  $(document).on('click', '#logout_operacoes', function(){
      
      $.ajax({
      type: "POST",
      url: "../db/realizarLogout.php",
      data: {modo: 'logout'},
      success: function(dados){        
          window.location.href = '../index.php';
      }
    }); 
      
  });
  
  //Função que exibe o número restante de caracteres restantes
  //para digitação em uma TextArea com limite de 250 caracteres
  function checarQuantidadeDigitada(txt){
      let qtdcaracteres = txt.length;
      let restantes = 250 - qtdcaracteres;
      $("#quantidade_restante").text(restantes);
  };
  
  $(document).on('keyup', '#txt_texto_conteudo', function(){
      checarQuantidadeDigitada($('#txt_texto_conteudo').val());
  });
  
  //Função que exibe o número restante de caracteres restantes
  //para digitação em uma TextArea com limite variado de acordo com a caixa.
  //Isso acontece pois cada região de uma página com conteúdo possui um
  //limite estrutural permitido
  function checarQuantidadeDigitadaPorCaixa(txt, idTxt){
      let qtdcaracteres = txt.length;
    
      let limite = 0;
    
      switch(idTxt){
        case '1':
          limite = 165;
          break;
          
        case '2':
          limite = 250;
          break;
          
        case '3':
          limite = 180;
          break;
          
        default:
          limite = 250;
          break;
      }  
    
      let restantes = limite - qtdcaracteres;
    
      $("#quantidade_restante"+idTxt).text(restantes);
    
  };
  
  //Evento para atualização de caracteres digitados restantes permitidos
  $(document).on('keyup', '.txt_texto_conteudo', function(){
      let $idCaixaTexto = $(this).attr('id');
      checarQuantidadeDigitadaPorCaixa($(this).val(), $idCaixaTexto);
  }); 
  
  //Evento para preview de imagem quando selecionada
  //Utilizada para páginas com CRUD de somente 1 imagem
  $(document).on('change', '#fle_imagem', function(){
    
    const imagem = document.getElementById('fle_imagem').files[0];
    
    const imgPreview = document.getElementById('secao_imagem');
    
    const reader = new FileReader();

    reader.onload = () => imgPreview.src = reader.result;

    reader.readAsDataURL(imagem);

  });
  
  //Evento para preview de imagem quando selecionada
  //Utilizada para páginas com CRUD de várias imagens
  $(document).on('change', '.fle_imagem', function(){

    const imagem = $('#' + $(this).attr('id'))[0].files[0];
    
    let numeroInput = $(this).attr('id').split("_");
    numeroInput = numeroInput[1];
    
    const imgPreview = $('#secao_imagem'+numeroInput)[0];

    const reader = new FileReader();

    reader.onload = () => imgPreview.src = reader.result;

    reader.readAsDataURL(imagem);

  });
  
  //Evento para excluir conteúdo de uma página específica no CMS 
  //no Controle de Conteúdo
  $(document).on('click', '.btn_excluir_conteudo', function(){
    
    let $identificador = $(this).attr('id').split("_");
    let $codigoConteudo = $identificador[0];
    let $foto = $identificador[1];
    let $codigoPagina = $identificador[2];
    
    $.ajax({
    type: "POST",
    url: "../db/excluirConteudo.php",
    data: {modo: 'remocao', codigoConteudo: $codigoConteudo, nomeFoto: $foto, codigoPagina: $codigoPagina},
    success: function(dados){
        
      carregarSecoesPagina($codigoPagina);
      
      alert("Conteúdo excluído com sucesso!");
      
      }
    });
    
  });
  
  //Função que bloqueia a inserção de dados para edição
  //no momento de visualização dos mesmos
  function impedirEdicao(){
    
    $('input[type="text"]').prop('readonly', true);
    $('input[type="file"]').prop('disabled', true);
    $('input[type="radio"]').prop('disabled', true);
    $('textarea').prop('readonly', true);
    $('select').prop('disabled', true);
    
  }
  
  //Evento utilizado para a visualização de um conteúdo de página específica
  //no CMS em Controle de Conteúdo
  //recarregando o formulário com edição bloqueada
  $(document).on('click', '.visualizar_conteudo', function(){
          
      let $identificacao = $(this).attr('id').split('_');
      let $idConteudo = $identificacao[0];
      let $idPagina = $identificacao[1];
    
      $.ajax({
        type: "POST",
        url: "../db/carregarConteudo.php",
        data: {modo: 'visualizarConteudo', codigo: $idConteudo, pagina: $idPagina},
        success: function(dados){

          $('#frm_sessao').html(dados);
          
          impedirEdicao();
          
          $('.btnCadastrarSecao').css({visibility: "hidden", transition: "0.5s"}).animate({opacity: 0}, 200);
          
        }
      });

    });
    
    //Evento utilizado para a edição de um conteúdo de página específica
    //no CMS em Controle de Conteúdo
    //recarregando o formulário com edição desbloqueada
    $(document).on('click', '.editar_conteudo', function(){
          
      let $identificacao = $(this).attr('id').split('_');
      let $idConteudo = $identificacao[0];
      let $idPagina = $identificacao[1];

      $.ajax({
        type: "POST",
        url: "../db/carregarConteudo.php",
        data: {modo: 'editarConteudo', codigo: $idConteudo, pagina: $idPagina},
        success: function(dados){

         $('#frm_sessao').html(dados);

         $('.btnCadastrarSecao').val('ATUALIZAR');

        }
      });

    });
  
    //Evento que atualiza a exibição de campos de acordo com o filtro
    //de categorias, sendo nova ou existente, no momento de cadastro/edição
    //de um Produto no Controle de Conteúdo do CMS
    $(document).on('change', 'input[name="rdo_categoria"]', function(){
      if (this.value == 'existente') {
        $('#slt_categoria').css('background', 'none');
        $('#slt_categoria').css('pointer-events', 'all');
        $('#slt_categoria').prop('required', true);
        $('#nova_categoria').css('visibility', 'hidden').animate({opacity: 0}, 200);
        $('#nova_subcategoria').css('visibility', 'hidden').animate({opacity: 0}, 200);
        $('#rdo_subcategoria_existente').attr('disabled', false);
        $('#rdo_subcategoria_existente').attr('checked', true);
        $('#rdo_nova_subcategoria').attr('disabled', true);
        $('#rdo_nova_subcategoria').attr('checked', false);
      }else{
        
        $('#slt_categoria').css('background', '#eee');
        $('#slt_categoria').css('pointer-events', 'none');
        $('#slt_categoria').prop('required', false);
        $('#nova_categoria').css({visibility: "visible", transition: "0.5s"}).animate({opacity: 1}, 200);
        
        $('#slt_subcategoria').css('background', '#eee');
        $('#slt_subcategoria').css('pointer-events', 'none');
        $('#slt_subcategoria').prop('required', false);
        $('#nova_subcategoria').css({visibility: "visible", transition: "0.5s"}).animate({opacity: 1}, 200);
        
        $('input[name="rdo_subcategoria"]').attr('disabled', false);
        $('#rdo_subcategoria_existente').attr('checked', false);
        $('#rdo_nova_subcategoria').attr('disabled', false);
        $('#rdo_nova_subcategoria').attr('checked', true);
        $('#rdo_subcategoria_existente').attr('disabled', true);
        
      }
    });
  
    //Evento que atualiza a exibição de campos de acordo com o filtro
    //de subcategorias, sendo nova ou existente, no momento de cadastro/edição
    //de um Produto no Controle de Conteúdo do CMS
    $(document).on('change', 'input[name="rdo_subcategoria"]', function(){
      if (this.value == 'existente') {
        $('#slt_subcategoria').css('background', 'none');
        $('#slt_subcategoria').css('pointer-events', 'all');
        $('#slt_subcategoria').prop('required', true);
        $('#nova_subcategoria').css('visibility', 'hidden').animate({opacity: 0}, 200);
      }
      else if (this.value == 'novo') {
        $('#slt_subcategoria').css('background', '#eee');
        $('#slt_subcategoria').css('pointer-events', 'none');
        $('#slt_subcategoria').prop('required', false);
        $('#nova_subcategoria').css({visibility: "visible", transition: "0.5s"}).animate({opacity: 1}, 200);
      }
    });
    
    //Evento para recarregar lista de subcategorias ou bloquea-la conforme
    //escolha da categoria na página Produtos em Controle de Conteúdo do CMS
    $(document).on('change', '#slt_categoria', function(){
      
        let $categoria = $(this).val();
        
        //Se o valor do select da categoria estiver vazio, não deve ser possível
        //escolher uma subcategoria
        //Se o valor estiver escolhido, as subcategorias devem ser carregadas
        //de acordo com a escolha
        if($categoria == ''){
          $('#slt_subcategoria').attr('disabled', true);
          $('input[name="rdo_subcategoria"]').attr('disabled', true);
        }else{
          $.ajax({
            type: "POST",
            url: "../db/carregarSubcategorias.php",
            data: {modo:'carregamento', categoria: $categoria},
            success: function(dados){
             $("#div_cadastro_subcategoria").html(dados); 
            }
          });
        }
        
    });
    
    //Evento para exibir o gerenciador de categorias na página de Produtos
    //no Controle de Conteúdo do CMS
    $(document).on("click", "#gerenciador_categorias", function(){

      $("#container_modal").fadeIn(1000);

      $.ajax({
            type: "POST",
            url: "../db/visualizarCategorias.php",
            data: {modo: 'gerenciar_categorias'},
            success: function(dados){

              $('#conteudo_modal').html(dados);

            }
      });
    });
    
    //Evento para exibir o gerenciador de categorias na página de Produtos
    //no Controle de Conteúdo do CMS
    $(document).on("click", "#gerenciador_subcategorias", function(){

      $("#container_modal").fadeIn(1000);

      $.ajax({
            type: "POST",
            url: "../db/visualizarSubcategorias.php",
            data: {modo: 'gerenciar_subcategorias'},
            success: function(dados){

              $('#conteudo_modal').html(dados);

            }
      });
    });

});







