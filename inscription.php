<?php
session_start();
if (isset($_SESSION['user'])) {
    header("location: index.php");
}


if (isset($_POST['signin'])){
  $db = mysqli_connect('localhost','root','','moduleconnexion');
  $login = $_POST['login'];
  $sql = "SELECT id FROM utilisateurs WHERE login = '$login'";
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);
  if ($count == 0){
    if (strlen($_POST['login']) >= 3) {
      if (strlen($_POST['password']) >= 6) {
        if ($_POST['password'] === $_POST['cpassword']) {
          if (!empty($_POST['prenom']) && !empty($_POST['nom'])) {
            $login = $_POST['login'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $db = mysqli_connect('localhost','root','','moduleconnexion');
            $sql = "INSERT INTO `utilisateurs` (id, login, prenom, nom, password) VALUES (null, '$login', '$prenom', '$nom', '$password')";
            $res = mysqli_query($db, $sql);
            mysqli_close();
            if ($res == True) {
              $msg = "Compte créé, Redirection";
              $_SESSION['user'] = $login;
              header("location: profil.php");
            }
            else {
              $msg = "Compte non crée, veuillez réessayer";
            }
          }
          else {
            $msg = "Prenom ou Nom non rempli";
          }
        }
        else {
          $msg = "Password =/= Confirm Password";
        }
      }
      else {
        $msg = "Password trop court";
      }
    }
    else {
      $msg = "Login trop court";
    }
  }
  else {
    $msg = "Login existant";
  }
}







?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php');?>
    <main id="inscription">
      <form method='post' id="inscription">
        <h2>Inscription</h2>
        <?php if (isset($msg)){echo ('<p class="error" style="font-size:25px;color:red;">'.$msg.'</p>');} ?>
          <label for='login'>Login:</label>
          <input type='text' name='login'><br/>
          <label for='prenom'>Prénom:</label>
          <input type='text' name='prenom'><br/>
          <label for='nom'>Nom:</label>
          <input type='text' name='nom'><br/>
          <label for='pass'>Password (6 characters minimum):</label>
          <input type='password' name='password' minlenght='6' required><br/>
          <label for='cpass'>Confirm password:</label>
          <input type='password' name='cpassword' minlenght='6' required><br/>
          <div class='submit-inscription'>
              <input type='submit' name='signin' id='bouton-inscription' value="S'inscrire">
          </div>
      </form>
    </main>
  </body>
</html>
