<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();

    $email = htmlspecialchars($_POST['email']) ?? '';
    $password = $_POST['password'] ?? '';

    $_SESSION['data'] = compact('email');

    if(empty($email) || empty($password)){
        $_SESSION['message'] = 'Veuillez remplir tout le champ';
        header('Location: login.php');
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['message'] = 'Email ou mot de passe incorrect';
        header('Location: login.php');
        exit;
    }

    require_once 'includes/dbconnect.php';

    $sql = 'SELECT id, lastname, firstname, email, password FROM authors WHERE email = :email LIMIT 1;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    $exec = $stmt->execute();
    if($exec){
        $user = $stmt->fetch();
        if(!$user){
            $_SESSION['message'] = 'Email ou mot de passe incorrect';
            header('Location: login.php');
            exit;
        }

        if(!password_verify($password, $user['password'])){
            $_SESSION['message'] = 'Email ou mot de passe incorrect';
            header('Location: login.php');
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'lastname' => $user['lastname'],
            'firstname' => $user['firstname'],
            'email' => $user['email']
        ];
        $sql = 'UPDATE authors SET last_login = NOW() WHERE id = :id;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $user['id'], PDO::PARAM_INT);
        $exec = $stmt->execute();
        if(!$exec){
            $_SESSION['message'] = 'Une erreur est survenue';
            header('Location: login.php');
            exit;
        }
        header('Location: index.php');
        exit;
    }

}

echo 'Méthode invalide';