<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title> <?php #echo $_COOKIE["user"] . "'s profile";?>
</head>
<body>

    <header class="header">
        <?php include './modules/header.php';?>
    </header>
    
<?php
require '../back-end/functions/functionsDB.php';
create_DB();
create_DB_table();

if(isset($_COOKIE["user"])) {
    $current_User = unserialize($_COOKIE['user']);
    echo '<br>';
    echo "Hello user.. " . $current_User['user'];
    echo "<br>";
    $id = $current_User['id'];
    echo "Your user id is " . $id;

    echo  '<br> <a href="post.php" style="text-align: left;">Create Post</a>';
} 
else {
    echo "You're not logged in!";
}

?>

 <footer class="footer">
        <?php include './modules/footer.php';?>
</footer>
</body>
</html>