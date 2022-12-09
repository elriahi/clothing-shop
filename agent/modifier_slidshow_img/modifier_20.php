<?php include "../includes/header.php"; ?>

        
<?php

    include '../includes/database.php';
 
    if (isset($_GET['modifier'])) {
        $req = $db->prepare('SELECT * FROM tous_produits WHERE id_produit = ?');
        $req->execute(array($_GET['modifier']));
        $tous_produits = $req->fetch();
    }

    if(isset($_POST['submit']))

    {
 
        
    // Count total files

        $id_produit = $_POST['id_produit'];
  
      
        extract($_POST);

        $content_dir ="../images/";

        $tmp_file = $_FILES['name_file']['tmp_name'];


        if (!is_uploaded_file($tmp_file)) {
        //    exit('le fichier est introuvable');
        }
        $type_file = $_FILES['name_file']['type'];

        if(!strstr($type_file, 'jpeg') && !strstr($type_file,'png')) {
           //exit("ce fichier n'est pas une image");
        }

        $name_file = time().'.jpg';

        if(!move_uploaded_file($tmp_file,$content_dir.$name_file)) {
          //  exit('impossible de copier le fichier');
        }

        


        $pdoQuery = "UPDATE tous_produits SET image_small_4=:name_file WHERE id_produit=:id_produit ";
        $pdoQuery_run = $db->prepare($pdoQuery);

        $pdoQuery_exec = $pdoQuery_run->execute(array(":name_file"=>$name_file, ":id_produit"=>$id_produit));

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
            <div class="content" class="form-floating">
            <a href="../check_articles/list_articles_tous_produits.php" class="btn btn-light" role="button">liste des articles : Tous les produits</a><br><br>

             <form method="POST" action="modifier_20.php?modifier=<?php echo $tous_produits['id_produit']; ?>" enctype="multipart/form-data">
             <input type="hidden" name="id_produit" value="<?php echo $tous_produits['id_produit']; ?>" class="form form-control">
             <img src="../images/<?php echo $tous_produits['image_small_4'];?> "width="20%">
             <lable for="floatingTextarea2"><input type="file" name="name_file"></label> <br><br>
             <lable for="floatingTextarea2"><input type="submit" name="submit" class="btn btn-primary bg-dark" style="float: left;" value="Mise a jour S4" ></label> <br><br>
             
             </form>
             </div>


     <!-- Bootsrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>