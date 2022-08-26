<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <header class="header">
        <?php include './modules/header.php';?>
    </header>

<?php
require '../back-end/functions/functionsDB.php';
    global $code; global $title_Okay; global $desc_Okay; global $title; global $desc; global $err;
if (isset($_COOKIE['user'])) {
    require '../back-end/functions/post_Form.php';
    //ом пател;
    //Devaan Sreeram lives at;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        global $code; global $title_Okay; global $desc_Okay; global $title; global $desc; global $err;
        $title_Okay =  $desc_Okay = FALSE;
        $title = $_POST['Title'];
        $desc = $_POST['Description'];
        $err = '';
        if (!$title || !$desc ) {
            $err = 'Field Missing';
            $code = http_response_code(400);
        }
        else {
            if (strlen($title) > 25) {
                $err = 'Title too long (25 Characters)';
                $code = http_response_code(400);
            }
            else {
                if (strlen($desc) > 255) {
                    $err = 'Description too long (255 Characters)';
                    $code = http_response_code(400);
                }
                else {
                    $title_Okay = $desc_Okay = TRUE;
                }
            }
        }
    }
}
else {
    echo '401 Unauthorized';
    return http_response_code(401);
}

if ($title_Okay && $desc_Okay == TRUE) {
    $cookie = unserialize($_COOKIE['user']);
    $id = $cookie['id'];
    create_Post($title,$desc,$id);
    return http_response_code(201);
}
else {
    echo $err;
    return $code;
}
?>

   
  
    <footer class="footer">
        <?php include './modules/footer.php';?>
    </footer>
</body>
</html>


