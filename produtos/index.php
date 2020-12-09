<?php
require('../externo/connect.php');
$pesquisar = mysqli_query($connect, "SELECT cod_athos, nome, csosn, ncm, cest, cfop FROM $produtos ORDER BY $nome");
$num_produtos = mysqli_num_rows($pesquisar);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | Pesquisar Produto</title>
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../externo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../externo/DataTables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../externo/DataTables/FixedHeader-3.1.7/css/fixedHeader.bootstrap4.min.css">
    <script src="../externo/jquery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="../externo/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../externo/DataTables/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../externo/DataTables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="../externo/DataTables/plug-ins/intl.js"></script>
    <script src="../externo/DataTables/plug-ins/accent-neutralise.js"></script>
    <script src="../externo/DataTables/FixedHeader-3.1.7/js/dataTables.fixedHeader.min.js"></script>
    <style>
        #img_nothing {
            /* position: absolute !important; */
            left: 50% !important;
            margin-left: -209px !important;
            top: 50% !important;
            margin-top: -92px !important;
        }

        #raphtalia {
            position: absolute !important;
            left: 50% !important;
            margin-left: -30px !important;
            top: 55% !important;
        }

        /* datatable search input */
        input[type="search"] {
            width: 250px !important;
            background-color: #eee;
            border-radius: 9999px;
            border: none;
            padding-left: 20px;
            padding-right: 15px;
        }

        /* input search cancel button */
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            margin: 0px;
            height: 15px;
            width: 15px;
            background: #d9534f;
            -webkit-mask: url(../imagens/times-solid.svg) center / contain no-repeat;
            cursor: pointer;
            margin-left: 5px;
        }

        /* dataTables CSS modification & positioning */
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc_disabled:before,
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:after {
            content: "" !important;
        }

        table.dataTable thead th.sorting:after,
        table.dataTable thead th.sorting_asc:after,
        table.dataTable thead th.sorting_desc:after {
            top: 12px !important;
            right: 1em !important;
        }

        /* sort icon default */
        table.dataTable thead th.sorting:after {
            font-family: "Font Awesome 5 Free";
            content: "\f0dc" !important;
            font-weight: 900;
        }

        /* sort asc icon */
        table.dataTable thead th.sorting_asc:after {
            font-family: "Font Awesome 5 Free";
            content: "\f0de" !important;
            opacity: 1 !important;
            font-weight: 900;
        }

        /* sort desc icon */
        table.dataTable thead th.sorting_desc:after {
            font-family: "Font Awesome 5 Free";
            content: "\f0dd" !important;
            font-weight: 900;
        }
    </style>
    <script>
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

        // datatable sorting language
        $.fn.dataTable.ext.order.intl("pt-BR");

        $(document).ready(function() {
            $('#data_table').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                // Ordenando por nome
                "order": [
                    [1, "asc"]
                ],
                "fixedHeader": {
                    "header": true,
                    // "footer": true,
                    "headerOffset": $('#navigation_bar').outerHeight()
                },
                "language": {
                    "searchPlaceholder": "Informação do produto",
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Exibindo _MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    }
                }
            });
        });
    </script>
</head>

<body>
    <nav id="navigation_bar" class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
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
                <li class="nav-item px-1">
                    <a class="nav-link" href="../alterar/troca_temporaria.php"><i class="far fa-clock text-white" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="javascript:void(0)"><i class="fas fa-book" style="font-size: 24px; vertical-align: middle; color: #b5651d"></i></a>
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
            <li class="breadcrumb-item asap_regular active"><a href="javascript:void(0)" class="none_li"><i class="fas fa-book"></i> Pesquisar Produto</a></li>
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
            <div id="raphtalia" data-depth="0.8"><img src="../imagens/raphtalia.png" alt="raphtalia" width="60px"></div>
        </div>
        <p class="lead" style="padding-top: 8%; font-size: 40px; text-align: center">Não foi encontrado nenhum produto!</p>
    <?php } else { ?>
        <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
            <h1 class="text-center montara" style="color: #daeff5">Pesquisar Produto</h1>
        </header>
        <main class="container">
            <table id="data_table" class="table table-striped table-hover text-center">
                <thead class="table-warning">
                    <tr>
                        <th class="lead" width="11%"><b>ATHOS</b></th>
                        <th class="lead" width="*"><b>NOME</b></th>
                        <th class="lead" width="10%"><b>NCM</b></th>
                        <th class="lead" width="11.5%"><b>CSOSN</b></th>
                        <th class="lead" width="10%"><b>CFOP</b></th>
                        <th class="lead" width="10%"><b>CEST</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < $num_produtos; $i++) {
                        $vetor_produto = mysqli_fetch_array($pesquisar); ?>
                        <tr>
                            <td><?php echo $vetor_produto['cod_athos'] ?></td>
                            <td style="word-break: break-word"><?php echo $vetor_produto['nome'] ?></td>
                            <td><?php echo $vetor_produto['ncm'] ?></td>
                            <td>
                                <?php if ($vetor_produto['csosn'] == 0) {
                                    echo "–";
                                } else {
                                    echo $vetor_produto['csosn'];
                                } ?>
                            </td>
                            <td>
                                <?php if ($vetor_produto['cfop'] == 0) {
                                    echo "–";
                                } else {
                                    echo $vetor_produto['cfop'];
                                } ?>
                            </td>
                            <td>
                                <?php if ($vetor_produto['cest'] == 0) {
                                    echo "–";
                                } else {
                                    echo $vetor_produto['cest'];
                                } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    <?php } ?>
    <!-- Footer -->
    <?php if ($num_produtos == 0) { ?>
        <footer id="footer1" class="footer" style="margin-bottom: -250px">
            <!-- style="margin-bottom: -100px" -->
        <?php } else { ?>
            <footer id="footer1" class="footer" style="margin-bottom: -250px">
                <!-- style="margin-bottom: -200px" -->
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