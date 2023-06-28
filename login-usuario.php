<?php

   //Incluindo a conexão com banco de dados   
   include("inc/conn.php"); 

     
      if(isset($_POST['usuario']) || isset($_POST['senha'])){


        if(strlen($_POST['usuario']) == 0) {
            echo "Preencha o seu usuario";
        }else if (strlen($_POST['senha']) == 0) {
                echo "Preencha a sua senha";
        } else {

            $usuario = $conn->real_escape_string($_POST['usuario']);
            $senha = $conn->real_escape_string($_POST['senha']);
            $senha = md5($senha);

            $sql = "SELECT * FROM  login_usuario WHERE usuario = '$usuario' AND senha = '$senha' ";
            $sql_query = $conn->query($sql) or die($sql);
        }
      }

    //   die($sql);
      $qtd = $sql_query->num_rows;
    
      if ($qtd!=0) {
        $usuario= $sql_query->fetch_assoc();
       
        if(session_status()!= 2){
            session_start();
        }

        $_SESSION['usuario']=$usuario['usuario'];
        $_SESSION['perfil']=$usuario['perfil'];
        $_SESSION['nome']=$usuario['nome_completo'];
        $_SESSION['id']=$usuario['id'];
        

        if ($_SESSION['perfil'] != 0) {

          // SQL para mudar o status de todos os visitantes que não saíram da biblioteca após 24 horas

$datahoje = date('d-m-Y', time()) . " 00:00";
$timestamphoje = strtotime($datahoje);

// $sql_mudar_status_visitante = "SELECT * FROM tabela_horario WHERE stats = 1";
// $result4 = mysqli_query($conn, $sql_mudar_status_visitante);

// while ($row4 = mysqli_fetch_assoc($result4)) {
//     $id_visitante = $row4['id_visitante'];
//     $data_entrada = $row4['data_entrada'];
    
   
    // if ($data_entrada < $timestamphoje) {
        $sql_update_stats = "UPDATE tabela_horario SET stats = 0, data_saida ='" . $timestamphoje . "' WHERE stats = 1 and data_entrada<'".$timestamphoje."'"; 
        mysqli_query($conn, $sql_update_stats);
        // if (mysqli_query($conn, $sql_update_stats)) {
        //     echo "Cliente $id_visitante registrado como saído.";
        // } else {
        //     echo "Erro ao registrar saída do cliente $id_visitante";
        // }
    // }
// }
          
        header("Location: menu.php");
      }else {
        echo "<script>alert('Permissão Revogada. Tente novamente.')
    ;location.href='index.php'</script>";

    session_destroy();
      }

      }else {
        echo "<script>alert('Usuário ou senha incorretos. Tente novamente.')
    ;location.href='index.php'</script>";
      }
?>  

















































<?php     
    //     //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    //     $result_usuario = "SELECT * FROM login_usuario WHERE usuario = '$usuario' && senha = '$senha' LIMIT 1";
    //     $resultado_usuario = mysqli_query($conn, $result_usuario);
    //     $resultado = mysqli_fetch_assoc($resultado_usuario);
        
    //     //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    //     if(isset($resultado)){
    //         header("Location: cadastro.php");
            
    //     //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    //     //redireciona o usuario para a página de login
    //     }else{    
    //         //Váriavel global recebendo a mensagem de erro
    //         $_SESSION['loginErro'] = "Usuário ou senha Inválido";
    //         header("Location: index.php");
    //     }
    // //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
    // }else{
    //     $_SESSION['loginErro'] = "Usuário ou senha inválido";
    //     header("Location: index.php");
    // }

?>