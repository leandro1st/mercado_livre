<?php

require('../externo/connect.php');

$pesquisar_ultimo_id_kit = mysqli_query($connect, "SELECT * FROM $kits ORDER BY id_kit DESC LIMIT 1");
$vetor_ultimo_id = mysqli_fetch_array($pesquisar_ultimo_id_kit);
$ultimo_id = $vetor_ultimo_id['id_kit'];
$proximo_id = $ultimo_id + 1;

$nome_kit = trim($_POST['nome_kit']);
$numero_produtos = $_POST['total'];
for ($i = 1; $i <= $numero_produtos; $i++) {
    $cod_athos_produto = $_POST['cod_athos_' . $i];
    $nome_produto = mb_convert_case(trim($_POST['produto_' . $i]), MB_CASE_UPPER, 'utf-8');
    $quantidade_produto = $_POST['quantidade_' . $i];

    $preco_produto = $_POST['preco_' . $i];
    $preco2 = str_replace('R$ ', '', $preco_produto);
    $preco3 = str_replace('.', '', $preco2);
    $preco_final = str_replace(',', '.', $preco3);

    $preco_total_produto = (int)$quantidade_produto * (float)$preco_final;
    $ncm_produto = $_POST['ncm_' . $i];
    $cest_produto = $_POST['cest_' . $i];

    $cadastrar = mysqli_query($connect, "INSERT INTO $kits($cod_athos, $nome, $quantidade, $preco, $preco_total, $ncm, $cest, $kit_nome, $id_kit) VALUES ('$cod_athos_produto', '$nome_produto', '$quantidade_produto', '$preco_final', '$preco_total_produto', '$ncm_produto', '$cest_produto', '$nome_kit', '$proximo_id')");
} 
if ($numero_produtos == 1) { ?>
<script>
    alert("Produto cadastrado com sucesso!");
    window.history.go(-1);
</script>
<?php } else { ?>
<script>
    alert("Produtos cadastrados com sucesso!");
    window.history.go(-1);
</script>
<?php } ?>