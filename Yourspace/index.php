<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yourspace</title>
</head>
<body>
    <?php require './back-end/functions/functionsDB.php';
    create_DB();
    create_DB_table();
    echo '<br>'
    ?>
    <header class="header">
        <?php 
        require_once("front-end/modules/header.php");     
        ?>
        
    </header>

    <a href="front-end\signup.php" style="text-align: left;">Sign up</a>
    <br>
    <a href="front-end\login.php" style="text-align: left;">Login</a>
    <br>
    <a href="front-end\posts.php" style="text-align: left;">Search Posts</a>
    
    <footer class="footer">
        <?php include './front-end/modules/footer.php';?>
    </footer>
</body>
</html>
