
<?php

if (isset($_GET["term"])) {
    $connect = new PDO("mysql:host=localhost; dbname=mercado_livre", "root", "");

    $term_post = mb_convert_case(trim($_GET['term']), MB_CASE_UPPER, 'utf-8');

    // dividindo $term_post em partes e criando termos de pesquisa para cada pedaço de string e armazenando-os numa string
    $searchTerms = explode(' ', $term_post);
    $searchTermBits = array();
    foreach ($searchTerms as $term) {
        $term = trim($term);
        if (!empty($term)) {
            $searchTermBits[] = "(kit_nome LIKE '%$term%' or id_kit LIKE '%$term%')";
        }
    }

    // query, juntando as strings armazenadas dentro do array $searchTermBits
    $query = "SELECT DISTINCT kit_nome, id_kit FROM kits WHERE " . implode(" AND ", $searchTermBits) . " ORDER BY kit_nome ASC";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    $total_row = $statement->rowCount();

    // Query para encontrar kits de acordo com o termo buscado
    // $query_pesquisar_kit = "SELECT id_kit FROM kits WHERE " . implode(" AND ", $searchTermBits) . "  GROUP BY id_kit ORDER BY kit_nome ASC";
    // $statement2 = $connect->prepare($query_pesquisar_kit);
    // $statement2->execute();
    // $vetor_kits_encontrados = $statement2->fetchAll();

    // Array para armazenar preço total de cada kit encontrado
    $array_precos = array();
    foreach ($result as $kit) {
        $vetor_id = $kit['id_kit'];
        // Query para filtrar kit repetido
        $query_pesquisar_kits_repetidos = "SELECT preco_total FROM kits WHERE id_kit = '$vetor_id'";
        $statement3 = $connect->prepare($query_pesquisar_kits_repetidos);
        $statement3->execute();
        $vetor_kit_repetido = $statement3->fetchAll();
        $preco_total_kit = 0;
        // Loop para armazenar preço total do kit
        foreach ($vetor_kit_repetido as $kit_repetido) {
            $preco_total_kit += $kit_repetido['preco_total'];
        }
        // Appending to array
        array_push($array_precos, $preco_total_kit);
    }

    $array_kit = array();
    if ($total_row > 0) {
        // Variavel de controle para acessar cada posição do array
        $x = 0;
        foreach ($result as $row) {
            $temp_array = array();
            $temp_array['value'] = $row['id_kit'];
            $temp_array['label'] = '<div class="row" style="margin: 0; display: flex; justify-content: center; align-items: center"><div class="col" style="word-wrap: break-word">' . $row['kit_nome'] . ' <span style="font-size: 14px">(#' . $row['id_kit'] . ')</span><br><small class="font-weight-bold text-danger float-right" style="font-size: 17px"> R$ ' . number_format($array_precos[$x], 2, ',', '.') . '</small></div></div>';
            $array_kit[] = $temp_array;
            $x++;
        }
    } else {
        // $array_kit['value'] = '';
        // $array_kit['label'] = '<span style="padding-left: 70px"></span>';
    }
    echo json_encode($array_kit);
}

?>