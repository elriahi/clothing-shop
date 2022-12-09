<?php include "../includes/header.php"; ?>

<?php


// post value
$catname = @$_POST['catname'];
// ajouter catégorie
if (isset($_POST['addcat'])) {

    $insert_cat = "insert into categories (catname) values('$catname')";

    $run_cat = mysqli_query($db, $insert_cat);

    if(isset($run_cat)) {

       echo '<script>alert("Vous avez ajouté un nouveau catégorie!");
       window.location="addcat.php"; 
       </script>';   }

}

?>
        <div class="container-sm pt-1" style="text-align: center;">
        <h2>#Catégorie</h2>
        <a href="sub-cat.php" class="btn btn-light" role="button">Accéder à la page sub-catégorie</a>
        </div>
        <br>

<!-- add cat -->
<div class="content"> 
<form action="addcat.php" method="POST">
  <div class="input-group mb-3">
        <div class="input-group-prepend">
        <button class="btn btn-success" type="submit" name="addcat">Ajouter</button>
        </div>
        <input type="text" name="catname" class="form-control" placeholder="Entrez le nom de la nouvelle catégorie">
        </div>
</form>
<!-- delete cat -->
<form action="delete.php" method="POST">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <button class="btn btn-danger" type="submit" name="delete" value="delete">Supprimer</button>
        </div>
        <input type="text" name="cat_id" class="form-control" placeholder="Entrez ID catégorie pour supprimer">
        </div>
</form>      
</div>  

<!-- Connect DB for the next form Query Categories -->

    <?php
    $connect = mysqli_connect("localhost", "root", "", "articles");
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connect, $query);
    ?>

<!-- Connect DB for the next form Query Categories -->

     <div class="content">

        <h5>Liste catégories</h5>

        <table id="example" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                    <th style="text-align:center">ID</th>
                    <th style="text-align:center">Catégorie</th>
                    <th style="text-align:center">Description</th>
                    <th style="text-align:center">Edit</th>
                </tr>
              </thead>
 
            <?php

               while($row = mysqli_fetch_array($result)) {

                echo '

                  <tr>
                  <td>'.$row['cat_id'].'</td>
                  <td>'.$row['catname'].'</td>
                  <td>'.$row['description'].'</td>
                  <td style="text-align:center"><a href="edit.php?edit='.$row['cat_id'].'" class="btn btn-outline-danger" role="button">Edit</a></td>
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


        

