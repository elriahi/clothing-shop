<?php include "../includes/header.php"; ?>

<?php

    include '../includes/database.php';
 
    if (isset($_GET['edit'])) {
        $req = $db->prepare('SELECT * FROM categories WHERE cat_id = ?');
        $req->execute(array($_GET['edit']));
        $categories = $req->fetch();
    }

    if(isset($_POST['up']))

    {

    // Count total values

        $cat_id = $_POST['cat_id'];
        $catname = $_POST['catname'];
        $description = $_POST['description'];
        
        extract($_POST);
        
        $pdoQuery = "UPDATE categories SET catname=:catname , description=:description WHERE cat_id =:cat_id ";

        $pdoQuery_run = $db->prepare($pdoQuery);

        $pdoQuery_exec = $pdoQuery_run->execute(array(":catname"=>$catname ,":description"=>$description ,":cat_id"=>$cat_id));

        if($pdoQuery_exec)
        {
            echo '<script>alert("Catégorie a été mis à jour")</script>';
        }
        else
        {
            echo '<script>alert("Catégerie pas etre mis à jour")</script>';
        }     
        
    }


?>
        <div class="content">
             <a type="button" class="btn btn-outline-dark" href="addcat.php">Retour à la page précédent</a>
         </div> <br>

        <div class="content" class="form-floating">
        <form method="POST" action="edit.php?edit=<?php echo $categories['cat_id']; ?>" enctype="multipart/form-data">
        <input type="hidden" name="cat_id" value="<?php echo $categories['cat_id']; ?>" class="form form-control">
        <h5>Catname : </h5>
        <input type="text" name="catname" value="<?php echo $categories['catname']; ?>" class="form form-control"> <br>
        <div class="input-group">
        <span class="input-group-text">Description :</span>
        <textarea name="description" class="form-control" aria-label="With textarea"><?php echo $categories['description']; ?></textarea>
        </div><br>
        <button type="submit" name="up" class="btn btn-outline-success">Mise a jour!</button> <br> <br>
         </form>
     </div>
     



     <!-- Bootsrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>