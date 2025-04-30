<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $email = htmlspecialchars($_POST['email']) ?? '';

    if(empty($email)){
        $_SESSION['message'] = '';
    }
}