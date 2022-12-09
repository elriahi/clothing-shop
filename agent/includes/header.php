<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.php');
	exit;
}
?>
<?php // Connect DB
$db = mysqli_connect('localhost','root','','articles'); 
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cara - Magasin de vêtements</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
	</head>

	<body class="loggedin">
		<nav class="navtop">
			<div>
                <a href="../home.php">CARA</a>
                <a href="../check_articles/list_articles_tous_produits.php">Produits</a>
                <a href="../categories/addcat.php">Catégories</a>
                <a href="../ordres/ordres.php">Ordres</a>
                <a href="../livraisons/livraisons.php">Livraisons</a>
                <a href="../messages/msgs.php">Messages</a>
                <a href="../profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>
			</div>
		</nav>
		<div class="content">
			<h2>Administration Page</h2>
            <p>Bienvenue au nouveau, <span style="color: red;"> <?=$_SESSION['name']?> </span>!</p>
		</div>
	
