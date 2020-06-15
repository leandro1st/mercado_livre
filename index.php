<?php
require('externo/connect.php');
$pesquisar = mysqli_query($connect, "SELECT * FROM $kits ORDER BY $kit_nome");
$pesquisar2 = mysqli_query($connect, "SELECT COUNT(*) c, $id_kit, $kit_nome, $hora_cadastro FROM $kits GROUP BY $id_kit HAVING c >= 1 ORDER BY $kit_nome");
$pesquisar_ultimo_cadastro = mysqli_query($connect, "SELECT $kit_nome, $hora_cadastro FROM $kits ORDER BY hora_cadastro DESC limit 1");
$vetor_ultimo = mysqli_fetch_array($pesquisar_ultimo_cadastro);

// $num_kits = 0;
$num_kits = mysqli_num_rows($pesquisar2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php if ($num_kits == 0) {
            echo "Mercado Livre | Nenhum Kit";
        } else if ($num_kits == 1) {
            echo "Mercado Livre | " . $num_kits . " Kit";
        } else {
            echo "Mercado Livre | " . $num_kits . " Kits";
        } ?>
    </title>
    <link rel="shortcut icon" href="imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="externo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <script src="jquery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        #img_nothing {
            /* position: absolute !important; */
            left: 50% !important;
            margin-left: -209px !important;
            top: 50% !important;
            margin-top: -92px !important;
        }

        #mai {
            position: absolute !important;
            left: 50% !important;
            margin-left: -30px !important;
            top: 55% !important;
        }

        .tooltip {
            font-size: 20px;
        }
    </style>
    <script>
        // alert($(window).width());
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(document).ready(function() {
            $('#nome_do_kit').autocomplete({
                source: "pesquisar/pesquisar_autocomplete.php",
                minLength: 1,
                select: function(event, ui) {
                    $('#nome_do_kit').val(ui.item.value);
                    $('#form_pesquisa').submit();
                },
                appendTo: "#div_autocomplete"
            }).data('ui-autocomplete')._renderItem = function(ul, item) {
                return $("<li class='ui-autocomplete-row'></li>")
                    .data("item.autocomplete", item)
                    .append(item.label)
                    .appendTo(ul);
            };
        });
    </script>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="imagens/logo.png" alt="logo" width="35px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="#"><i class="fas fa-home" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="cadastrar/"><i class="fas fa-pen text-success" style="padding-right: 5px"></i> Cadastrar Kit</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="cadastrar/associar.php"><i class="fas fa-link text-secondary" style="padding-right: 5px"></i> Associar Produto</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="excluir/"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="info.php"><i class="fas fa-question-circle text-primary" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="alterar/troca_temporaria.php"><i class="far fa-clock text-white" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <i class="fas fa-info-circle" style="font-size: 24px; color: #5bc0de; vertical-align: middle; margin-right: 15px; cursor: pointer" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<img src='imagens/example.png' width='130px'>"></i>
            <form id="form_pesquisa" class="form-inline my-2 my-lg-0" method="POST" action="pesquisar/">
                <input class="form-control mr-sm-2" id="nome_do_kit" name="nome_do_kit" placeholder="Código/Nome do kit" aria-label="Search" autocomplete="off" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px">
                <div id="div_autocomplete">
                </div>
                <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
            </form>
        </div>
    </nav>
    <?php
    if ($num_kits == 0) { ?>
        <script>
            $(document).ready(function() {
                if (window.matchMedia("(max-width:1366px)").matches) {
                    document.getElementById("footer1").style.marginBottom = "-269px";
                } else if (window.matchMedia("(min-width:1600px) and (max-width:1920px)").matches) {
                    document.getElementById("footer1").style.marginBottom = "-68px";
                }
            });
        </script>
        <div id="scene" style="overflow: hidden">
            <div data-depth="0.4" style="margin-top: -25px; margin-bottom: -25px; margin-left: -350px; z-index: 0;">
                <img src="imagens/deserto.jpg" alt="wallpaper" height="500px" width="110%">
            </div>
            <div id="img_nothing" data-depth="0.6"><img src="imagens/nothing.png" alt="nada"></div>
            <div id="mai" data-depth="0.8"><img src="imagens/mai.png" alt="mai" width="60px"></div>
        </div>
        <p class='lead' style='padding-top: 8%; font-size: 40px; text-align: center;'>Comece cadastrando novos kits!</p>
    <?php } else { ?>
        <p class="lead" style="position: absolute; margin: 15px 0 0 25px; font-size: 18px">
            <b><i class="fas fa-history text-warning"></i> Último cadastro: </b><?php echo $vetor_ultimo['kit_nome'] . " <span style='font-size: 16px'>(" . date("d/m/Y H:i:s", strtotime($vetor_ultimo['hora_cadastro'])) . ")</span>" ?>
        </p>
        <header class="jumbotron" style="background-image: url('imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
            <center>
                <h1 style="color: #daeff5">Mercado Livre</h1>
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
                    <div class="card">
                        <?php if ($i == 0) { ?>
                            <!-- <div class="card-header" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer;"> -->
                            <div class="card-header collapsed" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer;">
                                <h5 class="accordion-toggle" style="margin: 0px" data-toggle="tooltip" data-placement="top" title="<?php echo date("d/m/Y H:i:s", strtotime($vetor2['hora_cadastro'])) ?>">
                                    <?php echo $vetor2['kit_nome'] . " <b><span style='font-size: 14px'>(#" . $vetor2['id_kit'] . ")</span></b>" ?>
                                </h5>
                            </div>
                            <!-- <div id="collapse_<?php echo $i ?>" class="collapse show" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits"> -->
                            <div id="collapse_<?php echo $i ?>" class="collapse" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                            <?php } else { ?>
                                <div class="card-header collapsed" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer;">
                                    <h5 class="accordion-toggle" style="margin: 0px" data-toggle="tooltip" data-placement="top" title="<?php echo date("d/m/Y H:i:s", strtotime($vetor2['hora_cadastro'])) ?>">
                                        <?php echo $vetor2['kit_nome'] . " <b><span style='font-size: 14px'>(#" . $vetor2['id_kit'] . ")</span></b>" ?>
                                    </h5>
                                </div>
                                <div id="collapse_<?php echo $i ?>" class="collapse" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                                <?php } ?>
                                <div class="card-body" style="padding: 10px 40px 10px 40px;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-center table-warning">
                                                <th scope="col" width="9%">#</th>
                                                <th scope="col" width="39%">Nome do produto</th>
                                                <th scope="col" width="1%">Qtde</th>
                                                <th scope="col" width="13%">Preço</th>
                                                <th scope="col" width="13%">Total</th>
                                                <th scope="col" width="4%">NCM</th>
                                                <th scope="col" width="4%">CSOSN</th>
                                                <th scope="col" width="5%">CFOP</th>
                                                <th scope="col" width="12%">CEST</th>
                                                <!-- <th scope="col" width="13,75%">Kit nome</th> -->
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
                                                    <td>
                                                        <?php if ($vetor['csosn'] == 0) {
                                                            echo "–";
                                                        } else {
                                                            echo $vetor['csosn'];
                                                        } ?>

                                                    </td>
                                                    <td>
                                                        <?php if ($vetor['cfop'] == 0) {
                                                            echo "–";
                                                        } else {
                                                            echo $vetor['cfop'];
                                                        } ?>

                                                    </td>
                                                    <td>
                                                        <?php if ($vetor['cest'] == 0) {
                                                            echo "–";
                                                        } else {
                                                            echo $vetor['cest'];
                                                        } ?>
                                                    </td>
                                                    <!-- <td><?php echo $vetor['kit_nome'] ?></td> -->
                                                </tr>
                                                <?php if ($j == $numero_repetido - 1) { ?>
                                                    <tr class="text-center">
                                                        <td colspan="9" style="border-top-color: #5cb85c; border-top-width: 2px;">
                                                            <font style="font-size: 24px" class="lead font-weight-bold">R$ <?php echo number_format($preco_total_kit, 2, ',', '') ?></font>
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
        </main>
    <?php } ?>
    <!-- Footer -->
    <?php if ($num_kits == 0) { ?>
        <footer id="footer1" class="footer" style="margin-bottom: -250px">
            <!-- style="/*margin-bottom: -100px*/" -->
        <?php } else { ?>
            <footer id="footer1" class="footer" style="margin-bottom: -250px">
                <!-- style="/*margin-bottom: -200px*/" -->
            <?php } ?>
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
            <?php if ($num_kits == 0) { ?>
                <script>
                    /* Parallax (efeito de diferentes objetos parecerem estar em diferentes posições ou direções quando observados em diferentes posições) */
                    var scene = document.getElementById('scene');
                    var parallax = new Parallax(scene, {
                        // calibrateX: false,
                        // calibrateY: true,
                        invertX: true,
                        invertY: true,
                        // limitX: 10,
                        // limitY: 10,
                        // scalarX: 2,
                        // scalarY: 8,
                        // frictionX: 0.2,
                        // frictionY: 0.8
                    });
                </script>
            <?php } ?>
</body>

</html>