<?php

require_once '../vendor/autoload.php';
require_once '../vendor/fzaninotto/faker/src/autoload.php';
require_once '../config/configuration.php';
require_once '../config/connect.php';
require_once '../config/slug.php';

$number = isset($_GET['faker']) && is_numeric($_GET['faker']) && $_GET['faker'] > 0 ? $_GET['faker'] : null;

?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <title>faker projets</title>
  </head>
  <body>
    <div class="container">
        <h1 class="mt-4">faker projets</h1>
        <form class="mb-5">
            <div class="form-group">
                <label for="faker" class="col-form-label">Nombre de faker projets</label>
                <input type="number" id="faker" name="faker" min="1">
            </div>
            <button type="submit" class="btn btn-primary">Faker projets</button>
        </form>
        <?php
            if (null !== $number) {
                //echo $number;
                for ($i = 1; $i <= $number; ++$i) {
                    $faker = Faker\Factory::create('fr_FR');
                    $name = $faker->sentence(rand(1, 10));
                    $description = $faker->paragraph(rand(3, 100));
                    $image = $faker->imageUrl(600, 400);
                    $time_at = $faker->dateTimeBetween('-'.rand(1, 30).' years', 'now', 'Europe/Paris');
                    $time_at = date_format($time_at, 'Y-m-d H:i:s');
                    $slug = slug($name);
                    $techs = ['css', 'html', 'php', 'javascript', 'jquery'];
                    shuffle($techs);
                    $techno = [];
                    for ($t = 0; $t < rand(1, 5); ++$t) {
                        array_push($techno, $techs[$t]);
                    }
                    $technos = json_encode($techno);
                    $github = null;
                    $lien = null;
                    $status = [true, false];
                    shuffle($status);
                    $status = $status[0];

                    $sql = "INSERT INTO projets(name,description,image,time_at,slug,technos,github,lien,status) VALUES ('$name','$description','$image','$time_at','$slug','$technos','$github','$lien','$status')";

                    if ($mysqli->query($sql) === true) {
                        echo '<h4>Projet '.$i.'</h4>';
                        echo '<strong>nom:</strong> '.$name.'<br>';
                        echo '<strong>slug:</strong> '.$slug.'<br>';
                        echo '<strong>description:</strong> '.$description.'<br>';
                        echo '<strong>image:</strong> '.$image.'<br>';
                        echo '<strong>time_at:</strong> '.$time_at.'<br>';
                        echo '<strong>tehnos:</strong> '.implode(',', $techno).'<br>';
                        echo '<strong>github:</strong> '.$github.'<br>';
                        echo '<strong>lien:</strong> '.$lien.'<br>';
                        echo '<strong>status:</strong> '.$status.'<br>';
                        echo '<br><br>';
                    } else {
                        echo '<h4>Projet '.$i.'. Une erreur est survenue !!</h4>';
                    }
                }
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>