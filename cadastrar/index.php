<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | Cadastrar Kit</title>
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <script src="../jquery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../maskmoney/src/jquery.maskMoney.js" type="text/javascript"></script>
    <script>
        function add() {
            var num_input = parseInt($('#total').val()) + 1;
            var new_label_cod_athos = "<label id='label_cod_athos_" + num_input + "' for='cod_athos_" + num_input + "'><b>Código Athos do produto " + num_input + ": </b>";
            var new_label_nome = "<label id='label_produto_" + num_input + "' for='produto_" + num_input + "'><b>Nome do produto " + num_input + ": </b>";
            var new_label_quantidade = "<label id='label_quantidade_" + num_input + "' for='quantidade_" + num_input + "'><b>Quantidade do produto " + num_input + ": </b>";
            var new_label_preco = "<label id='label_preco_" + num_input + "' for='preco_" + num_input + "'><b>Preço do produto " + num_input + ": </b>";
            var new_label_ncm = "<label id='label_ncm_" + num_input + "' for='ncm_" + num_input + "'><b>NCM do produto " + num_input + ": </b>";
            var new_label_cest = "<label id='label_cest_" + num_input + "' for='cest_" + num_input + "'><b>CEST do produto " + num_input + ": </b>";

            var new_input_cod_athos = "<input type='text' class='form-control' id='cod_athos_" + num_input + "' name='cod_athos_" + num_input + "' placeholder='Código Athos do produto " + num_input + "'><div id='div_cod_athos_" + num_input + "' class='invalid-feedback'>Forneça o código Athos do produto " + num_input + "!</div><br class='teste" + num_input + "'>";
            var new_input_nome = "<input type='text' class='form-control' id='produto_" + num_input + "' name='produto_" + num_input + "' placeholder='Nome do produto " + num_input + "'><div id='div_produto_" + num_input + "' class='invalid-feedback'>Forneça o nome do produto " + num_input + "!</div><br class='teste" + num_input + "'>";
            var new_input_quantidade = "<input type='number' class='form-control' id='quantidade_" + num_input + "' name='quantidade_" + num_input + "' placeholder='Quantidade do produto " + num_input + "'><div id='div_quantidade_" + num_input + "' class='invalid-feedback'>Forneça a quantidade do produto " + num_input + "!</div><br class='teste" + num_input + "'>";
            var new_input_preco = "<input type='text' class='form-control' id='preco_" + num_input + "' name='preco_" + num_input + "' placeholder='Preço do produto " + num_input + "'><div id='div_preco_" + num_input + "' class='invalid-feedback'>Forneça o preço do produto " + num_input + "!</div><br class='teste" + num_input + "'>";
            var new_input_ncm = "<input type='number' class='form-control' id='ncm_" + num_input + "' name='ncm_" + num_input + "' placeholder='NCM do produto " + num_input + "'><div id='div_ncm_" + num_input + "' class='invalid-feedback'>Forneça o NCM do produto " + num_input + "!</div><br class='teste" + num_input + "'>";
            var new_input_cest = "<input type='number' class='form-control' id='cest_" + num_input + "' name='cest_" + num_input + "' placeholder='CEST do produto " + num_input + "'><div id='div_cest_" + num_input + "' class='invalid-feedback'></div><br class='teste" + num_input + "'>";

            var new_hr = "<hr class='hr-success' id='hr_" + num_input + "'><br class='teste" + num_input + "'>";

            $('#div_produto_novo').append(new_hr);
            $('#div_produto_novo').append(new_label_cod_athos);
            $('#div_produto_novo').append(new_input_cod_athos);
            $('#div_produto_novo').append(new_label_nome);
            $('#div_produto_novo').append(new_input_nome);
            $('#div_produto_novo').append(new_label_quantidade);
            $('#div_produto_novo').append(new_input_quantidade);
            $('#div_produto_novo').append(new_label_preco);
            $('#div_produto_novo').append(new_input_preco);
            $('#div_produto_novo').append(new_label_ncm);
            $('#div_produto_novo').append(new_input_ncm);
            $('#div_produto_novo').append(new_label_cest);
            $('#div_produto_novo').append(new_input_cest);


            document.getElementById('cod_athos_' + num_input).focus();
            document.getElementById('cod_athos_' + num_input).required = true;
            document.getElementById('produto_' + num_input).required = true;
            document.getElementById('quantidade_' + num_input).required = true;
            document.getElementById('preco_' + num_input).required = true;
            document.getElementById('ncm_' + num_input).required = true;

            $(document).ready(function() {
                $("#preco_" + num_input).maskMoney({
                    prefix: "R$ ",
                    decimal: ",",
                    thousands: "."
                });
            });

            $('#total').val(num_input);
        }

        function remove() {
            var ultimo_num_input = $('#total').val();

            if (ultimo_num_input > 1) {
                $('#label_cod_athos_' + ultimo_num_input).remove();
                $('#cod_athos_' + ultimo_num_input).remove();
                $('#div_cod_athos_' + ultimo_num_input).remove();
                $('#label_produto_' + ultimo_num_input).remove();
                $('#produto_' + ultimo_num_input).remove();
                $('#div_produto_' + ultimo_num_input).remove();
                $('#label_quantidade_' + ultimo_num_input).remove();
                $('#quantidade_' + ultimo_num_input).remove();
                $('#div_quantidade_' + ultimo_num_input).remove();
                $('#label_preco_' + ultimo_num_input).remove();
                $('#preco_' + ultimo_num_input).remove();
                $('#div_preco_' + ultimo_num_input).remove();
                $('#label_ncm_' + ultimo_num_input).remove();
                $('#ncm_' + ultimo_num_input).remove();
                $('#div_ncm_' + ultimo_num_input).remove();
                $('#label_cest_' + ultimo_num_input).remove();
                $('#cest_' + ultimo_num_input).remove();
                $('#div_cest_' + ultimo_num_input).remove();
                $('.teste' + ultimo_num_input).remove();
                $('#hr_' + ultimo_num_input).remove();
                $('#total').val(ultimo_num_input - 1);
            }
        }

        $(document).ready(function() {
            $("#preco_1").maskMoney({
                prefix: "R$ ",
                decimal: ",",
                thousands: "."
            });
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(document).ready(function() {
            $('#nome_do_kit').autocomplete({
                source: "../pesquisar/pesquisar_autocomplete.php",
                minLength: 1,
                select: function(event, ui) {
                    $('#nome_do_kit').val(ui.item.value);
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
    <style>
        #div_botoes {
            border-width: 2px !important;
        }
    </style>
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
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="#"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../excluir/"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <i class="fas fa-info-circle" style="font-size: 24px; color: #5bc0de; vertical-align: middle; margin-right: 15px; cursor: pointer" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<img src='../imagens/example.png' width='130px'>"></i>
            <form class="form-inline my-2 my-lg-0" method="POST" action="../pesquisar/">
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
            <li class="breadcrumb-item active"><a href="#" class="none_li"><i class="fas fa-edit"></i> Cadastrar Kit</a></li>
        </ol>
    </nav>
    <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
        <center>
            <h1 style="color: #daeff5">Cadastrar Kit</h1>
        </center>
    </header>
    <main class="container">
        <!-- <form method="post" action="cadastrar.php" onsubmit="this.submit(); this.reset(); return false;"> -->
        <form method="post" action="cadastrar.php" class="needs-validation" novalidate>
            <div class="input-group input-group-lg" style="margin-bottom: 7px">
                <div class="input-group-prepend">
                    <span class="input-group-text text-success" id="inputGroup-sizing-lg"><b>Nome do kit</b></span>
                </div>
                <input type="text" name="nome_kit" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="Nome do kit" required autofocus>
                <div class="invalid-feedback">
                    Forneça o nome do kit!
                </div>
            </div>
            <div id="div_botoes" class="sticky-top border border-dark rounded" style="float: right; top: 70px; padding: 8px; background-color: white; z-index: 1">
                <i class="fas fa-plus" style="color: green; font-size: 30px; cursor: pointer; margin-right: 13px" onclick="add()" data-toggle="tooltip" data-placement="bottom" title="Adicionar +1 produto"></i>
                <i class="fas fa-times" style="color: red; font-size: 30px; cursor: pointer" onclick="remove()" data-toggle="tooltip" data-placement="bottom" title="Remover último produto"></i>
            </div><br>
            <label for="cod_athos_1">
                <b>Código Athos do produto 1:</b>
            </label>
            <input type="text" id="cod_athos_1" name="cod_athos_1" class="form-control" placeholder="Código Athos do produto 1" required>
            <div class="invalid-feedback">
                Forneça o código Athos do produto 1!
            </div><br>
            <label for="produto_1">
                <b>Nome do produto 1:</b>
            </label>
            <input type="text" id="produto_1" name="produto_1" class="form-control" placeholder="Nome do produto 1" required>
            <div class="invalid-feedback">
                Forneça o nome do produto 1!
            </div><br>
            <label for="quantidade_1">
                <b>Quantidade do produto 1:</b>
            </label>
            <input type="number" id="quantidade_1" name="quantidade_1" class="form-control" placeholder="Quantidade do produto 1" required>
            <div class="invalid-feedback">
                Forneça a quantidade do produto 1!
            </div><br>
            <label for="preco_1">
                <b>Preço do produto 1:</b>
            </label>
            <input type="text" id="preco_1" name="preco_1" class="form-control" placeholder="Preço do produto 1" required>
            <div class="invalid-feedback">
                Forneça o preço do produto 1!
            </div><br>
            <label for="ncm_1">
                <b>NCM do produto 1:</b>
            </label>
            <input type="number" id="ncm_1" name="ncm_1" class="form-control" placeholder="NCM do produto 1" required>
            <div class="invalid-feedback">
                Forneça o NCM do produto 1!
            </div><br>
            <label for="cest_1">
                <b>CEST do produto 1:</b>
            </label>
            <input type="number" id="cest_1" name="cest_1" class="form-control" placeholder="CEST do produto 1">
            <div class="invalid-feedback">
            </div><br>
            <div id="div_produto_novo"></div>
            <input type="hidden" name="total" value="1" id="total">
            <button type="submit" class="btn btn-success" style="float: right">Cadastrar</button>
        </form>
    </main>
    <!-- Footer -->
    <footer class="footer" style="margin-bottom: -250px">
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

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>