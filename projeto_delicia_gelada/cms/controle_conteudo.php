<?php

  require_once('header.php');

?>      
      <!--CONTEÚDO-->
      <div id="container_principal" class="center">
        
        <div id="gerenciador_conteudo">
            <div id="conteudo_paginas">
                <?php
                
                    $idPagina = null;
                    
                    $sql = "SELECT * FROM tbl_pagina;";
                
                    $select = mysqli_query($conexao, $sql);
                
                    //Controle e edição de conteúdo por páginas
                    while($rs = mysqli_fetch_assoc($select)){
                
                ?>
                
                    <button class="btnPagina btnPaginaComum" value="<?= $rs['id_pagina'] ?>"><?= $rs['nome_pagina']?></button>
                
                <?php
                    
                    }
                    
                ?>
                      
            </div>
            <div id="conteudo_crud">
              
              <div id="conteudo_crud_abertura">
                <h1>Selecione uma página ao lado para adicionar, editar ou excluir suas seções!</h1>
                <img src="img/website.png" alt="Imagem de página de website" title="Imagem de página de website">
              </div>
                
            </div>
        </div>    
          
      </div>

<?php

  require_once('footer.php');

?>

      
