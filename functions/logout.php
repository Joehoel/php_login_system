<?php 
function logout() {
    header("location: ../index.php");
    session_destroy();
    die();
}

if (isset($_POST['logout'])) {
    logout();
}
