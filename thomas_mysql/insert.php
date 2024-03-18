<?php

require_once './conn.php';


    //For form.php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $email_address = $_POST['email_address'];
    $password = $_POST['password'];

    
    $select_query = "SELECT * FROM reg_table WHERE email_address = :email_address";
    $stmt1 = $conn->prepare($select_query);
    $stmt1->bindParam(':email_address', $email_address);
    $stmt1->execute();
    if ($stmt1->rowCount() > 0) {
        $data = array("status" => "error", "message" => "Email already exists.");
        echo json_encode($data);
    } else {
    try {
        $sql = "INSERT INTO reg_table (username, first_name, middle_name, last_name, gender, birthdate, age, email_address, password) 
        VALUES (:username, :first_name, :middle_name, :last_name, :gender, :birthdate, :age, :email_address, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':middle_name', $middle_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email_address', $email_address);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        echo "Data inserted successfully";

        $data = array("status" => "success", "message" => "Data inserted successfully.");
        echo json_encode($data);

        $con = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
} else {
echo "server error";
}

//try{
   // prepare the SQL query with placeholders
   // $sql = "INSERT INTO user (name,email) VALUES (:name,:email)";
   // $stmt = $conn->prepare($sql);
    //$stmt->bindParam(':name', $name);
  //  $stmt->bindParam(':email', $email);
   // $name = "John Doe";
   // $email = "john@example.com";
   // $stmt->execute();
   //echo "Data inserted successfully";
   // $conn = null;
//} catch(PDOException $error){
    //echo "Error:" .$error->getMessage();
//}


?>