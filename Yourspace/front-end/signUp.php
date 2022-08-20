<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signUp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet"> 
</head>
<body>
 
<?php 

require '../back-end/functionsDB.php';

create_DB();
connect_DB();
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
                        print_r($result);
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
    
<?php

if ($userOkay == TRUE and $passOkay == TRUE) {
    create_User($user,$pass);
    echo "New user created named " . $user . "<br>";
    echo "at time and a date " . date("y/m/d"). " @ " . date("H.i.s") . "<br>";
}
else {
    echo $userErr ."<br>";
    echo $passErr ."<br>";
}
$conn = null
?>
  
    <footer class="footer">
        <?php include 'footer.php';?>
    </footer>
</body>
</html>


