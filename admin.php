<?php
session_start();
if ($_SESSION['user'] !== "admin") {
  header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include('header.php');?>
    <main id="admin">
      <h1>Information des utilisateurs:</h1>
        <?php
        $db = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
        $requete = "SELECT * FROM utilisateurs";
        $result = mysqli_query($db, $requete);
        if($result) {
          echo "<table style='color:white;border:2px solid rgb(26, 23, 23)'><th style='font-size:20px;border:2px solid rgb(26, 23, 23)'>ID Utilisateur:</th><th style='font-size:20px;padding:10px;border:2px solid rgb(26, 23, 23)'>Login:</th><th style='font-size:20px;padding:10px;border:2px solid rgb(26, 23, 23)'>Prenom:</th><th style='font-size:20px;padding:10px;border:2px solid rgb(26, 23, 23)'>Nom:</th>";
          foreach ($result as $key => $value) {
            echo "<tr style='border:1px solid rgb(26, 23, 23)'><td style='color:white;text-align:center'>".$value['id']."</td><td style='color:white;text-align:center'>".$value['login']."</td><td style='text-align:center;color:white;'>".$value['prenom']."</td><td style='text-align:center;color:white;'>".$value['nom']."</tr>";
          }
          echo "</table>";
        }
        ?>

    </main>
  </body>
</html>
