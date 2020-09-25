<?php
require('../externo/connect.php');
// Using 'group by' to avoid selecting repeated 'cod_athos'
// $pesquisar = mysqli_query($connect, "SELECT id, cod_athos, nome, ncm, csosn, cfop, cest, COUNT(*) as produto_total_kits FROM $kits GROUP BY $cod_athos ORDER BY $csosn, $nome");
$pesquisar = mysqli_query($connect, "SELECT id, cod_athos, nome, ncm, csosn, cfop, cest, COUNT(*) as produto_total_kits FROM $kits GROUP BY $cod_athos ORDER BY $nome");

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
    <link rel="stylesheet" href="../externo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <script src="../externo/jquery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="../externo/bootstrap/js/bootstrap.bundle.min.js"></script>
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

        function htmlEntities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        $(document).ready(function() {
            $('#nome_do_kit').autocomplete({
                source: "../pesquisar/pesquisar_autocomplete.php",
                minLength: 1,
                select: function(event, ui) {
                    $('#nome_do_kit').val(ui.item.value);
                    $('#form_pesquisa').submit();
                },
                appendTo: "#div_autocomplete",

                // clearing the input text
                close: function(event) {
                    var ev = event.originalEvent;
                    if (ev.type === "keydown" && ev.keyCode === $.ui.keyCode.ESCAPE) {
                        $(this).val("");
                    }
                }
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

            document.getElementById('span_produto_total_kits-' + id_produto).style.display = "none";

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
            document.getElementById('span_icone_confirmar-' + id_produto + '').style.cursor = 'pointer';
            document.getElementById('icone_confirmar-' + id_produto + '').style.cssText = 'color: green; font-size: 24px; opacity: 1; pointer-events: auto';
        }

        // Alterando as informações
        function alterar_info(id_produto, cod_athos, nome, ncm, csosn, cfop, cest, produto_total_kits) {
            n = document.getElementById('input_nome-' + id_produto).value.trim();
            nc = document.getElementById('input_ncm-' + id_produto).value.trim();
            c = document.getElementById('input_csosn-' + id_produto).value.trim();
            cf = document.getElementById('input_cfop-' + id_produto).value.trim();
            ce = document.getElementById('input_cest-' + id_produto).value.trim();

            values = [n, nc, c, cf]
            fields = ["Nome", "NCM", "CSOSN", "CFOP"]
            empty_fields = []

            for (i = 0; i < fields.length; i++) {
                // alert(values[i]);
                if (!values[i] || parseInt(values[i]) === 0) {
                    // appending empty fields to array
                    empty_fields.push(fields[i]);
                }
            }

            // if array is not empty
            if (empty_fields.length > 0) {
                // appending element to list
                document.getElementById('lista_campos').innerHTML = '<li class="list-group-item">' + empty_fields.join('</li><li class="list-group-item">') + '</li>';

                $('#modalCamposPreenchidos').modal('show');
            } else {
                $.ajax({
                    method: 'POST',
                    url: 'alterar_temporario.php',
                    data: $('#form-' + id_produto).serialize(),
                    success: function(data) {
                        // Alterando os valores de exibição
                        //document.getElementById('input_athos-' + id_produto).type = 'hidden';
                        //document.getElementById('athos-' + id_produto).innerHTML = cod_athos;

                        document.getElementById('input_nome-' + id_produto).type = 'hidden';
                        document.getElementById('nome-' + id_produto).innerHTML = htmlEntities(nome.trim().toUpperCase());

                        document.getElementById('span_produto_total_kits-' + id_produto).style.display = "inline-block";
                        // Alterando conteúdo do tooltip
                        if (produto_total_kits == 1) {
                            var texto_tooltip_novo = "Há <b><span class='text-success'>" + produto_total_kits + "</span></b> kit que contém o produto <b><span class='text-warning'>" + htmlEntities(nome.toUpperCase()) + "</span></b>";
                        } else {
                            var texto_tooltip_novo = "Há <b><span class='text-success'>" + produto_total_kits + "</span></b> kits que contém o produto <b><span class='text-warning'>" + htmlEntities(nome.toUpperCase()) + "</span></b>";
                        }
                        $('#span_produto_total_kits-' + id_produto).attr('data-original-title', texto_tooltip_novo);

                        document.getElementById('input_ncm-' + id_produto).type = 'hidden';
                        document.getElementById('ncm-' + id_produto).innerHTML = htmlEntities(ncm.trim().toUpperCase());

                        document.getElementById('input_csosn-' + id_produto).type = 'hidden';
                        document.getElementById('csosn-' + id_produto).innerHTML = csosn.trim();

                        document.getElementById('input_cfop-' + id_produto).type = 'hidden';
                        document.getElementById('cfop-' + id_produto).innerHTML = cfop.trim();

                        document.getElementById('input_cest-' + id_produto).type = 'hidden';
                        if (parseInt(cest.trim()) === 0 || cest.trim() === "") {
                            document.getElementById('cest-' + id_produto).innerHTML = "–";
                        } else {
                            document.getElementById('cest-' + id_produto).innerHTML = cest.trim();
                        }

                        // Ícones
                        $('#icone_editar-' + id_produto).attr('data-original-title', 'Editar ' + htmlEntities(nome.toUpperCase()));
                        document.getElementById('span_icone_confirmar-' + id_produto + '').style.cursor = 'not-allowed';
                        $('#icone_confirmar-' + id_produto).attr('data-original-title', 'Confirmar alterações de ' + htmlEntities(nome.toUpperCase()));
                        document.getElementById('icone_confirmar-' + id_produto + '').style.cssText = 'color: green; font-size: 24px; opacity: .5; pointer-events: none';

                        // if number of rows affected > 0, adding new class
                        if (data > 0) {
                            $('#linha-' + id_produto).fadeOut(0, function() {
                                $(this).addClass('table-success');
                            }).fadeIn(300);
                        } else {
                            $('#linha-' + id_produto).fadeOut(0, function() {
                                // nothing happens
                            }).fadeIn(300);
                        }
                    },
                    error: function(data) {
                        alert("Ocorreu um erro!");
                    }
                });
            }
        }

        // avoiding negative numbers and stuff
        $(document).ready(function() {
            for (i = 0; i < vetor_id.length; i++) {
                csosn = document.getElementById('input_csosn-' + vetor_id[i]);
                cfop = document.getElementById('input_cfop-' + vetor_id[i]);
                cest = document.getElementById('input_cest-' + vetor_id[i]);

                // Listen for input event on numInput.
                csosn.onkeydown = function(e) {
                    // allowing only numbers, backspace, tab, f5, f6, delete, arrows, c, x, v
                    if (!((e.keyCode > 95 && e.keyCode < 106) ||
                            (e.keyCode > 47 && e.keyCode < 58) ||
                            e.keyCode == 8 ||
                            e.keyCode == 9 ||
                            e.keyCode == 116 ||
                            e.keyCode == 117 ||
                            e.keyCode == 46 ||
                            (e.keyCode > 36 && e.keyCode < 41) ||
                            e.keyCode == 67 ||
                            e.keyCode == 88 ||
                            e.keyCode == 86)) {
                        return false;
                    }
                }
                cfop.onkeydown = function(e) {
                    // allowing only numbers, backspace, tab, f5, f6, delete, arrows, c, x, v
                    if (!((e.keyCode > 95 && e.keyCode < 106) ||
                            (e.keyCode > 47 && e.keyCode < 58) ||
                            e.keyCode == 8 ||
                            e.keyCode == 9 ||
                            e.keyCode == 116 ||
                            e.keyCode == 117 ||
                            e.keyCode == 46 ||
                            (e.keyCode > 36 && e.keyCode < 41) ||
                            e.keyCode == 67 ||
                            e.keyCode == 88 ||
                            e.keyCode == 86)) {
                        return false;
                    }
                }
                cest.onkeydown = function(e) {
                    // allowing only numbers, backspace, tab, f5, f6, delete, arrows, c, x, v
                    if (!((e.keyCode > 95 && e.keyCode < 106) ||
                            (e.keyCode > 47 && e.keyCode < 58) ||
                            e.keyCode == 8 ||
                            e.keyCode == 9 ||
                            e.keyCode == 116 ||
                            e.keyCode == 117 ||
                            e.keyCode == 46 ||
                            (e.keyCode > 36 && e.keyCode < 41) ||
                            e.keyCode == 67 ||
                            e.keyCode == 88 ||
                            e.keyCode == 86)) {
                        return false;
                    }
                }
            }
        });
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
                <li class="nav-item px-1 dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i></a>
                    <ul class="dropdown-menu asap_regular">
                        <li>
                            <a class="dropdown-item" href="../cadastrar/"><i class="fas fa-pen text-success" style="padding-right: 5px"></i> Cadastrar Kit</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../cadastrar/associar.php"><i class="fas fa-link text-secondary" style="padding-right: 5px"></i> Associar Produto</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../excluir/"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../info.php"><i class="fas fa-question-circle text-primary" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="javascript:void(0)"><i class="far fa-clock text-white" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../produtos/"><i class="fas fa-book" style="font-size: 24px; vertical-align: middle; color: #b5651d"></i></a>
                </li>
            </ul>
            <i class="fas fa-info-circle" style="font-size: 24px; color: #5bc0de; vertical-align: middle; margin-right: 15px; cursor: pointer" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<img src='../imagens/example.png' width='130px'>"></i>
            <form id="form_pesquisa" class="form-inline my-2 my-lg-0" method="POST" action="../pesquisar/">
                <input class="form-control mr-sm-2" id="nome_do_kit" name="nome_do_kit" placeholder="Código/Nome do kit" aria-label="Search" autocomplete="off" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px" onkeydown="if ( event.keyCode == 27 ) this.value=''">
                <div id="div_autocomplete">
                </div>
                <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
            </form>
        </div>
    </nav>
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 1;">
        <ol class="breadcrumb" style="background: none; margin: 0;">
            <li class="breadcrumb-item asap_regular"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item asap_regular active"><a href="javascript:void(0)" class="none_li"><i class="far fa-clock"></i> Alterar Produto</a></li>
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
            <h1 class="text-center montara" style="color: #daeff5">Alterar Produto</h1>
        </header>
        <main class="container">
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="text-center table-warning">
                        <th class="theader_top lead" scope="col" width="5%"><b>ATHOS</b></th>
                        <th class="theader_top lead" scope="col" width="*"><b>NOME</b></th>
                        <th class="theader_top lead" scope="col" width="9%"><b>NCM</b></th>
                        <th class="theader_top lead" scope="col" width="9%"><b>CSOSN</b></th>
                        <th class="theader_top lead" scope="col" width="9%"><b>CFOP</b></th>
                        <th class="theader_top lead" scope="col" width="12%"><b>CEST</b></th>
                        <th class="theader_top lead" scope="col" width="12%" colspan="2"><i class="fas fa-cogs text-secondary" style="font-size: 22px;"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <script>
                        // Criando vetor para armazenar todos os ids dos produtos
                        var vetor_id = [];
                    </script>
                    <?php
                    for ($i = 0; $i < $num_produtos; $i++) {
                        $vetor_produto = mysqli_fetch_assoc($pesquisar);
                    ?>
                        <script>
                            // adicionando os códigos dos produtos no array
                            vetor_id.push("<?php echo $vetor_produto['id'] ?>");
                        </script>
                        <?php
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
                                <td class="text-left" style="max-width: 400px; word-wrap: break-word;">
                                    <!-- Input pra alterar o nome do produto -->
                                    <input type="hidden" id="input_nome-<?php echo $vetor_produto['id'] ?>" name="nome_novo" class="form-control" value="<?php echo $vetor_produto['nome'] ?>" placeholder="Nome novo" onkeydown="return event.key != 'Enter';">

                                    <!-- Nome do produto -->
                                    <span id="nome-<?php echo $vetor_produto['id'] ?>">
                                        <?php echo $vetor_produto['nome']; ?>
                                    </span>
                                    <!-- Número de kits que contém determinado produto -->
                                    <?php if ($vetor_produto['produto_total_kits'] == 1) { ?>
                                        <span id="span_produto_total_kits-<?php echo $vetor_produto['id'] ?>" class="noselect font-weight-bold badge badge-pill badge-success" data-toggle="tooltip" data-html="true" data-placement="right" title="Há <b><span class='text-success'><?php echo $vetor_produto['produto_total_kits'] ?></span></b> kit que contém o produto <b><span class='text-warning'><?php echo $vetor_produto['nome'] ?></span></b>"><?php echo $vetor_produto['produto_total_kits'] ?></span>
                                    <?php } else { ?>
                                        <span id="span_produto_total_kits-<?php echo $vetor_produto['id'] ?>" class="noselect font-weight-bold badge badge-pill badge-success" data-toggle="tooltip" data-html="true" data-placement="right" title="Há <b><span class='text-success'><?php echo $vetor_produto['produto_total_kits'] ?></span></b> kits que contém o produto <b><span class='text-warning'><?php echo $vetor_produto['nome'] ?></span></b>"><?php echo $vetor_produto['produto_total_kits'] ?></span>
                                    <?php } ?>
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
                                    <input type="hidden" id="input_csosn-<?php echo $vetor_produto['id'] ?>" name="csosn_novo" class="form-control" value="<?php echo $vetor_produto['csosn'] ?>" placeholder="CSOSN novo" onkeydown="return event.key != 'Enter';" min="0">

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
                                    <input type="hidden" id="input_cfop-<?php echo $vetor_produto['id'] ?>" name="cfop_novo" class="form-control" value="<?php echo $vetor_produto['cfop'] ?>" placeholder="CFOP novo" onkeydown="return event.key != 'Enter';" min="0">

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
                                    <input type="hidden" id="input_cest-<?php echo $vetor_produto['id'] ?>" name="cest_novo" class="form-control" value="<?php echo $vetor_produto['cest'] ?>" placeholder="CEST novo" onkeydown="return event.key != 'Enter';" min="0">

                                    <span id="cest-<?php echo $vetor_produto['id'] ?>">
                                        <?php if ($vetor_produto['cest'] == 0) {
                                            echo "–";
                                        } else {
                                            echo $vetor_produto['cest'];
                                        } ?>
                                    </span>
                                </td>
                                <td>
                                    <i id="icone_editar-<?php echo $vetor_produto['id'] ?>" class="far fa-edit font-weight-bold" style="color: green; font-size: 24px; cursor: pointer;" data-toggle="tooltip" data-html="true" title="Editar <?php echo htmlspecialchars(trim($vetor_produto['nome']), ENT_QUOTES, 'UTF-8') ?>" onclick="texto_input(<?php echo $vetor_produto['id'] ?>)"></i>
                                </td>
                                <td>
                                    <span id="span_icone_confirmar-<?php echo $vetor_produto['id'] ?>" style="cursor: not-allowed">
                                        <i id="icone_confirmar-<?php echo $vetor_produto['id'] ?>" class="fas fa-check-square font-weight-bold" style="color: green; font-size: 24px; opacity: .5; pointer-events: none;" data-toggle="tooltip" data-html="true" title="Confirmar alterações de <?php echo htmlspecialchars(trim($vetor_produto['nome']), ENT_QUOTES, 'UTF-8') ?>" onclick="alterar_info('<?php echo $vetor_produto['id'] ?>', document.getElementById('input_athos-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_nome-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_ncm-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_csosn-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_cfop-<?php echo $vetor_produto['id'] ?>').value, document.getElementById('input_cest-<?php echo $vetor_produto['id'] ?>').value, '<?php echo $vetor_produto['produto_total_kits'] ?>')"></i>
                                    </span>
                                </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    <?php } ?>
    <!-- Modal campos não preenchidos -->
    <div class="modal fade" id="modalCamposPreenchidos" tabindex="-1" role="dialog" aria-labelledby="modalCamposPreenchidosTitle" aria-hidden="true" onkeypress="$('#modalCamposPreenchidos').modal('toggle');">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-warning" id="modalTitle">
                        Há campos a serem preenchidos!
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p class="lead">Os seguintes campos não foram preenchidos: </p>
                        <ul id="lista_campos" class="list-group list-group-flush">

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="">OK</button>
                </div>
            </div>
        </div>
    </div>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 offset-md-3 text-right">
                            <a href="https://www.facebook.com/sakamototen/" class="btn-social btn-facebook"><i class="fab fa-facebook-f"></i></a>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="https://github.com/leandro1st" class="btn-social btn-github"><i class="fab fa-github"></i></a>
                        </div>
                        <div class="col-md-2">
                            <a href="https://www.instagram.com/sakamototen/" class="btn-social btn-instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Elements -->
            <!-- Copyright -->
            <div class="text-center asap_regular" style="background-color: #323741; padding: 16px; color: #dddddd">©
                2020 Copyright –
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