<?
    header("Content-type: application/json; charset=utf-8");
    $received_data = json_decode(file_get_contents("php://input"));

    echo json_encode($received_data);
?>