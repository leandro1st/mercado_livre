<?php 

require('../externo/connect.php');

$id_prod = trim($_POST['id_produto']);
$athos_novo = trim($_POST['athos_novo']);
$nome_novo = mb_convert_case(trim($_POST['nome_novo']), MB_CASE_UPPER, 'utf-8');
$ncm_novo = mb_convert_case(trim($_POST['ncm_novo']), MB_CASE_UPPER, 'utf-8');
$csosn_novo = trim($_POST['csosn_novo']);
$cfop_novo = trim($_POST['cfop_novo']);
$cest_novo = trim($_POST['cest_novo']);

$alterar = mysqli_query($connect, "UPDATE $kits SET $cod_athos = '$athos_novo', $nome = '$nome_novo', $ncm = '$ncm_novo', $csosn = '$csosn_novo', $cfop = '$cfop_novo', $cest = '$cest_novo' WHERE $cod_athos = '$athos_novo'");
// Checking number of rows affected by update
echo mysqli_affected_rows($connect);
?>