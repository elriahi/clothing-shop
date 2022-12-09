<?php 

include "../includes/header.php"; 

?>

<?php 

$conn = mysqli_connect("localhost","root","","articles");

// post value
    
if(isset($_POST['submit_subcat'])) {

$catname = $_POST['catname'];    
$subcat_name = $_POST['subcat_name'];
$subcat_display = $_POST['subcat_display'];

// ajouter sub-catégorie

    if ($subcat_name!='') {
    
    $subcat = "INSERT INTO subcat (catname, subcat_name, subcat_display) VALUES ('$catname','$subcat_name','$subcat_display')";

    $sql = mysqli_query($conn, $subcat);

    echo '<script>alert("Un nouveau sub-catégorie a étais ajouté !")</script>';

     }

    }

?>

        <div class="container-sm pt-1" style="text-align: center;">
        <h2>#Sub-catégorie</h2>
        <a href="addcat.php" class="btn btn-light" role="button">Retour à la page catégorie</a>
        </div>
        <br>
 

        <section class="container-sm">
        <div class="row my-5">
        <div class="col-lg-5 col-md-12 col-12">

        <form action="#" method="POST">
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <button class="btn btn-danger" type="submit" name="delete" value="delete">Supprimer</button>&nbsp;
        </div>
        <input type="text" name="subcat_id" class="form-control" placeholder="Entrez ID sub-catégorie pour supprimer" aria-label="" aria-describedby="basic-addon1">
        </div>
        </form>    
        <hr>
        
        <!-- add cat -->
        <h5 class="text-center">Ajouter Sub-catégorie</h5>&nbsp;

        <form action="" method="POST">

         <div class="form-group">
         <select class="form-control" name="catname">
            <option value="">Sélectionner catégorie</option>
            <?php
            $catqry = "SELECT * FROM categories";
            $run_catqry = mysqli_query($db,$catqry);
            while($catdata=mysqli_fetch_assoc($run_catqry)) 
            {
            ?>
            <option value="<?php echo $catdata['catname'];?>"><?php echo $catdata['catname'];?></option>
         <?php } ?>   
         </select> 
         <br>
         </div>


        <div class="form-group">

         <input type="text" name="subcat_name" class="form-control" placeholder="Entrez le nom de la nouvelle sub-catégorie"> <br>

        </div>

        <div class="form-group">

          <select class="form-control" name="subcat_display">
            <option value="Oui">Oui</option>
            <option value="Non">Non</option>
          </select> <br>

        </div>

        <div class="form-group">

        <input class="btn btn-success" type="submit" name="submit_subcat" value="Ajouter">
        
        </div>

        </form> <br>

        </div>


<!-- Connect DB for the next form Query Sub-Categories -->

    <?php

    $connect = mysqli_connect("localhost", "root", "", "articles");
    $query = "SELECT * FROM subcat";
    $result = mysqli_query($connect, $query);

    ?>

<!-- Connect DB for the next form Query Categories -->


     <div class="col-lg-6 col-md-12 col-12">

        <h5>Liste Sub-catégories</h5>

        <table id="example" class="table table-striped" style="width:100%">

              <thead>
                <tr>
                    <th style="text-align:center">Subcat_id</th>
                    <th style="text-align:center">Catname</th>
                    <th style="text-align:center">Subcat</th>
                    <th style="text-align:center">Display</th>
                    <th style="text-align:center">Edit</th>
                </tr>
              </thead>
 
            <?php

            while($row = mysqli_fetch_array($result)) {

                echo '
                  <tr>
                  <td>'.$row['subcat_id'].'</td>
                  <td>'.$row['catname'].'</td>
                  <td>'.$row['subcat_name'].'</td>
                  <td>'.$row['subcat_display'].'</td>
                  <td style="text-align:center"><a href="edit_subcat.php?edit='.$row['subcat_id'].'" class="btn btn-outline-danger" role="button">Edit</a></td>
                  </tr>

                ';
            }

            ?>
            
        </table>

        </div>
        </div>
   </section>
        
         <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="../includes/js/app.js"></script>

    </body>
</html>