<!DOCTYPE html>
<html lang="en">
  <head>
       <!-- Sweet Alert -->
    <script src="Js/jquery.js"></script>
    <script src="Js/sweetalert.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara - Magasin de vêtements</title>
    <!-- My CSS Style -->
    <link rel="stylesheet" href="style.css">
    <!--Font awsome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="layouts/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style type="text/css">
        *{
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Poppins';font-size: 15px;
        }
        .dropdown-menu .dropdown-menu{
            margin-left:0; margin-right: 0;
        }

        .dropdown-menu li{
            position: relative;
        }
        .dropdown-toggle::after {
        display: none !important;
        }
        .nav-item .submenu{ 
            display: none;
            position: absolute;
            left:100%; top:-7px;
            color: #eeffff;
        }
        .nav-item .submenu-left{ 
            right:100%; left:auto;
        }

        .dropdown-menu > li:hover{ background-color: #bfdecb;  }
        .dropdown-menu > li:hover > .submenu{
            display: block;
        }
        </style>
    </head>

<?php 

session_start();

include 'login/includes/config/db.php'; // DB Connection ..

$msg = "";  // MSG 

   if (isset($_POST['login_btn'])) {
    $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
    $mdp = mysqli_real_escape_string($conn, md5($_POST['mdp']));

    $sql = "SELECT * FROM membre WHERE pseudo='{$pseudo}' AND mdp='{$mdp}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {  
            $_SESSION['SESSION_PSEUDO'] = $pseudo;
                  echo '
                  <script type="text/javascript">
                  $(document).ready(function() {
                  swal({
                  text: "Vous êtes maintenant connecté",
                  icon: "success",
                  button: false,
                  timer: 3500,
                  className: "popup"
                  });
                  });
                  </script>
                  ';
        } else {
            $msg = "<div class='alert alert-info'>Vérifiez d'abord votre compte et réessayez.</div>";
        }
      } else {
            $msg = "<div class='alert alert-danger'>Le pseudo et le mot de passe sont incompatibles</div>";
    }
}
?>


<?php include 'login/includes/function.php'; ?>


<body>
 
<!-- Back to top button -->

<button
        type="button"
        class="btn btn-danger btn-floating btn-lg"
        id="btn-back-to-top">
        
  <i class="fas fa-arrow-up"></i>
</button>

