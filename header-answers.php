<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <Link rel="stylesheet" href="../css/styles-answers.css" />
    <Link rel="stylesheet" href="../css/bootstrap-4.5.2-dist/css/bootstrap.min.css" />

    <title>Election Results | Bincom Interview</title>

    <?php

        // require functions.php file
        require ('../database/functions.php');

    ?>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="/bincom-election" class="navbar-brand">election results | Bincom Interview</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsive-nav"
            aria-controls="#responsive-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="#responsive-nav">

            <ul class="navbar-nav mx-auto mr-sm-2">
                <li class="nav-item">
                    <a class="nav-link" href="create-polls.php"
                        title="Create a new polling unit and Upload results of political parties">Create polling unit</a>
                </li>
            </ul>
        </div>
    </nav>