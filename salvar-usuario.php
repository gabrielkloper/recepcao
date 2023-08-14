<?php
include("inc/conn.php");
include("inc/validar-sessao.php");


function limpar_dados($valor)
{
    $valor = trim($valor);
    $valor = str_replace(array('.', '(', ')', '-', '/', " "), "", $valor);
    return $valor;
}



switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $nome = $conn->real_escape_string($_POST["nome"]);
        $cpf = $conn->real_escape_string($_POST["cpf"]);
        $usuario = $conn->real_escape_string($_POST["usuario"]);
        $senha = md5(htmlentities($_POST["senha"]));

        $sql = "INSERT INTO login_usuario (nome_completo, cpf, usuario, senha, perfil) VALUES ('{$nome}','{$cpf}','{$usuario}','{$senha}', 2)";
        try {
            $res = $conn->query($sql);
            } catch (Exception $e){
                if($e->getCode() ==1062){ 
                    echo "<script>alert('Nome de usuário ou CPF já cadastrado! Tente novamente');location.href='cadastro.php';</script>";
            }
        }
        if ($res === true) {

            echo "<script>alert('Cadastro realizado com sucesso!')
            ;location.href='menu.php';</script>";
        } else {

            echo "<script>alert('Não foi possível realizar o seu cadastro');location.href='menu.php';</script>";
        }
        break;

    case 'cadastrar_visitante':
        $nome_visitante = $conn->real_escape_string($_POST["nome-visitante"]);
        $nome_social = $conn->real_escape_string($_POST["nome-social"]);
        $cpf = $conn->real_escape_string($_POST["cpf"]);
        $rg = $conn->real_escape_string($_POST["rg"]);
        $telefone = $conn->real_escape_string($_POST["telefone"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $cep = $conn->real_escape_string($_POST["cep"]);
        $rua = $conn->real_escape_string($_POST["rua"]);
        $cidade = $conn->real_escape_string($_POST["cidade"]);
        $bairro = $conn->real_escape_string($_POST["bairro"]);
        $numero = $conn->real_escape_string($_POST["numero"]);
        $uf = $conn->real_escape_string($_POST["uf"]);
        $sexo = $conn->real_escape_string($_POST["sexo"]);
        $data_nascimento = $conn->real_escape_string($_POST["nascimento"]);
        $nome_responsavel = $conn->real_escape_string($_POST["nome-responsavel"]);
        $cpf_responsavel = $conn->real_escape_string($_POST["cpf-responsavel"]);
        $nome_responsavel2 = $conn->real_escape_string($_POST["nome-responsavel2"]);
        $cpf_responsavel2 = $conn->real_escape_string($_POST["cpf-responsavel2"]);
        $foto = $conn->real_escape_string($_POST["txtfoto"]);
        $data_cadastro = time();

        

        
        $telefone = limpar_dados($telefone);
        $cpf = limpar_dados($cpf);
        $cpf_responsavel = limpar_dados($cpf_responsavel);
        $cpf_responsavel2 = limpar_dados($cpf_responsavel2);

        $sql = "INSERT INTO tabela_visitante (nome_visitante, nome_social, cpf, rg, email, telefone, sexo, data_nascimento, cep, rua, cidade, bairro, numero, uf, nome_responsavel, cpf_responsavel, nome_responsavel2, cpf_responsavel2, data_cadastro, foto) VALUES ('{$nome_visitante}','{$nome_social}','{$cpf}', '{$rg}','{$email}','{$telefone}', '{$sexo}', '{$data_nascimento}','{$cep}','{$rua}', '{$cidade}', '{$bairro}', '{$numero}', '{$uf}', '{$nome_responsavel}','{$cpf_responsavel}', '{$nome_responsavel2}','{$cpf_responsavel2}', '{$data_cadastro}','{$foto}')";
    
        try {
        $res = $conn->query($sql);
        } catch (Exception $e){
            if($e->getCode() ==1062){ 
                echo "<script>alert('Pessoa já cadastrada! Não foi possível realizar o seu cadastro');location.href='menu.php';</script>";
        }
    }
//die($sql);
        if ($res === true) {

            echo "<script>alert('Cadastro realizado com sucesso!');location.href='menu.php';</script>";
        } else {

            echo "<script>alert('Não foi possível realizar o seu cadastro');location.href='menu.php';</script>";
        }
        break;


    case 'alterar-senha':


        $usuario = $_SESSION["usuario"];

        $nova_senha = md5(htmlentities($_POST["alterar-senha"]));

        $sql_nova_senha = "UPDATE login_usuario SET
                        senha ='{$nova_senha}'
                    WHERE usuario='{$usuario}'";

        $res = $conn->query($sql_nova_senha);
        // die($sql_nova_senha);

        if ($res === true) {

            echo "<script>alert('Editado com sucesso!');location.href='menu.php';</script>";
        } else {

            echo "<script>alert('Não foi possível realizar o edição.');</script>";
        }

        break;


    case '2':



        $sql_excluir = "UPDATE login_usuario SET perfil = 0 WHERE id=" . $_GET["id"];

        $res = $conn->query($sql_excluir);
        // $sql = "DELETE FROM tabela_visitante WHERE id=" . $_POST["id"];

        // $res = $conn->query($sql);

        if ($res === true) {
            echo "<script>alert('Cliente excluido com sucesso!');location.href='buscar-usuario.php';</script>";
            
        } else {
            echo "<script>alert('Não foi possível realizar a exclusão!');location.href='menu.php';</script>";
        }
        break;
}

?>