<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <header class="header">
        <?php include './modules/header.php';?>
    </header>
    
<?php
require '../back-end/functions/functionsDB.php';
create_DB();
create_DB_table();

$userErr = $passErr = '';
$user = $pass = $pass_Hash = '';
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
        $result = query_Password($_POST["username"]);
        global $pass_Hash;
        $pass_Hash = md5($_POST["password"]);
        if ($result == $pass_Hash) {
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
    <a href='./signup.php'>No Account?</a>
    <br>


<?php
require '../back-end/functions/cookies.php';

if ($userOkay == TRUE and $passOkay == TRUE) {
    $id = get_ID($user);
    $info = ['user' => $user, 'pass' => $pass_Hash, 'id' => $id];
    $info = serialize($info);
    login_Cookie($info);
}
else {
    echo $userErr ."<br>";
    echo $passErr ."<br>";
}
?>

    <footer class="footer">
        <?php include './modules/footer.php';?>
    </footer>

</body>
</html>