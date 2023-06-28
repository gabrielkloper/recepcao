<?php 

include("inc/conn.php");

// SQL query to display row count
// in building table


 //Total de cadastros
 $sql_total_cadastrados = "SELECT * from tabela_visitante";
 if ($result_total_c = mysqli_query($conn, $sql_total_cadastrados)) {
     $rowcount_cadastros_total = mysqli_num_rows($result_total_c);
 }

 //Total de Visitantes
 $sql_total_visitas = "SELECT * FROM tabela_horario";
 if ($result_total_v = mysqli_query($conn, $sql_total_visitas)) {
     $rowcount_visitas_total = mysqli_num_rows($result_total_v);
 }

 // Total de visitantes masculinos cadastrados no mês
 $sql_total_homens_cadastrados = "SELECT * from tabela_visitante WHERE sexo ='masculino'";
 if ($result_total_h_c = mysqli_query($conn, $sql_total_homens_cadastrados)) {
     $rowcount_total_h_c = mysqli_num_rows($result_total_h_c);
 }


 // Total de visitantes femininos cadastrados no mês
 $sql_total_mulheres_cadastradas = "SELECT * from tabela_visitante WHERE sexo ='feminino'";
 if ($result_total_m_c = mysqli_query($conn, $sql_total_mulheres_cadastradas)) {
     $rowcount_total_m_c = mysqli_num_rows($result_total_m_c);
 }


//SQL para listar os visitantes masculinos que visitaram a biblioteca
$sql_visitas_homens_total = "SELECT
tabela_visitante.sexo,
tabela_visitante.id,
tabela_horario.data_entrada,
tabela_horario.data_saida
FROM
tabela_visitante
INNER JOIN
tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante
WHERE
tabela_visitante.sexo = 'masculino'";

if ($result_visita_h_t = mysqli_query($conn, $sql_visitas_homens_total)) {
    $rowcount_result_visita_h_t = mysqli_num_rows($result_visita_h_t);
}

//SQL para listar os visitantes mulheres que visitaram a biblioteca
$sql_visitas_mulheres_total = "SELECT
tabela_visitante.sexo,
tabela_visitante.id,
tabela_horario.data_entrada,
tabela_horario.data_saida
FROM
tabela_visitante
INNER JOIN
tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante
WHERE
tabela_visitante.sexo = 'feminino'";

if ($result_visita_m_t = mysqli_query($conn, $sql_visitas_mulheres_total)) {
    $rowcount_result_visita_m_t = mysqli_num_rows($result_visita_m_t);
}






//SQL para listar os visitantes que estão dentro da biblioteca
$sql_visitantes_dentro = "SELECT
tabela_visitante.nome_visitante,
tabela_visitante.nome_social,
tabela_visitante.id,
tabela_visitante.data_cadastro,
tabela_horario.data_entrada,
tabela_horario.data_saida
FROM
tabela_visitante
INNER JOIN
tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante
WHERE
tabela_horario.stats = 1";

if ($result3 = mysqli_query($conn, $sql_visitantes_dentro)) {
    $rowcount3 = mysqli_num_rows($result3);
}














//  #### MÊS JANEIRO ####

// $sql_total_cadastrados_janeiro = "SELECT * from tabela_visitante WHERE data_cadastro < 1675220399";
// if ($result6 = mysqli_query($conn, $sql_total_cadastrados_janeiro)) {

//     // Return the number of rows in result set
//     $rowcount6 = mysqli_num_rows($result6);
// }

// $sql_total_visitas_janeiro = "SELECT * FROM tabela_horario WHERE data_saida < 1675220399";
// if ($result7 = mysqli_query($conn, $sql_total_visitas_janeiro)) {
//     $rowcount7 = mysqli_num_rows($result7);
// }


// //SQL para listar os visitantes do sexo masculino janeiro
// $sql_cadastrados_masculinos_janeiro = "SELECT * from tabela_visitante WHERE sexo = 'masculino' AND data_cadastro < 1675220399";
// if ($result8 = mysqli_query($conn, $sql_cadastrados_masculinos_janeiro)) {
//     $rowcount8 = mysqli_num_rows($result8);
// }

