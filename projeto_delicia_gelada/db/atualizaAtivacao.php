<?php 
  
  //Recebe dados de conexão com o banco
  require_once("../db/conexao.php");
  $conexao = conexaoMysql();

  //Determina as variáveis base e recebe as informações por POST
  $modo = $_POST['modo'];
  $tipo = $_POST['tipo'];
  $id = $_POST['codigo'];
  $tabela = '';
  $campoChavePrimaria = '';
  
  //Verifica se o modo é de ativação e de acordo com o tipo de entidade, determina o nome da tabela e do campo que possui o ID, ou seja, a chave primária
  if($modo == 'ativacao'){
    
    switch($tipo){
        
      case 'usuario':
        
        $tabela = 'tbl_usuarios';
        $campoChavePrimaria = 'id_usuario';
        
        break;
        
      case 'perfil':
        
        $tabela = 'tbl_perfil';
        $campoChavePrimaria = 'id_perfil';
        
        break;
        
      case 'produto':
        
        $tabela = 'tbl_produtos';
        $campoChavePrimaria = 'id_produto';
        
        break;
        
      case 'curiosidade':
        
        $tabela = 'tbl_secao_curiosidades';
        $campoChavePrimaria = 'id_secao';
        
        break;
        
      default:
        break;
    }
    
    //Realiza uma busca na tabela com o ID específico checando o status de ativação
    //armazenando esse status na variável $ativacao
    $sqlAtivacao = "SELECT (ativado) FROM ". $tabela ." WHERE ". $campoChavePrimaria ." = " . $id;

    $selectAtivacao = mysqli_query($conexao, $sqlAtivacao);

    $entidade = mysqli_fetch_assoc($selectAtivacao);

    $ativacao = $entidade['ativado'];                               
    
    //A nova ativação é determinada sendo o inverso da ativação atual
    $novaAtivacao = $ativacao == '0' ? '1' : '0';        

    $sql = "UPDATE ". $tabela ." SET ativado = " . $novaAtivacao . " WHERE ". $campoChavePrimaria ." = " . $id;
    
    if(!mysqli_query($conexao, $sql)){
      echo("<script>
              alert('Ativação não realizada, consulte o suporte técnico.');
            </script>");      
    }
    
  }

?>
