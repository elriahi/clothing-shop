    <head>
        <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style type="text/css">
              .popup{
                    width: 300px;
                    font-size: 1.6rem !important;
                    font-family: Georgia, serif;
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara - Magasin de vêtements</title>
    <!-- My CSS Style -->
    <link rel="stylesheet" href="./style.css">
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

<body>
 
<!-- Back to top button -->

<button
        type="button"
        class="btn btn-danger btn-floating btn-lg"
        id="btn-back-to-top"
        >
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


                 <li class="nav-item"><a class="nav-link active" href="about.php"> À Propos </a></li>
                 <li class="nav-item"><a class="nav-link" href="contact.php"> Contact </a></li>
                 
                       <div class="search-box">
                           <form action="search.php" method="get">
                               <input type="text pt-1" name="searchArea" maxlength="60" size="15" placeholder="Reference,Marque.." required>
                               <input type="submit" name="search" value="Explorer" />
                           </form>
                       </div>

                  <li class="nav-item pt-auto"><a class="nav-link pl-auto pr-auto" href="cart.php" ><i class="far fa-shopping-cart"></i>( <?php echo total_item(); ?> ) <?php total_price(); ?>TD</a></li>

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


                 <li class="nav-item"><a class="nav-link active" href="about.php"> À Propos </a></li>
                 <li class="nav-item"><a class="nav-link" href="contact.php"> Contact </a></li>

                       <div class="search-box">
                           <form action="search.php" method="get">
                               <input type="text pt-1" name="searchArea" maxlength="60" size="15" placeholder="Reference,Marque.." required>
                               <input type="submit" name="search" value="Explorer" />
                           </form>
                       </div>

                  <li class="nav-item pt-auto"><a class="nav-link pl-auto pr-auto" href="cart.php" ><i class="far fa-shopping-cart"></i>( <?php echo total_item(); ?> ) <?php total_price(); ?>TD</a></li>

                  <li class="nav-item pt-auto"><a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#ModalForm"><i class="fas fa-user"></i>Login</a></li>
                  </li>

                  <?php endif ?>

                  </ul>

</div> <!-- navbar-collapse.// -->
</div> <!-- container-fluid.// -->
</nav>


<section class="container sproduct my-5 pt-1">
<div class="row my-5">
<div class="col-lg-5 col-md-12 col-12">

 <h4>Qui sommes nous ?</h4>
 <hr>
 <p>Notre website <strong>CARA.</strong> est un plateforme en ligne spécialisé dans la vente de la plus dernière modes avec la possibilité de livrer sur tout le territoire de la République Tunisiene .</p>
 <p><strong>Adresse : </strong> Béja, Medjez el beb, 9070 <br>
 <strong>Téléphone : </strong> +216 43 513 874<br>
 <strong>E-mail : </strong>  caracompany1@gmail.com
 </p> 	
 <br>
 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3201.165582739219!2d9.609807720302268!3d36.646466979394646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fcc14a301fbefd%3A0xd6155847091c1f40!2scit%C3%A9%20el%20hwerir%20medjez%20el%20beb%2C%20Majaz%20Al%20Bab!5e0!3m2!1sfr!2stn!4v1663861538175!5m2!1sfr!2stn" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div> 
<div class="col-lg-6 col-md-12 col-12">
<img  class="img-fluid w-100 pb-1" src="img/about..png">
</div> 
</div>
</section>

<?php include 'files/footer.php' ?>