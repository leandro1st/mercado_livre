<?php
require('../externo/connect.php');
// Using 'group by' to avoid selecting repeated 'cod_athos'
$pesquisar = mysqli_query($connect, "SELECT id, cod_athos, nome, ncm, csosn, cfop, cest, COUNT(*) as produto_total_kits FROM $kits GROUP BY $cod_athos ORDER BY $csosn, $nome");

// $num_produtos = 0;
$num_produtos = mysqli_num_rows($pesquisar);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php if ($num_produtos == 0) {
            echo "Mercado Livre | Nenhum produto";
        } else if ($num_produtos == 1) {
            echo "Mercado Livre | " . $num_produtos . " produto";
        } else {
            echo "Mercado Livre | " . $num_produtos . " produtos";
        } ?>
    </title>
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <script src="../jquery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
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

        /* adding some margin between element and tooltip */
        .bs-tooltip-right {
            margin-left: 5px;
        }
    </style>
    <script>
        // alert($(window).width());
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(document).ready(function() {
            $('#nome_do_kit').autocomplete({
                source: "../pesquisar/pesquisar_autocomplete.php",
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

        // Função para alterar o preço antigo
        function texto_input(id_produto) {
            // Código Athos
            /*document.getElementById('athos-' + id_produto + '').innerHTML = '';
            document.getElementById('input_athos-' + id_produto).type = 'text';
            document.getElementById('input_athos-' + id_produto).focus();
            // Resentando o valor do input, pois o cursor estava começando da direita
            var copia_athos = document.getElementById('input_athos-' + id_produto).value;
            document.getElementById('input_athos-' + id_produto).value = '';
            document.getElementById('input_athos-' + id_produto).value = copia_athos;*/

            // Nome
            document.getElementById('nome-' + id_produto + '').innerHTML = '';
            document.getElementById('input_nome-' + id_produto).type = 'text';
            document.getElementById('input_nome-' + id_produto).focus();
            // Resentando o valor do input, pois o cursor estava começando da direita
            var copia_nome = document.getElementById('input_nome-' + id_produto).value;
            document.getElementById('input_nome-' + id_produto).value = '';
            document.getElementById('input_nome-' + id_produto).value = copia_nome;

            // NCM
            document.getElementById('ncm-' + id_produto + '').innerHTML = '';
            document.getElementById('input_ncm-' + id_produto).type = 'text';

            // CSOSN
            document.getElementById('csosn-' + id_produto + '').innerHTML = '';
            document.getElementById('input_csosn-' + id_produto).type = 'number';

            // CFOP
            document.getElementById('cfop-' + id_produto + '').innerHTML = '';
            document.getElementById('input_cfop-' + id_produto).type = 'number';

            // CEST
            document.getElementById('cest-' + id_produto + '').innerHTML = '';
            document.getElementById('input_cest-' + id_produto).type = 'number';

            // Icone confirmar
            document.getElementById('span-' + id_produto + '').style.cursor = 'pointer';
            document.getElementById('icone-' + id_produto + '').style.cssText = 'color: green; font-size: 24px; opacity: 1; pointer-events: auto';
        }

        function alterar_info(id_produto, cod_athos, nome, ncm, csosn, cfop, cest) {
            $.ajax({
                method: 'POST',
                url: 'alterar_temporario.php',
                data: $('#form-' + id_produto).serialize(),
                success: function(data) {
                    // Alterando os valores de exibição
                    //document.getElementById('input_athos-' + id_produto).type = 'hidden';
                    //document.getElementById('athos-' + id_produto).innerHTML = cod_athos;

                    document.getElementById('input_nome-' + id_produto).type = 'hidden';
                    document.getElementById('nome-' + id_produto).innerHTML = nome.toUpperCase();

                    document.getElementById('input_ncm-' + id_produto).type = 'hidden';
                    document.getElementById('ncm-' + id_produto).innerHTML = ncm.toUpperCase();

                    document.getElementById('input_csosn-' + id_produto).type = 'hidden';
                    if (csosn == "0" || csosn == "") {
                        document.getElementById('csosn-' + id_produto).innerHTML = "–";
                    } else {
                        document.getElementById('csosn-' + id_produto).innerHTML = csosn;
                    }

                    document.getElementById('input_cfop-' + id_produto).type = 'hidden';
                    if (cfop == "0" || cfop == "") {
                        document.getElementById('cfop-' + id_produto).innerHTML = "–";
                    } else {
                        document.getElementById('cfop-' + id_produto).innerHTML = cfop;
                    }

                    document.getElementById('input_cest-' + id_produto).type = 'hidden';
                    if (cest == "0000000" || cest == "") {
                        document.getElementById('cest-' + id_produto).innerHTML = "–";
                    } else {
                        document.getElementById('cest-' + id_produto).innerHTML = cest;
                    }

                    document.getElementById('span-' + id_produto + '').style.cursor = 'not-allowed';
                    document.getElementById('icone-' + id_produto + '').style.cssText = 'color: green; font-size: 24px; opacity: .5; pointer-events: none';

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
                    <a class="nav-link" href="../cadastrar/"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../excluir/"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../info.php"><i class="fas fa-question-circle text-primary" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="#"><i class="far fa-clock text-white" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <i class="fas fa-info-circle" style="font-size: 24px; color: #5bc0de; vertical-align: middle; margin-right: 15px; cursor: pointer" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<img src='../imagens/example.png' width='130px'>"></i>
            <form id="form_pesquisa" class="form-inline my-2 my-lg-0" method="POST" action="../pesquisar/">
                <input class="form-control mr-sm-2" id="nome_do_kit" name="nome_do_kit" placeholder="Código/Nome do kit" aria-label="Search" autocomplete="off" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px">
                <div id="div_autocomplete">
                </div>
                <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 1;">
        <ol class="breadcrumb" style="background: none; margin: 0;">
            <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item active"><a href="#" class="none_li"><i class="far fa-clock"></i> Alterar Produto</a></li>
        </ol>
    </nav>
    <?php
    if ($num_produtos == 0) { ?>
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
                <img src="../imagens/deserto.jpg" alt="wallpaper" height="500px" width="110%">
            </div>
            <div id="img_nothing" data-depth="0.6"><img src="../imagens/nothing.png" alt="nada"></div>
            <div id="mai" data-depth="0.8"><img src="../imagens/mai.png" alt="mai" width="60px"></div>
        </div>
        <p class='lead' style='padding-top: 8%; font-size: 40px; text-align: center;'>Comece cadastrando novos kits!</p>
    <?php } else { ?>
        <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
            <center>
                <h1 style="color: #daeff5">Alterar Produto</h1>
            </center>
        </header>
        <main class="container">
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="text-center table-warning">
                        <th class="theader_top" scope="col" width="5%">#</th>
                        <th class="theader_top" scope="col" width="35%">Nome do produto</th>
                        <th class="theader_top" scope="col" width="12%">NCM</th>
                        <th class="theader_top" scope="col" width="12%">CSOSN</th>
                        <th class="theader_top" scope="col" width="12%">CFOP</th>
                        <th class="theader_top" scope="col" width="12%">CEST</th>
                        <th class="theader_top" scope="col" width="12%" colspan="2"><i class="fas fa-cogs text-secondary" style="font-size: 22px;"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $num_produtos; $i++) {
                        $vetor_produto = mysqli_fetch_assoc($pesquisar);
                        $id_produto = $vetor_produto['id'];
                        $cod_athos_produto = $vetor_produto['cod_athos'];
                        $nome_produto = $vetor_produto['nome'];
                        $csosn_produto = $vetor_produto['ncm'];
                        $csosn_produto = $vetor_produto['csosn'];
                        $cfop_produto = $vetor_produto['cfop'];
                        $cest_produto = $vetor_produto['cest'];
                        $produto_total_kits = $vetor_produto['produto_total_kits'];
                    ?>
                        <tr class="text-center" id="linha-<?php echo $vetor_produto['id'] ?>">
                            <form id="form-<?php echo $vetor_produto['id'] ?>" method="POST">
                                <input type="hidden" name="id_produto" value="<?php echo $vetor_produto['id'] ?>">
                                <td>
                                    <!-- Input pra alterar o cod athos -->
                                    <input type="hidden" id="input_athos-<?php echo $vetor_produto['id'] ?>" name="athos_novo" class="form-control" value="<?php echo $vetor_produto['cod_athos'] ?>" placeholder="Código Athos novo" onkeydown="return event.key != 'Enter';">
                                    <span id="athos-<?php echo $vetor_produto['id'] ?>">
                                        <?php echo $vetor_produto['cod_athos'] ?>
                                    </span>
                                </td>
                                <td style="max-width: 400px; word-wrap: break-word;">
                                    <!-- Input pra alterar o nome do produto -->
                                    <input type="hidden" id="input_nome-<?php echo $vetor_produto['id'] ?>" name="nome_novo" class="form-control" value="<?php echo $vetor_produto['nome'] ?>" placeholder="Nome novo" onkeydown="return event.key != 'Enter';">

                                    <span id="nome-<?php echo $vetor_produto['id'] ?>">
                                        <!-- Nome e número de kits que contém determinado produto -->
                                        <?php echo $vetor_produto['nome'] . "<span class='noselect font-weight-bold text-success' data-toggle='tooltip' data-html='true' data-placement='right' title='Há <b><span class=" . "text-success" . ">" . $vetor_produto['produto_total_kits'] . "</span></b>";
                                        echo $produto_total_kits == 1 ? " kit" : " kits";
                                        echo " que contém o produto <b>" . $vetor_produto['nome'] . "</b>'> (" . $vetor_produto['produto_total_kits'] . ")</span>" ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- Input pra alterar o ncm -->
                                    <input type="hidden" id="input_ncm-<?php echo $vetor_produto['id'] ?>" name="ncm_novo" class="form-control" value="<?php echo $vetor_produto['ncm'] ?>" placeholder="NCM novo" onkeydown="return event.key != 'Enter';">

                                    <span id="ncm-<?php echo $vetor_produto['id'] ?>">
                                        <?php echo $vetor_produto['ncm'] ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- Input pra alterar o csosn -->
                                    <input type="hidden" id="input_csosn-<?php echo $vetor_produto['id'] ?>" name="csosn_novo" class="form-control" value="<?php echo $vetor_produto['csosn'] ?>" placeholder="CSOSN novo" onkeydown="return event.key != 'Enter';">

                                    <span id="csosn-<?php echo $vetor_produto['id'] ?>">
                                        <?php if ($vetor_produto['csosn'] == 0) {
                                            echo "–";
                                        } else {
                                            echo $vetor_produto['csosn'];
                                        } ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- Input pra alterar o cfop -->
                                    <input type="hidden" id="input_cfop-<?php echo $vetor_produto['id'] ?>" name="cfop_novo" class="form-control" value="<?php echo $vetor_produto['cfop'] ?>" placeholder="CFOP novo" onkeydown="return event.key != 'Enter';">

                                    <span id="cfop-<?php echo $vetor_produto['id'] ?>">
                                        <?php if ($vetor_produto['cfop'] == 0) {
                                            echo "–";
                                        } else {
                                            echo $vetor_produto['cfop'];
                                        } ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- Input pra alterar o cest -->
                                    <input type="hidden" id="input_cest-<?php echo $vetor_produto['id'] ?>" name="cest_novo" class="form-control" value="<?php echo $vetor_produto['cest'] ?>" placeholder="CEST novo" onkeydown="return event.key != 'Enter';">

                                    <span id="cest-<?php echo $vetor_produto['id'] ?>">
                                        <?php if ($vetor_produto['cest'] == 0) {
                                            echo "–";
                                        } else {
                                            echo $vetor_produto['cest'];
                                        } ?>
                                    </span>
                                </td>
                                <td>
                                    <i class="far fa-edit font-weight-bold" style="color: green; font-size: 24px; cursor: pointer;" data-toggle="tooltip" title="Editar <?php echo $vetor_produto['nome'] ?>" onclick="texto_input(<?php echo $vetor_produto['id'] ?>)"></i>
                                </td>
                                <td>
                                    <span id="span-<?php echo $vetor_produto['id'] ?>" style="cursor: not-allowed">
                                        <i id="icone-<?php echo $vetor_produto['id'] ?>" class="fas fa-check-square font-weight-bold" style="color: green; font-size: 24px; opacity: .5; pointer-events: none;" data-toggle="tooltip" title="Confirmar alterações de <?php echo $vetor_produto['nome'] ?>" onclick="alterar_info('<?php echo $vetor_produto['id'] ?>', document.getElementById('input_athos-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_nome-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_ncm-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_csosn-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_cfop-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_cest-<?php echo $vetor_produto['id'] ?>').value)"></i>
                                    </span>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    <?php } ?>
    <!-- Footer -->
    <?php if ($num_produtos == 0) { ?>
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
            <?php if ($num_produtos == 0) { ?>
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