<?php

require_once '../vendor/autoload.php';
require_once '../vendor/fzaninotto/faker/src/autoload.php';
require_once '../config/configuration.php';
require_once '../config/connect.php';

function removeSpecialChar(string $text): string
{
    return preg_replace('/[^A-Za-z0-9\-]/', '', $text);
}
$number = isset($_GET['faker']) && is_numeric($_GET['faker']) && $_GET['faker'] > 0 ? $_GET['faker'] : null;
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <title>faker users</title>
  </head>
  <body>
    <div class="container">
        <h1 class="mt-4">faker users</h1>
        <form class="mb-5">
            <div class="form-group">
                <label for="faker" class="col-form-label">Nombre de faker users</label>
                <input type="number" id="faker" name="faker" min="1">
            </div>
            <button type="submit" class="btn btn-primary">Faker Users</button>
        </form>
        <?php
            if (null !== $number) {
                //echo $number;
                for ($i = 1; $i <= $number; ++$i) {
                    $faker = Faker\Factory::create('fr_FR');
                    $pseudo = $faker->name;
                    $email = removeSpecialChar(strtolower($faker->lastName.rand().$faker->firstName));
                    $password = '@@__'.$email;
                    $password_hash = password_hash('admin', PASSWORD_DEFAULT);
                    $email = $email.'@'.$faker->freeEmailDomain;
                    $roles = json_encode(['user']);
                    $sql = "INSERT INTO users(email,password,pseudo,roles) VALUES ('$email','$password_hash','$pseudo','$roles')";

                    if ($mysqli->query($sql) === true) {
                        echo '<h4>Profil '.$i.'</h4>';
                        echo '<strong>pseudo:</strong> '.$pseudo.'<br>';
                        echo '<strong>email:</strong> '.$email.'<br>';
                        echo '<strong>password:</strong> '.$password.'<br>';
                        echo '<strong>password hash:</strong> '.$password_hash.'<br>';
                        echo '<strong>roles:</strong> '.implode(',', json_decode($roles)).'<br>';
                        echo '<br><br>';
                    }
                }
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>