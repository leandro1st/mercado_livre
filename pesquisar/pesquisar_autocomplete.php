
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

    $array_kit = array();
    if ($total_row > 0) {
        foreach ($result as $row) {
            $temp_array = array();
            $temp_array['value'] = $row['id_kit'];
            $temp_array['label'] = '<div class="row" style="margin: 0; display: flex; justify-content: center; align-items: center"><div class="col">' . $row['kit_nome'] . ' <span style="font-size: 14px">(#' . $row['id_kit'] . ')</span></div></div>';
            $array_kit[] = $temp_array;
        }
    } else {
        // $array_kit['value'] = '';
        // $array_kit['label'] = '<span style="padding-left: 70px"></span>';
    }
    echo json_encode($array_kit);
}

?>