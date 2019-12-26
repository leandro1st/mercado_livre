<?php
require('../externo/connect.php');

$nome_kit_post = $_POST['nome_do_kit'];
$procurar = mysqli_query($connect, "SELECT * FROM $kits WHERE $id_kit = '$nome_kit_post'");/* or $kit_nome = '$nome_kit_post' */
$mostrar_nome_kit = mysqli_query($connect, "SELECT $kit_nome, $id_kit FROM $kits WHERE $id_kit = '$nome_kit_post' or $kit_nome like '%" . $nome_kit_post . "%'");
$num_kits = mysqli_num_rows($procurar);
$vetor_mostrar_nome_kit = mysqli_fetch_array($mostrar_nome_kit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php if ($nome_kit_post == '') { ?>
            Mercado Livre | Pesquisar
        <?php } else if ($num_kits == 0) { ?>
            Mercado Livre | <?php echo $nome_kit_post ?>
        <?php } else { ?>
            Mercado Livre | <?php echo $nome_kit_post ?>
        <?php } ?>
    </title>
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="../externo/style.css">
    <script src="../jquery/jquery-3.4.0.min.js"></script>
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

        #megumin {
            position: absolute !important;
            left: 50% !important;
            margin-left: -30px !important;
            top: 55% !important;
        }
    </style>
    <script>
        // alert($(window).width());
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
                    <a class="nav-link" href="../cadastrar/"><i class="fas fa-edit" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="../excluir/"><i class="fas fa-trash" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1 active underline">
                    <a class="nav-link" href="#"><i class="fas fa-search" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="./">
                <input class="form-control mr-sm-2" name="nome_do_kit" placeholder="Digite o código do kit" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
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
        <?php if ($nome_kit_post == '') { ?>
            <p class="lead" style="padding-top: 8%; font-size: 40px; text-align: center">Nenhum código fornecido!</p>
        <?php } else { ?>
            <p class="lead" style="padding-top: 8%; font-size: 40px; text-align: center">Nenhum kit com esse código encontrado!</p>
        <?php } ?>
    <?php } else { ?>
        <header class="jumbotron" style="background-image: url('../imagens/wallpaper.jpg'); background-size: cover; background-position: center 38%; padding: 100px; border-radius: 0">
            <h1 style="text-align: center">
                <span style="color: #edead8"><?php echo $vetor_mostrar_nome_kit['kit_nome'] . " </span><b><span class='text-warning' style='font-size: 22px'>(#" . $vetor_mostrar_nome_kit['id_kit'] . ")</span></b>" ?>
            </h1>
        </header>
        <main class="container">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $preco_total_kit = 0;
                    for ($j = 0; $j < $num_kits; $j++) {
                        $vetor_kit = mysqli_fetch_array($procurar);
                        $preco_total_kit = $preco_total_kit + $vetor_kit['preco_total'];
                    ?>
                        <tr class="text-center">
                            <td><?php echo $vetor_kit['cod_athos'] ?></td>
                            <td style="max-width: 400px; word-wrap: break-word;"><?php echo $vetor_kit['nome'] ?></td>
                            <td><?php echo $vetor_kit['quantidade'] ?></td>
                            <td>R$ <?php echo number_format($vetor_kit['preco'], 2, ',', '') ?></td>
                            <td>R$ <?php echo number_format($vetor_kit['preco_total'], 2, ',', '') ?></td>
                            <td><?php echo $vetor_kit['ncm'] ?></td>
                            <td><?php echo $vetor_kit['cest'] ?></td>
                        </tr>
                        <?php if ($j == $num_kits - 1) { ?>
                            <tr class="text-center">
                                <td colspan="7" style="border-top-color: #5cb85c; border-top-width: 2px;">
                                    <font style="font-size: 24px" class="lead font-weight-bold">R$ <?php echo number_format($preco_total_kit, 2, ',', '') ?></font>
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
    <!-- Footer -->
    <?php if ($num_kits == 0) { ?>
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
            <script>
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
</body>

</html>