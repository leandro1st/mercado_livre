<?php
require('../externo/connect.php');
$pesquisar = mysqli_query($connect, "SELECT * FROM $kits");
$pesquisar2 = mysqli_query($connect, "SELECT COUNT(*) c, $id_kit, $kit_nome FROM $kits GROUP BY $id_kit HAVING c >= 1");
$num_kits = mysqli_num_rows($pesquisar2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | Excluir Kits</title>
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <script src="../jquery/jquery-3.4.0.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function obter_dados(id_kit, nome_kit, quantidade) {
            document.getElementById('input_id_kit').value = id_kit;
            document.getElementById('input_quantidade').value = quantidade;
            document.getElementById('nome').innerHTML = nome_kit;
            document.getElementById('codigo').innerHTML = id_kit;
            document.getElementById('quantidade').innerHTML = quantidade;
        }
        function excluir(id_kit) {
            $.ajax({
                method: 'POST',
                url: 'excluir.php',
                data: $('#form_excluir').serialize(),
                success: function(data) {
                    $('#card-' + id_kit).fadeOut(500, function() {
                        $('#card-' + id_kit).remove();
                    });
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }
    </script>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../">
            <img src="../imagens/logo.png" alt="logo" width="35px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item px-1">
                    <a class="nav-link" href="../"><i class="fas fa-home" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../cadastrar/"><i class="fas fa-edit" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 active underline">
                    <a class="nav-link" href="#"><i class="fas fa-trash" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0" method="POST" action="#">
                <input class="form-control mr-sm-2" name="nome_produto" placeholder="Nome do kit" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form> -->
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 1;">
        <ol class="breadcrumb" style="background: none; margin: 0;">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item active"><a href="#" class="none_li"><i class="fas fa-trash"></i> Excluir Kit</a></li>
        </ol>
    </nav>
    <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center; padding: 100px; border-radius: 0">
        <center>
            <h1 style="color: white">Excluir Kits</h1>
        </center>
    </header>
    <main class="container">
        <div class="accordion" id="accordionKits">
            <?php
            for ($i = 0; $i < $num_kits; $i++) {
                $vetor2 = mysqli_fetch_assoc($pesquisar2);
                $id_do_kit = $vetor2['id_kit'];
                $pesquisar_repetido = mysqli_query($connect, "SELECT * FROM $kits WHERE $id_kit = $id_do_kit");
                $numero_repetido = mysqli_num_rows($pesquisar_repetido);
                // echo $numero_repetido;
                // echo $vetor['kit_nome'] . '<br>';
                // echo $vetor['nome'] . '<br>';
                // echo $vetor['preco'] . '<br>';
            ?>
                <div class="card" id="card-<?php echo $id_do_kit ?>">
                    <?php if ($i == 0) { ?>
                        <div class="card-header" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer">
                            <h5 class="accordion-toggle" style="margin: 0px; display: inline; cursor: pointer">
                                <?php echo $vetor2['kit_nome'] . " <b><span style='font-size: 14px'>(#" . $vetor2['id_kit'] . ")</span></b>" ?>
                            </h5>
                        </div>
                        <div id="collapse_<?php echo $i ?>" class="collapse show" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                        <?php } else { ?>
                            <div class="card-header collapsed" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer">
                                <h5 class="accordion-toggle" style="margin: 0px; display: inline; cursor: pointer">
                                    <?php echo $vetor2['kit_nome'] . " <b><span style='font-size: 14px'>(#" . $vetor2['id_kit'] . ")</span></b>" ?>
                                </h5>
                            </div>
                            <div id="collapse_<?php echo $i ?>" class="collapse" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                            <?php } ?>
                            <div class="card-body" style="padding: 10px 40px 10px 40px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" width="8%">#</th>
                                            <th scope="col" width="35%">Nome do produto</th>
                                            <th scope="col" width="2%">Quantidade</th>
                                            <th scope="col" width="13,75%">Preço</th>
                                            <th scope="col" width="13,75%">Preço Total</th>
                                            <th scope="col" width="13,75%">NCM</th>
                                            <th scope="col" width="13,75%">CEST</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $preco_total_kit = 0;
                                            for ($j = 0; $j < $numero_repetido; $j++) {
                                                $vetor = mysqli_fetch_assoc($pesquisar);
                                                $preco_total_kit = $preco_total_kit + $vetor['preco_total'];
                                        ?>
                                            <tr class="text-center">
                                                <td><?php echo $vetor['cod_athos'] ?></td>
                                                <td style="max-width: 400px; word-wrap: break-word;"><?php echo $vetor['nome'] ?></td>
                                                <td><?php echo $vetor['quantidade'] ?></td>
                                                <td>R$ <?php echo number_format($vetor['preco'], 2, ',', '') ?></td>
                                                <td>R$ <?php echo number_format($vetor['preco_total'], 2, ',', '') ?></td>
                                                <td><?php echo $vetor['ncm'] ?></td>
                                                <td><?php echo $vetor['cest'] ?></td>
                                            </tr>
                                            <?php if ($j == $numero_repetido - 1) { ?>
                                                <tr class="text-center">
                                                    <td colspan="7" style="border-top-color: #5cb85c; border-top-width: 2px;">
                                                        <font style="font-size: 24px" class="lead font-weight-bold">R$ <?php echo number_format($preco_total_kit, 2, ',', '') ?></font>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir" style="float: right;" onclick="obter_dados('<?php echo $id_do_kit ?>', '<?php echo $vetor2['kit_nome'] ?>' ,'<?php echo $numero_repetido ?>')">
                                                            Excluir <i class="fas fa-trash" style="color: white;"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
    </main><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">
                        <font color="#D9534F">Deseja realmente excluir?</font>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_excluir" name="form_excluir" method="POST">
                        <input type="hidden" id="input_id_kit" class="form-control" name="input_id_kit" value="<?php echo $id_do_kit ?>" readonly>
                        <input type="hidden" id="input_quantidade" class="form-control" name="input_quantidade" value="<?php echo $numero_repetido ?>" readonly>
                    </form>
                    <div class="container">
                        <span class="font-weight-bold" style="font-size: 18px">Nome do kit: </span>
                        <nome id="nome" class="lead" style="overflow-wrap: break-word;"></nome><br>
                        <span class="font-weight-bold" style="font-size: 18px">Id do kit: </span>
                        <codigo id="codigo" class="lead"></codigo><br>
                        <span class="font-weight-bold" style="font-size: 18px">Quantidade de produtos: </span>
                        <quantidade id="quantidade" class="lead"></quantidade><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" onclick="excluir(document.getElementById('input_id_kit').value)" data-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <!-- Footer Elements -->
        <div style="background-color: #3e4551; padding: 16px">
            <center>
                <div class="row" style="display: inline-block">
                    <a href="https://www.facebook.com/sakamototen/" class="btn-social btn-facebook" style="margin-right: 40px;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://github.com/leandro1st" class="btn-social btn-github" style="margin-right: 40px;"><i class="fab fa-github"></i></a>
                    <a href="https://www.instagram.com/sakamototen/" class="btn-social btn-instagram" style="margin-right: 40px;"><i class="fab fa-instagram"></i></a>
                </div>
            </center>
        </div>
        <!-- Footer Elements -->
        <!-- Copyright -->
        <div class="text-center" style="background-color: #323741; padding: 16px; color: #dddddd">©
            2019 Copyright –
            <a href="https://sakamototen.com.br/" style="text-decoration: none"> SakamotoTen – Produtos Orientais e
                Naturais</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>