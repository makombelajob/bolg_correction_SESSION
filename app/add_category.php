<?php
session_start();
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <title>Ajouter une catégorie</title>
</head>

<body>
<header>
        <?php include_once 'includes/nav.php'; ?>
        <h1 class="text-center text-uppercase my-3">Ajouter une catégorie</h1>
    </header>

    <main>
        <?php if(isset($_SESSION['message'])) : ;?>
            <p><?= $_SESSION['message'] ?? '';?></p>
            <?php unset($_SESSION['message']);?>
        <?php endif;?>
        <form action="add_category_treatment.php" method="post" novalidate class="w-75 m-auto">
            <small class="fs-5 text-danger">Seul le nom de la catégorie est obligatoire</small>
            <div>
                <label class="form-label" for="name">Nom de la catégorie</label>
                <input class="form-control" type="text" id="name" name="name" value="<?= $_SESSION['data']['name'] ?? '';?>">
                <div>
                    <?php if(isset($_SESSION['errors']['name'])) : ;?>
                        <p><?= $_SESSION['errors']['name'];?></p>
                        <?php unset($_SESSION['errors']['name']) ;?>
                    <?php endif;?>
                </div>
            </div>
            <div>
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" type="text" id="description" name="description" cols="30" rows="10"><?= $_SESSION['data']['description'] ?? '';?></textarea>
                <div>
                    <?php if(isset($_SESSION['errors']['description'])) : ;?>
                        <p><?= $_SESSION['errors']['description'];?></p>
                        <?php unset($_SESSION['errors']['description']);?>
                    <?php endif;?>
                </div>
            </div>
            <div class="text-center my-3">
                <button class="btn btn-warning" type="submit">Envoyer</button>

            </div>
        </form>
        <?php unset($_SESSION['errors']) ;?>
        <?php unset($_SESSION['data']) ;?>
    </main>
</body>

</html>