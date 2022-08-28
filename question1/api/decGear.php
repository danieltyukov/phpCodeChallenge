<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../class/bicycle.php';

$data = json_decode(file_get_contents("php://input"));

// $editBicycle = new EditBicycle($data->id);
$editBicycle = new EditBicycle(2);

if ($editBicycle->decreaseGear($editBicycle->id)) {
    echo json_encode(
        array('message' => 'Bicycle Gear Decreased')
    );
} else {
    echo json_encode(
        array('message' => 'Bicycle Gear Not Decreased')
    );
}
