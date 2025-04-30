<?php
session_start();
?>
<!doctype html>
<html lang="fe">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <h1 class="text-center text-uppercase fs-1 text-secondary my-3">Login</h1>
        <?php include_once 'includes/nav.php'; ?>
    </header>
    <main class="container">

        <form action="login_treatment.php" method="post" class="row w-75 m-auto">
            <div>
                <label class="form-label" for="email">E-mail</label>
                <input class="form-control" type="text" id="email" />
            </div>
            <div>
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" />
            </div>
            <div class="my-3">
                <a class="text-decoration-none text-white btn btn-secondary" href="password-reset-request.php">Forget password</a>
            </div>
            <div class="text-center my-3">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>

        </form>
    </main>
</body>
</html>
