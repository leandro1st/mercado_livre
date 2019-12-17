<?php
require('../externo/connect.php');

$input_id_kit = $_POST['input_id_kit'];
// $quantidade = $_POST['input_quantidade'];
$pesquisar = mysqli_query($connect, "SELECT $kit_nome FROM $kits WHERE $id_kit = '$input_id_kit'");
$vetor = mysqli_fetch_array($pesquisar);
$nome = $vetor['kit_nome'];
$excluir = mysqli_query($connect, "DELETE FROM $kits WHERE $id_kit = '$input_id_kit'");
if ($excluir) {
    echo $nome . " foi excluído com sucesso!";
}

?>