<!-- NAVBAR -->


               <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 fixed-top">
               <div class="container">
                <a class="navbar-brand" href="index.php" style="margin-left: 5px"><img src="img/logo.png" class="logo" alt="cara website logo"></a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="             Toggle navigation">
                   <span><i id="bar" class="fas fa-bars"></i></span>
                 </button>
             
                 <div class="collapse navbar-collapse" id="main_nav">

                 <ul class="navbar-nav ml-auto">

                 <li class="nav-item"> 
                     <a class="nav-link" href="index.php">Acceuil </a>
                 </li>

                 <?php if (isset($_SESSION['SESSION_PSEUDO'])):?>


                  
                 <li class="nav-item dropdown">

                 <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown">Magasin</a>


                 <ul class="dropdown-menu">

                 <?php 

                    global $db;

                    $get_cat = "SELECT * from categories";

                    $run_cat = mysqli_query($db, $get_cat);

                    while($row_cat = mysqli_fetch_array($run_cat)) {

                    $catname = $row_cat['catname'];

                    echo '<li><a class="dropdown-item dropdown-toggle" href="cat.php?cat='.$row_cat['cat_id'].'">'.$row_cat['catname'].'</a>';

                ?>
                
                 <ul class="submenu dropdown-menu">

                 <?php

                    global $db; 

                    $get_subcat = "SELECT * FROM subcat where catname = '$catname' AND subcat_display = 'Oui' ORDER BY subcat_id ASC ";

                    $run_subcat = mysqli_query($db, $get_subcat);

                    while($row_subcat = mysqli_fetch_array($run_subcat)) {

                    echo '<li><a class="dropdown-item" href="subcat.php?subcat='.$row_subcat['subcat_id'].'">'.$row_subcat['subcat_name'].'</a></li>';

                 ?>
                 
                                  <?php } ?>
                 </ul>
                                  <?php } ?>
                 </ul>


                 </li> 


                 <li class="nav-item"><a class="nav-link" href="about.php"> À Propos </a></li>
                 <li class="nav-item"><a class="nav-link" href="contact.php"> Contact </a></li>

                       <div class="search-box">
                           <form action="search.php" method="get">
                               <input type="text pt-1" name="searchArea" maxlength="60" size="15" placeholder="Reference,Marque.." required>
                               <input type="submit" name="search" value="Explorer" />
                           </form>
                       </div>

                  <li class="nav-item pt-auto"><a class="nav-link pl-auto pr-auto active" href="cart.php" ><i class="far fa-shopping-cart"></i>( <?php echo total_item(); ?> ) <?php total_price(); ?>TD</a></li>

                 <li class="nav-item dropdown">
                 <a class="nav-link  dropdown-toggle" href="" data-bs-toggle="dropdown"><i class="fas fa-user"></i>

                  <?php 
                
                    $query = mysqli_query($conn, "SELECT * FROM membre WHERE pseudo='{$_SESSION['SESSION_PSEUDO']}'");

                    if (mysqli_num_rows($query) > 0) {
                        $row = mysqli_fetch_assoc($query);
                
                   echo " " . $row['pseudo'] . " ";

                  }

                 ?>

                 </a>
                 <ul class="dropdown-menu">

                  <li><a class="dropdown-item" href="user/profil.php">Mon profil</a></li>
                  <li><a class="dropdown-item" href="user/profil.php?order">Mes commandes</a></li>
                  <li><a class="dropdown-item" href="logout.php">Se déconnecter</a></li>
                  
                 </ul>
                 </li>

                  </li>

                  <?php else: ?>

                 <li class="nav-item dropdown">

                 <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown">Magasin</a>


                 <ul class="dropdown-menu">

                 <?php 

                    global $db;

                    $get_cat = "SELECT * from categories";

                    $run_cat = mysqli_query($db, $get_cat);

                    while($row_cat = mysqli_fetch_array($run_cat)) {

                    $catname = $row_cat['catname'];

                    echo '<li><a class="dropdown-item dropdown-toggle" href="cat.php?cat='.$row_cat['cat_id'].'">'.$row_cat['catname'].'</a>';

                ?>
                
                 <ul class="submenu dropdown-menu">

                 <?php

                    global $db; 

                    $get_subcat = "SELECT * FROM subcat where catname = '$catname' AND subcat_display = 'Oui' ORDER BY subcat_id ASC ";

                    $run_subcat = mysqli_query($db, $get_subcat);

                    while($row_subcat = mysqli_fetch_array($run_subcat)) {

                    echo '<li><a class="dropdown-item" href="subcat.php?subcat='.$row_subcat['subcat_id'].'">'.$row_subcat['subcat_name'].'</a></li>';

                 ?>
                 
                                  <?php } ?>
                 </ul>
                                  <?php } ?>
                 </ul>


                 </li> 


                 <li class="nav-item"><a class="nav-link" href="about.php"> À Propos </a></li>
                 <li class="nav-item"><a class="nav-link" href="contact.php"> Contact </a></li>

                       <div class="search-box">
                           <form action="search.php" method="get">
                               <input type="text pt-1" name="searchArea" maxlength="60" size="15" placeholder="Reference,Marque.." required>
                               <input type="submit" name="search" value="Explorer" />
                           </form>
                       </div>


                  <li class="nav-item pt-auto"><a class="nav-link pl-auto pr-auto active" href="cart.php" ><i class="far fa-shopping-cart"></i>( <?php echo total_item(); ?> ) <?php total_price(); ?>TD</a></li>

                  <li class="nav-item pt-auto"><a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#ModalForm"><i class="fas fa-user"></i>Login</a></li>
                  </li>

                  <?php endif ?>

                  </ul>

