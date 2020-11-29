<?php
session_start();
if (empty($_SESSION['user'])) {
  header("location: index.php");
}

$oldLogin = $_SESSION['user'];
if(isset($_POST['submit'])){
    $db = mysqli_connect('localhost','root','','moduleconnexion');
    $newlogin = mysqli_real_escape_string($db, htmlspecialchars($_POST['newlogin']));
    $sql = "SELECT id FROM utilisateurs WHERE login = '$newlogin'";
    $result = mysqli_query($db,$sql);
    $count = mysqli_num_rows($result);
    if ($count) {
      $msg = "Pseudo déjà pris";
    }
    elseif(strlen($newlogin) >= 3) {
      $sql = "UPDATE utilisateurs SET login='$newlogin' WHERE login = '$oldLogin'";
      $result = mysqli_query($db,$sql);
      $_SESSION['user'] = $newlogin;
      $msg = "Pseudo modifié!";
    }
  }
    if(isset($_POST['newpassword']) && isset($_POST['repassword'])){
      if ($_POST['newpassword'] == $_POST['repassword']) {
        if (strlen($_POST['repassword']) >= 6 && strlen($_POST['repassword']) >= 6) {
          $newpassword = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
          $sql = "UPDATE utilisateurs SET password='$newpassword' WHERE login = '$oldLogin'";
          $res = mysqli_query($db, $sql);
          $msg = "Mot de passe Modifié!";
        }
        else {
          $msg = "Mot de passe trop court";
        }
      }
      else {
        $msg = "Les Mdps sont inexacts";
      }
    }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php');?>
    <main id="inscription">
      <form method='post' id="profil">
        <h2>Mon profil</h2>
        <?php if (isset($msg)){echo ('<p class="error">'.$msg.'</p>');} ?>
          <label for='login'>Login:</label>
          <?php echo "<input type='text' name='login' value=".$_SESSION['user']."><br/>"; ?>
          <label for='pass'>Password (6 characters minimum):</label>
          <input type='password' name='password' minlenght='6' required><br/>
          <label for='cpass'>Confirm password:</label>
          <input type='password' name='cpassword'><br/>
          <div class='submit-inscription'>
              <input type='submit' name='signin' id='bouton-modification' value="Modifier mes infos">
          </div>
      </form>
    </main>
  </body>
</html>
