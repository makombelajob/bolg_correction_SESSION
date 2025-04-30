<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_start();

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if(empty($email) || empty($password)){
        $_SESSION['message'] = 'Veuillez remplir tout le champs';
        header('Location: login.php');
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['errors']['email'] = 'L\'email n\'est pas valide';
    }
    if(isset($_SESSION['errors'])){
        header('Location: login.php');
        exit;
    }

    require_once 'includes/dbconnect.php';

    $sql = 'SELECT email, password FROM authors WHERE email = :email;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    $exec = $stmt->execute();
    if($exec) {
        $user = $stmt->fetch();
        var_dump($user);
    }
}