</div> <!-- navbar-collapse.// -->
</div> <!-- container-fluid.// -->
</nav>

<div class="container">
<!-- Modal Form -->
<div class="modal fade" id="ModalForm" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <!-- Login Form -->
        <form action="" method="POST">
          <div class="modal-header">
            <h5 class="modal-title">Connexion client</h5>
          </div>
           <?php echo $msg; ?>
          <div class="modal-body">

            <div class="mb-3">
                <label for="pseudo">Pseudo<span class="text-danger">* :</span></label>
                <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" />
            </div>

            <div class="mb-3">
                <label for="mdp">Mot de passe<span class="text-danger">* :</span></label>
                <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" />
            </div>
            <div class="mb-3">
                <a href="forgot-password.php" class="float-end">Mot de passe oublié</a> <br>
            </div>
          </div>
          <div class="modal-footer pt-4">                  
            <input type="submit" name="login_btn" class="btn btn-success mx-auto w-100" value="login" /> 
          </div>
          <p class="text-center">Pas encore de compte, <a href="inscription.php"><strong>S'inscrire</strong> </a></p> 
      </form>
    </div>
  </div>
</div>
</div>


<section id="featured">
<div class="row mx-auto">
<form class="container text-center mt-5 py-5" action="" method="POST">    
<table class="table table-striped">
    <tr>
        <th>ID.</th>
        <th>Ref.</th>
        <th>Marque</th>
        <th>Produit Image</th>
        <th>Prix</th>
        <th>Prix final</th>
        <th>Quantité</th>
        <th>Taille</th>
        <th>Supprimer</th>

    </tr>


<?php 

    global $db;

    $total = 0;

    $ip = getIp();   

    $t_price = "select * from cart where ip_add = '$ip'";

    $run_price = mysqli_query($db, $t_price);

    while($row_t_price = mysqli_fetch_array($run_price)) {

        $id_produit = $row_t_price['id_produit'];

        // Tous les produits 

        $price_pro = "select * from tous_produits where id_produit = '$id_produit'";

        $run_price_pro = mysqli_query($db, $price_pro);

            while($row_pro_price = mysqli_fetch_array($run_price_pro)) {

            $pro_price = array($row_pro_price['prix']);

            $p_id = $row_pro_price['id_produit'];

            $p_reference = $row_pro_price['reference'];

            $p_marque = $row_pro_price['marque'];

            $p_img = $row_pro_price['images_name'];

            $p_single_p = $row_pro_price['prix'];
?>

<?php

if (isset($_POST['up_cart'])) // upgrade card
 {
    //POST VALUES
    $qty = $_POST['qty'];
    $size = $_POST['size'];
    $p_cat= 'tous_les_produits'; // $_POST insert into column p_cat

    //Query 
    
    $up_qty = "UPDATE cart set qty='$qty' WHERE p_cat='$p_cat' "; // req up qty
    $up_size = "UPDATE cart set size='$size' WHERE p_cat='$p_cat' "; // req up taille
    $run_u_qty = mysqli_query($db, $up_qty);
    $run_u_size = mysqli_query($db, $up_size);
    $_SESSION['qty'] = $qty; // display qty
    $_SESSION['size'] = $size; // choiser taille
    $p_final = $p_single_p*$qty;
    $up_pfinal = "UPDATE cart set pfinal='$p_final' WHERE p_cat='$p_cat'"; // req up pfinal
    $run_u_pfinal = mysqli_query($db, $up_pfinal);
    $_SESSION['p_final'] = $p_final; // calcul prix total

     echo '
     <script type="text/javascript">
      $(document).ready(function() {
      swal({
      text: "Votre panier a été mise à jour",
      icon: "success",
      button: false,
      timer: 2000,
      className: "popup"
      }).then(function() {
      window.location = "http://localhost/projet/cart.php";
      });
      });
      </script>
      ';

}

?>
<tr>

<td> <?php echo $p_id;?> </td>
<td> <?php echo $p_reference; ?> </td>
<td> <?php echo $p_marque; ?> </td>
<td><img width="70" src="login/images/<?php echo $p_img; ?>"></td>
<td><?php echo $p_single_p; ?> TD</td>
<td><?php echo $_SESSION['p_final']; ?> TD</td>
<td><input type="numbre" class="text-center" name="qty" size="3" value="<?php echo $_SESSION['qty']; ?>"></t>
<td>  
    <select name="size">
     <option><?php echo $_SESSION['size']; ?></option>
     <option value="XL">XL</option>
     <option value="M">M</option>
     <option value="S">S</option>
     <option value="XS">XS</option>
    </select>
</td>


<td><input type="checkbox" name="remove[]" value="<?php echo $id_produit; ?>"/></td>

</tr>

 <?php  }  } ?>


