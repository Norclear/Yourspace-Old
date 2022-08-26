<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>

    <header class="header">
        <?php include './modules/header.php';?>
    </header>

<?php
require '../back-end/functions/functionsDB.php';
create_DB();
create_DB_table();

$parts = parse_url($_SERVER['REQUEST_URI']);
parse_str($parts['query'], $query);
$id =  $query['id'];
$user_Array = query_ID($id);
if ($user_Array == true) {
    $requsted_Username = $user_Array['username'];
    echo "Welcome to " . $requsted_Username . "'s profile";
}
else {
    echo '404 Not Found';
    return http_response_code(404);
}

?>
 <footer class="footer">
        <?php include './modules/footer.php';?>
</footer>

</body>
</html>