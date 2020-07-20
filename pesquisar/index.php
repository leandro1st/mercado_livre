<?php
if (isset($_POST['nome_do_kit'])) {
    require('../externo/connect.php');

    $nome_kit_post = trim($_POST['nome_do_kit']);
    $procurar = mysqli_query($connect, "SELECT * FROM $kits WHERE $id_kit = '$nome_kit_post' ORDER BY $nome");/* or $kit_nome = '$nome_kit_post' */
    $procurar_para_alterar_valores_vetor_javascript = mysqli_query($connect, "SELECT * FROM $kits WHERE $id_kit = '$nome_kit_post' ORDER BY $nome");/* or $kit_nome = '$nome_kit_post' */
    $num_kits = mysqli_num_rows($procurar);
    // Outra query e vetor pra exibir nome e id do kit
    $mostrar_nome_kit = mysqli_query($connect, "SELECT $kit_nome, $id_kit FROM $kits WHERE $id_kit = '$nome_kit_post' ORDER BY $nome");/* or $kit_nome like '%" . $nome_kit_post . "%' */
    $vetor_mostrar_nome_kit = mysqli_fetch_array($mostrar_nome_kit);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title id="nome_kit_html">
            <?php if ($nome_kit_post == '' || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $nome_kit_post)) { ?>
                Mercado Livre | Pesquisar
            <?php } else if ($num_kits == 0) { ?>
                Mercado Livre | <?php echo $nome_kit_post ?>
            <?php } else { ?>
                Mercado Livre | <?php echo $vetor_mostrar_nome_kit['kit_nome'] ?> (#<?php echo $vetor_mostrar_nome_kit['id_kit'] ?>)
            <?php } ?>
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
        <script src="../externo/maskmoney/dist/jquery.maskMoney.min.js" type="text/javascript"></script>
        <style>
            #img_nothing {
                /* position: absolute !important; */
                left: 50% !important;
                margin-left: -209px !important;
                top: 50% !important;
                margin-top: -92px !important;
            }

            #megumin {
                position: absolute !important;
                left: 50% !important;
                margin-left: -30px !important;
                top: 55% !important;
            }

            .bs-tooltip-top {
                margin-bottom: 4px;
            }

            .button_border {
                border-width: 3px !important;
            }

            .btn-outline-warning {
                color: #daeff5 !important;
            }

            .btn-outline-warning:hover {
                color: #000000 !important;
            }

            .highlight {
                background-color: #ACCEF7 !important;
            }

            .highlight_td {
                background-color: #F8D8B1 !important;
            }
        </style>
        <script>
            // alert($(window).width());
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });

            // Função para alterar o preço antigo
            function texto_input(id_produto) {
                // overriding class 'clickable' click event, removing highlight from rows, columns
                $('.clickable').off('click');
                $('td').removeClass('highlight_td');
                $('tr').removeClass('highlight');

                // Código Athos
                document.getElementById('athos-' + id_produto + '').innerHTML = '';
                document.getElementById('input_athos-' + id_produto).type = 'text';
                document.getElementById('input_athos-' + id_produto).focus();
                // Resentando o valor do input, pois o cursor estava começando da direita
                var copia_athos = document.getElementById('input_athos-' + id_produto).value;
                document.getElementById('input_athos-' + id_produto).value = '';
                document.getElementById('input_athos-' + id_produto).value = copia_athos;

                // Nome
                document.getElementById('nome-' + id_produto + '').innerHTML = '';
                document.getElementById('input_nome-' + id_produto).type = 'text';

                // Quantidade
                document.getElementById('quantidade-' + id_produto + '').innerHTML = '';
                document.getElementById('input_quantidade-' + id_produto).type = 'number';

                // Alterando o conteúdo de preco-x e mostrando input para modificar o preço
                document.getElementById('preco-' + id_produto + '').innerHTML = '';
                document.getElementById('input_preco-' + id_produto).type = 'text';

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
                document.getElementById('icone_confirmar-' + id_produto + '').style.cssText = 'color: green; font-size: 24px; opacity: 1; pointer-events: auto';

                // Ícone deletar produto
                document.getElementById('icone_excluir-' + id_produto + '').style.cursor = 'not-allowed';
                document.getElementById('span_excluir-' + id_produto + '').style.cssText = 'opacity: .5; pointer-events: none';

                // Currency mask 
                $(document).ready(function() {
                    $('#input_preco-' + id_produto).maskMoney({
                        prefix: "R$ ",
                        decimal: ",",
                        thousands: ".",
                    });
                });
            }

            // Função para alterar mask, enviar valores através do ajax, alterar valores de exibição do preço unitário/total do produto
            function alterar_info(id_produto, preco_novo, nome, quantidade, cod_athos, ncm, csosn, cfop, cest) {
                a = document.getElementById('input_athos-' + id_produto).value.trim();
                n = document.getElementById('input_nome-' + id_produto).value.trim();
                q = document.getElementById('input_quantidade-' + id_produto).value.trim();
                p = document.getElementById('input_preco-' + id_produto).value.trim();
                nc = document.getElementById('input_ncm-' + id_produto).value.trim();
                c = document.getElementById('input_csosn-' + id_produto).value.trim();
                cf = document.getElementById('input_cfop-' + id_produto).value.trim();
                ce = document.getElementById('input_cest-' + id_produto).value.trim();

                values = [a, n, q, p, nc, c, cf]
                fields = ["Código Athos", "Nome", "Quantidade", "Preço", "NCM", "CSOSN", "CFOP"]
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
                    // overriding class 'clickable' click event
                    // not highlighting when clicking on one of last 3 columns (td)
                    $('.clickable').off('click').on('click', function(event) {
                        // alert(this.className);
                        // remove previous parent (tr) highlight class 
                        if ($(this).parent().hasClass('highlight')) {
                            // $(this).parent().removeClass('highlight');

                            // remove selected td class (highlight_td)
                            if ($(this).hasClass('highlight_td')) {
                                $(this).removeClass('highlight_td');
                                // adding class to selected td (highlight_td)
                            } else {
                                $(this).addClass('highlight_td');
                            }

                            // remove class 'highlight'/'highlightd' if selected td text == first cell of given row text
                            if ($(this).text().trim() == $(this).closest('tr').find('td:first').text().trim()) {
                                // alert($(this).closest('tr').find('td:first').text().trim());
                                $(this).parent().removeClass('highlight');
                                // remove highlight from all columns
                                $(this).removeClass('highlight_td').siblings().removeClass('highlight_td');
                            }
                        } else {
                            // highlight clicked row (parent) and remove class 'highlight' from siblings (tbody tr)
                            // $(this).parent().addClass('highlight').siblings().removeClass('highlight');
                            // highlight multiple rows
                            $(this).parent().addClass('highlight');
                            // td highlight
                            $(this).addClass('highlight_td');
                        }
                    });

                    //Alterando a mask
                    preco_novo = preco_novo.replace("R$ ", "");
                    preco_novo_ptBR = preco_novo.replace(/\./g, "");
                    preco_novo_calculo = preco_novo_ptBR.replace(",", ".");
                    preco_novo_span = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(preco_novo_calculo);
                    // Preço total novo
                    preco_total_novo = (quantidade * preco_novo_calculo).toFixed(2).toString();
                    preco_total_novo_ptBR = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(preco_total_novo);
                    // Mostrar preço novo
                    var span_preco = "<span id='preco-" + id_produto + "'>" + preco_novo_span + "</span>";
                    $.ajax({
                        method: 'POST',
                        url: '../alterar/alterar.php',
                        data: $('#form-' + id_produto).serialize(),
                        success: function(data) {
                            // Alterando os valores dos inputs do modal
                            document.getElementById('nome_produto_modal').innerHTML = nome.toUpperCase();

                            document.getElementById('athos_antigo_modal').innerHTML = document.getElementById('athos_modal-' + id_produto).value;
                            document.getElementById('athos_novo_modal').innerHTML = cod_athos;

                            document.getElementById('nome_antigo_modal').innerHTML = document.getElementById('nome_modal-' + id_produto).value;
                            document.getElementById('nome_novo_modal').innerHTML = nome.toUpperCase();

                            document.getElementById('quantidade_antigo_modal').innerHTML = document.getElementById('quantidade_modal-' + id_produto).value;
                            document.getElementById('quantidade_novo_modal').innerHTML = quantidade;

                            document.getElementById('preco_antigo_modal').innerHTML = document.getElementById('preco_velho-' + id_produto).value;
                            document.getElementById('preco_novo_modal').innerHTML = preco_novo_span;

                            document.getElementById('ncm_antigo_modal').innerHTML = document.getElementById('ncm_modal-' + id_produto).value;
                            document.getElementById('ncm_novo_modal').innerHTML = ncm.toUpperCase();

                            // csosn antigo
                            if (document.getElementById('csosn_modal-' + id_produto).value != "0") {
                                document.getElementById('csosn_antigo_modal').innerHTML = document.getElementById('csosn_modal-' + id_produto).value;
                            } else {
                                document.getElementById('csosn_antigo_modal').innerHTML = "–";
                            }
                            // csosn novo
                            if (csosn == "0" || csosn == "") {
                                document.getElementById('csosn_novo_modal').innerHTML = "–";
                            } else {
                                document.getElementById('csosn_novo_modal').innerHTML = csosn;
                            }

                            // cfop antigo
                            if (document.getElementById('cfop_modal-' + id_produto).value != "0") {
                                document.getElementById('cfop_antigo_modal').innerHTML = document.getElementById('cfop_modal-' + id_produto).value;
                            } else {
                                document.getElementById('cfop_antigo_modal').innerHTML = "–";
                            }
                            // cfop novo
                            if (cfop == "0" || cfop == "") {
                                document.getElementById('cfop_novo_modal').innerHTML = "–";
                            } else {
                                document.getElementById('cfop_novo_modal').innerHTML = cfop;
                            }

                            // Cest antigo
                            if (document.getElementById('cest_modal-' + id_produto).value != "0000000") {
                                document.getElementById('cest_antigo_modal').innerHTML = document.getElementById('cest_modal-' + id_produto).value;
                            } else {
                                document.getElementById('cest_antigo_modal').innerHTML = "–";
                            }
                            // Cest novo
                            if (cest == "0000000" || cest == "") {
                                document.getElementById('cest_novo_modal').innerHTML = "–";
                            } else {
                                document.getElementById('cest_novo_modal').innerHTML = cest;
                            }

                            $('#modalAlteradoInfo').modal('show');

                            // Alterando os valores de exibição
                            document.getElementById('input_athos-' + id_produto).type = 'hidden';
                            document.getElementById('athos-' + id_produto).innerHTML = cod_athos;

                            document.getElementById('input_nome-' + id_produto).type = 'hidden';
                            document.getElementById('nome-' + id_produto).innerHTML = nome.toUpperCase();

                            document.getElementById('input_quantidade-' + id_produto).type = 'hidden';
                            document.getElementById('quantidade-' + id_produto).innerHTML = quantidade;

                            document.getElementById('input_preco-' + id_produto).type = 'hidden';
                            document.getElementById('preco-' + id_produto).innerHTML = span_preco;
                            document.getElementById('preco_total-' + id_produto).innerHTML = preco_total_novo_ptBR;

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

                            // Ícones
                            $('#icone_editar-' + id_produto).attr('data-original-title', 'Editar ' + nome.toUpperCase());
                            document.getElementById('span-' + id_produto + '').style.cursor = 'not-allowed';
                            $('#icone_confirmar-' + id_produto).attr('data-original-title', 'Confirmar alterações de ' + nome.toUpperCase());
                            document.getElementById('icone_confirmar-' + id_produto + '').style.cssText = 'color: green; font-size: 24px; opacity: .5; pointer-events: none';
                            // Ícone deletar produto
                            document.getElementById('icone_excluir-' + id_produto + '').style.cursor = 'pointer';
                            document.getElementById('span_excluir-' + id_produto + '').style.cssText = 'opacity: 1; pointer-events: auto';
                            $('#icone_excluir-' + id_produto).attr('data-original-title', 'Excluir ' + nome.toUpperCase());
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
                    quantidade = document.getElementById('input_quantidade-' + vetor_id[i]);
                    csosn = document.getElementById('input_csosn-' + vetor_id[i]);
                    cfop = document.getElementById('input_cfop-' + vetor_id[i]);
                    cest = document.getElementById('input_cest-' + vetor_id[i]);

                    // Listen for input event on numInput.
                    quantidade.onkeydown = function(e) {
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

            // Autocomplete (ferramenta de busca)
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

            // Função que permite a alteração do nome do kit
            function texto_input_nome_kit() {
                // Escondendo botão de clone
                document.getElementById('btn_nome_kit').style.display = 'none';
                // Alterando o conteúdo de span e mostrando input para modificar o nome do kit
                document.getElementById('titulo_kit').innerHTML = '';
                document.getElementById('input_nome_kit').type = 'text';
                document.getElementById('input_nome_kit').focus();

                // Resentando o valor do input, pois o cursor estava começando da direita
                var copia_nome_kit = document.getElementById('input_nome_kit').value;
                document.getElementById('input_nome_kit').value = '';
                document.getElementById('input_nome_kit').value = copia_nome_kit;

                // Ativando botão
                document.getElementById('span_titulo').style.cursor = 'pointer';
                document.getElementById('icone_titulo').style.cssText = 'color: #0cf249; font-size: 30px; opacity: 1; pointer-events: auto';
            };

            // Função alterar nome do kit
            function alterar_nome_kit(id_kit, nome_kit_novo) {
                nome_kit = document.getElementById('input_nome_kit').value.trim();

                if (!nome_kit) {
                    document.getElementById('lista_campo_nome_kit').innerHTML = '<li class="list-group-item">Nome do Kit</li>';

                    $('#modalNomeKitPreenchido').modal('show');
                } else {
                    $.ajax({
                        method: 'POST',
                        url: '../alterar/alterar_nome_kit.php',
                        data: $('#form-kit').serialize(),
                        success: function(data) {
                            // Alterando os valores dos inputs/title/breadcrumb
                            document.getElementById('titulo_kit').innerHTML = nome_kit_novo.toUpperCase().trim();
                            document.getElementById('nome_kit_html').innerHTML = "Mercado Livre | " + nome_kit_novo.toUpperCase().trim() + " (#" + id_kit.toString() + ")"
                            document.getElementById('kit_nome_breadcrumb').innerHTML = nome_kit_novo.toUpperCase().trim();
                            document.getElementById('input_nome_kit').type = 'hidden';
                            // Alterando nome do kit dentro do tooltip e exibindo o botão novamente
                            $('#btn_nome_kit').attr('data-original-title', 'Clonar ' + nome_kit_novo.toUpperCase().trim());
                            document.getElementById('btn_nome_kit').style.display = "block";
                            // Alterando o nome do kit dentro do modal Clonar
                            if (document.getElementById('quantidade_produto_kit').innerHTML == 0) {
                                document.getElementById('nome_kit_modal_clonado').classList.remove("text-success");
                                document.getElementById('nome_kit_modal_clonado').classList.add("text-danger");
                                document.getElementById('nome_kit_modal_clonado').innerHTML = "Ocorreu um erro ao clonar o " + nome_kit_novo.toUpperCase().trim() + "!";
                            } else {
                                document.getElementById('nome_kit_modal_clonado').classList.add("text-success");
                                document.getElementById('nome_kit_modal_clonado').innerHTML = nome_kit_novo.toUpperCase().trim() + " foi clonado com sucesso!";
                            }
                            // Desativando botão
                            document.getElementById('span_titulo').style.cursor = 'not-allowed';
                            document.getElementById('icone_titulo').style.cssText = 'color: #0cf249; font-size: 30px; opacity: .5; pointer-events: none';

                            // Modal
                            document.getElementById('nome_kit_antigo_modal').innerHTML = document.getElementById('nome_kit_modal').value.trim();
                            document.getElementById('nome_kit_novo_modal').innerHTML = nome_kit_novo.toUpperCase().trim();
                            $('#modalAlteradoNomeKit').modal('show');
                        },
                        error: function(data) {
                            alert("Ocorreu um erro!");
                        }
                    });
                }
            };

            // Função para clonar kit
            function clonar() {
                $.ajax({
                    method: 'POST',
                    url: '../cadastrar/clonar.php',
                    data: $('#form-kit').serialize(),
                    success: function(data) {
                        document.getElementById('texto_modal_clonado').innerHTML = data;
                        $('#modalKitClonado').modal('show');
                    },
                    error: function(data) {
                        alert("Ocorreu um erro!");
                    }
                });
            }

            function copy(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();

                // $('#icone_texto').attr('title', 'Texto copiado para a área de transferência!').tooltip('_fixTitle').tooltip('show');
                $('#icone_texto').tooltip('dispose').attr('title', 'Copiado!').tooltip('show');
            }

            // Função para enviar dados ao modal
            function informacoes_produto(nome_produto, id_produto, index_vetor) {
                document.getElementById("nome_produto_titulo_excluir_modal").innerHTML = nome_produto.trim();
                document.getElementById("nome_produto_excluir_modal").innerHTML = nome_produto.trim();
                document.getElementById("produto_modal_excluido").innerHTML = nome_produto.trim();
                document.getElementById("id_produto_modal").value = id_produto;
                document.getElementById("index_vetor_produto").value = index_vetor;
            }

            // Função para exclusão de um produto
            function excluir_produto(id, index_produto_vetor) {
                $.ajax({
                    method: "POST",
                    url: "../excluir/excluir_produto.php",
                    data: $('#form_excluir_produto').serialize(),
                    success: function(data) {
                        // Remove a linha do produto
                        $('#linha-' + id).fadeOut(500, function() {
                            $('#linha-' + id).remove();
                        });

                        // Exibindo mensagem que o produto foi excluído com sucesso
                        document.getElementById('produto_modal_body_excluido').innerHTML = data;
                        $('#modalExcluidoSucesso').modal('show');

                        // Zerando o valor dentro do vetor_precos
                        vetor_precos[index_produto_vetor] = 0;
                        // alert(vetor_precos);

                        soma = 0;
                        // Realizando a soma de todos os valores do vetor
                        for (var i = 0; i < vetor_precos.length; i++) {
                            soma = soma + parseFloat(vetor_precos[i]);
                        }
                        // Alterando o valor de exibição do preço total do kit
                        document.getElementById('preco_total_kit').innerHTML = new Intl.NumberFormat('pt-BR', {
                            style: 'currency',
                            currency: 'BRL'
                        }).format(soma);
                        // document.getElementById('preco_total_kit').innerHTML = soma.toFixed(2).replace(".", ",");

                        // Alterando a exibição da quantidade total de produtos
                        document.getElementById('quantidade_produto_kit').innerHTML = parseInt(document.getElementById('quantidade_produto_kit').innerHTML) - 1;
                        if (document.getElementById('quantidade_produto_kit').innerHTML == 0) {
                            $('#span_quantidade_produtos').attr('data-original-title', 'Não há nenhum item nesse kit');
                            // Alterando o nome do kit dentro do modal Clonar
                            document.getElementById('nome_kit_modal_clonado').classList.add("text-danger");
                            document.getElementById('nome_kit_modal_clonado').classList.remove("text-success");
                            document.getElementById('nome_kit_modal_clonado').innerHTML = "Ocorreu um erro ao clonar o " + document.getElementById('titulo_kit').innerHTML.trim() + "!";
                        } else if (document.getElementById('quantidade_produto_kit').innerHTML == 1) {
                            $('#span_quantidade_produtos').attr('data-original-title', 'Há <b><span class="text-primary">' + document.getElementById('quantidade_produto_kit').innerHTML + '</span></b> item nesse kit');
                        } else {
                            $('#span_quantidade_produtos').attr('data-original-title', 'Há <b><span class="text-primary">' + document.getElementById('quantidade_produto_kit').innerHTML + '</span></b> itens nesse kit');
                        }
                    },
                    error: function(data) {
                        alert("Ocorreu um erro!");
                    }
                });
            }

            // Pesquisa os dados do produto a partir do código Athos fornecido
            function pesquisar_produto(num_input) {
                $.ajax({
                    method: 'POST',
                    url: 'pesquisa_produto.php',
                    data: $('#form-' + num_input).serialize(),
                    success: function(data) {
                        // alert(data);
                        // Dividindo a data em um array de strings
                        dados_produto = data.split("|");
                        // Preenchendo automaticamente de acordo com o código Athos fornecido
                        // Se o código não existir no banco, os campos permanecerão com os valores do último preenchimento
                        if (dados_produto[1]) {
                            document.getElementById('input_nome-' + num_input).value = dados_produto[1].trim();
                            document.getElementById('input_ncm-' + num_input).value = dados_produto[3].trim();
                            document.getElementById('input_csosn-' + num_input).value = dados_produto[2].trim();
                            document.getElementById('input_cfop-' + num_input).value = dados_produto[5].trim();
                            document.getElementById('input_cest-' + num_input).value = dados_produto[4].trim();
                        }
                    },
                    error: function(data) {
                        alert("Ocorreu um erro!");
                    }
                });
            }

            // highlight a row onclick (method 1)
            // $(document).ready(function() {
            //     $('#tabela').on('click', 'tbody tr', function(event) {
            //         // alert(this.className);
            //         // alert(this.siblings());
            //         if ($(this).hasClass('highlight')) {
            //             // remove previous highlight class
            //             $(this).removeClass('highlight');
            //         } else {
            //             // highlight clicked row and remove class 'highlight' from siblings (tbody tr)
            //             $(this).addClass('highlight').siblings().removeClass('highlight');
            //             // highlight multiple rows
            //             // $(this).addClass('highlight');
            //         }
            //     });
            // });

            // highlight a row onclick (method 2)
            $(document).ready(function() {
                // not highlighting when clicking on one of last 3 columns (td)
                $('.clickable').on('click', function(event) {
                    // alert(this.className);
                    // remove previous parent (tr) highlight class 
                    if ($(this).parent().hasClass('highlight')) {
                        // $(this).parent().removeClass('highlight');

                        // remove selected td class (highlight_td)
                        if ($(this).hasClass('highlight_td')) {
                            $(this).removeClass('highlight_td');
                            // adding class to selected td (highlight_td)
                        } else {
                            $(this).addClass('highlight_td');
                        }

                        // remove class 'highlight'/'highlightd' if selected td text == first cell of given row text
                        if ($(this).text().trim() == $(this).closest('tr').find('td:first').text().trim()) {
                            // alert($(this).closest('tr').find('td:first').text().trim());
                            $(this).parent().removeClass('highlight');
                            // remove highlight from all columns
                            $(this).removeClass('highlight_td').siblings().removeClass('highlight_td');
                        }
                    } else {
                        // highlight clicked row (parent) and remove class 'highlight' from siblings (tbody tr)
                        // $(this).parent().addClass('highlight').siblings().removeClass('highlight');
                        // highlight multiple rows
                        $(this).parent().addClass('highlight');
                        // td highlight
                        $(this).addClass('highlight_td');
                    }
                });
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
                        <ul class="dropdown-menu">
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
                    <li class="nav-item px-1">
                        <a class="nav-link" href="../produtos/"><i class="fas fa-book" style="font-size: 24px; vertical-align: middle; color: #b5651d"></i></a>
                    </li>
                    <li class="nav-item px-1 active">
                        <a class="nav-link underline" href="javascript:void(0)"><i class="fas fa-search text-white" style="font-size: 24px; vertical-align: middle"></i></a>
                    </li>
                </ul>
                <i class="fas fa-info-circle" style="font-size: 24px; color: #5bc0de; vertical-align: middle; margin-right: 15px; cursor: pointer" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<img src='../imagens/example.png' width='130px'>"></i>
                <form id="form_pesquisa" class="form-inline my-2 my-lg-0" method="POST" action="./">
                    <input class="form-control mr-sm-2" id="nome_do_kit" name="nome_do_kit" placeholder="Código/Nome do kit" aria-label="Search" autocomplete="off" style="width: 300px; background-color: #eee; border-radius: 9999px; border: none; padding-left: 20px; padding-right: 42px">
                    <div id="div_autocomplete">
                    </div>
                    <button type="submit" style="position: absolute; margin-left: 259px; border: none; cursor: pointer"><i class="fas fa-search text-success"></i></button>
                </form>
            </div>
        </nav>
        <nav aria-label="breadcrumb" style="position: absolute; z-index: 1;">
            <ol class="breadcrumb" style="background: none; margin: 0; word-break: break-word;">
                <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
                <li class="breadcrumb-item active">
                    <a href="javascript:void(0)" class="none_li">
                        <i class="fas fa-search"></i>
                        <?php if ($nome_kit_post == '' || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $nome_kit_post)) { ?>
                            Pesquisar
                        <?php } else if ($num_kits == 0) { ?>
                            Pesquisar | <?php echo $nome_kit_post ?>
                        <?php } else { ?>
                            Pesquisar | <span id="kit_nome_breadcrumb"><?php echo $vetor_mostrar_nome_kit['kit_nome'] . "</span><small> (#" . $vetor_mostrar_nome_kit['id_kit'] . ")</small>" ?>
                            <?php } ?>
                    </a>
                </li>
            </ol>
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
                    <img src="../imagens/deserto.jpg" alt="wallpaper" height="500px" width="110%">
                </div>
                <div id="img_nothing" data-depth="0.6"><img src="../imagens/nothing.png" alt="nada"></div>
                <div id="megumin" data-depth="0.8"><img src="../imagens/megumin.png" alt="megumin" width="60px"></div>
            </div>
            <?php if ($nome_kit_post == '' || preg_match('/^[\pZ\pC]+|[\pZ\pC]+$/u', $nome_kit_post)) { ?>
                <p class="lead" style="padding-top: 8%; font-size: 40px; text-align: center">Nenhum código fornecido!</p>
            <?php } else { ?>
                <p class="lead" style="padding-top: 8%; font-size: 40px; text-align: center">Nenhum kit com esse código encontrado!</p>
            <?php } ?>
        <?php } else { ?>
            <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
                <form id="form-kit" method="POST">
                    <h1 style="text-align: center; word-wrap: break-word;">
                        <!-- Nome do kit antigo para exibir no modal -->
                        <input type="hidden" id="nome_kit_modal" class="form-control" value="<?php echo $vetor_mostrar_nome_kit['kit_nome'] ?>">
                        <!-- Código do kit a enviar -->
                        <input type="hidden" id="id_kit" name="id_kit" class="form-control" value="<?php echo $vetor_mostrar_nome_kit['id_kit'] ?>">
                        <!-- Input pra alterar nome do kit -->
                        <center><input type="hidden" id="input_nome_kit" name="nome_kit_novo" class="form-control form-control-lg col-10" value="<?php echo $vetor_mostrar_nome_kit['kit_nome'] ?>" placeholder="Novo nome do kit" onkeydown="return event.key != 'Enter';"></center>
                        <span id="titulo_kit" style="color: #daeff5; font-family: Comic Sans MS"><?php echo $vetor_mostrar_nome_kit['kit_nome'] . "</span><b><span style='font-size: 24px; color: #ffa21f'> (#" . $vetor_mostrar_nome_kit['id_kit'] . ")</span></b>" ?>
                            <i class="far fa-edit font-weight-bold" style="color: #0cf249; font-size: 30px; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Editar nome do kit" onclick="texto_input_nome_kit()"></i>
                            <span id="span_titulo" style="cursor: not-allowed">
                                <i id="icone_titulo" class="fas fa-check-square font-weight-bold" style="color: #0cf249; font-size: 30px; opacity: .5; pointer-events: none;" data-toggle="tooltip" data-placement="bottom" title="Confirmar alteração do nome do kit" onclick="alterar_nome_kit('<?php echo $vetor_mostrar_nome_kit['id_kit'] ?>', document.getElementById('input_nome_kit').value)"></i>
                            </span>
                    </h1>
                    <!-- botão clonar -->
                    <button type="button" id="btn_nome_kit" class="btn btn-outline-warning button_border text-center" style="display: block; margin: 20px auto 0 auto" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="Clonar <?php echo $vetor_mostrar_nome_kit['kit_nome'] ?>" onclick="clonar()">
                        <i class="fas fa-clone"></i><b> CLONAR</b>
                    </button>
                </form>
            </header>
            <main class="container-fluid">
                <table id="tabela" class="table table-hover table-striped">
                    <thead>
                        <tr class="text-center table-warning">
                            <th class="theader_top" scope="col" width="7%">Athos</th>
                            <th class="theader_top" scope="col" width="25%">Nome do produto</th>
                            <th class="theader_top" scope="col" width="8%">
                                Qtde
                                <?php if ($num_kits == 1) { ?>
                                    <span id="span_quantidade_produtos" class="noselect font-weight-bold badge badge-pill badge-primary" data-toggle="tooltip" data-html="true" title="Há <b><span class='text-primary'><?php echo $num_kits ?></span></b> item nesse kit"><span id="quantidade_produto_kit"><?php echo $num_kits ?></span></span>
                                <?php } else { ?>
                                    <span id="span_quantidade_produtos" class="noselect font-weight-bold badge badge-pill badge-primary" data-toggle="tooltip" data-html="true" title="Há <b><span class='text-primary'><?php echo $num_kits ?></span></b> itens nesse kit"><span id="quantidade_produto_kit"><?php echo $num_kits ?></span></span>
                                <?php } ?>
                            </th>
                            <th class="theader_top" scope="col" width="10%">Preço</th>
                            <th class="theader_top" scope="col" width="13%">Total</th>
                            <th class="theader_top" scope="col" width="10%">NCM</th>
                            <th class="theader_top" scope="col" width="8%">CSOSN</th>
                            <th class="theader_top" scope="col" width="8%">CFOP</th>
                            <th class="theader_top" scope="col" width="10%">CEST</th>
                            <th class="theader_top" scope="col" width="1%" colspan="3"><i class="fas fa-cogs text-secondary" style="font-size: 22px;"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Criando vetor para armazenar os preços, alterar valor de exibição etc -->
                        <script>
                            // Criando vetor para armazenar todos os preços antigos
                            var vetor_precos = [];
                            // Criando vetor para armazenar todos os ids dos produtos
                            var vetor_id = [];
                        </script>
                        <!-- Loop para armazenar todos os preços e ids dos produtos -->
                        <?php for ($i = 0; $i < $num_kits; $i++) {
                            $vetor_kit_para_alterar_valores_vetor_javascript = mysqli_fetch_array($procurar_para_alterar_valores_vetor_javascript); ?>
                            <script>
                                // Adicionando preço na última posição
                                var novo = "<?php echo $vetor_kit_para_alterar_valores_vetor_javascript['preco_total'] ?>";
                                vetor_precos.push(novo);
                                // adicionando os códigos dos produtos no array
                                vetor_id.push("<?php echo $vetor_kit_para_alterar_valores_vetor_javascript['id'] ?>");
                            </script>
                        <?php } ?>
                        <script>
                            // Função para alterar o preço total do kit toda vez que um preço é alterado
                            function mudarVetor(posicao_vetor, preco_novo_vetor, quantidade_vetor) {
                                preco_novo_vetor_sem_R$ = preco_novo_vetor.replace("R$ ", "");
                                preco_novo_vetor_ptBR = preco_novo_vetor_sem_R$.replace(/\./g, "");
                                preco_novo_vetor_calculo = preco_novo_vetor_ptBR.replace(",", ".");
                                // Atribuindo um novo valor para a posição 'x' do vetor
                                vetor_precos[posicao_vetor] = preco_novo_vetor_calculo * quantidade_vetor;

                                soma = 0;
                                // Realizando a soma de todos os valores do vetor
                                for (var i = 0; i < vetor_precos.length; i++) {
                                    soma = soma + parseFloat(vetor_precos[i]);
                                }
                                // Alterando o valor de exibição do preço total do kit
                                document.getElementById('preco_total_kit').innerHTML = new Intl.NumberFormat('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL'
                                }).format(soma);
                                // document.getElementById('preco_total_kit').innerHTML = soma.toFixed(2).replace(".", ",");
                            }
                        </script>
                        <!-- Criando vetor para armazenar os preços, alterar valor de exibição etc -->

                        <?php
                        $preco_total_kit = 0;
                        for ($j = 0; $j < $num_kits; $j++) {
                            $vetor_kit = mysqli_fetch_array($procurar);
                            $preco_total_kit = $preco_total_kit + $vetor_kit['preco_total'];
                        ?>
                            <tr class="text-center" id="linha-<?php echo $vetor_kit['id'] ?>">
                                <form id="form-<?php echo $vetor_kit['id'] ?>" method="POST">
                                    <input type="hidden" name="id_produto" value="<?php echo $vetor_kit['id'] ?>">
                                    <td class="clickable">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="athos_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['cod_athos'] ?>">
                                        <!-- Input pra alterar o cod athos -->
                                        <input type="hidden" id="input_athos-<?php echo $vetor_kit['id'] ?>" name="cod_athos_<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['cod_athos'] ?>" placeholder="Código Athos novo" onkeydown="return event.key != 'Enter';" onkeyup="pesquisar_produto('<?php echo $vetor_kit['id'] ?>')">
                                        <span id="athos-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['cod_athos'] ?>
                                        </span>
                                    </td>
                                    <td class="clickable text-left" style="max-width: 400px; word-wrap: break-word;">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="nome_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['nome'] ?>">
                                        <!-- Input pra alterar o nome do produto -->
                                        <input type="hidden" id="input_nome-<?php echo $vetor_kit['id'] ?>" name="nome_novo" class="form-control" value="<?php echo $vetor_kit['nome'] ?>" placeholder="Nome novo" onkeydown="return event.key != 'Enter';">

                                        <span id="nome-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['nome'] ?>
                                        </span>
                                    </td>
                                    <td class="clickable">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="quantidade_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['quantidade'] ?>">
                                        <!-- Input pra alterar a quantidade -->
                                        <input type="hidden" id="input_quantidade-<?php echo $vetor_kit['id'] ?>" name="quantidade" class="form-control" value="<?php echo $vetor_kit['quantidade'] ?>" placeholder="Quantidade nova" onkeydown="return event.key != 'Enter';" min="1">
                                        <span id="quantidade-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['quantidade'] ?>
                                        </span>
                                    </td>
                                    <!-- Coluna do preço do produto -->
                                    <td class="clickable" id="coluna-<?php echo $vetor_kit['id'] ?>">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="preco_velho-<?php echo $vetor_kit['id'] ?>" class="form-control" value="R$ <?php echo number_format($vetor_kit['preco'], 2, ',', '.') ?>">
                                        <!-- Input pra alterar o preço -->
                                        <input type="hidden" id="input_preco-<?php echo $vetor_kit['id'] ?>" name="preco_novo" class="form-control" value="R$ <?php echo number_format($vetor_kit['preco'], 2, ',', '.') ?>" placeholder="Preço novo" onkeydown="return event.key != 'Enter';">
                                        <span id="preco-<?php echo $vetor_kit['id'] ?>">
                                            R$ <?php echo number_format($vetor_kit['preco'], 2, ',', '.') ?>
                                        </span>
                                    </td>
                                    <!-- Coluna do preço do produto -->
                                    <td class="clickable">
                                        <span id="preco_total-<?php echo $vetor_kit['id'] ?>">R$ <?php echo number_format($vetor_kit['preco_total'], 2, ',', '.') ?></span>
                                    </td>
                                    <td class="clickable">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="ncm_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['ncm'] ?>">
                                        <!-- Input pra alterar o ncm -->
                                        <input type="hidden" id="input_ncm-<?php echo $vetor_kit['id'] ?>" name="ncm_novo" class="form-control" value="<?php echo $vetor_kit['ncm'] ?>" placeholder="NCM novo" onkeydown="return event.key != 'Enter';">

                                        <span id="ncm-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['ncm'] ?>
                                        </span>
                                    </td>
                                    <td class="clickable">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="csosn_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['csosn'] ?>">
                                        <!-- Input pra alterar o csosn -->
                                        <input type="hidden" id="input_csosn-<?php echo $vetor_kit['id'] ?>" name="csosn_novo" class="form-control" value="<?php echo $vetor_kit['csosn'] ?>" placeholder="CSOSN novo" onkeydown="return event.key != 'Enter';" min="0">

                                        <span id="csosn-<?php echo $vetor_kit['id'] ?>">
                                            <?php if ($vetor_kit['csosn'] == 0) {
                                                echo "–";
                                            } else {
                                                echo $vetor_kit['csosn'];
                                            } ?>
                                        </span>
                                    </td>
                                    <td class="clickable">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="cfop_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['cfop'] ?>">
                                        <!-- Input pra alterar o cfop -->
                                        <input type="hidden" id="input_cfop-<?php echo $vetor_kit['id'] ?>" name="cfop_novo" class="form-control" value="<?php echo $vetor_kit['cfop'] ?>" placeholder="CFOP novo" onkeydown="return event.key != 'Enter';" min="0">

                                        <span id="cfop-<?php echo $vetor_kit['id'] ?>">
                                            <?php if ($vetor_kit['cfop'] == 0) {
                                                echo "–";
                                            } else {
                                                echo $vetor_kit['cfop'];
                                            } ?>
                                        </span>
                                    </td>
                                    <td class="clickable">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="cest_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['cest'] ?>">
                                        <!-- Input pra alterar o cest -->
                                        <input type="hidden" id="input_cest-<?php echo $vetor_kit['id'] ?>" name="cest_novo" class="form-control" value="<?php echo $vetor_kit['cest'] ?>" placeholder="CEST novo" onkeydown="return event.key != 'Enter';" min="0">

                                        <span id="cest-<?php echo $vetor_kit['id'] ?>">
                                            <?php if ($vetor_kit['cest'] == 0) {
                                                echo "–";
                                            } else {
                                                echo $vetor_kit['cest'];
                                            } ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i id="icone_editar-<?php echo $vetor_kit['id'] ?>" class="far fa-edit font-weight-bold" style="color: green; font-size: 24px; cursor: pointer;" data-toggle="tooltip" title="Editar <?php echo $vetor_kit['nome'] ?>" onclick="texto_input(<?php echo $vetor_kit['id'] ?>)"></i>
                                    </td>
                                    <td>
                                        <span id="span-<?php echo $vetor_kit['id'] ?>" style="cursor: not-allowed">
                                            <i id="icone_confirmar-<?php echo $vetor_kit['id'] ?>" class="fas fa-check-square font-weight-bold" style="color: green; font-size: 24px; opacity: .5; pointer-events: none;" data-toggle="tooltip" title="Confirmar alterações de <?php echo $vetor_kit['nome'] ?>" onclick="alterar_info('<?php echo $vetor_kit['id'] ?>', document.getElementById('input_preco-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_nome-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_quantidade-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_athos-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_ncm-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_csosn-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_cfop-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_cest-<?php echo $vetor_kit['id'] ?>').value); mudarVetor('<?php echo $j ?>', document.getElementById('input_preco-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_quantidade-<?php echo $vetor_kit['id'] ?>').value)"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <span id="span_excluir-<?php echo $vetor_kit['id'] ?>" data-toggle="modal" data-target="#modalExcluir" onclick="informacoes_produto(document.getElementById('nome-<?php echo $vetor_kit['id'] ?>').innerHTML, '<?php echo $vetor_kit['id']; ?>', '<?php echo $j ?>')">
                                            <a id="icone_excluir-<?php echo $vetor_kit['id'] ?>" class="fas fa-times" data-toggle="tooltip" title="Excluir <?php echo $vetor_kit['nome'] ?>" style="color: red; font-size: 26px; cursor: pointer;"></a>
                                        </span>
                                    </td>
                                    <!-- input para armazenar o valor do id atual -->
                                    <input type="hidden" class="form-control" name="atual" value="<?php echo $vetor_kit['id'] ?>" id="atual">
                                </form>
                            </tr>
                            <?php if ($j == $num_kits - 1) { ?>
                                <tr class="text-center">
                                    <td colspan="12" style="border-top-color: #5cb85c; border-top-width: 2px;">
                                        <font style="font-size: 24px" class="lead font-weight-bold"><span id="preco_total_kit">R$ <?php echo number_format($preco_total_kit, 2, ',', '.') ?></span></font>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                </div>
                </div>
                </div>
                </div>
            </main>
        <?php } ?>
        <!-- Modal alteração preço unitario -->
        <div class="modal fade" id="modalAlteradoInfo" tabindex="-1" role="dialog" aria-labelledby="modalAlteradoInfoTitle" aria-hidden="true" onkeypress="$('#modalAlteradoInfo').modal('toggle');">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-success" id="modalTitle" style="word-break: break-word">
                            Informações de <span id="nome_produto_modal"></span> alteradas!
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-center text-warning table-warning lead">
                                        <th width="5%"></th>
                                        <th>ANTIGO</th>
                                        <th>NOVO</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>Cód. Athos</b>
                                        </td>
                                        <td>
                                            <span id="athos_antigo_modal"></span>
                                        </td>
                                        <td>
                                            <span class="text-success" id="athos_novo_modal"></span>
                                        </td>
                                    </tr>
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>Nome</b>
                                        </td>
                                        <td style="word-break: break-word">
                                            <span id="nome_antigo_modal"></span>
                                        </td>
                                        <td style="word-break: break-word">
                                            <span class="text-success" id="nome_novo_modal"></span>
                                        </td>
                                    </tr>
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>Quantidade</b>
                                        </td>
                                        <td>
                                            <span id="quantidade_antigo_modal"></span>
                                        </td>
                                        <td>
                                            <span class="text-success" id="quantidade_novo_modal"></span>
                                        </td>
                                    </tr>
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>Preço</b>
                                        </td>
                                        <td>
                                            <span id="preco_antigo_modal"></span>
                                        </td>
                                        <td>
                                            <span class="text-success" id="preco_novo_modal"></span>
                                        </td>
                                    </tr>
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>NCM</b>
                                        </td>
                                        <td>
                                            <span id="ncm_antigo_modal"></span>
                                        </td>
                                        <td>
                                            <span class="text-success" id="ncm_novo_modal"></span>
                                        </td>
                                    </tr>
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>CSOSN</b>
                                        </td>
                                        <td>
                                            <span id="csosn_antigo_modal"></span>
                                        </td>
                                        <td>
                                            <span class="text-success" id="csosn_novo_modal"></span>
                                        </td>
                                    </tr>
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>CFOP</b>
                                        </td>
                                        <td>
                                            <span id="cfop_antigo_modal"></span>
                                        </td>
                                        <td>
                                            <span class="text-success" id="cfop_novo_modal"></span>
                                        </td>
                                    </tr>
                                    <tr class="lead">
                                        <td class="text-right">
                                            <b>CEST</b>
                                        </td>
                                        <td>
                                            <span id="cest_antigo_modal"></span>
                                        </td>
                                        <td>
                                            <span class="text-success" id="cest_novo_modal"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <p class="lead"><b>Preço antigo: </b><span id="preco_antigo_modal"></span></p> -->
                            <!-- <p class="lead text-success"><b>Preço novo: </b><span id="preco_novo_modal"></span></p> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="">OK</button>
                    </div>
                </div>
            </div>
        </div>
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
        <!-- Modal alteração nome kit -->
        <div class="modal fade" id="modalAlteradoNomeKit" tabindex="-1" role="dialog" aria-labelledby="modalAlteradoNomeKitTitle" aria-hidden="true" onkeypress="$('#modalAlteradoNomeKit').modal('toggle');">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-success" id="modalTitle">
                            Nome do kit alterado!
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" style="word-wrap: break-word">
                            <p class="lead"><b>Nome antigo: </b><span id="nome_kit_antigo_modal"></span></p>
                            <p class="lead text-success"><b>Nome novo: </b><span id="nome_kit_novo_modal"></span></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal nome kit não preenchido -->
        <div class="modal fade" id="modalNomeKitPreenchido" tabindex="-1" role="dialog" aria-labelledby="modalNomeKitPreenchidoTitle" aria-hidden="true" onkeypress="$('#modalNomeKitPreenchido').modal('toggle');">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-warning" id="modalTitle">
                            Há campo a ser preenchido!
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <p class="lead">O seguintes campo não foi preenchido: </p>
                            <ul id="lista_campo_nome_kit" class="list-group list-group-flush">

                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal kit clonado -->
        <form id="form_pesquisar_clone" method="POST" action="./">
            <!-- form é enviado quando o modal perde o foco ou alguma tecla é pressionada (inclusive o ESC) -->
            <div class="modal fade" id="modalKitClonado" tabindex="-1" role="dialog" aria-labelledby="modalKitClonadoTitle" aria-hidden="true" onkeydown="document.forms['form_pesquisar_clone'].submit();" onfocusout="document.forms['form_pesquisar_clone'].submit();">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalTitle">
                                <span class="text-success" id="nome_kit_modal_clonado"><?php echo $vetor_mostrar_nome_kit['kit_nome'] ?> foi clonado com sucesso!</span>
                            </h4>
                            <!-- form é enviado quando o usuário clica no ícone X -->
                            <button type="button" class="close" aria-label="Close" onclick="document.forms['form_pesquisar_clone'].submit();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <b>
                                    <p id="texto_modal_clonado" class="lead"></p>
                                </b>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- form é enviado quando o usuário clica no botão OK -->
                            <button type="submit" class="btn btn-success">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Modal excluir produto -->
        <form id="form_excluir_produto" method="POST" action="../excluir/excluir_produto.php">
            <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-danger" id="modalTitle">
                                Deseja realmente excluir <span id="nome_produto_titulo_excluir_modal"></span>?
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-9">
                                    <input id="id_produto_modal" name="id_produto_modal" type="hidden" class="form-control" value="">
                                    <input id="index_vetor_produto" type="hidden" class="form-control" value="">
                                    <h5 class="text-warning">Você irá excluir <span id="nome_produto_excluir_modal"></span>!</h5>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" id="btn_modal_excluir" class="btn btn-danger" onclick="excluir_produto(document.getElementById('id_produto_modal').value, document.getElementById('index_vetor_produto').value)" data-dismiss="modal">Excluir</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Modal produto excluído com sucesso -->
        <div class="modal fade" id="modalExcluidoSucesso" tabindex="-1" role="dialog" aria-labelledby="modalExcluidoSucessoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-success" id="modalTitle">
                            <span id="produto_modal_excluido"></span> foi excluído com sucesso!
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="produto_modal_body_excluido" class="lead text-success"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php if ($num_kits == 0) { ?>
            <footer id="footer1" class="footer" style="margin-bottom: -250px">
                <!-- style="/*margin-bottom: -100px*/" -->
            <?php } else { ?>
                <footer id="footer1" class="footer" style="margin-bottom: -290px">
                    <!-- style="/*margin-bottom: -200px*/" -->
                <?php } ?>
                <!-- Footer Elements -->
                <div style="background-color: #3e4551; padding: 16px">
                    <!-- Mostra se o kit existir  -->
                    <?php if ($num_kits > 0) { ?>
                        <div class="container">
                            <p class="lead" style="font-size: 18px; color: #c4c4c4">
                                <!-- Dados adicionais <b>(fora de São Paulo)</b> -->
                                <i id="icone_texto" onclick="copy('#texto')" class="fas fa-exclamation-triangle text-warning" style="margin-right: 8px; cursor: pointer" data-toggle="tooltip" data-html="true" data-placement="top" title="Copiar para a área de transferência"></i><span id="texto">Devido a Liminar ADI 5464, as empresas optantes pelo Simples Nacional estão desobrigadas a recolher o imposto DIFAL </span>
                            </p>
                        </div>
                    <?php } ?>
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
<?php } else { ?>
    <script>
        window.location.href = '../';
    </script>
<?php }
