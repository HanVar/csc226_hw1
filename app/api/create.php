<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/dog_adoption.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new dog_adoption($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->breed = $data->breed;
    $item->age = $data->age;
    $item->gender = $data->gender;
    $item->date_entered = date('Y-m-d H:i:s');
    
    if($item->createDog()){
        echo 'Dog created successfully.';
    } else{
        echo 'Dog could not be created.';
    }
?>