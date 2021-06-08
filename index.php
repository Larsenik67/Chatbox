<?php

require_once 'config/configuration.php';
require_once 'config/connect.php';
require_once 'form/loginForm.php';

//echo password_hash('admin', PASSWORD_DEFAULT);

$sitename = 'Tchat';
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?= $sitename; ?></title>
        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="manifest" href="images/favicon/site.webmanifest">
        <link rel="stylesheet" href="css/bootstrap-v4.6.0.css">
        <link rel="stylesheet" href="css/font-awesome-4.7.0.css">
        <link rel="stylesheet" href="css/custom.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/"><img src="images/logo.png" alt="logo" class="mr-2"><?= $sitename; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tchat.php">Tchat</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="/deconnexion.php">Déconnexion</a>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid pb-5">
            <div class="container">
                <h1 class="display-4">Mugs & Tasses</h1>
                <p class="lead"><a href="#">Découvrez notre sélection.</a> <small><em>Commande simple et livraison rapide.</em></small></p>
                <div class="new">
                </div>
            </div>
        </div>

        <div class="container mt-40">
            <?php
            if (isset($error)) {
                echo $error.'<br>';
            }
            ?>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="spacer spacer-md"></div>
        <footer role="contentinfo" id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-6 footer-box">
                        <p style="padding-right:80px;"><h4><?= $sitename; ?>.</h4>On y trouve de tout et surtout du n'importe quoi !!</p>
                        <h3 class="footer-heading">Nous suivre</h3>
                        <ul class="social-icons">
                            <li><a href="#" target="_blank"><i class="rounded-circle fa fa-google"></i></a></li>
                            <li><a href="#" target="_blank"><i class="rounded-circle fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="rounded-circle fa fa-facebook"></i></a></li>	
                            <li><a href="#" target="_blank"><i class="rounded-circle fa fa-rss"></i></a></li>
                        </ul>
                        <h3 class="footer-heading">Contact</h3>
                        <ul class="contact-info">
                            <li><span class="icon fa fa-home"></span><?= $sitename; ?>, 67000 Strasbourg</li>
                            <li><span class="icon fa fa-phone"></span>03.99.98.97.96</li>
                            <li><span class="icon fa fa-envelope"></span>contact@mugsparty.fr</li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 footer-box">
                        <h3 class="footer-heading">Liens</h3>
                        <ul class="footer-links">
                            <li><a href="#" target="_blank">Home</a></li>
                            <li><a href="#" target="_blank">About us</a></li>
                            <li><a href="#" target="_blank">Contact</a></li>
                            <li><a href="#" target="_blank">Legal mentions</a></li>
                        </ul>
                        <h3 class="footer-heading">Catégories</h3>
                        <ul class="footer-links">
                            <li><a href="#" target="_blank">Mugs</a></li>
                            <li><a href="#" target="_blank">Tasses</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-12 footer-box">
                        <h3 class="footer-heading">Nous contacter</h3>
                        <form action="contact.php" method="post">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Votre email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="username@yahoo.fr">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message" class="col-sm-2 col-form-label">Votre message</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="..."></textarea>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-send mr-2"></i>Envoyer</button>
                            </div>
                        </div>
                </form>
                    <div class="col-md-12 footer-box">
                        <div class="copyright">
                        <p>&copy; <?= $sitename; ?> 2021. Tous droits réservés.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>