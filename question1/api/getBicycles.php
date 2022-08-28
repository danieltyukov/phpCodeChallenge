<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// test sqlite database connection
if (!file_exists('../db/bicycleDB.db')) {
    echo "Database does not exist";
}
echo "Database exists";

$pdo = new PDO('sqlite:../db/bicycleDB.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM bicycleDB";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$bicycles = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($bicycles, JSON_PRETTY_PRINT);
