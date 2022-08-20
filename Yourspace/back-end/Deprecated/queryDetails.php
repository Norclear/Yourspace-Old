<?php
function queryForUser($checkname) {
    require 'connectDb.php';
    $result = $conn->query("SELECT username FROM users WHERE username = '$checkname'");
    $result = $result->fetch();
    $conn = null;
    return $result;
}
?>
