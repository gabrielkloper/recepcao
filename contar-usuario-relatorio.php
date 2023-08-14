<?php 

include("inc/conn.php");

// SQL query to display row count
// in building table


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



