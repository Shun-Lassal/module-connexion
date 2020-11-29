<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['prenom']);
unset($_SESSION['nom']);


header("location: index.php");
?>
