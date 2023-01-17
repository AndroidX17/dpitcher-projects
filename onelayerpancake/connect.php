<?php
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $language = $_POST['language'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Database connection
   require_once '../keys/storage.php';

   // $conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) {

    die('Connection Failed : '.$conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, language, email, password)
    VALUES (?, ?, ?, ?, ?)");


    $stmt->bind_param("sssss",$firstName, $lastName, $language, $email, $password);
    $stmt->execute();
$stmt->store_result();
/*
    if (mysqli_query($conn,$stmt)) {

        echo "NEw record YAY";
    } else {
        echo "error: " . $stmt . "<BR>" . mysqli_error($conn);
    }*/

    echo "registratin Sucecsefuly...";
    $stmt->close();
    $conn->close();


   // header('location: database.php');



}



?>