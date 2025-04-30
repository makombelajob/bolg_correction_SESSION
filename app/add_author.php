<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <title>Ajouter un auteur</title>
</head>

<body>
    <header>
        <?php include_once 'includes/nav.php'; ?>
        <h1 class="fs-2 text-center text-uppercase">Ajouter un auteur</h1>
    </header>
    <main class="container">
        <form action="add_author_treatment.php" method="post" class="row w-75 m-auto">
            <div class="text-center">
                <small class="text-danger fs-2">Tous les champs sont obligatoires</small>
                <div class="bg-warning fs-3 rounded-3">
                    <?php if(isset($_SESSION['message'])) : ;?>
                        <?= $_SESSION['message'];?>
                    <?php endif;?>

                    <?php if(isset($_SESSION['errors'])): ?>
                        <ul class="list-unstyled">
                            <?php foreach($_SESSION['errors'] as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <label class="form-label fs-3 my-3" for="lastname">Nom</label>
                <input class="form-control" type="text" id="lastname" name="lastname">
                <div class="bg-warning text-center fs-3 rounded-3">
                    <?php if(isset($_SESSION['errors']['lastname'])) : ;?>
                        <?= $_SESSION['errors']['lastname'];?>
                    <?php endif;?>
                </div>
            </div>
            <div>
                <label class="form-label fs-3 my-3" for="firstname">Prenom</label>
                <input class="form-control" type="text" id="firstname" name="firstname">
            </div>
            <div>
                <label class="form-label fs-3 my-3" for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email">
            </div>
            <div>
                <label class="form-label fs-3 my-3" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password">
            </div>
            <div>
                <input type="checkbox" id="gpdr" name="gpdr">
                <label for="gpdr">J'acceptes les conditions ...</label>
            </div>
            <div class="text-center my-3">
                <button class="btn btn-danger" type="submit">Ajouter</button>
            </div>
        </form>
        <?php unset($_SESSION['message']);?>
        <?php unset($_SESSION['errors']);?>
    </main>
</body>

</html>