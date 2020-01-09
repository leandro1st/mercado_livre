
<?php

if (isset($_GET["term"])) {
    $connect = new PDO("mysql:host=localhost; dbname=mercado_livre", "root", "");

    $term = mb_convert_case(trim($_GET['term']), MB_CASE_UPPER, 'utf-8');

    $query = "SELECT DISTINCT kit_nome, id_kit FROM kits WHERE kit_nome LIKE '%" . $term . "%' or id_kit LIKE '%" . $term . "%'  ORDER BY kit_nome ASC";

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