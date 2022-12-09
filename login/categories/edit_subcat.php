<?php include "../includes/header.php"; ?>

<?php

    include '../includes/database.php';
 
    if (isset($_GET['edit'])) {
        $req = $db->prepare('SELECT * FROM subcat WHERE subcat_id = ?');
        $req->execute(array($_GET['edit']));
        $subcat = $req->fetch();
    }

    if(isset($_POST['up']))

    {

    // Count total values

        $subcat_id = $_POST['subcat_id'];
        $catname = $_POST['catname'];
        $subcat_name = $_POST['subcat_name'];
        $subcat_display = $_POST['subcat_display'];
        
        extract($_POST);
        
        $pdoQuery = "UPDATE subcat SET catname=:catname , subcat_name=:subcat_name , subcat_display=:subcat_display WHERE subcat_id =:subcat_id ";

        $pdoQuery_run = $db->prepare($pdoQuery);

        $pdoQuery_exec = $pdoQuery_run->execute(array(":catname"=>$catname ,":subcat_name"=>$subcat_name , ":subcat_display"=>$subcat_display ,":subcat_id"=>$subcat_id));

        if($pdoQuery_exec)
        {
            echo '<script>alert("Subcat a été mis à jour")</script>';
        }
        else
        {
            echo '<script>alert("Subcat pas etre mis à jour")</script>';
        }     
        
    }


?>
        <div class="content">
             <a type="button" class="btn btn-outline-dark" href="sub-cat.php">Retour à la page précédent</a>
         </div> <br>

        <div class="content" class="form-floating">
        <form method="POST" action="edit_subcat.php?edit=<?php echo $subcat['subcat_id']; ?>" enctype="multipart/form-data">
        <input type="hidden" name="subcat_id" value="<?php echo $subcat['subcat_id']; ?>" class="form form-control">
        <h5> Subcat name : </h5> 
        <input type="text" name="subcat_name" class="form-control" value="<?php echo $subcat['subcat_name']; ?>"> <br>
        <h5> Catname : </h5> 
        <input type="text" name="catname" class="form-control" value="<?php echo $subcat['catname']; ?>"> <br>
         <h5>Display (Oui/Non) : </h5>
        <input type="text" name="subcat_display" class="form-control" value="<?php echo $subcat['subcat_display']; ?>"> <br>
        <button type="submit" name="up" class="btn btn-outline-success">Mise a jour!</button> <br> <br>
         </form>
     </div>
     



     <!-- Bootsrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>