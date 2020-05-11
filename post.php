<?php

$servername = "localhost";

// REPLACE with your DB name
$dbname = "hey_waiter";

// REPLACE with DB user
$username = "root";

// REPLACE with DB user password
$password = "";

//This API Key value must be  the same than the Api Key used in the ESP32 
$api_key_value = "Hzn97bK";

$api_key= $tableNumber = $request = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $tableNumber = test_input($_POST["tableNumber"]);
        $request = test_input($_POST["request"]);

        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO app (tableNumber, request)
        VALUES ('" . $tableNumber . "', '" . $request . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
