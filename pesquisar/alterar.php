<?php 

require('../externo/connect.php');

$id_prod = $_POST['id_produto'];
$qntd = $_POST['quantidade'];
$preco_novo = $_POST['preco_novo'];
$preco2 = str_replace('R$ ', '', $preco_novo);
$preco3 = str_replace('.', '', $preco2);
$preco_final = str_replace(',', '.', $preco3);

$preco_total_produto = (int) $qntd * (float) $preco_final;

$alterar = mysqli_query($connect, "UPDATE $kits SET $preco = '$preco_final', $preco_total = '$preco_total_produto' WHERE $id = '$id_prod'");

?>