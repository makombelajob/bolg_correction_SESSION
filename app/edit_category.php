<?php
session_start();
// Récupère l'identifiant de la catégorie depuis les paramètres GET de l'URL
$id = $_GET['id'] ?? '';

// Vérifie si l'identifiant est un nombre
if (is_numeric($id)) {

    // Inclut le fichier de connexion à la base de données
    require_once 'includes/dbconnect.php';

    // Prépare la requête SQL pour sélectionner la catégorie avec l'identifiant donné
    $sql = 'SELECT * FROM categories WHERE id = :id;';

    // Prépare la requête SQL
    $stmt = $pdo->prepare($sql);

    // Lie la valeur de l'identifiant à la requête en tant qu'entier
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // Exécute la requête
    $stmt->execute();

    // Récupère les informations de la catégorie
    $category = $stmt->fetch();

    // Vérifie si la catégorie existe
    if (!$category) {
        // Arrête le script et affiche un message d'erreur si la catégorie n'existe pas
        $_SESSION['message'] = 'Catégorie inexistante';
        header('Location: categories.php');
        exit;
    }


} else {
    // Arrête le script et affiche un message d'erreur si l'identifiant n'est pas un nombre
    $_SESSION['message'] = 'Une erreur est survenue';
    header('Location: categories.php');
    exit;
}

?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <title>Modifier une catégorie</title>
</head>

<body>
<header>
        <?php include_once 'includes/nav.php'; ?>
        <h1 class="text-center text-uppercase fs-1 my-3">Modifier une catégorie</h1>
    </header>

    <main class="container">
        <?php if(isset($_SESSION['message'])) : ;?>
            <p><?= $_SESSION['message'] ?? '';?></p>
            <?php unset($_SESSION['message']);?>
        <?php endif;?>
        <form action="edit_category_treatment.php" method="post" class="w-75 m-auto">
            <small class="text-danger">Seul le nom de la catégorie est obligatoire</small>
            <div>
                <label class="label-form fs-2 my-3" for="name">Nom de la catégorie</label>
                <input class="form-control fs-3" type="text" id="name" name="name" value="<?= $_SESSION['data']['name'] ?? htmlspecialchars($category['name']) ;?>">
                <?php if(isset($_SESSION['errors']['name'])) : ;?>
                    <p><?= $_SESSION['errors']['name'];?></p>
                    <?php unset($_SESSION['errors']['name']) ;?>
                <?php endif;?>
            </div>
            <div>
                <label class="label-form fs-2 my-3" for="description">Description</label>
                <textarea class="form-control fs-4" type="text" id="description" name="description" cols="5" rows="5"><?= $_SESSION['data']['description'] ?? htmlspecialchars($category['description']) ;?></textarea>
                <?php if(isset($_SESSION['errors']['description'])) : ;?>
                    <p><?= $_SESSION['errors']['description'];?></p>
                    <?php unset($_SESSION['errors']['description']);?>
                <?php endif;?>
            </div>
            <input type="hidden" name="id" value="<?= intval($category['id']) ?>">
            <div class="text-center my-3">
                <button class="btn btn-primary" type="submit">Envoyer</button>
            </div>
        </form>
        <?php unset($_SESSION['errors']) ;?>
        <?php unset($_SESSION['data']) ;?>
    </main>
</body>

</html>