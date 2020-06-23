<?php

require('../externo/connect.php');

$ultimo_produto = $_POST['total'];
$cod_athos_produto = $_POST['cod_athos_' . $ultimo_produto];

$pesquisa_produto = mysqli_query($connect, "SELECT * FROM $produtos WHERE $cod_athos = '$cod_athos_produto'");
$vetor_produto = mysqli_fetch_array($pesquisa_produto);

// data
echo $vetor_produto[1] . "|" . $vetor_produto[2] . "|" . $vetor_produto[3] . "|" . $vetor_produto[4] . "|" . $vetor_produto[5] . "|" . $vetor_produto[6];

?>