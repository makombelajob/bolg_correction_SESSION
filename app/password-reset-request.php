<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>password reset</title>
</head>
<body>
    <header>
        <h1 class="text-center text-uppercase fs-1">password reset</h1>
        <?php include_once 'includes/nav.php'; ?>
    </header>
    <main>
        <form action="password-request-treatment.php" method="post" class="w-75 m-auto">
            <div>
                <label class="form-label fs-1 my-3" for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email">
            </div>
            <div class="text-center my-3">
                <button class="btn btn-danger" type="submit">Reset</button>
            </div>
        </form>

    </main>
</body>
</html>
