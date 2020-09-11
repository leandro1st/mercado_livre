<?php

if (!isset($_POST['id_kit'])) {
    header("location:associar_produto.php");
} elseif (trim($_POST['id_kit'] == "") || trim($_POST['id_kit'] == null) || trim($_POST['cod_athos_1']) == "") {
    header("location:associar_produto.php");
} else {
    require('../externo/connect.php');

    // ID do kit
    $id_do_kit = $_POST['id_kit'];
    $pesquisar_nome_kit = mysqli_query($connect, "SELECT kit_nome FROM kits WHERE $id_kit = '$id_do_kit'");
    $vetor_nome_kit = mysqli_fetch_array($pesquisar_nome_kit);
    // Nome do kit
    $nome_kit = $vetor_nome_kit['kit_nome'];

    // Hora do cadastro
    date_default_timezone_set('America/Sao_Paulo');
    $agora = date("Y-m-d H:i:s");

    // Código athos
    $cod_athos_produto = $_POST['cod_athos_1'];
    // Nome do produto
    $nome_produto = mb_convert_case(trim($_POST['produto']), MB_CASE_UPPER, 'utf-8');
    // Quantidade
    $quantidade_produto = $_POST['quantidade'];
    // Preço do produto
    $preco_produto = $_POST['preco'];
    $preco2 = str_replace('R$ ', '', $preco_produto);
    $preco3 = str_replace('.', '', $preco2);
    $preco_final = str_replace(',', '.', $preco3);
    // Preço total do produto
    $preco_total_produto = $_POST['preco_total'];
    // NCM
    $ncm_produto = mb_convert_case(trim($_POST['ncm']), MB_CASE_UPPER, 'utf-8');
    // CSOSN
    $csosn_produto = $_POST['csosn'];
    // CFOP
    $cfop_produto = $_POST['cfop'];
    // CEST
    $cest_produto = $_POST['cest'];

    $associar = mysqli_query($connect, "INSERT INTO $kits($cod_athos, $nome, $quantidade, $preco, $preco_total, $ncm, $csosn, $cfop, $cest, $kit_nome, $id_kit, $hora_cadastro) VALUES ('$cod_athos_produto', '$nome_produto', '$quantidade_produto', '$preco_final', '$preco_total_produto', '$ncm_produto', '$csosn_produto', '$cfop_produto', '$cest_produto', '$nome_kit', '$id_do_kit', '$agora')");
?>

    <html lang="en">

    <head>
        <title>Mercado Livre | Associar Produto</title>
        <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../externo/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../externo/style.css">
        <script src="../externo/jquery/jquery-3.4.0.min.js"></script>
        <script src="../externo/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalAssociado').modal('show');
            });
        </script>
    </head>

    <body>
        <div class="modal fade" id="modalAssociado" tabindex="-1" role="dialog" aria-labelledby="modalAssociadoTitle" aria-hidden="true" onblur="window.location.replace('associar_produto.php')" onkeypress="window.location.replace('associar_produto.php')">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title lead asap_regular" id="modalTitle" style="font-size: 1.75em">
                            <span class="text-success" style="word-break: break-word"><b class="asap_bold"><?php echo $nome_produto . "</b></span> associado com sucesso!" ?>
                        </p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('associar_produto.php')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <h5 class="lead asap_regular" style="word-break: break-word"><b class="text-success asap_bold"><?php echo $nome_produto ?></b> associado ao <b class="text-success asap_bold"><?php echo $nome_kit ?> <small>(#<?php echo $id_do_kit ?>)</small></b> com sucesso!</h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success asap_regular" data-dismiss="modal" onclick="window.location.replace('associar_produto.php')">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>