<?php

require './back-end/database_Config.php';


function create_DB() {
    global $servername; global $username; global $password; global $dbname;
    try {
        $pdo = new PDO("mysql:host=$servername", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS Yourspace";
        $pdo->exec($sql);
        // echo "Database created successfully<br>";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $pdo = null;
}

function connect_DB(){
    global $servername; global $username; global $password; global $dbname;
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=yourspace", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "connected successfully <br";
    } catch(PDOException $e) {
        echo "connection failed: " . $e->getMessage();
    }
    return $pdo;
}

function create_DB_Table() {
    global $servername; global $username; global $password; global $dbname;
    $pdo = connect_DB();
    try {
        // USERS TABLE CREATION
        $sql_users = "CREATE TABLE IF NOT EXISTS users (
        user_id INT(7) UNSIGNED AUTO_INCREMENT UNIQUE KEY,
        username VARCHAR(15) NOT NULL UNIQUE KEY,
        password VARCHAR(32) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY(user_id)
        )";

        $pdo->exec($sql_users);
        // echo "Table users created successfully <br>";
    } catch(PDOException $e) {
        echo $sql_users . "<br>" . $e->getMessage();
    }
    try {
        // POSTS TABLE CREATION
        $sql_posts = "CREATE TABLE IF NOT EXISTS posts (
        user_id INT(7) UNSIGNED NOT NULL,
        post_id INT(7) UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT,
        title VARCHAR(15) NOT NULL,
        content VARCHAR(255) NOT NULL,
        post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT user_id 
            FOREIGN KEY(user_id) 
            REFERENCES users(user_id) ON DELETE CASCADE
        )";

        $pdo->exec($sql_posts);
        // echo "Table posts created successfully <br>";
        $pdo = null;
    } catch(PDOException $e) {
        echo $sql_posts . "<br>" . $e->getMessage();
    }
    $pdo = null;
}

function create_User($user,$pass) {
    global $servername; global $username; global $password; global $dbname;
    $pdo = connect_DB();
    $pass_Hashed = md5($pass);
    try {
        $sql = "INSERT INTO users (username, password)
        VALUES (:user, :pass)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':user' => $user, ':pass' => $pass_Hashed));
        $pdo = null;
        return http_response_code(201);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $pdo = null;
}

function query_Username($checkname) {
    $pdo = connect_DB();
    $sql = "SELECT username FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':username' => $checkname));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}

function query_Password($user) {
    $pdo = connect_DB();
    $sql = "SELECT password FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':username' => $user));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result == TRUE) {
        $hashed_pass = $result['password'];
        return $hashed_pass;
        $pdo = null;
    }
    $pdo = null;
    return FALSE;
}

function get_ID($user) {
    $pdo = connect_DB();
    $sql = "SELECT user_id FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':username' => $user));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $result['user_id'];
    $pdo = null;
    return $user_id;
}

function query_ID($user_id){
    $pdo = connect_DB();
    $sql = "SELECT username FROM users WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}

function create_Post($title,$desc,$id) {
    global $servername; global $username; global $password; global $dbname;
    $pdo = connect_DB();
    try {
        $sql = "INSERT INTO posts (user_id, title, content)
        VALUES (:id, :title, :content)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':id' => $id, ':title' => $title, ':content' => $desc));
        $pdo = null;
        return http_response_code(201);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $pdo = null;
}

function search_By_Post_ID($post_id) {
    $pdo = connect_DB();
    $sql = "SELECT * FROM posts WHERE post_id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':post_id' => $post_id));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}

function search_By_User_ID($user_id) {
    $pdo = connect_DB();
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id));
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;
}
?>