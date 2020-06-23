<?php
require('../externo/connect.php');

$id_produto = $_POST['id_produto_modal'];

$pesquisar = mysqli_query($connect, "SELECT $nome, $kit_nome, $id_kit FROM $kits WHERE $id = '$id_produto'");
$vetor = mysqli_fetch_array($pesquisar);
$nome_produto = $vetor['nome'];
$nome_kit = $vetor['kit_nome'];
$codigo_kit = $vetor['id_kit'];

$excluir = mysqli_query($connect, "DELETE FROM $kits WHERE $id = '$id_produto'");
if ($excluir) {
    echo "<b>" . $nome_produto . "</b> foi excluído do <b>" . $nome_kit . "</b> <small>(#" . $codigo_kit . ")</small> com sucesso!";
}

?>