<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../class/bicycle.php';

$data = json_decode(file_get_contents("php://input"));
$rotations = 10;

// $editBicycle = new EditBicycle($data->id);
$editBicycle = new EditBicycle(2);

// call cycle function with the id of the bicycle to be cycled and the number of rotations
$distance = $editBicycle->cycle($rotations);
echo json_encode(
    array('message' => 'Bicycle Cycled', 'distance' => $distance)
);
