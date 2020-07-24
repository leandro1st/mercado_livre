<?php 

require('../externo/connect.php');

$id_do_kit = $_POST['id_kit'];
$pesquisar = mysqli_query($connect, "SELECT * FROM kits WHERE $id_kit = '$id_do_kit'");
$numero_produtos = mysqli_num_rows($pesquisar);

// pesquisando ultimo id e incrementando 1
$pesquisar_ultimo_id_kit = mysqli_query($connect, "SELECT * FROM $kits ORDER BY id_kit DESC LIMIT 1");
$vetor_ultimo_id = mysqli_fetch_array($pesquisar_ultimo_id_kit);
$ultimo_id = $vetor_ultimo_id['id_kit'];
$proximo_id = $ultimo_id + 1;

$flag = False;
for ($i = 0; $i < $numero_produtos; $i++) { 
    // vetor do produto
    $vetor_produtos = mysqli_fetch_array($pesquisar);

    // agora
    date_default_timezone_set('America/Sao_Paulo');
    $agora = date("Y-m-d H:i:s");

    $cod_athos_produto = $vetor_produtos['cod_athos'];
    $nome_produto = $vetor_produtos['nome'];
    $quantidade_produto = $vetor_produtos['quantidade'];
    $preco_produto = $vetor_produtos['preco'];
    $preco_total_produto = (int) $quantidade_produto * (float) $preco_produto;
    $ncm_produto = $vetor_produtos['ncm'];
    $csosn_produto = $vetor_produtos['csosn'];
    $cfop_produto = $vetor_produtos['cfop'];
    $cest_produto = $vetor_produtos['cest'];
    $kit_nome_produto = $vetor_produtos['kit_nome'];

    $clonar = mysqli_query($connect, "INSERT INTO $kits($cod_athos, $nome, $quantidade, $preco, $preco_total, $ncm, $csosn, $cfop, $cest, $kit_nome, $id_kit, $hora_cadastro) VALUES ('$cod_athos_produto', '$nome_produto', '$quantidade_produto', '$preco_produto', '$preco_total_produto', '$ncm_produto', '$csosn_produto', '$cfop_produto', '$cest_produto', '$kit_nome_produto', '$proximo_id', '$agora')");

    if ($clonar) {
        $flag = True;
    } else {
        $flag = False;
    }
}
if ($flag) {
    echo "<span style='margin-bottom: 5px; display: block'><b>Código do kit clonado: </b>" . $proximo_id . "</span>";
    if ($numero_produtos == 1) {
        echo "<input type='hidden' class='form-control' id='kit' name='nome_do_kit' value='" . $proximo_id . "'><span><b class='text-success'>" . $numero_produtos . " produto</b> foi clonado com sucesso!</span>";
    } else {
        echo "<input type='hidden' class='form-control' id='kit' name='nome_do_kit' value='" . $proximo_id . "'><span><b class='text-success'>" . $numero_produtos . " produtos</b> foram clonados com sucesso!</span>";
    }
} else {
    echo "<span class='text-warning'><b>Nenhum produto foi clonado, pois não há produtos nesse kit!</span>";
}
?>