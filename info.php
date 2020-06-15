<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | Perguntas Frequentes</title>
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
        <a class="navbar-brand" href="./">
            <img src="imagens/logo.png" alt="logo" width="35px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item px-1">
                    <a class="nav-link" href="./"><i class="fas fa-home" style="font-size: 24px; vertical-align: middle"></i></a>
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
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="#"><i class="fas fa-question-circle text-primary" style="font-size: 24px; vertical-align: middle"></i></a>
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
    <nav aria-label="breadcrumb" style="position: absolute; z-index: 1;">
        <ol class="breadcrumb" style="background: none; margin: 0;">
            <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Página Inicial</a></li>
            <li class="breadcrumb-item active"><a href="#" class="none_li"><i class="fas fa-question-circle"></i> FAQ</a></li>
        </ol>
    </nav>
    <header class="jumbotron" style="background-image: url('imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
        <center>
            <h1 style="color: #daeff5">FAQ</h1>
        </center>
    </header>
    <main class="container">
        <div class="accordion" id="accordionFaq">
            <div class="card">
                <div class="card-header collapsed" id="heading_1" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1" style="cursor: pointer;">
                    <h5 class="accordion-toggle" style="margin: 0px">
                        CFOP/Natureza da Operação
                    </h5>
                </div>
                <div id="collapse_1" class="collapse" aria-labelledby="heading_1" data-parent="#accordionFaq">
                    <div class="card-body" style="padding: 25px">
                        <span class="lead" style="padding-left: 24px"><b>Fora de São Paulo:</b> 6108</span><br>
                        <span class="lead" style="padding-left: 24px"><b>Dentro de São Paulo:</b> O que tiver mais quantidade (5405 ou 5102)</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header collapsed" id="heading_2" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" aria-controls="collapse_2" style="cursor: pointer;">
                    <h5 class="accordion-toggle" style="margin: 0px">
                        Dados adicionais (fora de São Paulo)
                    </h5>
                </div>
                <div id="collapse_2" class="collapse" aria-labelledby="heading_2" data-parent="#accordionFaq">
                    <div class="card-body" style="padding: 25px">
                        <span class="lead" style="padding-left: 24px">Devido a Liminar ADI 5464, as empresas optantes pelo Simples Nacional estão desobrigadas a recolher o imposto DIFAL</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header collapsed" id="heading_3" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" aria-controls="collapse_3" style="cursor: pointer;">
                    <h5 class="accordion-toggle" style="margin: 0px">
                        Código de barras
                    </h5>
                </div>
                <div id="collapse_3" class="collapse" aria-labelledby="heading_3" data-parent="#accordionFaq">
                    <div class="card-body" style="padding: 25px">
                        <span class="lead" style="padding-left: 24px">Se o código de barras iniciar com o número 0, 7, 8 ou 9, é necessário deixar o campo em branco.</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header collapsed" id="heading_4" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true" aria-controls="collapse_4" style="cursor: pointer;">
                    <h5 class="accordion-toggle" style="margin: 0px">
                        Pagamento
                    </h5>
                </div>
                <div id="collapse_4" class="collapse" aria-labelledby="heading_4" data-parent="#accordionFaq">
                    <div class="card-body" style="padding: 25px">
                        <span class="lead" style="padding-left: 24px"><b>Indicador:</b> Pagamento à prazo</span><br>
                        <span class="lead" style="padding-left: 24px"><b>Meio de pagamento:</b> Outros</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- <h5>Fora do estado de São Paulo</h5>
        <span class="lead" style="padding-left: 24px">Devido a Liminar ADI 5464, as empresas optantes pelo Simples Nacional estão desobrigadas a recolher o imposto DIFAL</span> -->
    </main>
    <!-- Footer -->
    <footer id="footer1" class="footer" style="margin-bottom: -250px">
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