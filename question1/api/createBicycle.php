<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../class/bicycle.php';

$data = json_decode(file_get_contents("php://input"));

// $bicycle = new Bicycle($data->gear_type, $data->gear_level, $data->wheel_size, $data->num_rings);
$bicycle = new Bicycle("expensive", 10, 26, 30);

if ($bicycle->createBicycle()) {
    echo json_encode(
        array('message' => 'Bicycle Created')
    );
} else {
    echo json_encode(
        array('message' => 'Bicycle Not Created')
    );
}
