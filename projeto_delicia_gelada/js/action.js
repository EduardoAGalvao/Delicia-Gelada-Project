'use strict';

$(function() {
  
    /*Elementos DOM - Slider*/
    const $containerSlides = document.querySelector('.slides');
    const $imagensSlider = document.querySelectorAll('.slides li'); 
    //Botões
    const $seta_direita = document.querySelector('#seta_direita');
    const $seta_esquerda = document.querySelector('#seta_esquerda'); 
    //Auxiliares
    let contador = 1;
    let tamanho = $imagensSlider[0].clientWidth;
  
    $containerSlides.style.transform = 'translateX(' + -tamanho * contador + 'px)'; 
  
    //Automatização
    setInterval(function () {
      if (contador >= $imagensSlider.length - 1) return;
      $containerSlides.style.transition = "transform 0.7s ease-in-out";
      contador++;
      $containerSlides.style.transform = 'translateX(' + -tamanho * contador + 'px)';
    }, 3000); 
  
    //Controle Manual - Ouvintes
    $seta_direita.addEventListener('click', function () {
      if (contador >= $imagensSlider.length - 1) return;
      $containerSlides.style.transition = "transform 0.4s ease-in-out";
      contador++;
      $containerSlides.style.transform = 'translateX(' + -tamanho * contador + 'px)';
    });
  
    $seta_esquerda.addEventListener('click', function () {
      if (contador <= 0) return;
      $containerSlides.style.transition = "transform 0.4s ease-in-out";
      contador--;
      $containerSlides.style.transform = 'translateX(' + -tamanho * contador + 'px)';
    });
  
    $containerSlides.addEventListener('transitionend', function () {
      
      if ($imagensSlider[contador].id === "cloneUltima") {
        $containerSlides.style.transition = "none";
        contador = $imagensSlider.length - 2;
        $containerSlides.style.transform = 'translateX(' + -tamanho * contador + 'px)';
      }

      if ($imagensSlider[contador].id === "clonePrimeira") {
        $containerSlides.style.transition = "none";
        contador = $imagensSlider.length - contador;
        $containerSlides.style.transform = 'translateX(' + -tamanho * contador + 'px)';
      }
      
    });
  
    /*Manipulação dos Submenus*/
    /*Elementos do DOM*/
    const $link_submenu = $('.link_submenu');

    //O método slideToggle() altera a posição do submenu,
    //fazendo-o aparecer ou desaparecer em determinado tempo
    $link_submenu.click(function manipularSubmenu(){
      
      $(this).children().slideToggle(1000);
      $(this).toggleClass("link_submenu_aberto");
      
    });

});
