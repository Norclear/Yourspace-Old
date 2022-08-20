<?php

$servername = "localhost";
$username = "root";
$password = "local_Development747";
$dbname = "yourspace";



function create_DB() {
    global $servername; global $username; global $password; global $dbname;
    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE Yourspace";
        $conn->exec($sql);
        // echo "Database created successfully<br>";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

function connect_DB(){
    global $servername; global $username; global $password; global $dbname;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=yourspace", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully <br";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

function create_DB_Table() {
    global $servername; global $username; global $password; global $dbname;
    $conn = connect_DB();
    try {
        // sql to create table
        $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE KEY,
        username VARCHAR(15) NOT NULL UNIQUE KEY,
        password VARCHAR(32) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        // use  () because no results are returned
        $conn->exec($sql);
        // echo "Table users created successfully <br>";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

function create_User($user,$pass) {
    global $servername; global $username; global $password; global $dbname;
    $conn = connect_DB();
    $pass_Hashed = md5($pass);
    try {
        $sql = "INSERT INTO users (username, password)
        VALUES ('$user', '$pass_Hashed')";
        // use exec() because no results are returned
        $conn->exec($sql);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}

function query_Username($checkname) {
    $conn = connect_DB();
    $result = $conn->query("SELECT username FROM users WHERE username = '$checkname'");
    $result = $result->fetch();
    $conn = null;
    return $result;
}

function query_Password($checkpass,$user) {
    $conn = connect_DB();
    $result = $conn->query("SELECT password FROM users WHERE username = '$user'");
    $result = $result->fetch();
    $conn = null;
    return $result;
}
?>