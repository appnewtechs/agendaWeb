<?php 
    require_once("../banco-cadastros.php");

    $id_empresa = $_POST["id_empresa"];
    $tipo_empresa = $_POST["tipo_empresa"];
    $prestador_servico = $_POST["prestador_servico"];
    $trabalho_prestado = $_POST["trabalho_prestado"];
    $cnpj = $_POST["cnpj"];
    $razao_social = $_POST["razao_social"];
    $nome_fantasia = $_POST["nome_fantasia"];
    $cpf = $_POST["cpf"];
    $rg = $_POST["rg"];
    $data_nascimento = $_POST["data_nascimento"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $cep = $_POST["cep"];
    $estado = $_POST["estado"];
    $municipio = $_POST["municipio"];
    $complemento = $_POST["complemento"];
    $observacao = $_POST["observacao"];
    $telefone_fixo = $_POST["telefone_fixo"];
    $telefone_celular = $_POST["telefone_celular"];
    $banco = $_POST["banco"];
    $agencia = $_POST["agencia"];
    $conta = $_POST["conta"];
    $descricao = $_POST["descricao"];
    $banco_2 = $_POST["banco_2"];
    $agencia_2 = $_POST["agencia_2"];
    $conta_2 = $_POST["conta_2"];
    $descricao_2 = $_POST["descricao_2"];
    $banco_3 = $_POST["banco_3"];
    $agencia_3 = $_POST["agencia_3"];
    $conta_3 = $_POST["conta_3"];
    $descricao_3 = $_POST["descricao_3"];
    $id_usuario = $_POST["id_usuario"];
    session_start();
    // if(buscaNomeFantasiaRazaoSocial($conexao,$cnpj,$nome_fantasia,$razao_social,$id_empresa)==null){
        if(alteraEmpresa($conexao,$id_empresa,$tipo_empresa,$prestador_servico,$trabalho_prestado,$cnpj,$razao_social,$nome_fantasia,$cpf,$endereco,$cep,$estado,$municipio,$complemento,$observacao,$telefone_fixo,$telefone_celular,$id_usuario,$banco,$agencia,$conta,$descricao,$banco_2,$agencia_2,$conta_2,$descricao_2,$banco_3,$agencia_3,$conta_3,$descricao_3,$rg,$data_nascimento,$email)){
            $_SESSION["sucesso"] = "Empresa atualizado com sucesso!";
            // var_dump($id_usuario);
            header("Location: empresa.php");
            die();
        }else{
            $_SESSION["danger"] = "Empresa não atualizado. Dados já utilizados por outra empresa verifique os campos de CNPJ, Razão Social e Nome Fantasia!";
            header("Location: empresa.php");
            die();
        }   
    // }else{
    //     $_SESSION["danger"] = "Empresa não atualizado. Razão Social ou Nome fantasia Já utilizado!";
    //     header("Location: empresa.php");
    //     die();      
    // }

?>