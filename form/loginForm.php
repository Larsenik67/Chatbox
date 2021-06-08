<?php

$error = null;

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
    $sql = 'SELECT * FROM users WHERE email="'.$_POST['email'].'" LIMIT 1';
    if ($result = $mysqli->query($sql)) {
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($_POST['password'], $user['password']) === true) {
                $_SESSION['msg-flash'] = 'Salut '.$user['pseudo'];
                $_SESSION['user'] = $user;

                redirectToRoute('/tchat.php');
            }
        }
        $error = 'Email ou mot de passe incorrect !!';
        $result->close();
    }
}
