<?php
// We need to use sessions, so you should always start sessions using the below code.

session_start();

// If the user is not logged in redirect to the login page...

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'articles';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM agent_data WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
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
			<h2>Mon Compte</h2>
			<div>
				<p>Les détails de votre compte sont ci-dessous :</p>

		         <?php
                 // connect to DB and set Talbe query
         
                 $connection = mysqli_connect("localhost","root","");
                 $db = mysqli_select_db($connection, 'articles');
         
                 $query = "SELECT * FROM admin_data";
                 $query_run  = mysqli_query($connection, $query);
                 ?>

				<table>
					<tr>
						<td>Nom d'utilisateur :</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Mot de Passe :</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email Adresse :</td>
						<td><?=$email?></td>
					</tr>
					<tr>
			 <?php

            if($query_run)
            {
                while ($row = mysqli_fetch_array($query_run)) {
                    ?>
				    </tr>
				     <?php 

                }
            }
            else
            {
                echo "No Record Found";
            }


        ?> 
				</table>
			</div>
		</div>
		        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

	</body>
</html>