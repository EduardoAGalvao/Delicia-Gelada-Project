"use strict";

$(document).ready(function(){
    
    //Sinalizando campos vazios ao usuário
    $("input").change(function(){
        if($(this).val().trim() == ""){
            $(this).addClass('campoVazio');    
        }else{
            $(this).removeClass('campoVazio');
        }
    });
    
    //Máscara para texto
    function filtrarTexto(txt) {
      return txt.replace(/[^A-Za-zÀ-ÿ ]/g, "");
    };
    
    //Máscara para celular
    function mascaraCelular(texto) {
        return filtrarNumero(texto).replace(/(.)/, "($1")
                                   .replace(/(.{3})(.)/, "$1)$2")
                                   .replace(/(.{9})(.)/, "$1-$2");
    };
    
    //Máscara para CPF
    function mascaraCpf(texto) {
        return filtrarNumero(texto).replace(/(.{3})/, "$1.")
                                   .replace(/(.{7})(.)/, "$1.$2")
                                   .replace(/(.{11})(.)/, "$1-$2");
    };
  
    //Máscara para preço
    function mascaraPreco(texto){
        return filtrarNumero(texto).replace(/(.*)(.{2})/,"$1,$2");
    }
    
    //Máscara para números
    function filtrarNumero(texto) {
        return texto.replace(/[^0-9]/g, "");
    };
    
    //Máscara para email
    function filtrarEmail(texto) {
        return texto.replace(/[^@-Za-z0-9_.-]/g, "");
    };
    
    /****EVENTOS****/
    $('#txt_nome').on("keyup", function () {
        $(this).val(filtrarTexto($(this).val()));
    });
    
    $('#txt_cpf').on("keyup", function () {
        $(this).val(mascaraCpf($(this).val()));
    });
    
    $('#txt_celular').on("keyup", function () {
        $(this).val(mascaraCelular($(this).val()));
    });
    
    $('#txt_email').on("keypress", function () {
        $(this).val(filtrarEmail($(this).val()));
    });
  
    $(document).on("keyup", '#txt_preco_produto', function () {
        $(this).val(mascaraPreco($(this).val()));
    });
    
    //Evento que impede que um usuário seja salvo 
    //sem a senha e a confirmação serem iguais
    $('#btnCadastrarUsuario').on('click', function(e){
        
        if($('#txt_senha').val() != $('#txt_confsenha').val()){
          e.preventDefault();
          alert('A senha e seu campo de confirmação devem ser iguais!');
        }  
      
    });
    
});
    