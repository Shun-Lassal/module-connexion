<?php session_start(); ?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Index</title>
  </head>
  <body>
    <?php include('header.php'); ?>
    <main id="index">
      <section id="index1">
        <h1 id="main">Bienvenue</h1>
        <p>Pour accéder au site, merci de vous inscrire et de vous connecter</p>
        <section id="index11">
          <a href="inscription.php">S'inscrire</a>
          <a href="connexion.php">Se connecter</a>
        </section>
      </section>
      <section id="index2">
      </section>
    </main>
  </body>
</html>