<?php 


    global $db;

    $total_B = 0;

    $ip = getIp();   

    $t_price = "select * from cart where ip_add = '$ip'";

    $run_price = mysqli_query($db, $t_price);

    while($row_t_price = mysqli_fetch_array($run_price)) {

        $id_produit = $row_t_price['id_produit'];

        // Nouvelle arrivals

        $price_pro_B = "select * from arrivals where id_produit = '$id_produit'";

        $run_price_pro_B = mysqli_query($db, $price_pro_B);


            while($row_pro_price_B = mysqli_fetch_array($run_price_pro_B)) {

            $pro_price_B = array($row_pro_price_B['prix']);

            $p_id_B = $row_pro_price_B['id_produit'];

            $p_reference_B = $row_pro_price_B['reference'];

            $p_marque_B = $row_pro_price_B['marque'];

            $p_img_B = $row_pro_price_B['images_name_arrivals'];

            $p_single_p_B = $row_pro_price_B['prix']; 
?>

<?php

if (isset($_POST['up_cart'])) // upgrade card
 {
    //POST VALUES
    $qty_B = $_POST['qty_B'];
    $size_B = $_POST['size_B'];
    $p_cat_2= 'arrivals'; // $_POST insert into column p_cat
    //Query 
    $up_qty_B = "UPDATE cart set qty='$qty_B' WHERE p_cat='$p_cat_2'"; // req up qty
    $up_size_B = "UPDATE cart set size='$size_B' WHERE p_cat='$p_cat_2'"; // req up taille
    $run_u_qty_B = mysqli_query($db, $up_qty_B);
    $run_u_size_B = mysqli_query($db, $up_size_B);
    $_SESSION['qty_B'] = $qty_B; // display qty
    $_SESSION['size_B'] = $size_B; // choiser taille
    $p_final_B = $p_single_p_B*$qty_B;
    $up_pfinal_B = "UPDATE cart set pfinal='$p_final_B' WHERE p_cat='$p_cat_2'"; // req up pfinal
    $run_u_pfinal_B = mysqli_query($db, $up_pfinal_B); 
    $_SESSION['p_final_B'] = $p_final_B; // calcul prix total

     echo '
     <script type="text/javascript">
      $(document).ready(function() {
      swal({
      text: "Votre panier a été mise à jour",
      icon: "success",
      button: false,
      timer: 2000,
      className: "popup"
      }).then(function() {
      window.location = "http://localhost/projet/cart.php";
      });
      });
      </script>
      ';
}

?>

<tr>
    
<td> <?php echo $p_id_B;?> </td>
<td> <?php echo $p_reference_B; ?> </td>
<td> <?php echo $p_marque_B; ?> </td>
<td><img width="70" src="login/images/<?php echo $p_img_B; ?>"></td>
<td><?php echo $p_single_p_B; ?></td>
<td><?php echo $_SESSION['p_final_B']; ?> TD</td>
<td><input type="text" class="text-center" name="qty_B" size="3" value="<?php echo $_SESSION['qty_B']; ?>"></td>
<td>  
    <select name="size_B">
     <option><?php echo $_SESSION['size_B'];?></option>
     <option value="XL">XL</option>
     <option value="M">M</option>
     <option value="S">S</option>
     <option value="XS">XS</option>
    </select>
</td>

<td><input type="checkbox" name="remove[]" value="<?php echo $id_produit; ?>"/></td>

</tr>

<?php  }  } ?>


