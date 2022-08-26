<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
$user = $pass = '';
$userOkay = $passOkay = FALSE;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $userErr = "Username field required <br>";
    }
    else {
        if (strlen($_POST["username"]) > 15) {
            $userErr = "Username can be no more than 15 characters! <br>";
        }
        else {
            if (strlen($_POST["username"]) < 4) {
            $userErr = "Username must be  more than 4 characters! <br>";
          }
            else {
                if (!preg_match("/^[a-zA-Z-'0-9_]*$/",$_POST["username"])) {
                    $userErr = "Only a-Z, 0-9 and _ <br>";
                }
                else {
                    $result = query_Username($_POST["username"]);
                    if ($result == true ) {
                        $userErr = "Username Already Taken! <br>";
                    }
                    else {
                        $user = proccessData($_POST["username"]);
                        $userOkay = TRUE;  
                    }
                }  
            }
        }
    }
    if (empty($_POST["password"])) {
        $passErr = "Password field required! <br>";
    }
    else {
        if (strlen($_POST["password"]) < 7) {
            $userErr = "Password must be more than 7 characters! <br>";
        }
        else {
            $pass = $_POST["password"];
            $passOkay = TRUE;
        }
    }
}

function proccessData($data) {
    $data = htmlspecialchars(stripcslashes(trim($data)));
    return $data;
}
$conn = null
?>

   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        Username: <input type="text" placeholder="Username" name="username" value="<?php echo $user; ?>">
        <br>
        Password: <input type="password" placeholder="Password" name="password">
        <br>
        <input id='submit' name='submit' type="submit" value="Sign Up">
    </form>
    <a href='./login.php'>Got an account?</a>
    <br>
    
<?php

if ($userOkay == TRUE and $passOkay == TRUE) {
    require '../back-end/functions/cookies.php';
    create_User($user,$pass);
    $id = get_ID($user);
    $info = ['user' => $user, 'pass' => md5($pass), 'id' => $id];
    $info = serialize($info);
    login_Cookie($info);
}
else {
    echo $userErr ."<br>";
    echo $passErr ."<br>";
    return http_response_code(400);
}
$conn = null
?>
  
    <footer class="footer">
        <?php include './modules/footer.php';?>
    </footer>
</body>
</html>


