<?php
// Vérifie si la méthode de requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    // Récupère et nettoie les données du formulaire
    $lastname = htmlspecialchars(trim($_POST['lastname'])); // Nettoie et sécurise le nom de famille
    $firstname = htmlspecialchars(trim($_POST['firstname'])); // Nettoie et sécurise le prénom
    $email = $_POST['email']; // Récupère l'email
    $password = $_POST['password'] ?? '';
    $rgpd = htmlspecialchars($_POST['gpdr'] ?? '');

    // Vérifie si l'un des champs est vide
    if (empty($lastname) || empty($firstname) || empty($email) || empty($password) || empty($rgpd)) {
        // Arrête le script et affiche un message d'erreur
        $_SESSION['message'] = 'Merci de remplir le formulaire';
        header('Location: add_author.php');
        exit;
    }

    // Vérifie la validité des champs
    if (strlen($lastname) > 100 ) {
        // Arrête le script et affiche un message d'erreur
        $_SESSION['errors']['lastname'] = 'Le nom est incorrect';
    }
    if (strlen($firstname) > 100 ) {
        // Arrête le script et affiche un message d'erreur
        $_SESSION['errors']['firstname'] = 'Le prénom est incorrect';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Arrête le script et affiche un message d'erreur
        $_SESSION['errors']['email'] = 'L\'email doit être valide ';
    }
    if (strlen($password) > 100 ) {
        // Arrête le script et affiche un message d'erreur
        $_SESSION['errors']['password'] = 'Le mots de passe doit être valide ';
    }
    if(!empty($_SESSION['errors'])){
        header('Location: add_author.php');
        exit;
    }
    // Inclut le fichier de connexion à la base de données
    require_once 'includes/dbconnect.php';
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Prépare la requête SQL pour insérer un nouvel auteur
    $sql = 'INSERT INTO authors (lastname, firstname, email, password) VALUES(:lastname, :firstname, :email, :password);';
    $stmt = $pdo->prepare($sql); // Prépare la requête

    // Lie les valeurs des paramètres à la requête
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $hash, PDO::PARAM_STR);

    // Exécute la requête
    if($stmt->execute()) {
        // Arrête le script et affiche un message de succès
        $_SESSION['message'] = 'Auteur ajouté avec succès';
        header('Location: /');
        exit;
    }
}
