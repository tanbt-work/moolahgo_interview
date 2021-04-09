<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");

function insertReferalCode($code) {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "moolahgo";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare( "INSERT INTO referal_code (code) VALUES (:code)" );
  $stmt->bindParam(':code', $code);
  $stmt->execute();

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}

$errors = [];
$data = [];
$pattern = '/^[A-Z0-9]{6}$/';


if (!empty($_POST)) {
  if (isset($_POST['referalCode'])){
    preg_match($pattern, $_POST['referalCode'], $matches);
    if(empty($matches)){
      $errors['referalCode'] = 'Invalid referal code.';
      $data['http_code'] = 400;
    }    
  } else {
    $errors['referalCode'] = 'Required referal code.';
    $data['http_code'] = 400;
  }
} else {
  $errors['referalCode'] = 'No data to post';
  if($_SERVER['REQUEST_METHOD'] != "POST"){
    $errors['referalCode']  = $_SERVER['REQUEST_METHOD'] . " is not allowed.";
  }
  $data['http_code'] = 405;
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['http_code'] = 200;
    $data['message'] = 'Success';
    insertReferalCode($_POST['referalCode']);
}


echo json_encode($data);