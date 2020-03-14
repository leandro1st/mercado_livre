<?php

if (!isset($_POST['nome_kit'])) {
    header("location:./");
} elseif (trim($_POST['nome_kit'] == "") || trim($_POST['nome_kit'] == null) || trim($_POST['cod_athos_1']) == "") {
    header("location:./");
} else {

require('../externo/connect.php');

    $pesquisar_ultimo_id_kit = mysqli_query($connect, "SELECT * FROM $kits ORDER BY id_kit DESC LIMIT 1");
    $vetor_ultimo_id = mysqli_fetch_array($pesquisar_ultimo_id_kit);
    $ultimo_id = $vetor_ultimo_id['id_kit'];
    $proximo_id = $ultimo_id + 1;

    date_default_timezone_set('America/Sao_Paulo');
    $agora = date("Y-m-d H:i:s");

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

        $preco_total_produto = (int) $quantidade_produto * (float) $preco_final;
        $ncm_produto = $_POST['ncm_' . $i];
        $cest_produto = $_POST['cest_' . $i];

        $cadastrar = mysqli_query($connect, "INSERT INTO $kits($cod_athos, $nome, $quantidade, $preco, $preco_total, $ncm, $cest, $kit_nome, $id_kit, $hora_cadastro) VALUES ('$cod_athos_produto', '$nome_produto', '$quantidade_produto', '$preco_final', '$preco_total_produto', '$ncm_produto', '$cest_produto', '$nome_kit', '$proximo_id', '$agora')");
    }  ?>

    <!-- alert("Produto cadastrado com sucesso!"); -->
    <!-- <script>
    window.history.go(-1);
</script> -->

    <html lang="en">

    <head>
        <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../externo/style.css">
        <script src="../jquery/jquery-3.4.0.min.js"></script>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modalCadastrado').modal('show');
            });
        </script>
    </head>

    <body>
        <div class="modal fade" id="modalCadastrado" tabindex="-1" role="dialog" aria-labelledby="modalCadastradoTitle" aria-hidden="true" onblur="window.location.replace('./')" onkeypress="window.location.replace('./')">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalTitle">
                            <font class="text-success"><?php echo $nome_kit . " cadastrado com sucesso!" ?></font>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.replace('./')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <?php if ($numero_produtos == 1) { ?>
                                <h5><?php echo $numero_produtos ?> produto cadastrado com sucesso!</h5>
                            <?php } else { ?>
                                <h5><?php echo $numero_produtos ?> produtos cadastrados com sucesso!</h5>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="window.location.replace('./')">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>