<?php 

require('../externo/connect.php');

$id_do_kit = $_POST['id_kit'];
$nome_kit_novo = mb_convert_case(trim($_POST['nome_kit_novo']), MB_CASE_UPPER, 'utf-8');

$alterar = mysqli_query($connect, "UPDATE $kits SET $kit_nome = '$nome_kit_novo' WHERE $id_kit = '$id_do_kit'");

?>