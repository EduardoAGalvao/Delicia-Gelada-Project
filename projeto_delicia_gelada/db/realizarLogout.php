<?php

  //Arquivo para realização de logout
  //Tornando variáveis de sessão falsas para as autenticações do header


    if(isset($_POST['modo']) && $_POST['modo'] == 'logout'){
        
        session_start();
        
        $_SESSION['logado'] = false;
        $_SESSION['edicao_produtos'] = false;
        
    }

?>