<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();

    $name = htmlspecialchars(trim($_POST['name'])) ?? '';
    $description = htmlspecialchars(trim($_POST['description'])) ?? '';

    $_SESSION['data'] = compact('name', 'description');

    if(empty($name) || strlen($name) > 50){
        $_SESSION['errors']['name'] = 'Le nom doit être valide !';
    }

    if(strlen($description) > 255){
        $_SESSION['errors']['description'] = 'La déscription dépasse 255 caractères';
    }
    if(isset($_SESSION['errors'])){
        header('Location: add_category.php');
        exit;
    }

    require_once 'includes/dbconnect.php';
    $sql = 'INSERT INTO categories(name, description) VALUES (:name, :description);';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $exec = $stmt->execute();
    if($exec) {
        $_SESSION['message'] = 'L\'ajout a bien réussit';
        header('Location: categories.php');
        exit;
    }
    $_SESSION['message'] = 'Une erreur interne est survenue !';
    header('Location: add_category.php');
    exit;
}
echo 'Mauvaise méthode détectée !';