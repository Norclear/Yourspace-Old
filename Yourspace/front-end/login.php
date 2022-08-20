<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
require '../back-end/functionsDB.php';

connect_DB();

$userErr = $passErr = '';
$user = $pass = '';
$userOkay = $passOkay = FALSE;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $userErr = "Incorrect credentials";
    }
    else {
        $result = query_Username($_POST["username"]);
        if ($result == TRUE ) {
            $userOkay = TRUE;
            $user = $_POST["username"];
        }
        else {
            $userErr = "Incorrect credentials";
        }
    }
    if (empty($_POST["password"])) {
        $passErr = "Incorrect credentials";
    }
    else {
        $result = query_Password($_POST["password"],$_POST["username"]);
        $pass_Hash = md5($_POST["password"]);
        if ($result[0] == $pass_Hash) {
        $passOkay = TRUE;
        }
        else {
            $passErr = "Incorrect credentials";
        }
    }

}
?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        Username: <input type="text" placeholder="Username" name="username" value="<?php echo $user; ?>">
        <br>
        Password: <input type="password" placeholder="Password" name="password">
        <br>
        <input id='submit' name='submit' type="submit" value="Login">
    </form>

<?php


if ($userOkay == TRUE and $passOkay == TRUE) {
    echo "User logged in: " . $user . "<br>";
    echo "at time and a date " . date("y/m/d"). " @ " . date("H.i.s") . "<br>";
}
else {
    echo $userErr ."<br>";
    echo $passErr ."<br>";
}

?>
</body>
</html>