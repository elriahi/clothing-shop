<?php include "../includes/header.php"; ?>

        
<?php

    include '../includes/database.php';
 
    if (isset($_GET['modifier'])) {
        $req = $db->prepare('SELECT * FROM all_articles WHERE id_produit = ?');
        $req->execute(array($_GET['modifier']));
        $all_articles = $req->fetch();
    }

    if(isset($_POST['submit']))

    {
 
        
    // Count total files

        $id_produit = $_POST['id_produit'];
  
      
        extract($_POST);

        $content_dir = "../../login/images/";

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

        


        $pdoQuery = "UPDATE all_articles SET images_name=:name_file WHERE id_produit=:id_produit ";
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
             <form method="POST" action="modifier_2.php?modifier=<?php echo $all_articles['id_produit']; ?>" enctype="multipart/form-data">
             <input type="hidden" name="id_produit" value="<?php echo $all_articles['id_produit']; ?>" class="form form-control">
             <img src="../../login/images/<?php echo $all_articles['images_name'];?> "width="20%"><br>
             <lable for="floatingTextarea2"><input type="file" name="name_file"></label> <br><br>
             <lable for="floatingTextarea2"><input type="submit" name="submit" class="btn btn-primary bg-dark" style="float: left;" value="Mise à jour" ></label> &nbsp;
             <a type="button" class="btn btn-primary bg-danger" href="/projet/login/check_articles/list_articles.php">Précédent</a>
             <br><br>

             
             </form>
             </div>


     <!-- Bootsrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>