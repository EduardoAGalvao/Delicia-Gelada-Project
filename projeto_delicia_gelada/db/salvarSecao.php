<?php

//Permite configurar os padrões de regionalidade
setLocale(LC_ALL, 'pt-br');

//Recebendo valor que identifica a página escolhida
$pagina = $_GET['codigoPagina'];

//Recebendo data atual, utilizada em várias inserções
$dataInsercao = date('Y-m-d');

//Setando ativação padrão para as seções que utilizarem
$ativado = (string) '0';

//Declaração das variáveis da seção de Curiosidades
$rdoPosicao = (string) null;
$rdoFormato = (string) null;
$txtTextoConteudo = (string) null;

//Declaração das variáveis da seção de Produtos
$txtNomeProduto = (string) null;
$txtPrecoProduto = (string) null;
$txtDescricaoProduto = (string) null;
$rdoCategoria = (string) null;
$rdoSubcategoria = (string) null;
$sltCategoria = (int) null;
$sltSubcategoria = (int) null;

//Declaração das variáveis da seção de Promoções
$sltProdutoPromocao = (string) null;
$txtDescontoPromocoes = (string) null;

//Declaração das variáveis da seção de Produto do Mês (Mensalistic)
$sltProdutoMes = (int) null;
$txtTitulo = (string) null;
$txtInicio = (string) null;
$txtMeio1  = (string) null;
$txtMeio2 = (string) null;

//Inicializando $_SESSION
session_start();

