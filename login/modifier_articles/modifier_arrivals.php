<?php include "../includes/header.php"; ?>

<?php

    include '../includes/database.php';
 
    if (isset($_GET['modifier'])) {
        $req = $db->prepare('SELECT * FROM arrivals WHERE id_produit = ?');
        $req->execute(array($_GET['modifier']));
        $arrivals = $req->fetch();
    }

    if(isset($_POST['update']))

    {
 
        
    // Count total files

        $id_produit = $_POST['id_produit'];
        $reference = $_POST['reference'];
        $p_cat = $_POST['p_cat'];
        $p_subcat = $_POST['p_subcat'];
        $marque = $_POST['marque'];
        $contenu = $_POST['contenu'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];
        $quantity = $_POST['quantity'];
        $p_key_word = $_POST['p_key_word'];
      
        extract($_POST);


        
        $pdoQuery = "UPDATE arrivals SET marque=:marque,reference=:reference,p_cat=:p_cat,p_subcat=:p_subcat,contenu=:contenu, prix=:prix, stock=:stock,quantity=:quantity,p_key_word=:p_key_word WHERE id_produit=:id_produit ";

        $pdoQuery_run = $db->prepare($pdoQuery);

        $pdoQuery_exec = $pdoQuery_run->execute(array(":marque"=>$marque,":reference"=>$reference,":p_cat"=>$p_cat,":p_subcat"=>$p_subcat,":contenu"=>$contenu, ":prix"=>$prix, 
            ":stock"=>$stock,":quantity"=>$quantity,":p_key_word"=>$p_key_word ,":id_produit"=>$id_produit));

        if($pdoQuery_exec)
        {
            echo '<script>alert("Article a été mis à jour")</script>';
        }
        else
        {
            echo '<script>alert("Article pas etre mis à jour")</script>';
        }

       
        
        
    }


?>
        <div class="content">
             <a type="button" class="btn btn-outline-success" href="/projet/login/check_articles/list_articles_arrivals.php">Retour à la page précédent</a>
         </div> <br>
        <div class="content" class="form-floating">
        <form method="POST" action="../modifier_articles/modifier_arrivals.php?modifier=<?php echo $arrivals['id_produit']; ?>" enctype="multipart/form-data">
        <input type="hidden" name="id_produit" value="<?php echo $arrivals['id_produit']; ?>" class="form form-control">
        <h5>Reference : </h5>
        <input type="text" name="reference" placeholder="reference" value="<?php echo $arrivals['reference']; ?>" class="form form-control"> <br><br>
        <h5>Marque : </h5>
        <input type="text" name="marque" placeholder="marque" value="<?php echo $arrivals['marque']; ?>" class="form form-control"> <br><br>
               <h5>Catégorie</h5>
                    <select name="p_cat" class="form-control">

                <?php

                $db = mysqli_connect('localhost','root','','articles'); 

                $get_c = "select * from categories";

                $run_c = mysqli_query($db, $get_c);

                while($row_c = mysqli_fetch_array($run_c)) {

                    echo '<option value="'.$row_c['cat_id'].'">'.$row_c['catname'].'</option>';
                }

                ?>

            </select> <br><br>

            <h5>Sub-Catégories</h5>

             <select name="p_subcat" class="form-control">

                <?php

                $db = mysqli_connect('localhost','root','','articles'); 

                $get_c = "select * from subcat";

                $run_c = mysqli_query($db, $get_c);

                while($row_c = mysqli_fetch_array($run_c)) {

                    echo '<option value="'.$row_c['subcat_id'].'">'.$row_c['catname'].' - '.$row_c['subcat_name'].'</option>';
                }

                ?>

            </select> <br><br>
        <div class="input-group">
        <span class="input-group-text">Description de produit :</span>
        <textarea name="contenu" placeholder="Contenu" class="form-control" aria-label="With textarea"><?php echo $arrivals['contenu']; ?></textarea>
        </div><br>
        <h5>Prix en Dinar tunisien : </h5>
        <input type="text" name="prix" placeholder="Prix" value="<?php echo $arrivals['prix']; ?>" class="form form-control"> <br> <br>
        <h5>Disponibilté : </h5>
        <input type="text" name="stock" placeholder="Stock" value="<?php echo $arrivals['stock']; ?>" class="form form-control"> <br> <br>
        <h5>Quantity : </h5>
        <input type="text" name="quantity" placeholder="quantity" value="<?php echo $arrivals['quantity']; ?>" class="form form-control"> <br> <br>
        <h5>Keywords<h5>
        <input type="text" name="p_key_word" placeholder="Keywords" value="<?php echo $arrivals['p_key_word']; ?>" class="form form-control"> <br> <br>   
        <button type="submit" name="update" class="btn btn-dark">Mise a jour Article</button> <br> <br>

         </form>
     </div>
     



     <!-- Bootsrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>