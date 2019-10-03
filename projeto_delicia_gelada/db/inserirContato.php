<?php

//Permite configurar os padrões de regionalidade
setLocale(LC_ALL, 'pt-br');
  
//Declaração das variáveis
$txtNome = (string) null;
$txtProfissao = (string) null;
$txtTelefone = (string) null;
$txtCelular = (string) null;
$txtEmail = (string) null;
$txtSexo = (string) null;
$txtHomePage = (string) null;
$txtFacebook = (string) null;
$txtMotivoContato = (string) null;
$txtMensagem = (string) null;

//Validação para receber dados do form via POST
if(isset($_POST['btnEnviar'])){

//Importa o arquivo de conexão com BD
require_once('conexao.php');

//Abre a conexão com BD
$conexao = conexaoMysql();

$txtNome = $_POST['txt_nome'];
$txtProfissao = $_POST['txt_profissao'];
$txtSexo = $_POST['rdo_sexo'];
$txtTelefone = $_POST['txt_telefone'];  
$txtCelular = $_POST['txt_celular'];
$txtEmail = $_POST['txt_email'];
$txtHomePage = $_POST['txt_homepage'];
$txtFacebook = $_POST['txt_facebook'];
$txtMotivoContato = $_POST['slt_mensagem'];
$txtMensagem = addslashes($_POST['txt_mensagem']);

    //Validando preenchimento de itens obrigatórios
    if(trim($txtNome) != "" && trim($txtProfissao) != "" && trim($txtSexo) != "" && trim($txtCelular) != "" && trim($txtEmail) != "" && trim($txtMotivoContato) != "" && $txtMensagem != ""){

        $sql = "INSERT INTO tbl_contato(nome, profissao, email, sexo, telefone, celular, home_page, facebook, motivo_contato, mensagem) 
        VALUES('" .$txtNome. "','" .$txtProfissao. "',
              '" .$txtEmail. "','" .$txtSexo. "',
              '" .$txtTelefone. "','" .$txtCelular. "',
              '" .$txtHomePage."','" .$txtFacebook."',
              '" .$txtMotivoContato."','" .$txtMensagem."');";  

        //Executa um script no BD
        if(mysqli_query($conexao,$sql)){
            //Permite  redirecionar para uma página
            echo("
                <script>
                  alert('Sua mensagem foi enviada com sucesso!');
                  window.location.href='../contato.php';
                </script>
            ");
        }else{
            echo("Erro: Problema na execução do script no BD");
	    echo $sql;
        }

    }

}

?>