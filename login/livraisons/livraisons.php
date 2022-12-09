<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}
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
                <a href="../usres/usres.php">Users</a>
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
<br>


<!-- Connect DB for the next form Query Categories -->

    <?php
    $connect = mysqli_connect("localhost", "root", "", "articles");
    $query = "SELECT * FROM livraisons_en_cours";
    $result = mysqli_query($connect, $query);
    ?>

<!-- Connect DB for the next form Query Categories -->

     <div class="content">

        <form action="add_livraison.php" method="POST">
            <input type="submit" name="ajouter" class="btn btn-success" value="Ajouter livraison" class="">
        </form> 
        <br>
        <form action="delete_livraison.php" method="POST">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <button class="btn btn-danger" type="submit" name="delete" value="delete">Supprimer</button>&nbsp;
        </div>
        <input type="text" name="order_id" class="form-control" placeholder="Entrez order .no pour supprimer">
        </div>
        </form> 
         <br>


         
        <h5>Liste marchandises en attentes d'expédition</h5>
         
        <div class="table-responsive">
        <table id="example" class="table table-bordered table-hover" style="width:100%">
              <thead>
                <tr>
                    <th style="text-align:center">Order .No</th>
                    <th style="text-align:center">Fact. No</th>
                    <th style="text-align:center">ID Prod</th>
                    <th style="text-align:center">Ref.</th>
                    <th style="text-align:center">Prod Name</th>
                    <th style="text-align:center">Qty</th>
                    <th style="text-align:center">Taille</th>
                    <th style="text-align:center">Prix</th>
                    <th style="text-align:center">Tél.</th>
                    <th style="text-align:center">Adresse</th>
                    <th style="text-align:center">Edit</th>
                    <th style="text-align:center">Valider</th>
                </tr>
              </thead>
 
            <?php

               while($row = mysqli_fetch_array($result)) {

                echo '

                  <tr>
                  <td style="text-align:center">'.$row['order_id'].'</td>
                  <td style="text-align:center">'.$row['invoice_no'].'</td>
                  <td style="text-align:center">'.$row['id_produit'].'</td>
                  <td style="text-align:center">'.$row['reference'].'</td>
                  <td style="text-align:center">'.$row['marque'].'</td>
                  <td style="text-align:center">'.$row['qty'].'</td>
                  <td style="text-align:center">'.$row['size'].'</td>
                  <td style="text-align:center">'.$row['due_amount'].' DT</td>
                  <td style="text-align:center">'.$row['tel'].'</td>
                  <td style="text-align:center">'.$row['ville'].' '.$row['adresse'].' '.$row['code_postal'].'</td>
                  <td style="text-align:center"><a href="edit_livraison.php?edit='.$row['order_id'].'" class="btn btn-outline-danger" role="button">Edit</a></td>
                  <td style="text-align:center"><a href="valider_livraison.php?valider='.$row['order_id'].'" class="btn btn-outline-success" role="button">Valider</a><br>'.$row['order_status'].'</td>
                  </tr>

                ';
            }

            ?>
            
        </table>
        </div>
        </div>

         <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
         <script type="text/javascript" src="../includes/js/app.js"></script>

    </body>
</html>


        

