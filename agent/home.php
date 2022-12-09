<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cara - Magasin de vêtements</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<a href="home.php">CARA</a>
				<a href="check_articles/list_articles_tous_produits.php">Produits</a>
				<a href="categories/addcat.php">Catégories</a>
			    <a href="ordres/ordres.php">Ordres</a>
                <a href="livraisons/livraisons.php">Livraisons</a>
				<a href="messages/msgs.php">Messages</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>
			</div>
		</nav>
		<div class="content">
			<h2>Administration Page</h2>
            <p>Bienvenue au nouveau, <span style="color: red;"> <?=$_SESSION['name']?> </span>!</p>
		</div>

	</body>
</html>