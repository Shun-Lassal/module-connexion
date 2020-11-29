<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location: index.php");
}

if (isset($_POST['signin'])){
    $login = $_POST['login'];
    $mdp =  $_POST['password'];
    $db = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
    $sql = "SELECT `id` FROM `utilisateurs` WHERE `login` = '$login'";
    $resultats = mysqli_query($db, $sql);
    $requete = "SELECT `password` FROM `utilisateurs` WHERE `login` = '$login'";
    $query = mysqli_query($db, $requete);
    $result = mysqli_fetch_assoc($query);
    $cryptedpass = $result['password'];

    if (mysqli_num_rows($resultats) == 1){
        if (password_verify($mdp, $cryptedpass))
            {
              session_start();
              $_SESSION['user'] = $login;
              header("location: profil.php");
            }
            else{
                $msg = 'Password incorrect';
            }
        }
        else{
            $msg = 'Identifiant incorrect';
        }
}

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php');?>
    <main id="connexion">
      <form method='post' id="connexion">
        <h2>Connexion</h2>
        <?php if (isset($msg)){echo ('<p class="error">'.$msg.'</p>');} ?>
          <label for='login'>Login:</label>
          <input type='text' name='login'><br/>
          <label for='pass'>Password:</label>
          <input type='password' name='password' minlenght='6' required><br/>
          <div class='submit-inscription'>
              <input type='submit' name='signin' id='bouton-connexion' value="Se connecter">
          </div>
      </form>
    </main>
  </body>
</html>
