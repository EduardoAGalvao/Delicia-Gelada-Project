<?php

if(isset($_POST)){
  //Variáveis para o upload de arquivos
  //Poderiam ser declaradas com constantes
  $diretorio = (string) "arquivos/";
  $tamanhoPermitido = (int) 1000;
  $arquivosPermitidos = array("image/jpeg", "image/jpg", "image/png"); 
  
  //Verifica se o número de arquivos enviados é maior que 1
  //caso seja, uma verificação diferente deverá ser feita
  if(count($_FILES) > 1){
    
    foreach($_FILES as $codigoFoto => $file){
      
      //Tratamento para tipo de arquivo vazio
      //Isso ocorre quando o arquivo ultrapassa o tamanho estipulado
      //pelo php.ini
      if($file['type'] != ''){

        //Tratamento para arquivos sem tamanho (corrompido) ou arquivo vazio
        if($file['size'] > 0){

          //Para resgatar o arquivo escolhido no HTML, usamos $_FILES
          $tipoArquivo = $file['type'];

          //Permite buscar dentro de um array um conteúdo específico
          if(in_array($tipoArquivo, $arquivosPermitidos)){

            //Resgata o tamanho do arquivo a ser upado para o servidor
            //É dividido por 1024 para a conversão de bytes para kbytes
            //Após pegar o tamanho do arquivo, dividimos por 1024 para transformar em kb
            //Depois aplicamos o round() para pegar somente a parte inteira do número
            $tamanhoArquivo = round($file['size']/1024);

            //Restrição de tamanho do arquivo
            if($tamanhoArquivo <= $tamanhoPermitido){

              $nomeCompletoArquivo = $file['name'];

              //pathinfo() - permite pegar qualquer parte do nome de um arquivo
              //utilizando o parâmetro PATHINFO_FILENAME pegamos apenas o nome
              //utilizando o parâmetro PATHINFO_EXTENSION pegamos apenas a extensão
              $nomeArquivo = pathinfo($nomeCompletoArquivo, PATHINFO_FILENAME);
              $extensaoArquivo = pathinfo($nomeCompletoArquivo, PATHINFO_EXTENSION);

              /*
                Algoritmos de criptografia no PHP:
                -> MD5()
                -> sha1()
                -> hash(tipo do algoritmo ,var) - possibilita mais possibilidades de algoritmo

                Para gerar o nome do arquivo que nunca se repita, usamos:
                -> uniqid() - que gera um valor aleatório com base em informações de sistema e número aleatório
                -> time() - retorna hh:mm:ss da máquina
                -> md5() - utilizado para embaralhar os dados
              */

              $nomeCrypt = md5(uniqid(time()).$nomeArquivo);
              $nomeFoto = $nomeCrypt.".".$extensaoArquivo;
              $arquivoTemp = $file['tmp_name'];

              //Encaminha a imagem para a pasta de destino
              //recebendo o caminho de origem, e o de destino concatenado com o novo nome
              if(move_uploaded_file($arquivoTemp, $diretorio.$nomeFoto)){

                 if(!isset($_SESSION)){
                    session_start();
                  }
                
                 $nomesFotos[$codigoFoto] = $nomeFoto;
                 $_SESSION['nomeFoto'] = $nomesFotos;

                }else{
                  echo('<script>

                        alert("Erro ao enviar o arquivo para o servidor.");

                      </script>');
                }

        }else{

            echo('<script>

                  alert("O arquivo está vazio e não pode ser salvo.");

                </script>');

          }


          }else{

            echo('<script>

                  alert("O tipo de arquivo selecionado possui tamanho superior ao limite de 1Mb");

                </script>');

          }

        }else{
          echo('<script>

                alert("O tipo de arquivo selecionado não é permitida");

              </script>');
        }

      }else{
          echo('<script>

                alert("Não é possível fazer o upload de um tipo de arquivo vazio");

              </script>');
        }
      
    } 
    
  }else{
  //Caso o $_FILES tenha somente 1 arquivo, deverá seguir por esse caminho
    
  //Tratamento para tipo de arquivo vazio
  //Isso ocorre quando o arquivo ultrapassa o tamanho estipulado
  //pelo php.ini
  if($_FILES['fle_imagem']['type'] != ''){

    //Tratamento para arquivos sem tamanho (corrompido) ou arquivo vazio
    if($_FILES['fle_imagem']['size'] > 0){

      //Para resgatar o arquivo escolhido no HTML, usamos $_FILES
      $tipoArquivo = $_FILES['fle_imagem']['type'];

      //Permite buscar dentro de um array um conteúdo específico
      if(in_array($tipoArquivo, $arquivosPermitidos)){

        //Resgata o tamanho do arquivo a ser upado para o servidor
        //É dividido por 1024 para a conversão de bytes para kbytes
        //Após pegar o tamanho do arquivo, dividimos por 1024 para transformar em kb
        //Depois aplicamos o round() para pegar somente a parte inteira do número
        $tamanhoArquivo = round($_FILES['fle_imagem']['size']/1024);

        //Restrição de tamanho do arquivo
        if($tamanhoArquivo <= $tamanhoPermitido){

          $nomeCompletoArquivo = $_FILES['fle_imagem']['name'];

          //pathinfo() - permite pegar qualquer parte do nome de um arquivo
          //utilizando o parâmetro PATHINFO_FILENAME pegamos apenas o nome
          //utilizando o parâmetro PATHINFO_EXTENSION pegamos apenas a extensão
          $nomeArquivo = pathinfo($nomeCompletoArquivo, PATHINFO_FILENAME);
          $extensaoArquivo = pathinfo($nomeCompletoArquivo, PATHINFO_EXTENSION);

          /*
            Algoritmos de criptografia no PHP:
            -> MD5()
            -> sha1()
            -> hash(tipo do algoritmo ,var) - possibilita mais possibilidades de algoritmo

            Para gerar o nome do arquivo que nunca se repita, usamos:
            -> uniqid() - que gera um valor aleatório com base em informações de sistema e número aleatório
            -> time() - retorna hh:mm:ss da máquina
            -> md5() - utilizado para embaralhar os dados
          */

          $nomeCrypt = md5(uniqid(time()).$nomeArquivo);
          $nomeFoto = $nomeCrypt.".".$extensaoArquivo;
          $arquivoTemp = $_FILES['fle_imagem']['tmp_name'];

          //Encaminha a imagem para a pasta de destino
          //recebendo o caminho de origem, e o de destino concatenado com o novo nome
          if(move_uploaded_file($arquivoTemp, $diretorio.$nomeFoto)){
             
             if(!isset($_SESSION)){
                session_start();
              }
            
             $_SESSION['nomeFoto'] = $nomeFoto;
            
            }else{
              echo('<script>

                    alert("Erro ao enviar o arquivo para o servidor.");

                  </script>');
            }

    }else{

        echo('<script>

              alert("O arquivo está vazio e não pode ser salvo.");

            </script>');

      }


      }else{

        echo('<script>

              alert("O tipo de arquivo selecionado possui tamanho superior ao limite de 1Mb");

            </script>');

      }

    }else{
      echo('<script>

            alert("O tipo de arquivo selecionado não é permitida");

          </script>');
    }

  }else{
      echo('<script>

            alert("Não é possível fazer o upload de um tipo de arquivo vazio");

          </script>');
    }
    
  }
}

?>