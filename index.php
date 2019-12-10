<?php
require('externo/connect.php');
$pesquisar = mysqli_query($connect, "SELECT * FROM $kits");
$pesquisar2 = mysqli_query($connect, "SELECT COUNT(*) c, $id_kit, $kit_nome FROM $kits GROUP BY $id_kit HAVING c >= 1");
$num_kits = mysqli_num_rows($pesquisar2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mercado Livre | <?php echo $num_kits ?> kits</title>
    <link rel="shortcut icon" href="imagens/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="externo/style.css">
    <script src="jquery/jquery-3.4.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="imagens/logo.png" alt="logo" width="35px">
            <!-- <i class="far fa-calendar-alt" style="font-size: 35px;"></i> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item px-1 active underline">
                    <a class="nav-link" href="#"><i class="fas fa-home" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
                <li class="nav-item px-1">
                    <a class="nav-link" href="cadastrar/"><i class="fas fa-edit" style="font-size: 24px; vertical-align: middle"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="#">
                <input class="form-control mr-sm-2" name="nome_produto" placeholder="Nome do kit" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    <header class="jumbotron" style="background-image: url('imagens/wallpaper.jpg'); background-size: cover; background-position: center; padding: 100px; border-radius: 0">
        <center>
            <h1 style="color: white">Mercado Livre</h1>
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
                <div class="card">
                    <?php if ($i == 0) { ?>
                        <div class="card-header" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer;">
                            <h5 class="accordion-toggle" style="margin: 0px">
                                <?php echo $vetor2['kit_nome'] . " (#" . $vetor2['id_kit'] . ")" ?>
                            </h5>
                        </div>
                        <div id="collapse_<?php echo $i ?>" class="collapse show" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                        <?php } else { ?>
                            <div class="card-header collapsed" id="heading_<?php echo $i ?>" data-toggle="collapse" data-target="#collapse_<?php echo $i ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i ?>" style="cursor: pointer;">
                                <h5 class="accordion-toggle" style="margin: 0px">
                                    <?php echo $vetor2['kit_nome'] . " (#" . $vetor2['id_kit'] . ")" ?>
                                </h5>
                            </div>
                            <div id="collapse_<?php echo $i ?>" class="collapse" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordionKits">
                            <?php } ?>
                            <div class="card-body" style="padding: 10px 40px 10px 40px;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">#</th>
                                            <th scope="col">Nome do produto</th>
                                            <th scope="col">Quantidade</th>
                                            <th scope="col" width="auto">Preço</th>
                                            <th scope="col">Preço Total</th>
                                            <th scope="col">NCM</th>
                                            <th scope="col">CEST</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            for ($j = 0; $j < $numero_repetido; $j++) {
                                                $vetor = mysqli_fetch_assoc($pesquisar);
                                                $id_do_kit = $vetor['id_kit'];
                                                ?>
                                            <tr class="text-center">
                                                <td><?php echo $vetor['cod_athos'] ?></td>
                                                <td><?php echo $vetor['nome'] ?></td>
                                                <td><?php echo $vetor['quantidade'] ?></td>
                                                <td>R$ <?php echo number_format($vetor['preco'], 2, ',', '') ?></td>
                                                <td>R$ <?php echo number_format($vetor['preco_total'], 2, ',', '') ?></td>
                                                <td><?php echo $vetor['ncm'] ?></td>
                                                <td><?php echo $vetor['cest'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
    </main><br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- Footer -->
    <footer class="footer">
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