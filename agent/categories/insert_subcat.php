<?php 

include "../includes/database.php"; 


if (isset($_POST['submit_subcat'])) {

// post value
    
$cat_id = @$_POST['cat_id'];    
$subcat_name = @$_POST['subcat_name'];
$subcat_url = @$_POST['subcat_url'];
$subcat_display = @$_POST['subcat_display'];
$subcat_order = @$_POST['subcat_order'];

// ajouter sub-catégorie

    if ($subcat_name!='') {
    
	$insert_subcat = "INSERT INTO sub_categories('cat_id','subcat_name','subcat_url','subcat_display','subcat_order') VALUES ('$cat_id','$subcat_name','$subcat_url','$subcat_display','$subcat_order')";

	$run_subcat = mysqli_query($db, $insert_subcat);


       echo '<script>alert("Vous avez ajouté un nouveau sub-catégorie!");
       window.location="sub-cat.php"; 
       </script>'; 

  
     }
         }

?>