<?php include "../includes/header.php"; ?>
 
        <div class="container-sm pt-1" style="text-align: center;">
            <h2>#Sections d'accueil</h2>
        <a href="list_articles_arrivals.php" class="btn btn-light" role="button">Nouvelles Arrivées</a>
        <a href="list_articles_robes.php" class="btn btn-light" role="button">Robes</a>
        <a href="list_articles_montres.php" class="btn btn-light" role="button">Montres</a>
        <a href="list_articles.php" class="btn btn-light" role="button">All Articles ( tendance )</a>
        </div>
        <br>

        <?php

        // connect to DB and set Talbe query

        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection, 'articles');
        $query = "SELECT * FROM tous_produits";
        $query_run  = mysqli_query($connection, $query);

        ?>

        <div class="container-sm">
        <form action="../delete_articles/delete_tous_produits.php" method="POST">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <button class="btn btn-danger" type="submit" name="delete" value="delete">Supprimer Article</button>
        </div>
        <input type="text" name="id_produit" class="form-control" placeholder="ID article pour supprimer" aria-label="" aria-describedby="basic-addon1">
        </div>
        <a href="../add_articles/tous_produits.php" class="btn btn-warning" role="button">Ajouter un article</a> <br> <br>
        </form>
        </div>
    
        <div class="container-sm">
        <table id="example" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Ref.</th>
                    <th>Cat</th>
                    <th>Subcat</th>
                    <th>Marque</th>
                    <th>Descr</th>
                    <th style="text-align:center">Main IMG</th>
                    <th style="text-align:center">IMG (1) </th>
                    <th style="text-align:center">IMG (2) </th>
                    <th style="text-align:center">IMG (3) </th>
                    <th style="text-align:center">IMG (4) </th>
                    <th>Prix</th>
                    <th>Qty</th>
                    <th>Stock</th>
                    <th>Date</th>
                    <th>#</th>
                </tr>
              </thead>

                 <?php 

                 while($row = mysqli_fetch_array($query_run)) {

                  echo '
                  <tr>
                  <td>'.$row['id_produit'].'</td>
                  <td>'.$row['reference'].'</td>
                  <td>'.$row['p_cat'].'</td>
                  <td>'.$row['p_subcat'].'</td>
                  <td>'.$row['marque'].'</td>

                  <td><p class="d-inline-block text-truncate" style="max-width: 50px;">'.$row['contenu'].'</p></td>
                  
                  <td><img src="../../login/images/'.$row['images_name'].' " width="80%"><br><br>
                  <a href="../modifier_p_img/modifier_1.php?modifier='.$row['id_produit'].'"
                  class="btn btn-outline-danger" role="button">Edit</a></td>

                  <td><img src="../../login/images/'.$row['image_small_1'].' "width="80%"><br><br>
                  <a href="../modifier_slidshow_img/modifier_17.php?modifier='.$row['id_produit'].'
                  " class="btn btn-outline-danger" role="button">Edit</a></td>

                  <td><img src="../../login/images/'.$row['image_small_2'].' "width="80%"><br><br>
                  <a href="../modifier_slidshow_img/modifier_18.php?modifier='.$row['id_produit'].'
                  " class="btn btn-outline-danger" role="button">Edit</a></td>

                  <td><img src="../../login/images/'.$row['image_small_3'].' "width="80%"><br><br>
                  <a href="../modifier_slidshow_img/modifier_19.php?modifier='.$row['id_produit'].'
                  " class="btn btn-outline-danger" role="button">Edit</a></td>

                  <td><img src="../../login/images/'.$row['image_small_4'].' "width="80%"><br><br>
                  <a href="../modifier_slidshow_img/modifier_20.php?modifier='.$row['id_produit'].'
                  " class="btn btn-outline-danger" role="button">Edit</a></td>

                  <td>'.$row['prix'].' DT</td>
                  <td>'.$row['quantity'].'</td>
                  <td>'.$row['stock'].'</td>
                  <td>'.$row['date_creation'].'</td>

                 <td><a href="../modifier_articles/modifier_tous_produits.php?modifier='.$row['id_produit'].'" class="btn btn-outline-danger" role="button">Edit</a></td>
                 </tr>

                ';
            }
        ?>


        </table>
        </div>

         <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
         <script type="text/javascript" src="../includes/js/app.js"></script>

    </body>
</html>