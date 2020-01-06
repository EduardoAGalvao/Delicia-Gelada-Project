<?php

//Arquivo para salvar um usuário no Controle de Usuários
//sendo para cadastro ou edição

//Permite configurar os padrões de regionalidade
setLocale(LC_ALL, 'pt-br');
  
//Declaração das variáveis
$txtNome = (string) null;
$txtCpf = (string) null;
$txtCelular = (string) null;
$txtEmail = (string) null;
$rdoPerfil = (string) null;
$sltPerfil = (string) null;
$txtNomePerfil = (string) null;
$txtUsername = (string) null;
$txtSenha = (string) null;

//Importa o arquivo de conexão com BD
require_once('conexao.php');

//Abre a conexão com BD
$conexao = conexaoMysql();

//Validando preenchimento de itens obrigatórios

$txtNome = $_POST['txt_nome'];
$txtCpf = $_POST['txt_cpf'];
$txtCelular = $_POST['txt_celular'];
$txtEmail = $_POST['txt_email'];
$rdoPerfil = $_POST['rdo_perfil'];
$sltPerfil = $_POST['slt_perfil'];
$txtNomePerfil = $_POST['txt_nome_perfil'];
$txtUsername = $_POST['txt_username'];
$txtSenha = $_POST['txt_senha']; 
$dataInsercao = date("Y-m-d");
$ativado = '0';
$perfilAtivado = '1';
$idPerfilUsuario = null;

if($rdoPerfil == 'novo'){
  //Criação de um novo perfil
  $sqlPerfil = "INSERT INTO tbl_perfil(nome_perfil, ativado, data_insercao, data_remocao) VALUES('" .$txtNomePerfil. "','" .$perfilAtivado. "', '".$dataInsercao."', null);";

  if(mysqli_query($conexao,$sqlPerfil)){
    
    //Coleta o último ID criado
    $idPerfilUsuario = mysqli_insert_id($conexao);

    //Criação de relação na tabela tbl_acesso_setor_perfil;
    $sqlSetores = "SELECT COUNT(id_setor_cms) as num_setor FROM tbl_setor";

    $selectSetores = mysqli_query($conexao, $sqlSetores);

    $num = mysqli_fetch_array($selectSetores);

    $contNum = $num['num_setor'];

    // INICIA UM CONTADOR EM 0
    $cont = 0;
    
    // ENQUANTO O CONTADOR FOR MENOR QUE O NUMERO DE DADOS NA TABELA
    while($cont < $contNum){
        // VERIFICA SE FOI CHECKADO O CHECKBOX
        if(isset($_POST['chk' . $cont])){
            // RESGATA O NAME DO CHECKBOX SELECIONADO
            $id_setor_cms = $_POST['chk' . $cont];
            // QUERY DE INSERÇÃO NA TABELA
            $insert = "INSERT INTO tbl_acesso_setor_perfil(id_perfil, id_setor_cms) VALUES (" .$idPerfilUsuario. ", " .$id_setor_cms. ")";
            // VERIFICA SE HOUVE SUCESSO NA EXECUÇÃO DA QUERY
            if(!mysqli_query($conexao, $insert)){
              echo('erro ao salvar a relação de setor e perfil');
              echo $insert;
            }
        }

        $cont++;
    }

  }

//Caso não haja um perfil novo, o usuário deve selecionar um existente
}else{

  $idPerfilUsuario = $sltPerfil;

}

//Validação para receber dados do form via POST
if(isset($_POST['btnCadastrar']) && $_POST['btnCadastrar'] == 'CADASTRAR'){

  $sql = "INSERT INTO tbl_usuarios(nome, cpf, email, celular, username, password, ativado, data_insercao, id_perfil) 
        VALUES('" .$txtNome. "','" .$txtCpf. "',
              '" .$txtEmail. "','" .$txtCelular. "',
              '" .$txtUsername. "','" .$txtSenha. "',
              '" .$ativado."','" .$dataInsercao."',
              " .$idPerfilUsuario. ");";

}elseif(isset($_POST['btnCadastrar']) && $_POST['btnCadastrar'] == 'ATUALIZAR'){

  session_start();
  $idUsuario = $_SESSION['id'];

  $sql = "UPDATE tbl_usuarios SET 
    nome = '" .$txtNome. "',
    cpf = '" .$txtCpf. "',
    email = '" .$txtEmail. "',
    celular = '" .$txtCelular. "',
    username = '" .$txtUsername. "',
    id_perfil = '" .$idPerfilUsuario. "' WHERE id_usuario = " . $idUsuario;

}

//Executa um script no BD
if(mysqli_query($conexao,$sql)){
    //Permite  redirecionar para uma página
    echo("
        <script>
          alert('Usuário salvo com sucesso!');
          window.location.href='../cms/controle_usuarios.php';
        </script>
    ");
}else{
    echo("
        <script>
          alert('Problemas ao salvar informações, consulte o suporte!');
          window.location.href='../cms/controle_usuarios.php';
        </script>
      ");
}

?>