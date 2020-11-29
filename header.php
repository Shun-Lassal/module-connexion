<header>
  <a href="index.php"><img src="images/home.png" alt=""></a>
  <a class="link" href="inscription.php">S'inscrire</a>
  <a class="link" href="connexion.php">Se connecter</a>
  <?php
  if(empty($_SESSION)) {
    $_SESSION['user'] = null;
  }


  if (!empty($_SESSION['user'])) {
    echo "<a class='link' href='profil.php'>Mon Profil</a>";
    echo "<a class='link' href='disconnect.php'>Déconnexion</a>'";

  }

  if ($_SESSION['user'] == "admin") {
    echo "<a class='link' href='admin.php'>Admin</a>";
  }

  print_r($_SESSION);


  ?>

</header>
