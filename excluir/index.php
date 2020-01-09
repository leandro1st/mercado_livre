<?php
require('../externo/connect.php');
$pesquisar = mysqli_query($connect, "SELECT * FROM $kits ORDER BY $kit_nome");
$pesquisar2 = mysqli_query($connect, "SELECT COUNT(*) c, $id_kit, $kit_nome FROM $kits GROUP BY $id_kit HAVING c >= 1 ORDER BY $kit_nome");
// $num_kits = 0;
$num_kits = mysqli_num_rows($pesquisar2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | Excluir Kits</title>
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
    #raphtalia {
        position: absolute !important;
        left: 50% !important;
        margin-left: -30px !important;
        top: 55% !important;
    }
    </style>
    <script>
        function obter_dados(id_kit, nome_kit, quantidade) {
            document.getElementById('input_id_kit').value = id_kit;
            document.getElementById('input_quantidade').value = quantidade;
            document.getElementById('nome').innerHTML = nome_kit;
            document.getElementById('nome_kit_modal').innerHTML = nome_kit;
            document.getElementById('codigo').innerHTML = id_kit;
            document.getElementById('quantidade').innerHTML = quantidade;
        }

        var paragrafo_1366 = "<p class='lead' style='padding-top: 151px; font-size: 40px; text-align: center;'>Comece cadastrando novos kits!</p>";
        var paragrafo_1920 = "<p class='lead' style='padding-top: 183px; font-size: 40px; text-align: center;'>Comece cadastrando novos kits!</p>";

        function excluir(id_kit, numero_restante) {
            $.ajax({
                method: 'POST',
                url: 'excluir.php',
                data: $('#form_excluir').serialize(),
                success: function(data) {
                    numero_restante -= 1;
                    document.getElementById('numero_restante').value = numero_restante;
                    $('#card-' + id_kit).fadeOut(500, function() {
                        $('#card-' + id_kit).remove();
                    });
                    if (numero_restante == 0) {
                        if (window.matchMedia("(max-width:1366px)").matches) {
                            $("main").append(paragrafo_1366);
                            /* Para resolução 1366x768 */
                            document.getElementById("footer1").style.marginBottom = "-250px";
                        } else if (window.matchMedia("(min-width:1600px) and (max-width:1920px)").matches) {
                            $("main").append(paragrafo_1920);
                            /* Para resolução 1920x1080 */
                            document.getElementById("footer1").style.marginBottom = "0px";
                        }
                    }
                },
                error: function(data) {
                    alert("Ocorreu um erro!");
                }
            });
        };
        
        $(function () {
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
                <li class="nav-item px-1 active">
                    <a class="nav-link underline" href="#"><i class="far fa-trash-alt text-danger" style="font-size: 24px; vertical-align: middle"></i></a>
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
            <li class="breadcrumb-item active"><a href="#" class="none_li"><i class="far fa-trash-alt"></i> Excluir Kits</a></li>
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
                <div id="raphtalia" data-depth="0.8"><img src="../imagens/raphtalia.png" alt="raphtalia" width="60px"></div>
            </div>
            <p class="lead" style="padding-top: 8%; font-size: 40px; text-align: center">Comece cadastrando novos kits!</p>
        <?php } else { ?>
    <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
        <center>
            <h1 style="color: #daeff5">Excluir Kits</h1>
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
                <div class="card" id="card-<?php echo $id_do_kit ?>">
                    <?php if ($i == 0) { ?>
                    <div class="card-header" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer">
                        <h5 class="accordion-toggle" style="margin: 0px">
                            <?php echo $vetor2['kit_nome'] . " <b><span style='font-size: 14px'>(#" . $vetor2['id_kit'] . ")</span></b>" ?>
                        </h5>
                    </div>
                    <div id="collapse_<?php echo $i ?>" class="collapse show" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                    <?php } else { ?>
                        <div class="card-header collapsed" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer">
                            <h5 class="accordion-toggle" style="margin: 0px">
                                <?php echo $vetor2['kit_nome'] . " <b><span style='font-size: 14px'>(#" . $vetor2['id_kit'] . ")</span></b>" ?>
                            </h5>
                        </div>
                        <div id="collapse_<?php echo $i ?>" class="collapse" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                        <?php } ?>
                        <div class="card-body" style="padding: 10px 40px 10px 40px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" width="8%">#</th>
                                        <th scope="col" width="35%">Nome do produto</th>
                                        <th scope="col" width="2%">Quantidade</th>
                                        <th scope="col" width="13,75%">Preço</th>
                                        <th scope="col" width="13,75%">Preço Total</th>
                                        <th scope="col" width="13,75%">NCM</th>
                                        <th scope="col" width="13,75%">CEST</th>
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
                                            <td><?php echo $vetor['cest'] ?></td>
                                            <!-- <td><?php echo $vetor['kit_nome'] ?></td> -->
                                        </tr>
                                        <?php if ($j == $numero_repetido - 1) { ?>
                                            <tr class="text-center">
                                                <td colspan="7" style="border-top-color: #5cb85c; border-top-width: 2px;">
                                                    <font style="font-size: 24px" class="lead font-weight-bold">R$ <?php echo number_format($preco_total_kit, 2, ',', '') ?></font>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir" style="float: right; margin-bottom: -40px" onclick="obter_dados('<?php echo $id_do_kit ?>', '<?php echo $vetor2['kit_nome'] ?>' ,'<?php echo $numero_repetido ?>')">
                                                        Excluir <i class="far fa-trash-alt" style="color: white;"></i>
                                                    </button>
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
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle">
                        <font color="#D9534F">Deseja realmente excluir <span id="nome_kit_modal"></span>?</font>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_excluir" name="form_excluir" method="POST">
                        <input type="hidden" id="input_id_kit" class="form-control" name="input_id_kit" value="<?php echo $id_do_kit ?>" readonly>
                        <input type="hidden" id="input_quantidade" class="form-control" name="input_quantidade" value="<?php echo $numero_repetido ?>" readonly>
                    </form>
                    <input type="hidden" id="numero_restante" value="<?php echo $num_kits ?>">
                    <div class="container">
                        <span class="font-weight-bold" style="font-size: 18px">Nome do kit: </span>
                        <nome id="nome" class="lead" style="overflow-wrap: break-word;"></nome><br>
                        <span class="font-weight-bold" style="font-size: 18px">Id do kit: </span>
                        <codigo id="codigo" class="lead"></codigo><br>
                        <span class="font-weight-bold" style="font-size: 18px">Quantidade de produtos: </span>
                        <quantidade id="quantidade" class="lead"></quantidade><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" onclick="excluir(document.getElementById('input_id_kit').value, document.getElementById('numero_restante').value)" data-dismiss="modal">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php if ($num_kits == 0) { ?>
        <footer id="footer1" class="footer" style="margin-bottom: -250px"> <!-- style="margin-bottom: -100px" -->
    <?php } else { ?>
        <footer id="footer1" class="footer" style="margin-bottom: -250px"> <!-- style="margin-bottom: -200px" -->
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