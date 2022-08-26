<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <header class="header">
        <?php include './modules/header.php';?>
    </header>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
    <input type='text' name='id' placeholder='Search by ID'> </input>
    <label>Search by ID of:</label>
    <select name="type" >
        <option value="user">User</option>
        <option value="post">Post</option>
    </select>
    <br>
    <input type='submit' name='submit' value='Query'></input>
    </form>
<?php

require '../back-end/functions/functionsDB.php';
create_DB();
create_DB_table();

if($_SERVER["REQUEST_METHOD"] == "GET") {

    $parts = parse_url($_SERVER['REQUEST_URI']);
    parse_str($parts['query'], $query);
    echo '<br>';
    if(in_array('post',$query) == TRUE) {
        $post = search_By_Post_ID($query['id']);
        if ($post == TRUE) {

            echo '<div>
                    <h1>' . $post['title'] . '</h1>
                    <p1> ' . $post['content'] . ' </p1>
                    <br>
                    <p1> Post ID: ' . $post['post_id'] . ' </p1>
                    <hr>
                 </div>';

            return http_response_code(200);
        }
        else {
            echo '404 Not Found';
            return http_response_code(404);
        }
    }
    elseif(in_array('user',$query) == TRUE) {
        $posts = search_By_User_ID($query['id']);
        if ($posts == TRUE) {
            foreach ($posts as $post) {

                echo '<div>
                    <h1>' . $post['title'] . '</h1>
                    <p1> ' . $post['content'] . ' </p1>
                    <br>
                    <p1> Post ID: ' . $post['post_id'] . ' </p1>
                    <hr>
                    <br>
                 </div>';
            }
        return http_response_code(200);  
        }
        else {
            echo '404 Not Found';
            return http_response_code(404);
        }
    }
}
?>
    <footer class="footer">
        <?php include './modules/footer.php';?>
    </footer>
</body>
</html>