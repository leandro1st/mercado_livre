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
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="../externo/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
        <script src="../jquery/jquery-3.4.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../maskmoney/src/jquery.maskMoney.js" type="text/javascript"></script>
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

            .theader_top {
                position: sticky;
                top: 60px;
                z-index: 1;
            }

            .bs-tooltip-top {
                margin-bottom: 4px;
            }
        </style>
        <script>
            // alert($(window).width());
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });

            // Função para alterar o preço antigo
            function texto_input(id_produto) {
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

                // CEST
                document.getElementById('cest-' + id_produto + '').innerHTML = '';
                document.getElementById('input_cest-' + id_produto).type = 'number';

                // Icone confirmar
                document.getElementById('span-' + id_produto + '').style.cursor = 'pointer';
                document.getElementById('icone-' + id_produto + '').style.cssText = 'color: green; font-size: 24px; opacity: 1; pointer-events: auto';

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
            function alterar_info(id_produto, preco_novo, nome, quantidade, cod_athos, ncm, cest) {
                //Alterando a mask 
                preco_novo_sem_R$ = preco_novo.replace("R$ ", "");
                preco_novo_ptBR = preco_novo_sem_R$.replace(/\./g, "");
                preco_novo_calculo = preco_novo_ptBR.replace(",", ".");
                // Preço total novo
                preco_total_novo = (quantidade * preco_novo_calculo).toFixed(2).toString();
                preco_total_novo_ptBR = preco_total_novo.replace(".", ",")
                // Mostrar preço novo
                var span_preco = "<span id='preco-" + id_produto + "'>R$ " + preco_novo_ptBR + "</span>";
                $.ajax({
                    method: 'POST',
                    url: 'alterar.php',
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

                        document.getElementById('preco_antigo_modal').innerHTML = "R$ " + document.getElementById('preco_velho-' + id_produto).value;
                        document.getElementById('preco_novo_modal').innerHTML = "R$ " + preco_novo_ptBR;

                        document.getElementById('ncm_antigo_modal').innerHTML = document.getElementById('ncm_modal-' + id_produto).value;
                        document.getElementById('ncm_novo_modal').innerHTML = ncm.toUpperCase();

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

            // Função alterar nome do kit
            function alterar_nome_kit(id_kit, nome_kit_novo) {
                $.ajax({
                    method: 'POST',
                    url: 'alterar_nome_kit.php',
                    data: $('#form-kit').serialize(),
                    success: function(data) {
                        // Alterando os valores dos inputs/title/breadcrumb
                        document.getElementById('titulo_kit').innerHTML = nome_kit_novo.toUpperCase();
                        document.getElementById('nome_kit_html').innerHTML = "Mercado Livre | " + nome_kit_novo.toUpperCase() + " (#" + id_kit.toString() + ")"
                        document.getElementById('kit_nome_breadcrumb').innerHTML = nome_kit_novo.toUpperCase();
                        document.getElementById('input_nome_kit').type = 'hidden';
                        // Desativando botão
                        document.getElementById('span_titulo').style.cursor = 'not-allowed';
                        document.getElementById('icone_titulo').style.cssText = 'color: #0cf249; font-size: 30px; opacity: .5; pointer-events: none';

                        // Modal
                        document.getElementById('nome_kit_antigo_modal').innerHTML = document.getElementById('nome_kit_modal').value;
                        document.getElementById('nome_kit_novo_modal').innerHTML = nome_kit_novo.toUpperCase();
                        $('#modalAlteradoNomeKit').modal('show');
                    },
                    error: function(data) {
                        alert("Ocorreu um erro!");
                    }
                });
            };

            function texto_input_nome_kit() {
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
                        <a class="nav-link underline" href="#"><i class="fas fa-search text-white" style="font-size: 24px; vertical-align: middle"></i></a>
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
            <ol class="breadcrumb" style="background: none; margin: 0;">
                <li class="breadcrumb-item"><a href="../"><i class="fas fa-home"></i> Página Inicial</a></li>
                <li class="breadcrumb-item active">
                    <a href="#" class="none_li">
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
                <h1 style="text-align: center">
                    <form id="form-kit" method="POST">
                        <!-- Nome do kit antigo para exibir no modal -->
                        <input type="hidden" id="nome_kit_modal" class="form-control" value="<?php echo $vetor_mostrar_nome_kit['kit_nome'] ?>">
                        <!-- Código do kit a enviar -->
                        <input type="hidden" id="id_kit" name="id_kit" class="form-control" value="<?php echo $vetor_mostrar_nome_kit['id_kit'] ?>">
                        <!-- Input pra alterar nome do kit -->
                        <center><input type="hidden" id="input_nome_kit" name="nome_kit_novo" class="form-control form-control-lg col-10" value="<?php echo $vetor_mostrar_nome_kit['kit_nome'] ?>" placeholder="Novo nome do kit"></center>
                    </form>
                    <span id="titulo_kit" style="color: #daeff5; font-family: Comic Sans MS"><?php echo $vetor_mostrar_nome_kit['kit_nome'] . "</span><b><span style='font-size: 24px; color: #ffa21f'> (#" . $vetor_mostrar_nome_kit['id_kit'] . ")</span></b>" ?>
                        <i class="far fa-edit font-weight-bold" style="color: #0cf249; font-size: 30px; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Editar nome do kit" onclick="texto_input_nome_kit()"></i>
                        <span id="span_titulo" style="cursor: not-allowed">
                            <i id="icone_titulo" class="fas fa-check-square font-weight-bold" style="color: #0cf249; font-size: 30px; opacity: .5; pointer-events: none;" data-toggle="tooltip" data-placement="bottom" title="Confirmar alteração do nome do kit" onclick="alterar_nome_kit('<?php echo $vetor_mostrar_nome_kit['id_kit'] ?>', document.getElementById('input_nome_kit').value)" onkeydown="return event.key != 'Enter';"></i>
                        </span>
                </h1>
            </header>
            <main class="container">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="text-center table-warning">
                            <th class="theader_top" scope="col" width="9%">#</th>
                            <th class="theader_top" scope="col" width="28%">Nome do produto</th>
                            <th class="theader_top" scope="col" width="10%">Qtde <span class="text-primary">(<?php echo $num_kits ?>)</span></th>
                            <th class="theader_top" scope="col" width="13%">Preço</th>
                            <th class="theader_top" scope="col" width="13%">Total</th>
                            <th class="theader_top" scope="col" width="13%">NCM</th>
                            <th class="theader_top" scope="col" width="13%">CEST</th>
                            <th class="theader_top" scope="col" width="1%" colspan="2"><i class="fas fa-cogs text-secondary" style="font-size: 22px;"></i></th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Criando vetor para armazenar os preços, alterar valor de exibição etc -->
                        <script>
                            // Criando vetor para armazenar todos os preços antigos
                            var vetor_precos = [];
                        </script>
                        <!-- Loop para armazenar todos os preços dos produtos -->
                        <?php for ($i = 0; $i < $num_kits; $i++) {
                            $vetor_kit_para_alterar_valores_vetor_javascript = mysqli_fetch_array($procurar_para_alterar_valores_vetor_javascript); ?>
                            <script>
                                // Adicionando preço na última posição
                                var novo = "<?php echo $vetor_kit_para_alterar_valores_vetor_javascript['preco_total'] ?>";
                                vetor_precos.push(novo);
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
                                document.getElementById('preco_total_kit').innerHTML = soma.toFixed(2).replace(".", ",");
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
                                    <td>
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="athos_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['cod_athos'] ?>">
                                        <!-- Input pra alterar o cod athos -->
                                        <input type="hidden" id="input_athos-<?php echo $vetor_kit['id'] ?>" name="athos_novo" class="form-control" value="<?php echo $vetor_kit['cod_athos'] ?>" placeholder="Código Athos novo" onkeydown="return event.key != 'Enter';">
                                        <span id="athos-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['cod_athos'] ?>
                                        </span>
                                    </td>
                                    <td style="max-width: 400px; word-wrap: break-word;">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="nome_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['nome'] ?>">
                                        <!-- Input pra alterar o nome do produto -->
                                        <input type="hidden" id="input_nome-<?php echo $vetor_kit['id'] ?>" name="nome_novo" class="form-control" value="<?php echo $vetor_kit['nome'] ?>" placeholder="Nome novo" onkeydown="return event.key != 'Enter';">

                                        <span id="nome-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['nome'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="quantidade_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['quantidade'] ?>">
                                        <!-- Input pra alterar a quantidade -->
                                        <input type="hidden" id="input_quantidade-<?php echo $vetor_kit['id'] ?>" name="quantidade" class="form-control" value="<?php echo $vetor_kit['quantidade'] ?>" placeholder="Quantidade nova" onkeydown="return event.key != 'Enter';">
                                        <span id="quantidade-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['quantidade'] ?>
                                        </span>
                                    </td>
                                    <!-- Coluna do preço do produto -->
                                    <td id="coluna-<?php echo $vetor_kit['id'] ?>">
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="preco_velho-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo number_format($vetor_kit['preco'], 2, ',', '') ?>">
                                        <!-- Input pra alterar o preço -->
                                        <input type="hidden" id="input_preco-<?php echo $vetor_kit['id'] ?>" name="preco_novo" class="form-control" value="R$ <?php echo number_format($vetor_kit['preco'], 2, ',', '') ?>" placeholder="Preço novo" onkeydown="return event.key != 'Enter';">
                                        <span id="preco-<?php echo $vetor_kit['id'] ?>">
                                            R$ <?php echo number_format($vetor_kit['preco'], 2, ',', '') ?>
                                        </span>
                                    </td>
                                    <!-- Coluna do preço do produto -->
                                    <td>R$ <span id="preco_total-<?php echo $vetor_kit['id'] ?>"><?php echo number_format($vetor_kit['preco_total'], 2, ',', '') ?></span></td>
                                    <td>
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="ncm_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['ncm'] ?>">
                                        <!-- Input pra alterar o ncm -->
                                        <input type="hidden" id="input_ncm-<?php echo $vetor_kit['id'] ?>" name="ncm_novo" class="form-control" value="<?php echo $vetor_kit['ncm'] ?>" placeholder="NCM novo" onkeydown="return event.key != 'Enter';">

                                        <span id="ncm-<?php echo $vetor_kit['id'] ?>">
                                            <?php echo $vetor_kit['ncm'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Input pra mostrar no modal -->
                                        <input type="hidden" id="cest_modal-<?php echo $vetor_kit['id'] ?>" class="form-control" value="<?php echo $vetor_kit['cest'] ?>">
                                        <!-- Input pra alterar o cest -->
                                        <input type="hidden" id="input_cest-<?php echo $vetor_kit['id'] ?>" name="cest_novo" class="form-control" value="<?php echo $vetor_kit['cest'] ?>" placeholder="CEST novo" onkeydown="return event.key != 'Enter';">

                                        <span id="cest-<?php echo $vetor_kit['id'] ?>">
                                            <?php if ($vetor_kit['cest'] == 0) {
                                                echo "–";
                                            } else {
                                                echo $vetor_kit['cest'];
                                            } ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="far fa-edit font-weight-bold" style="color: green; font-size: 24px; cursor: pointer;" data-toggle="tooltip" title="Editar <?php echo $vetor_kit['nome'] ?>" onclick="texto_input(<?php echo $vetor_kit['id'] ?>)"></i>
                                    </td>
                                    <td>
                                        <span id="span-<?php echo $vetor_kit['id'] ?>" style="cursor: not-allowed">
                                            <i id="icone-<?php echo $vetor_kit['id'] ?>" class="fas fa-check-square font-weight-bold" style="color: green; font-size: 24px; opacity: .5; pointer-events: none;" data-toggle="tooltip" title="Confirmar alterações de <?php echo $vetor_kit['nome'] ?>" onclick="alterar_info('<?php echo $vetor_kit['id'] ?>', document.getElementById('input_preco-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_nome-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_quantidade-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_athos-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_ncm-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_cest-<?php echo $vetor_kit['id'] ?>').value); mudarVetor('<?php echo $j ?>', document.getElementById('input_preco-<?php echo $vetor_kit['id'] ?>').value, document.getElementById('input_quantidade-<?php echo $vetor_kit['id'] ?>').value)"></i>
                                        </span>
                                    </td>
                                </form>
                            </tr>
                            <?php if ($j == $num_kits - 1) { ?>
                                <tr class="text-center">
                                    <td colspan="9" style="border-top-color: #5cb85c; border-top-width: 2px;">
                                        <font style="font-size: 24px" class="lead font-weight-bold">R$ <span id="preco_total_kit"><?php echo number_format($preco_total_kit, 2, ',', '') ?></span></font>
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
        <div class="modal fade" id="modalAlteradoInfo" tabindex="-1" role="dialog" aria-labelledby="modalAlteradoInfoTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-success" id="modalTitle">
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
                                        <td>
                                            <span id="nome_antigo_modal"></span>
                                        </td>
                                        <td>
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
        <!-- Modal alteração nome kit -->
        <div class="modal fade" id="modalAlteradoNomeKit" tabindex="-1" role="dialog" aria-labelledby="modalAlteradoNomeKitTitle" aria-hidden="true">
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
                        <div class="container">
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
                                <i class="fas fa-exclamation-triangle text-warning" style="margin-right: 8px; cursor: pointer" data-toggle="tooltip" data-html="true" data-placement="top" title="Dados adicionais <b>(fora de São Paulo)</b>"></i>Devido a Liminar ADI 5464, as empresas optantes pelo Simples Nacional estão desobrigadas a recolher o imposto DIFAL
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
