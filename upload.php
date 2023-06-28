<?php

// new filename
$filename = 'pic_'.time() . '.jpeg';

$url = '';
if( move_uploaded_file($_FILES['webcam']['tmp_name'],'upload/'.$filename) ){
   $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
}

// Return image url
echo $url;
?>

<?php
// include("inc/conn.php");

// for ($i=1; $i < 111; $i++) { 
   
//    $sql = "INSERT INTO tabela_chave (chave) VALUES ('{$i}')";
    
//         $res = $conn->query($sql);
// }

?>