<?php 

    global $db;

    $total_A = 0;

    $ip = getIp();   

    $t_price = "select * from cart where ip_add = '$ip'";

    $run_price = mysqli_query($db, $t_price);

    while($row_t_price = mysqli_fetch_array($run_price)) {

        $id_produit = $row_t_price['id_produit'];

        //  Produits populaires

        $price_pro_A = "select * from all_articles where id_produit = '$id_produit'";

        $run_price_pro_A = mysqli_query($db, $price_pro_A);


            while($row_pro_price_A = mysqli_fetch_array($run_price_pro_A)) {

            $pro_price_A = array($row_pro_price_A['prix']);

            $p_id_A = $row_pro_price_A['id_produit'];

            $p_reference_A = $row_pro_price_A['reference'];

            $p_marque_A = $row_pro_price_A['marque'];

            $p_img_A = $row_pro_price_A['images_name'];

            $p_single_p_A = $row_pro_price_A['prix'];

?>

<?php

if (isset($_POST['up_cart']))
 {
    //POST VALUES
    $qty_A = $_POST['qty_A'];
    $size_A = $_POST['size_A'];
    $p_cat_3 = 'all_articles';
    
    $up_qty_A = "UPDATE cart set qty='$qty_A' WHERE p_cat='$p_cat_3' "; // req up qty
    $up_size_A = "UPDATE cart set size='$size_A'WHERE p_cat='$p_cat_3' "; // req up taille
    $run_u_qty = mysqli_query($db, $up_qty_A);
    $run_u_size = mysqli_query($db, $up_size_A);
    $_SESSION['qty_A'] = $qty_A; // display qty
    $_SESSION['size_A'] = $size_A; // choiser taille
    $p_final_A = $p_single_p_A*$qty_A;
    $up_pfinal_A = "UPDATE cart set pfinal='$p_final_A' WHERE p_cat='$p_cat_3'"; // req up pfinal
    $run_u_pfinal_A = mysqli_query($db, $up_pfinal_A); 
    $_SESSION['p_final_A'] = $p_final_A; // calcul prix total

      echo '
      <script type="text/javascript">
      $(document).ready(function() {
      swal({
      text: "Votre panier a été mise à jour",
      icon: "success",
      button: false,
      timer: 2000,
      className: "popup"
      }).then(function() {
      window.location = "http://localhost/projet/cart.php";
      });
      });
      </script>
      ';
}

?>

<tr>
<td> <?php echo $p_id_A;?></td>
<td> <?php echo $p_reference_A; ?></td>
<td> <?php echo $p_marque_A; ?></td>
<td><img width="70" src="login/images/<?php echo $p_img_A; ?>"></td>
<td><?php echo $p_single_p_A ?></td>
<td><?php echo $_SESSION['p_final_A']; ?> TD</td>
<td><input type="text" class="text-center" name="qty_A" size="3" value="<?php echo $_SESSION['qty_A']; ?>"></td>
<td>  
    <select name="size_A">
     <option><?php echo $_SESSION['size_A'];?></option>
     <option value="XL">XL</option>
     <option value="M">M</option>
     <option value="S">S</option>
     <option value="XS">XS</option>
    </select>
</td>

<td><input type="checkbox" name="remove[]" value="<?php echo $id_produit; ?>"/></td>

</tr>

 <?php  }  } ?>




 <?php 

    global $db;

    $total_M = 0;

    $ip = getIp();   

    $t_price = "select * from cart where ip_add = '$ip'";

    $run_price = mysqli_query($db, $t_price);

    while($row_t_price = mysqli_fetch_array($run_price)) {

        $id_produit = $row_t_price['id_produit'];

        //  Montres


        $price_pro_M = "select * from montres where id_produit = '$id_produit'";


        $run_price_pro_M = mysqli_query($db, $price_pro_M);



            while($row_pro_price_M = mysqli_fetch_array($run_price_pro_M)) {

            $pro_price_M = array($row_pro_price_M['prix']);

            $p_id_M = $row_pro_price_M['id_produit'];

            $p_reference_M = $row_pro_price_M['reference'];

            $p_marque_M = $row_pro_price_M['marque'];

            $p_img_M = $row_pro_price_M['images_name_montres'];

            $p_single_p_M = $row_pro_price_M['prix'];



?>


<?php

if (isset($_POST['up_cart']))
 {
    //POST VALUES
    $qty_M = $_POST['qty_M'];
    $size_M = $_POST['size_M'];
    $p_cat_5 = 'Montres';

    
    $up_qty_M = "UPDATE cart set qty='$qty_M' WHERE p_cat='$p_cat_5'"; // req up qty
    $up_size_M = "UPDATE cart set size='$size_M' WHERE p_cat='$p_cat_5'"; // req up qty
    $run_u_qty = mysqli_query($db, $up_qty_M);
    $run_u_size = mysqli_query($db, $up_size_M);
    $_SESSION['qty_M'] = $qty_M; // display qty
    $_SESSION['size_M'] = $size_M; // choiser taille
    $p_final_M = $p_single_p_M*$qty_M;
    $up_pfinal_M = "UPDATE cart set pfinal='$p_final_M' WHERE p_cat='$p_cat_5'"; // req up pfinal
    $run_u_pfinal_M = mysqli_query($db, $up_pfinal_M); 
    $_SESSION['p_final_M'] = $p_final_M; // calcul prix total

       echo '
      <script type="text/javascript">
      $(document).ready(function() {
      swal({
      text: "Votre panier a été mise à jour",
      icon: "success",
      button: false,
      timer: 2000,
      className: "popup"
      }).then(function() {
      window.location = "http://localhost/projet/cart.php";
      });
      });
      </script>
      ';
}

?>
<tr>
<td> <?php echo $p_id_M;?></td>
<td> <?php echo $p_reference_M; ?></td>
<td> <?php echo $p_marque_M; ?></td>
<td><img width="70" src="login/images/<?php echo $p_img_M; ?>"></td>
<td><?php echo $p_single_p_M ?></td>
<td><?php echo $_SESSION['p_final_M']; ?> TD</td>
<td><input type="text" class="text-center" name="qty_M" size="3" value="<?php echo $_SESSION['qty_M']; ?>"></td>
<td>  
    <select name="size_M">
     <option><?php echo $_SESSION['size_M'];?></option>
     <option value="XL">XL</option>
     <option value="M">M</option>
     <option value="S">S</option>
     <option value="XS">XS</option>
    </select>
</td>
<td><input type="checkbox" name="remove[]" value="<?php echo $id_produit; ?>"/></td>

</tr>

 <?php  }  } ?>

