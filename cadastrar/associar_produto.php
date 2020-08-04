<?php
require('../externo/connect.php');
$pesquisar_ultimo_cadastro = mysqli_query($connect, "SELECT $kit_nome, $hora_cadastro FROM $kits ORDER BY hora_cadastro DESC limit 1");
$vetor_ultimo = mysqli_fetch_array($pesquisar_ultimo_cadastro);

$pesquisar_todos_kits = mysqli_query($connect, "SELECT kit_nome, id_kit FROM $kits GROUP BY $id_kit ORDER BY $kit_nome");
$numero_kits = mysqli_num_rows($pesquisar_todos_kits);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | Associar Produto</title>
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../externo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="../externo/jquery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="../externo/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../externo/maskmoney/dist/jquery.maskMoney.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-pt_BR.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#form_associar')[0].reset();
        });

        $(document).ready(function() {
            $("#preco").maskMoney({
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

        function alterar(quantidade, preco) {
            //Alterando a mask 
            preco_sem_R$ = preco.replace("R$ ", "");
            preco_ptBR = preco_sem_R$.replace(/\./g, "");
            preco_calculo = preco_ptBR.replace(",", ".");
            // Preço total novo
            preco_total = (quantidade * preco_calculo).toFixed(2).toString();
            // Mostrar preço novo
            document.getElementById('preco_total').value = preco_total;
            document.getElementById('subtotal').innerHTML = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(preco_total);

        }

        // Quando o scroll é feito na janela, esconde o tooltip icone_ultimo_cadastro
        window.onscroll = function(oEvent) {
            $('#icone_ultimo_cadastro').tooltip('hide');
        }

        // Pesquisa os dados do produto a partir do código Athos fornecido
        function pesquisar_produto(num_input) {
            $.ajax({
                method: 'POST',
                url: '../pesquisar/pesquisa_produto.php',
                data: $('#form_associar').serialize(),
                success: function(data) {
                    // Dividindo a data em um array de strings
                    dados_produto = data.split("|");
                    // Preenchendo automaticamente de acordo com o código Athos fornecido
                    // Se o código não existir no banco, os campos não serão preenchidos
                    document.getElementById('produto').value = dados_produto[1].trim();
                    document.getElementById('ncm').value = dados_produto[3].trim();
                    document.getElementById('csosn').value = dados_produto[2].trim();
                    document.getElementById('cfop').value = dados_produto[5].trim();
                    document.getElementById('cest').value = dados_produto[4].trim();

                    // validando inputs
                    validar_inputs();
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }

        // avoiding negative numbers and stuff
        $(document).ready(function() {
            quantidade = document.getElementById('quantidade');
            csosn = document.getElementById('csosn');
            cfop = document.getElementById('cfop');
            cest = document.getElementById('cest');

            // Listen for input event on numInput.
            quantidade.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13)) {
                    return false;
                }
            }
            csosn.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13)) {
                    return false;
                }
            }
            cfop.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13)) {
                    return false;
                }
            }
            cest.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13)) {
                    return false;
                }
            }
        });

        // validador de input
        function validar_inputs() {
            var id_kit = $("#id_kit").val().trim();
            var athos = $("#cod_athos_1").val().trim();
            var nome = $("#produto").val().trim();
            var qtd = $("#quantidade").val().trim();
            var preco = $("#preco").val().trim();
            var ncm = $("#ncm").val().trim();
            var csosn = $("#csosn").val().trim();
            var cfop = $("#cfop").val().trim();

            if (id_kit && athos && nome && qtd && preco && preco != 'R$ 0,00' && ncm && csosn && cfop) {
                document.getElementById('btn_enviar').className = 'btn btn-success';
                document.getElementById('btn_enviar').disabled = false;
                document.getElementById('btn_enviar').style.cursor = 'pointer';
            } else {
                document.getElementById('btn_enviar').className = 'btn btn-danger';
                document.getElementById('btn_enviar').disabled = true;
                document.getElementById('btn_enviar').style.cursor = 'not-allowed';
            }
        }
    </script>
    <style>
        #div_botoes {
            border-width: 2px !important;
        }

        /* data-none-results-text */
        li.no-results {
            padding: .25rem 1.5rem !important;
            margin: 0 !important;
            background-color: transparent !important;
        }

        /* custom cancel button */
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            margin: 0px;
            height: 20px;
            width: 20px;
            background: #d9534f;
            -webkit-mask: url(../imagens/times-solid.svg) center / contain no-repeat;
            cursor: pointer;
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
                <li class="nav-item px-1 dropdown active">
                    <a class="nav-link underline" data-toggle="dropdown" href="javascript:void(0)"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="./"><i class="fas fa-pen text-success" style="padding-right: 5px"></i> Cadastrar Kit</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-link text-secondary" style="padding-right: 5px"></i> Associar produto</a>
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
                <li class="nav-item px-1">
                    <a class="nav-link" href="../produtos/"><i class="fas fa-book" style="font-size: 24px; vertical-align: middle; color: #b5651d"></i></a>
                </li>
                <!-- <li class="nav-item px-1 text-success"><br>
                    R$ <span id="subtotal">0,00</span>
                </li> -->
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
            <li class="breadcrumb-item active"><a href="javascript:void(0)" class="none_li"><i class="fas fa-edit"></i> Associar Produto</a>
                <i id="icone_ultimo_cadastro" class="fas fa-sticky-note text-warning" style="cursor: pointer" data-toggle="tooltip" data-trigger="click hover focus" data-html="true" data-placement="bottom" title="<span class='lead'><b><i class='fas fa-history text-warning'></i> Último cadastro: </b><?php echo $vetor_ultimo['kit_nome'] . "<small> (" . date('d/m/Y H:i:s', strtotime($vetor_ultimo['hora_cadastro'])) . ")</small></span>" ?>"></i>
            </li>
        </ol>
    </nav>
    <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
        <h1 class="text-center montara" style="color: #daeff5">Associar Produto</h1>
    </header>
    <main class="container-fluid">
        <div class="row">
            <div class="col-2" style="padding: 0; max-width: 143px">
                <!-- só pra deixar um espaço -->
            </div>
            <div class="col">
                <!-- <form method="post" action="cadastrar.php" onsubmit="this.submit(); this.reset(); return false;"> -->
                <form id="form_associar" class="needs-validation" method="post" action="associar.php" novalidate onkeyup="validar_inputs()" onchange="validar_inputs()">
                    <div class="form-group">
                        <label for="id_kit">
                            <b>Nome do Kit:</b>
                        </label>
                        <!--  style='padding: 0 17px 0 17px' -->
                        <select id="id_kit" name="id_kit" class="selectpicker show-tick" data-live-search="true" data-width="fit" data-size="6" title="Selecione um kit" data-none-results-text="Nenhum resultado encontrado!" required onchange="validar_inputs()">
                            <?php
                            for ($i = 0; $i < $numero_kits; $i++) {
                                $vetor_kit = mysqli_fetch_array($pesquisar_todos_kits);
                                $nome_kit = $vetor_kit['kit_nome'];
                                $id_kit = $vetor_kit['id_kit'];
                                echo "<option value='" . $id_kit . "'>" . $nome_kit . " (#" . $id_kit . ")</option>";
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Selecione um kit para associar o produto!</div>
                    </div>
                    <div class="form-group">
                        <label for="cod_athos_1">
                            <b>Código Athos do produto:</b>
                        </label>
                        <input type="text" id="cod_athos_1" name="cod_athos_1" class="form-control" placeholder="Código Athos do produto" required onkeyup="pesquisar_produto(1)">
                        <div class="invalid-feedback">
                            Forneça o código Athos do produto!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="produto">
                            <b>Nome do produto:</b>
                        </label>
                        <input type="text" id="produto" name="produto" class="form-control" placeholder="Nome do produto" required>
                        <div class="invalid-feedback">
                            Forneça o nome do produto!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantidade">
                            <b>Quantidade do produto:</b>
                        </label>
                        <input type="number" id="quantidade" name="quantidade" class="form-control" placeholder="Quantidade do produto" required onkeyup="alterar(document.getElementById('quantidade').value, document.getElementById('preco').value)" onchange="alterar(document.getElementById('quantidade').value, document.getElementById('preco').value)" min="1">
                        <div class="invalid-feedback">
                            Forneça a quantidade do produto!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="preco">
                            <b>Preço do produto:</b><input type="hidden" class="form-control" id="preco_total" name="preco_total" value="0.00" readonly>
                        </label>
                        <input type="text" id="preco" name="preco" class="form-control" placeholder="Preço do produto" required onkeyup="alterar(document.getElementById('quantidade').value, document.getElementById('preco').value)">
                        <div class="invalid-feedback">
                            Forneça o preço do produto!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ncm">
                            <b>NCM do produto:</b>
                        </label>
                        <input type="text" id="ncm" name="ncm" class="form-control" placeholder="NCM do produto" required>
                        <div class="invalid-feedback">
                            Forneça o NCM do produto!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="csosn">
                            <b>CSOSN do produto:</b>
                        </label>
                        <input type="number" id="csosn" name="csosn" class="form-control" placeholder="CSOSN do produto" required min="0">
                        <div class="invalid-feedback">
                            Forneça o CSOSN do produto!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cfop">
                            <b>CFOP do produto:</b>
                        </label>
                        <input type="number" id="cfop" name="cfop" class="form-control" placeholder="CFOP do produto" required min="0">
                        <div class="invalid-feedback">
                            Forneça o CFOP do produto!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cest">
                            <b>CEST do produto:</b>
                        </label>
                        <input type="number" id="cest" name="cest" class="form-control" placeholder="CEST do produto" min="0">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="atual" value="1" id="atual">
                    <input type="hidden" class="form-control" name="total" value="1" id="total">
                    <button id="btn_enviar" type="submit" class="btn btn-success" style="float: right">Associar</button>
                </form>
            </div>
            <div class="col-1" style="padding-left: 0; max-width: 136px">
                <div class="card border-success sticky-top" style="width: 121px; top: 70px; bottom: 10px; left: 0; right: 0; z-index: 1">
                    <!-- width: 108px -->
                    <div class="card-footer text-success">
                        <h5 class="card-title text-center" style="margin: 0">Total:</h5>
                        <p class="card-text text-center lead" style="margin: 0 -12px 0px -12px; font-size: 18px"><span id="subtotal">R$ 0,00</span></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer" style="margin-bottom: -250px">
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
                            // button css
                            document.getElementById('btn_enviar').className = 'btn btn-danger';
                            document.getElementById('btn_enviar').disabled = true;
                            document.getElementById('btn_enviar').style.cursor = 'not-allowed';

                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // onkeyup validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('keyup', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // onchange validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('change', function(event) {
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