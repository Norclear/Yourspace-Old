<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
Title: <input type="text" placeholder="Title" name="Title">
<br>
Description: <input type="text" placeholder="Description" name="Description">
<br>
<input id='submit' name='submit' type="submit" value="Post">
</form>
<a href='./posts.php'>Search posts</a>
</body>
</html>