<?php 

    global $db;

    $total_R = 0;

    $ip = getIp();   

    $t_price = "select * from cart where ip_add = '$ip'";

    $run_price = mysqli_query($db, $t_price);

    while($row_t_price = mysqli_fetch_array($run_price)) {

        $id_produit = $row_t_price['id_produit'];

        //  Robes

        $price_pro_R = "select * from robes where id_produit = '$id_produit'";


        $run_price_pro_R = mysqli_query($db, $price_pro_R);


            while($row_pro_price_R = mysqli_fetch_array($run_price_pro_R)) {

            $pro_price_R = array($row_pro_price_R['prix']);

            $p_id_R = $row_pro_price_R['id_produit'];

            $p_reference_R = $row_pro_price_R['reference'];

            $p_marque_R = $row_pro_price_R['marque'];

            $p_img_R = $row_pro_price_R['images_name_robes'];

            $p_single_p_R = $row_pro_price_R['prix'];


?>


<?php

if (isset($_POST['up_cart']))
 {

    //POST VALUES
    $qty_R = $_POST['qty_R'];
    $size_R = $_POST['size_R'];
    $p_cat_4 = 'Robes';
    
    $up_qty_R = "UPDATE cart set qty='$qty_R' WHERE p_cat='$p_cat_4' "; // req up qty
    $up_size_R = "UPDATE cart set size='$size_R' WHERE p_cat='$p_cat_4' "; // req up qty
    $run_u_qty = mysqli_query($db, $up_qty_R);
    $run_u_size = mysqli_query($db, $up_size_R);
    $_SESSION['qty_R'] = $qty_R; // display qty
    $_SESSION['size_R'] = $size_R; // choiser taille
    $p_final_R = $p_single_p_R*$qty_R;
    $up_pfinal_R = "UPDATE cart set pfinal='$p_final_R' WHERE p_cat='$p_cat_4'"; // req up pfinal
    $run_u_pfinal_R = mysqli_query($db, $up_pfinal_R); 
    $_SESSION['p_final_R'] = $p_final_R; // calcul prix total

     echo '
     <script type="text/javascript">
      $(document).ready(function() {
      swal({
      text: "Votre panier a été mise à jour",
      icon: "success",
      button: false,
      timer: 2000,
      className: "popup"
      }).then(function() {
      window.location = "http://localhost/projet/cart.php";
      });
      });
      </script>
      ';
}

?>

<tr>
<td> <?php echo $p_id_R;?></td>
<td> <?php echo $p_id_R;?></td>
<td> <?php echo $p_marque_R; ?></td>
<td><img width="70" src="login/images/<?php echo $p_img_R; ?>"></td>
<td><?php echo $p_single_p_R ?></td>
<td><?php echo $_SESSION['p_final_R']; ?> TD</td>
<td><input type="text" class="text-center" name="qty_R" size="3" value="<?php echo $_SESSION['qty_R']; ?>"></td>
<td>  
    <select name="size_R">
     <option><?php echo $_SESSION['size_R'];?></option>
     <option value="XL">XL</option>
     <option value="M">M</option>
     <option value="S">S</option>
     <option value="XS">XS</option>
    </select>
</td>

<td><input type="checkbox" name="remove[]" value="<?php echo $id_produit; ?>"/></td>

</tr>


 <?php  }  } ?>


