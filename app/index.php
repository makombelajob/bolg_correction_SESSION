<?php
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['message'] = 'Vous devez vous identifier avant ';
    header('Location: login.php');
    exit;
}
// Inclut le fichier de connexion à la base de données
require_once 'includes/dbconnect.php';

// Prépare la requête SQL pour sélectionner tous les articles
$sql = 'SELECT * FROM posts;';

// Exécute la requête SQL
$stmt = $pdo->query($sql);

// Récupère tous les résultats de la requête sous forme de tableau associatif
$posts = $stmt->fetchAll();
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <title>Liste des articles</title>
</head>

<body class="container">
    <header class="row">
        <?php include_once 'includes/nav.php'; ?>
        <p class="fs-1 text-center">Bonjour <span class="text-uppercase"><?= $_SESSION['user']['lastname'] . ' ' . $_SESSION['user']['firstname'];?></span></p>
        <div class="text-center my-3">
            <a class="btn btn-warning" href="logout.php">Logout</a>
        </div>
        <h1 class="text-center text-uppercase fs-1 text-secondary">Liste des articles</h1>
    </header>

    <main>
        <?php foreach ($posts as $post): ?>
            <article class="card my-3 w-75 m-auto p-3">
                <!-- Affiche le titre du post avec un lien vers la page du post -->
                <h2>
                    <a class="text-decoration-none" href="post.php?id=<?= intval($post['id']) ?>">
                        <?= htmlspecialchars($post['title']) ?>
                    </a>
                </h2>
                <!-- Affiche la date de création du post -->
                <time class="text-center text-secondary" datetime="<?= htmlspecialchars($post['created_at']) ?>">
                    <?= htmlspecialchars($post['created_at']) ?>
                </time>
            </article>
        <?php endforeach; ?>
    </main>
</body>

</html>