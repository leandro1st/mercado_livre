<?php
require('../externo/connect.php');
$pesquisar_ultimo_cadastro = mysqli_query($connect, "SELECT $kit_nome, $hora_cadastro FROM $kits ORDER BY hora_cadastro DESC limit 1");
$vetor_ultimo = mysqli_fetch_array($pesquisar_ultimo_cadastro);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | Cadastrar Kit</title>
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../externo/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <script src="../externo/jquery/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="../externo/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../externo/maskmoney/dist/jquery.maskMoney.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#form_cadastrar')[0].reset();
            $('label').addClass('asap_bold');
        });

        function add() {
            var num_input = parseInt($('#total').val()) + 1;
            var new_label_cod_athos = "<div id='div_form_cod_athos_" + num_input + "' class='form-group'><label id='label_cod_athos_" + num_input + "' for='cod_athos_" + num_input + "'><b>Código Athos do produto " + num_input + ": </b></label><input type='text' class='form-control' id='cod_athos_" + num_input + "' name='cod_athos_" + num_input + "' placeholder='Código Athos do produto " + num_input + "' onkeyup='pesquisar_produto(" + num_input + ")'><div id='div_cod_athos_" + num_input + "' class='invalid-feedback'>Forneça o código Athos do produto " + num_input + "!</div></div>";
            var new_label_nome = "<div id='div_form_produto_" + num_input + "' class='form-group'><label id='label_produto_" + num_input + "' for='produto_" + num_input + "'><b>Nome do produto " + num_input + ": </b></label><input type='text' class='form-control' id='produto_" + num_input + "' name='produto_" + num_input + "' placeholder='Nome do produto " + num_input + "'><div id='div_produto_" + num_input + "' class='invalid-feedback'>Forneça o nome do produto " + num_input + "!</div></div>";
            var new_label_quantidade = "<div id='div_form_quantidade_" + num_input + "' class='form-group'><label id='label_quantidade_" + num_input + "' for='quantidade_" + num_input + "'><b>Quantidade do produto " + num_input + ": </b></label><input min='1' type='number' class='form-control' id='quantidade_" + num_input + "' name='quantidade_" + num_input + "' placeholder='Quantidade do produto " + num_input + "' onkeyup='alterar(" + num_input + ", document.getElementById(`quantidade_" + num_input + "`).value, document.getElementById(`preco_" + num_input + "`).value)'><div id='div_quantidade_" + num_input + "' class='invalid-feedback'>Forneça a quantidade do produto " + num_input + "!</div></div>";
            var new_label_preco = "<div id='div_form_preco_" + num_input + "' class='form-group'><label id='label_preco_" + num_input + "' for='preco_" + num_input + "'><b>Preço do produto " + num_input + ": </b><input type='hidden' class='form-control' id='preco_total_" + num_input + "' value='0.00' readonly></label><input type='text' class='form-control' id='preco_" + num_input + "' name='preco_" + num_input + "' placeholder='Preço do produto " + num_input + "' onkeyup='alterar(" + num_input + ", document.getElementById(`quantidade_" + num_input + "`).value, document.getElementById(`preco_" + num_input + "`).value)'><div id='div_preco_" + num_input + "' class='invalid-feedback'>Forneça o preço do produto " + num_input + "!</div></div>";
            var new_label_ncm = "<div id='div_form_ncm_" + num_input + "' class='form-group'><label id='label_ncm_" + num_input + "' for='ncm_" + num_input + "'><b>NCM do produto " + num_input + ": </b></label><input type='text' class='form-control' id='ncm_" + num_input + "' name='ncm_" + num_input + "' placeholder='NCM do produto " + num_input + "'><div id='div_ncm_" + num_input + "' class='invalid-feedback'>Forneça o NCM do produto " + num_input + "!</div></div>";
            var new_label_csosn = "<div id='div_form_csosn_" + num_input + "' class='form-group'><label id='label_csosn_" + num_input + "' for='csosn_" + num_input + "'><b>CSOSN do produto " + num_input + ": </b></label><input min='0' type='number' class='form-control' id='csosn_" + num_input + "' name='csosn_" + num_input + "' placeholder='CSOSN do produto " + num_input + "'><div id='div_csosn_" + num_input + "' class='invalid-feedback'>Forneça o CSOSN do produto " + num_input + "!</div></div>";
            var new_label_cfop = "<div id='div_form_cfop_" + num_input + "' class='form-group'><label id='label_cfop_" + num_input + "' for='cfop_" + num_input + "'><b>CFOP do produto " + num_input + ": </b></label><input min='0' type='number' class='form-control' id='cfop_" + num_input + "' name='cfop_" + num_input + "' placeholder='CFOP do produto " + num_input + "'><div id='div_cfop_" + num_input + "' class='invalid-feedback'>Forneça o CFOP do produto " + num_input + "!</div></div>";
            var new_label_cest = "<div id='div_form_cest_" + num_input + "' class='form-group'><label id='label_cest_" + num_input + "' for='cest_" + num_input + "'><b>CEST do produto " + num_input + ": </b></label><input min='0' type='number' class='form-control' id='cest_" + num_input + "' name='cest_" + num_input + "' placeholder='CEST do produto " + num_input + "'><div id='div_cest_" + num_input + "' class='invalid-feedback'></div></div>";


            // var new_input_cod_athos = "";
            // var new_input_nome = "";
            // var new_input_quantidade = "";
            // var new_input_preco = "";
            // var new_input_ncm = "";
            // var new_input_cest = "";

            var new_hr = "<hr class='hr-success' id='hr_" + num_input + "'>";

            $('#div_produto_novo').append(new_hr);
            $('#div_produto_novo').append(new_label_cod_athos);
            // $('#div_produto_novo').append(new_input_cod_athos);
            $('#div_produto_novo').append(new_label_nome);
            // $('#div_produto_novo').append(new_input_nome);
            $('#div_produto_novo').append(new_label_quantidade);
            // $('#div_produto_novo').append(new_input_quantidade);
            $('#div_produto_novo').append(new_label_preco);
            // $('#div_produto_novo').append(new_input_preco);
            $('#div_produto_novo').append(new_label_ncm);
            // $('#div_produto_novo').append(new_input_ncm);
            $('#div_produto_novo').append(new_label_csosn);
            // $('#div_produto_novo').append(new_input_csosn);
            $('#div_produto_novo').append(new_label_cfop);
            // $('#div_produto_novo').append(new_input_cfop);
            $('#div_produto_novo').append(new_label_cest);
            // $('#div_produto_novo').append(new_input_cest);


            document.getElementById('cod_athos_' + num_input).focus();
            document.getElementById('cod_athos_' + num_input).required = true;
            document.getElementById('produto_' + num_input).required = true;
            document.getElementById('quantidade_' + num_input).required = true;
            document.getElementById('preco_' + num_input).required = true;
            document.getElementById('ncm_' + num_input).required = true;
            document.getElementById('csosn_' + num_input).required = true;
            document.getElementById('cfop_' + num_input).required = true;

            // avoiding negative numbers and stuff
            quantidade = document.getElementById('quantidade_' + num_input);
            csosn = document.getElementById('csosn_' + num_input);
            cfop = document.getElementById('cfop_' + num_input);
            cest = document.getElementById('cest_' + num_input);

            // Listen for input event on numInput.
            quantidade.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }
            csosn.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }
            cfop.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }
            cest.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }

            $(document).ready(function() {
                $("#preco_" + num_input).maskMoney({
                    prefix: "R$ ",
                    decimal: ",",
                    thousands: "."
                });
            });

            $('#total').val(num_input);

            // appending new anchor link to nav_links
            new_anchor = '<a id="link_produto_' + num_input + '" class="nav-link asap_regular" href="#label_cod_athos_' + num_input + '" style="word-break: break-word">Produto ' + num_input + '</a>';
            $('#nav_links').append(new_anchor);

            // adjusting scrolltop when anchor link is clicked
            $(document).ready(function() {
                $("a[href^='#']").on('click', function(event) {
                    // store hash
                    var target = this.hash;

                    // Keep URL unaffected when anchor link is clicked
                    event.preventDefault();

                    // navbar height
                    var navOffset = document.getElementById('navigation_bar').clientHeight;

                    // animate
                    return $('html, body').animate({
                        scrollTop: $(this.hash).offset().top - navOffset
                    }, 0, function() {
                        return false;
                        // when done, add hash to url
                        // (default click behaviour)
                        // return window.history.pushState(null, null, target);
                    });
                });
            });

            // validando inputs
            validar_inputs();
            $('label').addClass('asap_bold');
        }

        function remove() {
            var ultimo_num_input = $('#total').val();

            if (ultimo_num_input > 1) {
                $('#div_form_cod_athos_' + ultimo_num_input).remove();
                $('#label_cod_athos_' + ultimo_num_input).remove();
                $('#cod_athos_' + ultimo_num_input).remove();
                $('#div_cod_athos_' + ultimo_num_input).remove();
                $('#div_form_produto_' + ultimo_num_input).remove();
                $('#label_produto_' + ultimo_num_input).remove();
                $('#produto_' + ultimo_num_input).remove();
                $('#div_produto_' + ultimo_num_input).remove();
                $('#div_form_quantidade_' + ultimo_num_input).remove();
                $('#label_quantidade_' + ultimo_num_input).remove();
                $('#quantidade_' + ultimo_num_input).remove();
                $('#div_quantidade_' + ultimo_num_input).remove();
                $('#div_form_preco_' + ultimo_num_input).remove();
                $('#label_preco_' + ultimo_num_input).remove();
                $('#preco_' + ultimo_num_input).remove();
                $('#div_preco_' + ultimo_num_input).remove();
                $('#div_form_ncm_' + ultimo_num_input).remove();
                $('#label_ncm_' + ultimo_num_input).remove();
                $('#ncm_' + ultimo_num_input).remove();
                $('#div_ncm_' + ultimo_num_input).remove();
                $('#div_form_csosn_' + ultimo_num_input).remove();
                $('#label_csosn_' + ultimo_num_input).remove();
                $('#csosn_' + ultimo_num_input).remove();
                $('#div_csosn_' + ultimo_num_input).remove();
                $('#div_form_cfop_' + ultimo_num_input).remove();
                $('#label_cfop_' + ultimo_num_input).remove();
                $('#cfop_' + ultimo_num_input).remove();
                $('#div_cfop_' + ultimo_num_input).remove();
                $('#div_form_cest_' + ultimo_num_input).remove();
                $('#label_cest_' + ultimo_num_input).remove();
                $('#cest_' + ultimo_num_input).remove();
                $('#div_cest_' + ultimo_num_input).remove();
                // $('.teste' + ultimo_num_input).remove();
                $('#hr_' + ultimo_num_input).remove();
                $('#total').val(ultimo_num_input - 1);
            }
            // Cálculo do preço total
            soma = 0.00;
            if (ultimo_num_input == 1) {
                for (x = 1; x <= ultimo_num_input; x++) {
                    preco = parseFloat(document.getElementById('preco_total_' + x).value);
                    soma += preco;
                }
            } else {
                for (x = 1; x < ultimo_num_input; x++) {
                    preco = parseFloat(document.getElementById('preco_total_' + x).value);
                    soma += preco;
                }
            }
            document.getElementById('subtotal').innerHTML = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(soma);

            // removing last anchor link from nav_links if the last input value != 1
            if (ultimo_num_input != 1) {
                $('#link_produto_' + ultimo_num_input).remove();
            }

            // validando inputs
            validar_inputs();
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

        function alterar(num_input, quantidade, preco) {
            var ultimo_num_input = $('#total').val();
            //Alterando a mask 
            preco_sem_R$ = preco.replace("R$ ", "");
            preco_ptBR = preco_sem_R$.replace(/\./g, "");
            preco_calculo = preco_ptBR.replace(",", ".");
            // Preço total novo
            preco_total = (quantidade * preco_calculo).toFixed(2).toString();
            // Mostrar preço novo
            document.getElementById('preco_total_' + num_input).value = preco_total;
            // Cálculo do preço total
            soma = 0.00;
            for (x = 1; x <= ultimo_num_input; x++) {
                preco = parseFloat(document.getElementById('preco_total_' + x).value);
                soma += preco;
            }
            document.getElementById('subtotal').innerHTML = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(soma);
        }

        // Quando o scroll é feito na janela, esconde o tooltip icone_ultimo_cadastro
        window.onscroll = function(oEvent) {
            $('#icone_ultimo_cadastro').tooltip('hide');
        }

        // Pesquisa os dados do produto a partir do código Athos fornecido
        function pesquisar_produto(num_input) {
            // Atualizando o valor do input 'atual' (codigo athos atual) para enviar via post
            document.getElementById('atual').value = num_input;
            $.ajax({
                method: 'POST',
                url: '../pesquisar/pesquisa_produto.php',
                data: $('#form_cadastrar').serialize(),
                success: function(data) {
                    // Dividindo a data em um array de strings
                    dados_produto = data.split("|");
                    // Preenchendo automaticamente de acordo com o código Athos fornecido
                    // Se o código não existir no banco, os campos não serão preenchidos
                    document.getElementById('produto_' + num_input).value = dados_produto[1].trim();
                    document.getElementById('ncm_' + num_input).value = dados_produto[3].trim();
                    document.getElementById('csosn_' + num_input).value = dados_produto[2].trim();
                    document.getElementById('cfop_' + num_input).value = dados_produto[5].trim();
                    document.getElementById('cest_' + num_input).value = dados_produto[4].trim();

                    // Verificando se o campo código athos está preenchido
                    // Se estiver, atualiza o nome do 'link' deste produto
                    if (document.getElementById('cod_athos_' + num_input).value.trim()) {
                        $('#link_produto_' + num_input).html($('#cod_athos_' + num_input).val().trim());
                    } else {
                        // Senão retorna ao valor original
                        $('#link_produto_' + num_input).html("Produto " + num_input);
                    }

                    // validando inputs
                    validar_inputs();
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        }

        // comparing values from (label_cod_athos - navigation_bar height) and window scroll position
        // $(document).on('scroll', function() {
        //     if (window.scrollY >= $('#label_cod_athos_1').offset().top - document.getElementById('navigation_bar').clientHeight) {
        //         // alert(document.getElementById('navigation_bar').clientHeight);
        //     }
        // })

        // setting the location hash to an empty string
        window.onload = function() {
            document.location.hash = "";
        }

        // scrollspy
        $(document).ready(function() {
            $("body").scrollspy({
                target: "#navbar_scroll",
                offset: document.getElementById('navigation_bar').clientHeight
            })
        });

        // adjusting scrolltop when anchor link is clicked
        $(document).ready(function() {
            $("a[href^='#']").on('click', function(event) {
                // store hash
                var target = this.hash;

                // Keep URL unaffected when anchor link is clicked
                event.preventDefault();

                // navbar height
                var navOffset = document.getElementById('navigation_bar').clientHeight;

                // animate
                return $('html, body').animate({
                    scrollTop: $(this.hash).offset().top - navOffset
                }, 0, function() {
                    return false;
                    // when done, add hash to url
                    // (default click behaviour)
                    // return window.history.pushState(null, null, target);
                });
            });
        });

        // avoiding negative numbers and stuff
        $(document).ready(function() {
            quantidade = document.getElementById('quantidade_1');
            csosn = document.getElementById('csosn_1');
            cfop = document.getElementById('cfop_1');
            cest = document.getElementById('cest_1');

            // Listen for input event on numInput.
            quantidade.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }
            csosn.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }
            cfop.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }
            cest.onkeydown = function(e) {
                // allowing only numbers, backspace, tab, f5, f6, delete, arrows, enter, c, x, v
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 ||
                        e.keyCode == 9 ||
                        e.keyCode == 116 ||
                        e.keyCode == 117 ||
                        e.keyCode == 46 ||
                        (e.keyCode > 36 && e.keyCode < 41) ||
                        e.keyCode == 13 ||
                        e.keyCode == 67 ||
                        e.keyCode == 88 ||
                        e.keyCode == 86)) {
                    return false;
                }
            }
        });

        // validando o form
        function validar_inputs() {
            var total = $("#total").val();
            var array_flags = [];

            for (i = 1; i <= total; i++) {
                var nome_kit = $("#nome_kit").val().trim();
                var athos = $("#cod_athos_" + i).val().trim();
                var nome = $("#produto_" + i).val().trim();
                var qtd = $("#quantidade_" + i).val().trim();
                var preco = $("#preco_" + i).val().trim();
                var ncm = $("#ncm_" + i).val().trim();
                var csosn = $("#csosn_" + i).val().trim();
                var cfop = $("#cfop_" + i).val().trim();

                // o campo do preço tem estar preenchido e ser diferente da mask ao mesmo tempo
                if (nome_kit && athos && nome && qtd && preco && preco != 'R$ 0,00' && ncm && csosn && cfop) {
                    array_flags.push(true);
                } else {
                    array_flags.push(false);
                }
            }

            // alert(array_flags.every(Boolean));

            // checking if all values in array_flags are true
            if (array_flags.every(Boolean)) {
                document.getElementById('btn_enviar').className = 'btn btn-success asap_regular';
                document.getElementById('btn_enviar').disabled = false;
                document.getElementById('btn_enviar').style.cursor = 'pointer';
            } else {
                document.getElementById('btn_enviar').className = 'btn btn-danger asap_regular';
                document.getElementById('btn_enviar').disabled = true;
                document.getElementById('btn_enviar').style.cursor = 'not-allowed';
            }
        }
    </script>
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* scrollspy */
        body {
            position: relative !important;
        }

        #div_botoes {
            border-width: 2px !important;
        }

        .nav-link.active {
            background-color: #5bc0de !important;
        }
    </style>
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
                <li class="nav-item px-1 dropdown active">
                    <a class="nav-link underline" data-toggle="dropdown" href="javascript:void(0)"><i class="fas fa-edit text-success" style="font-size: 24px; vertical-align: middle"></i></a>
                    <ul class="dropdown-menu asap_regular">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="fas fa-pen text-success" style="padding-right: 5px"></i> Cadastrar Kit</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="associar.php"><i class="fas fa-link text-secondary" style="padding-right: 5px"></i> Associar Produto</a>
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
            <li class="breadcrumb-item asap_regular active"><a href="javascript:void(0)" class="none_li"><i class="fas fa-edit"></i> Cadastrar Kit</a>
                <i id="icone_ultimo_cadastro" class="fas fa-sticky-note text-warning" style="cursor: pointer" data-toggle="tooltip" data-trigger="click hover focus" data-html="true" data-placement="bottom" title="<span class='lead'><b><i class='fas fa-history text-warning'></i> Último cadastro: </b><?php echo $vetor_ultimo['kit_nome'] . "<small> (" . date('d/m/Y H:i:s', strtotime($vetor_ultimo['hora_cadastro'])) . ")</small></span>" ?>"></i>
            </li>
        </ol>
    </nav>
    <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
        <h1 class="text-center montara" style="color: #daeff5">Cadastrar Kit</h1>
    </header>
    <main class="container-fluid">
        <div class="row">
            <div class="col-2" style="padding: 0; max-width: 143px">
                <div class="" style="position: sticky; top: 70px;">
                    <nav id="navbar_scroll" class="navbar navbar-light bg-light" style="border-radius: 0 10px 10px 0;">
                        <nav id="nav_links" class="nav nav-pills flex-column">
                            <a id="link_produto_1" class="nav-link asap_regular" href="#label_cod_athos_1" style="word-break: break-word; width: 111px">Produto 1</a>
                        </nav>
                    </nav>
                </div>
            </div>
            <div id="scrollspy" class="col" data-spy="scroll" data-target="#navbar_scroll">
                <!-- <form method="post" action="cadastrar.php" onsubmit="this.submit(); this.reset(); return false;"> -->
                <form id="form_cadastrar" class="needs-validation" method="post" action="cadastrar.php" novalidate onkeyup="validar_inputs()" onchange="validar_inputs()">
                    <div class="form-group">
                        <div class="input-group input-group-lg" style="margin-bottom: -12px">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-success asap_bold" id="inputGroup-sizing-lg"><b>Nome do kit</b></span>
                            </div>
                            <input type="text" id="nome_kit" name="nome_kit" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" placeholder="Nome do kit" required autofocus style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem">
                            <div class="invalid-feedback" style="margin-left: 150px">
                                Forneça o nome do kit!
                            </div>
                        </div>
                    </div>
                    <div id="div_botoes" class="sticky-top border border-dark rounded" style="float: right; top: 70px; padding: 8px; background-color: white; z-index: 1">
                        <!-- white space = 0.25em = 4px -->
                        <i class="fas fa-plus" style="color: green; font-size: 30px; cursor: pointer; margin-right: 17px" onclick="add()" data-toggle="tooltip" data-placement="bottom" title="Adicionar +1 produto"></i><i class="fas fa-times" style="color: red; font-size: 30px; cursor: pointer" onclick="remove()" data-toggle="tooltip" data-placement="bottom" title="Remover último produto"></i>
                    </div>

                    <div class="form-group">
                        <label id="label_cod_athos_1" for="cod_athos_1" style="margin-top: 1.5rem">
                            <b>Código Athos do produto 1:</b>
                        </label>
                        <input type="text" id="cod_athos_1" name="cod_athos_1" class="form-control" placeholder="Código Athos do produto 1" required onkeyup="pesquisar_produto(1)">
                        <div class="invalid-feedback">
                            Forneça o código Athos do produto 1!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="produto_1">
                            <b>Nome do produto 1:</b>
                        </label>
                        <input type="text" id="produto_1" name="produto_1" class="form-control" placeholder="Nome do produto 1" required>
                        <div class="invalid-feedback">
                            Forneça o nome do produto 1!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantidade_1">
                            <b>Quantidade do produto 1:</b>
                        </label>
                        <input type="number" id="quantidade_1" name="quantidade_1" class="form-control" placeholder="Quantidade do produto 1" required onkeyup="alterar(1, document.getElementById('quantidade_1').value, document.getElementById('preco_1').value)" onchange="alterar(1, document.getElementById('quantidade_1').value, document.getElementById('preco_1').value)" min="1">
                        <div class="invalid-feedback">
                            Forneça a quantidade do produto 1!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="preco_1">
                            <b>Preço do produto 1:</b><input type="hidden" class="form-control" id="preco_total_1" value="0.00" readonly>
                        </label>
                        <input type="text" id="preco_1" name="preco_1" class="form-control" placeholder="Preço do produto 1" required onkeyup="alterar(1, document.getElementById('quantidade_1').value, document.getElementById('preco_1').value)">
                        <div class="invalid-feedback">
                            Forneça o preço do produto 1!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ncm_1">
                            <b>NCM do produto 1:</b>
                        </label>
                        <input type="text" id="ncm_1" name="ncm_1" class="form-control" placeholder="NCM do produto 1" required>
                        <div class="invalid-feedback">
                            Forneça o NCM do produto 1!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="csosn_1">
                            <b>CSOSN do produto 1:</b>
                        </label>
                        <input type="number" id="csosn_1" name="csosn_1" class="form-control" placeholder="CSOSN do produto 1" required min="0">
                        <div class="invalid-feedback">
                            Forneça o CSOSN do produto 1!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cfop_1">
                            <b>CFOP do produto 1:</b>
                        </label>
                        <input type="number" id="cfop_1" name="cfop_1" class="form-control" placeholder="CFOP do produto 1" required min="0">
                        <div class="invalid-feedback">
                            Forneça o CFOP do produto 1!
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cest_1">
                            <b>CEST do produto 1:</b>
                        </label>
                        <input type="number" id="cest_1" name="cest_1" class="form-control" placeholder="CEST do produto 1" min="0">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div id="div_produto_novo"></div>
                    <input type="hidden" class="form-control" name="atual" value="1" id="atual">
                    <input type="hidden" class="form-control" name="total" value="1" id="total">
                    <button id="btn_enviar" type="submit" class="btn btn-success asap_regular" style="float: right">Cadastrar</button>
                </form>
            </div>
            <div class="col-1" style="padding-left: 0; max-width: 136px">
                <div class="card border-success sticky-top" style="width: 121px; top: 70px; bottom: 10px; left: 0; right: 0; z-index: 1">
                    <!-- width: 108px -->
                    <div class="card-footer text-success">
                        <h5 class="card-title text-center asap_bold" style="margin: 0">Total:</h5>
                        <p class="card-text text-center lead asap_regular" style="margin: 0 -12px 0px -12px; font-size: 18px"><span id="subtotal">R$ 0,00</span></p>
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
        <div class="text-center asap_regular" style="background-color: #323741; padding: 16px; color: #dddddd">©
            2020 Copyright –
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
                            document.getElementById('btn_enviar').className = 'btn btn-danger asap_regular';
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