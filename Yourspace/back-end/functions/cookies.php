<?php 
function login_Cookie($user) {
    if (isset($_COOKIE['user'])) {
        setcookie('user', "", time()-3600);
    }
    setcookie("user",$user,time()+3600*3);
    return header("Location: home.php");
}
?>