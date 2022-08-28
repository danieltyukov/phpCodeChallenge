<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../class/bicycle.php';

$data = json_decode(file_get_contents("php://input"));

// $editBicycle = new EditBicycle($data->id);
$editBicycle = new EditBicycle(4);

if ($editBicycle->increaseGear($editBicycle->id)) {
    echo json_encode(
        array('message' => 'Bicycle Gear Increased')
    );
} else {
    echo json_encode(
        array('message' => 'Bicycle Gear Not Increased')
    );
}
