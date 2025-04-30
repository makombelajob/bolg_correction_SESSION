<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    session_start();

    $id = $_POST['id'] ?? '';
    if(!is_numeric($id)){
        $_SESSION['message'] = 'Une erreur est survenue';
        header('Location: categories.php');
        exit;
    }
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
        header('Location: edit_category.php?id=' . $id);
        exit;
    }

    require_once 'includes/dbconnect.php';
    $sql = 'UPDATE categories SET name = :name , description = :description WHERE id = :id;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $exec = $stmt->execute();
    if($exec) {
        $_SESSION['message'] = 'La modification a bien réussit';
        header('Location: categories.php');
        exit;
    }
    $_SESSION['message'] = 'Une erreur interne est survenue !';
    header('Location: edit_category.php?id=' . $id);
    exit;
}
echo 'Mauvaise méthode détectée !';