// //SQL para listar os visitantes do sexo feminino total
// $sql_cadastrados_femininos_janeiro = "SELECT * from tabela_visitante WHERE sexo = 'feminino' AND data_cadastro < 1675220399";
// if ($result9 = mysqli_query($conn, $sql_cadastrados_femininos_janeiro)) {
//     $rowcount9 = mysqli_num_rows($result9);
// }



// //SQL para listar os visitantes femininos que visitaram a biblioteca em janeiro
// $sql_visitas_masculinas_janeiro = "SELECT
// tabela_visitante.sexo,
// tabela_visitante.id,
// tabela_horario.data_entrada,
// tabela_horario.data_saida
// FROM
// tabela_visitante
// INNER JOIN
// tabela_horario ON tabela_visitante.id = tabela_horario.id_visitante
// WHERE
// tabela_visitante.sexo = 'feminino' AND data_saida < 1675220399";

// if ($result11 = mysqli_query($conn, $sql_total_visitas_janeiro)) {
//     $rowcount11 = mysqli_num_rows($result11);
// }

// #### MÊS FEVEREIRO #### MUITA REPETIÇÃOA 

// $sql_total_cadastrados_fevereiro = "SELECT * from tabela_visitante WHERE data_cadastro > 1675220399 AND data_cadastro < 1675220400";
// if ($result12 = mysqli_query($conn, $sql_total_cadastrados_fevereiro)) {

//     // Return the number of rows in result set
//     $rowcount12 = mysqli_num_rows($result12);
// }

// $sql_total_visitas_fevereiro = "SELECT * FROM tabela_horario WHERE data_saida > 1675220399 AND data_saida < 1675220400";
// if ($result13 = mysqli_query($conn, $sql_total_visitas_fevereiro)) {
//     $rowcount13 = mysqli_num_rows($result13);
// }


// //SQL para listar os visitantes do sexo masculino fevereiro
// $sql_cadastrados_masculinos_fevereiro = "SELECT * from tabela_visitante WHERE sexo = 'masculino' AND data_cadastro > 1675220399 AND data_cadastro < 1675220400";
// if ($result14 = mysqli_query($conn, $sql_cadastrados_masculinos_fevereiro)) {
//     $rowcount14 = mysqli_num_rows($result14);
// }

// //SQL para listar os visitantes do sexo feminino fevereiro
// $sql_cadastrados_femininos_fevereiro = "SELECT * from tabela_visitante WHERE sexo = 'feminino' AND data_cadastro > 1675220399 AND data_cadastro < 1675220400";
// if ($result15 = mysqli_query($conn, $sql_cadastrados_femininos_fevereiro)) {
//     $rowcount15 = mysqli_num_rows($result15);
// }




























function telefone($n)
{
    $tam = strlen(preg_replace("/[^0-9]/", "", $n));
    
    if ($tam == 13) {
        // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
        return "+".substr($n, 0, $tam-11)." (".substr($n, $tam-11, 2).") ".substr($n, $tam-9, 5)."-".substr($n, -4);
    }
    if ($tam == 12) {
        // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
        return "+".substr($n, 0, $tam-10)." (".substr($n, $tam-10, 2).") ".substr($n, $tam-8, 4)."-".substr($n, -4);
    }
    if ($tam == 11) {
        // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
        return " (".substr($n, 0, 2).") ".substr($n, 2, 5)."-".substr($n, 7, 11);
    }
    if ($tam == 10) {
        // COM CÓDIGO DE ÁREA NACIONAL
        return " (".substr($n, 0, 2).") ".substr($n, 2, 4)."-".substr($n, 6, 10);
    }
    if ($tam <= 9) {
        // SEM CÓDIGO DE ÁREA
        return substr($n, 0, $tam-4)."-".substr($n, -4);
    }
}

?>
