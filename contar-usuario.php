<?php 

include("inc/conn.php");

// SQL query to display row count
// in building table





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