if(isset($_POST['btnCadastrarSecao'])){
  
  //Executando rotinas de upload de imagem
  require_once('upload.php');
  
  //Importa o arquivo de conexão com BD
  require_once('conexao.php');

  //Abre a conexão com BD
  $conexao = conexaoMysql();
  
  //Checando qual seção está sendo salva para decisão de lógicas
  //O salvamento do conteúdo é feito conforme a página, especificamente
  //Página 1 -> Curiosidades
  //Página 4 -> Produtos
  //Página 5 -> Promoções
  //Página 6 -> Mensalistic (Produto do mês)
  switch($pagina){

    case 1:
      
      $rdoPosicao = $_POST['rdo_posicao'];
      $rdoFormato = $_POST['rdo_formato'];
      $txtTextoConteudo = $_POST['txt_texto_conteudo'];

      //Tratamento para editar com/sem foto
      if($_FILES['fle_imagem']['name'] == '' && $_POST['btnCadastrarSecao'] == 'ATUALIZAR'){

        $sql = "UPDATE tbl_secao_curiosidades SET 
                    texto ='" .$txtTextoConteudo. "',
                    posicao_imagem ='" .$rdoPosicao. "', 
                    formato_imagem ='" .$rdoFormato. "' 
                    WHERE id_secao = ". $_SESSION['idConteudoEdicao']; 

        //Executa um script no BD
        if(!mysqli_query($conexao,$sql)){
          echo("Erro: Problema na execução do script no BD");
          echo $sql;  
        }

      //Tratamento para o update sem a foto
      }else{

        if($_POST['btnCadastrarSecao'] == "CADASTRAR"){

            //Sessão criada no arquivo upload.php
            $nomeFoto = $_SESSION['nomeFoto'];

            $sql = "INSERT INTO tbl_secao_curiosidades(texto, imagem, posicao_imagem, formato_imagem, ativado, data_insercao) 
            VALUES('" .$txtTextoConteudo. "','" .$nomeFoto. "',
                  '" .$rdoPosicao. "','" .$rdoFormato. "',
                  '" .$ativado. "','" .$dataInsercao. "');";  

        }elseif($_POST['btnCadastrarSecao'] == "ATUALIZAR"){

            //Sessão criada no arquivo upload.php
            $nomeFoto = $_SESSION['nomeFoto'];

            $sql = "UPDATE tbl_secao_curiosidades SET 
                    texto ='" .$txtTextoConteudo. "',
                    posicao_imagem ='" .$rdoPosicao. "', 
                    formato_imagem ='" .$rdoFormato. "',  
                    imagem = '".$nomeFoto."' 
                    WHERE id_secao = ". $_SESSION['idConteudoEdicao']; 

        }

        //Executa um script no BD
        if(mysqli_query($conexao,$sql)){

          //Verifica a existência da variável de sessão,
          //ela será criada na página anterior quando carregamos 
          //os dados nas caixas de texto
          if(isset($_SESSION['foto'])){
            unlink('arquivos/'.$_SESSION['foto']);
            unset($_SESSION['foto']);
            unset($_SESSION['nomeFoto']);
          }

          //Apaga a variável de sessão que foi utilizada
          //no upload.php
          if(isset($_SESSION['nomeFoto'])){
            unset($_SESSION['nomeFoto']);
          }

        }else{
            echo("Erro: Problema na execução do script no BD");
            echo $sql;
        }

      }

      break;

    case 4:
      
      $txtNomeProduto = $_POST['txt_nome_produto'];
      $txtPrecoProduto = $_POST['txt_preco_produto'];
      $txtDescricaoProduto = $_POST['txt_descricao_produto'];
      $rdoCategoria = $_POST['rdo_categoria'];
      $rdoSubcategoria = $_POST['rdo_subcategoria'];
      $sltCategoria = $_POST['slt_categoria'];
      $sltSubcategoria = $_POST['slt_subcategoria'];
      $codigoCategoria = (int) null;
      $codigoSubcategoria = (int) null;
      
      //Se for maior que 3 digítos, significa que o valor segue o padrão X,XX e deve ter a vírgula substituída por ponto para acesso ao banco, caso contrário a vírgula deverá apenas ser retirada 
      
      //Ex: retornará 1.50 ou 12.50
      if($txtPrecoProduto.count() > 3){
        $txtPrecoProduto = str_replace(',', '.', $txtPrecoProduto);
      //Ex: retornará 0.05
      }elseif($txtPrecoProduto.count() == 1){
        $txtPrecoProduto = '0.0' . $txtPrecoProduto;
      //Ex: retornará 0.25
      }else{
        $txtPrecoProduto = str_replace(',', '0.', $txtPrecoProduto);
      }
      
      //Checando se uma nova categoria foi definida
      //Em caso afirmativo, realiza o insert e coleta o novo ID criado
      //para o cadastro no banco
      //Em caso negativo, coleta o valor escolhido no select
      if($rdoCategoria == 'novo'){
        
        $txtCategoria = $_POST['txt_nome_categoria'];
        
        $sql = "INSERT INTO tbl_categorias (nome_categoria, data_insercao) VALUES ('".$txtCategoria."', '".$dataInsercao."')";
        
        mysqli_query($conexao, $sql);
        
        $codigoCategoria = mysqli_insert_id($conexao);
        
      }else{
        
        $codigoCategoria = $sltCategoria;
        
      }
      
      //Checando se uma nova subcategoria foi definida
      //Em caso afirmativo, realiza o insert e coleta o novo ID criado
      //para o cadastro no banco
      //Em caso negativo, coleta o valor escolhido no select
      if($rdoSubcategoria == 'novo'){
        
        $txtSubcategoria = $_POST['txt_nome_subcategoria'];
        
        $sql = "INSERT INTO tbl_subcategorias (nome_subcategoria, id_categoria, data_insercao) VALUES ('".$txtSubcategoria."', ".$codigoCategoria." ,'".$dataInsercao."')";
        
        mysqli_query($conexao, $sql);
        
        $codigoSubcategoria = mysqli_insert_id($conexao);
        
      }else{
        
        $codigoSubcategoria = $sltSubcategoria;
        
      }
      
      //Tratamento para editar com/sem foto
      if($_FILES['fle_imagem']['name'] == '' && $_POST['btnCadastrarSecao'] == 'ATUALIZAR'){

        $sql = "UPDATE tbl_produtos SET 
                    nome_produto ='" .$txtNomeProduto. "',
                    descricao ='" .$txtDescricaoProduto. "', 
                    preco =" .$txtPrecoProduto. ",
                    id_categoria = " .$codigoCategoria. ",
                    id_subcategoria = " .$codigoSubcategoria. "
                    WHERE id_produto = ". $_SESSION['idConteudoEdicao']; 

        //Executa um script no BD
        if(!mysqli_query($conexao,$sql)){
          echo("Erro: Problema na execução do script no BD");
          echo $sql;  
        }

      //Tratamento para o update sem a foto
      }else{

        if($_POST['btnCadastrarSecao'] == "CADASTRAR"){

            //Sessão criada no arquivo upload.php
            $nomeFoto = $_SESSION['nomeFoto'];

            $sql = "INSERT INTO tbl_produtos(nome_produto, descricao, preco, imagem, ativado, id_categoria, id_subcategoria, data_insercao) 
            VALUES('" .$txtNomeProduto. "','" .$txtDescricaoProduto. "',
                  '" .$txtPrecoProduto. "','" .$nomeFoto. "',
                  '" .$ativado. "', ".$codigoCategoria." , ".$codigoSubcategoria.", '" .$dataInsercao. "');";  

        }elseif($_POST['btnCadastrarSecao'] == "ATUALIZAR"){

            //Sessão criada no arquivo upload.php
            $nomeFoto = $_SESSION['nomeFoto'];

            $sql = "UPDATE tbl_produtos SET 
                    nome_produto ='" .$txtNomeProduto. "',
                    descricao ='" .$txtDescricaoProduto. "',
                    preco =" .$txtPrecoProduto. ",  
                    imagem = '".$nomeFoto."',
                    id_categoria = " .$codigoCategoria. ",
                    id_subcategoria = " .$codigoSubcategoria. "
                    WHERE id_produto = ". $_SESSION['idConteudoEdicao'];  

        }

        //Executa um script no BD
        if(mysqli_query($conexao,$sql)){

          //Verifica a existência da variável de sessão,
          //ela será criada na página anterior quando carregamos 
          //os dados nas caixas de texto
          if(isset($_SESSION['foto'])){
            unlink('arquivos/'.$_SESSION['foto']);
            unset($_SESSION['foto']);
            unset($_SESSION['nomeFoto']);
          }

          //Apaga a variável de sessão que foi utilizada
          //no upload.php
          if(isset($_SESSION['nomeFoto'])){
            unset($_SESSION['nomeFoto']);
          }

        }else{
            echo("Erro: Problema na execução do script no BD");
            echo $sql;
        }

      }
          
      break;
      
    case 5:
      
      $sltProdutoPromocao = $_POST['slt_produtos'];
      $txtDescontoPromocoes = $_POST['txt_desconto_promocoes'];
      
      if($_POST['btnCadastrarSecao'] == 'CADASTRAR'){
        
        $sql = "INSERT INTO tbl_promocoes(id_produto, desconto, ativado, data_insercao) VALUES(".$sltProdutoPromocao.", ".$txtDescontoPromocoes.", '".$ativado."', '".$dataInsercao."')";
        
      }else{
        
        $sql = "UPDATE tbl_promocoes SET 
                id_produto = ".$sltProdutoPromocao.",
                desconto = ".$txtDescontoPromocoes." 
                WHERE id_promocao = ".$_SESSION['idConteudoEdicao'];
        
      }
      
      //Executa um script no BD
      if(!mysqli_query($conexao,$sql)){
        echo("Erro: Problema na execução do script no BD");
        echo $sql;
      }
      
      break;
      
    case 6:
      
      $sltProdutoMes = $_POST['slt_produto_mes'];
      $txtTitulo = $_POST['txt_titulo_mensalistic'];
      $txtInicio = $_POST['txt_conteudo1'];
      $txtMeio1  = $_POST['txt_conteudo2'];
      $txtMeio2 = $_POST['txt_conteudo3'];
     
      $names = 0;
      
      foreach($_FILES as $file){
        $names = ($file['name'] == true) ? ($names+1) : ($names+0);
      }
      
      //Tratamento para editar com/sem foto
      if($names == 0 && $_POST['btnCadastrarSecao'] == 'ATUALIZAR'){

        $sql = "UPDATE tbl_mensalistic SET 
                    id_produto = ".$sltProdutoMes.",
                    titulo ='" .$txtTitulo. "',
                    texto_inicio = '".$txtInicio."',
                    texto1_meio ='" .$txtMeio1. "', 
                    texto2_meio ='" .$txtMeio2. "' 
                    WHERE id_produto_mes = ". $_SESSION['idConteudoEdicao'];
        
        //Executa um script no BD
        if(!mysqli_query($conexao,$sql)){
          echo("Erro: Problema na execução do script no BD");
          echo $sql;  
        }

      }else{
        
        if($_POST['btnCadastrarSecao'] == "CADASTRAR"){
          
          //Todo produto do mês que é cadastrado já é adicionado ativado, logo após deverá desativar os outros se já existirem
          $ativado = '1';
              
          //Sessão criada no arquivo upload.php
          for($cont = 1; $cont<=4; $cont++){
            ${"foto" . $cont} = $_SESSION['nomeFoto']['fle_imagem_'.$cont.''];
          }
          
          //Seleciona o produto do mês atual
          $sqlSelect = "SELECT * FROM tbl_mensalistic WHERE ativado = 1;";
          
          $select = mysqli_query($conexao, $sqlSelect);
                    
          //EXCLUIR IMAGENS AO ATUALIZAR A EXCLUSÃO
          if(mysqli_num_rows($select) > 0){
            
            while($produtoAtual = mysqli_fetch_assoc($select)){
              $imagem1Inicio = $produtoAtual['imagem1_inicio'];
              $imagem2Inicio = $produtoAtual['imagem2_inicio'];
              $imagemMeio = $produtoAtual['imagem_meio'];
              $imagemFinal = $produtoAtual['imagem_final'];
            }
            
            $sqlUpdate = "UPDATE tbl_mensalistic SET data_exclusao = '".$dataInsercao."', ativado = 0 WHERE ativado = 1";

            if(mysqli_query($conexao, $sqlUpdate)){
              unlink('arquivos/'.$imagem1Inicio);
              unlink('arquivos/'.$imagem2Inicio);
              unlink('arquivos/'.$imagemMeio);
              unlink('arquivos/'.$imagemFinal);
            }else{
              echo($sqlUpdate);
            }
          }
            
          $sql = "INSERT INTO tbl_mensalistic(id_produto, titulo, imagem1_inicio, texto_inicio, imagem2_inicio, texto1_meio, imagem_meio, texto2_meio, imagem_final, ativado, data_insercao) 
          VALUES( ".$sltProdutoMes." ,'" .$txtTitulo. "','" .$foto1. "',
                  '" .$txtInicio. "','" .$foto2. "',
                  '" .$txtMeio1. "','" .$foto3. "', '".$txtMeio2."', '".$foto4."', '".$ativado."', '".$dataInsercao."');";  

        }elseif($_POST['btnCadastrarSecao'] == "ATUALIZAR"){
          
            //Sessão criada no arquivo upload.php
            //O repetidor atribui valores às variáveis pré-definidias:
            //$foto1, $foto2, $foto3, $foto4
            //verificando se existiu alguma edição no envio do name
            //na $_SESSION['nomeFoto']['fle_imagem_'.$cont.'']
            //Caso haja, atribui o novo name à variável
            //Senão, atribui o nome antigo pelo $_SESSION['fotos'][$cont-1]
          
            for($cont = 1; $cont<=4; $cont++){
              
              ${"foto" . $cont} = isset($_SESSION['nomeFoto']['fle_imagem_'.$cont.'']) ? $_SESSION['nomeFoto']['fle_imagem_'.$cont] : $_SESSION['fotos'][$cont-1];
              
            }
          
            $sql = "UPDATE tbl_mensalistic SET 
                    id_produto = ".$sltProdutoMes.",
                    titulo ='" .$txtTitulo. "',
                    imagem1_inicio = '".$foto1."',
                    texto_inicio = '".$txtInicio."',
                    imagem2_inicio = '".$foto2."',
                    texto1_meio ='" .$txtMeio1. "',
                    imagem_meio = '".$foto3."',
                    texto2_meio ='" .$txtMeio2. "',
                    imagem_final = '".$foto4."'
                    WHERE id_produto_mes = ". $_SESSION['idConteudoEdicao']; 
            
          echo $sql;
        }

        //Executa um script no BD
        if(mysqli_query($conexao,$sql)){

          //Verifica a existência da variável de sessão,
          //ela será criada na página anterior quando carregamos 
          //os dados nas caixas de texto
          if(isset($_SESSION['fotos'])){
            
            //Temos que descobrir os índices das imagens que foram substituídas para apagar as antigas
            for($cont = 1; $cont<=4; $cont++){
              if(isset($_SESSION['nomeFoto']['fle_imagem_'.$cont.''])){ 
                unlink('arquivos/'.$_SESSION['fotos'][$cont-1]);
              }
            }
            
            unset($_SESSION['fotos']);
            unset($_SESSION['nomeFoto']);
          }

          //Apaga a variável de sessão que foi utilizada
          //no upload.php
          if(isset($_SESSION['nomeFoto'])){
            unset($_SESSION['nomeFoto']);
          }

        }else{
            echo("Erro: Problema na execução do script no BD");
            echo $sql;
        }

      }
    
      break;
      
    default:
      break;
  }
  
  
    
}else{
  echo("Problemas ao verificar a superglobal POST");
}

?>