"use strict";

$(document).ready(function(){
    
    //Declaração de variáveis de campos
    const $nome = document.getElementById("txt_nome");
    const $profissao = document.getElementById("txt_profissao");
    const $telefone = document.getElementById("txt_telefone");
    const $celular = document.getElementById("txt_celular");
    const $email = document.getElementById("txt_email");
    const $mensagem = document.getElementById("txt_mensagem");
    
    //Sinalizando campos vazios ao usuário
    $("input").change(function(){
        if($(this).val().trim() == ""){
            $(this).addClass('campoVazio');    
        }else{
            $(this).removeClass('campoVazio');
        }
    });
    
    //Função que exibe o número restante de caracteres para digitação em uma TextArea
    function checarQuantidadeDigitada(txt){
        let qtdcaracteres = $mensagem.value.length;
        let restantes = 300 - qtdcaracteres;
        $("#quantidade_restante").text(restantes);
    };
    
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
    
    //Máscara para telefone
    function mascaraTelefone(texto) {
        return filtrarNumero(texto).replace(/(.)/, "($1")
                                   .replace(/(.{3})(.)/, "$1)$2")
                                   .replace(/(.{8})(.)/, "$1-$2");
    };
    
    //Máscara para números
    function filtrarNumero(texto) {
        return texto.replace(/[^0-9]/g, "");
    };
    
    //Máscara para email
    function filtrarEmail(texto) {
        return texto.replace(/[^@-Za-z0-9_.-]/g, "");
    };
    
    /****EVENTOS****/
    $nome.addEventListener("keypress", function () {
        return $nome.value = filtrarTexto($nome.value);
    });
    
    $profissao.addEventListener("keypress", function () {
        return $profissao.value = filtrarTexto($profissao.value);
    });
    
    $telefone.addEventListener("keyup", function () {
        return $telefone.value = mascaraTelefone($telefone.value);
    });
    
    $celular.addEventListener("keyup", function () {
        return $celular.value = mascaraCelular($celular.value);
    });
    
    $email.addEventListener("keypress", function () {
        return $email.value = filtrarEmail($email.value);
    });
    
    $mensagem.addEventListener("keyup", function () {
        return checarQuantidadeDigitada($mensagem.value);
    });
});
    