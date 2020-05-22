<?php 

require('../externo/connect.php');

$id_prod = trim($_POST['id_produto']);
$qntd = trim($_POST['quantidade']);
$preco_novo = $_POST['preco_novo'];
$preco2 = str_replace('R$ ', '', $preco_novo);
$preco3 = str_replace('.', '', $preco2);
$preco_final = str_replace(',', '.', $preco3);
$preco_total_produto = (int) $qntd * (float) $preco_final;

$athos_novo = trim($_POST['athos_novo']);
$nome_novo = mb_convert_case(trim($_POST['nome_novo']), MB_CASE_UPPER, 'utf-8');
$ncm_novo = mb_convert_case(trim($_POST['ncm_novo']), MB_CASE_UPPER, 'utf-8');
$csosn_novo = trim($_POST['csosn_novo']);
$cfop_novo = trim($_POST['cfop_novo']);
$cest_novo = trim($_POST['cest_novo']);

$alterar = mysqli_query($connect, "UPDATE $kits SET $quantidade = '$qntd', $preco = '$preco_final', $preco_total = '$preco_total_produto', $cod_athos = '$athos_novo', $nome = '$nome_novo', $ncm = '$ncm_novo', $csosn = '$csosn_novo', $cfop = '$cfop_novo', $cest = '$cest_novo' WHERE $id = '$id_prod'");

?>