<tr class="container text-center mt-5 py-5">
<th><h6>Prix total : <?php total_price(); ?> TD</h6></th> 
</tr>
<tr class="container text-center mt-5 py-5">
<td><input type="submit" name="up_cart" class="btn btn-info" value="Mise à jour panier" /></td> 
<td><a href="index.php" type="submit" class="btn btn-warning" />Continuer mes achats</td>
<td><a href="checkout.php" type="submit" class="btn btn-success" />Confirmer panier</td> 
</tr>

<?php

function up_cart() {

global $db;

$ip = getIp();

if (isset($_POST['up_cart'])) {

    foreach ($_POST['remove'] as $id_remove) {
     
       $delete_pro = "DELETE from cart where id_produit='$id_remove' AND ip_add='$ip'";

       $run_delete = mysqli_query($db,$delete_pro);

       if($run_delete) {

      echo '
      <script type="text/javascript">
      $(document).ready(function() {
      swal({
      text: "Votre panier a été mise à jour",
      icon: "success",
      button: false,
      timer: 2000,
      className: "popup"
      }).then(function() {
      window.location = "http://localhost/projet/cart.php";
      });
      });
      </script>
      ';

       }
    }

}
}

echo @$up_c = up_cart();

?>


</table>
</form>
</div>
</section>


<?php include 'files/footer.php'; ?>