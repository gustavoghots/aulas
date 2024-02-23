<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clientes";
    $tablename = "pessoas";

    $conn = new mysqli($servername,  $username, $password, $dbname);

    if($conn -> connect_error){
        die("Erro na conexão: " . $conn -> connect_error);
    }

    $sql = "SELECT * FROM $tablename";
    $result = $conn->query($sql);

    $data = array();

    if($result -> num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);

    $conn->close();

