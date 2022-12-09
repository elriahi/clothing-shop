   <!-- Sweet Alert -->
    <head>
        <script src="Js/jquery.js"></script>
        <script src="Js/sweetalert.min.js"></script>
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

    if (isset($_GET['verif'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM membre WHERE code='{$_GET['verif']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE membre SET code='' WHERE code='{$_GET['verif']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>La vérification du compte a été effectuée avec succès.</div>";
            }
        } else {
            header("Location: index.php");
        }
    }

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
                     <a class="nav-link active" href="index.php">Acceuil </a>
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


                 <li class="nav-item"><a class="nav-link" href="about.php"> À Propos </a></li>
                 <li class="nav-item"><a class="nav-link" href="contact.php"> Contact </a></li>

                       <div class="search-box">
                           <form action="search.php" method="get">
                               <input type="text pt-1" name="searchArea" maxlength="60" size="15" placeholder="Reference,Marque.." required>
                               <input type="submit" name="search" value="Explorer" />
                           </form>
                       </div>


                  <li class="nav-item pt-auto"><a class="nav-link pl-auto pr-auto" href="cart.php" ><i class="far fa-shopping-cart"></i>( <?php echo total_item(); ?> ) <?php total_price(); ?>DT</a></li>

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
                <input type="text" name="pseudo" class="form-control"  placeholder="Pseudo" />
            </div>

            <div class="mb-3">
                <label for="mdp">Mot de passe<span class="text-danger">* :</span></label>
                <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" /><br>
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
    <!-- Header -->

    <section id="hero">
    <?php echo $msg; ?>
    <h4>Bienvenue sur CARA</h4>
    <h2>Offres super valeur</h2>
    <h1>Sur tous les produits</h1>
    <p>« Le bonheur le plus doux est celui qu'on partage. » – Jacques Delile.</p>
    <button onclick="window.location.href='http://localhost/projet/search.php?searchArea=new&search=search'">Explorer plus</button>

    </section>

    <!-- brands -->

    <section id="brand" class="container">
    <div class="row m-0 py-5">
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brand/north.png" alt="Nrth face">
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brand/vogue.png" alt="vogue">  
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brand/unnamed.jpg" alt="Jordon">  
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brand/adidas.png" alt="Adidas">  
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brand/cd.png" alt="Christian Dior">  
        <img class="img-fluid col-lg-2 col-md-4 col-6" src="img/brand/image.jpg" alt="Chanel">  

    </div>
  </section>

     <!-- Banner (1) -->

     <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="img/new/img2.jpg">
                   <div class="details">
                    <h2 class="mt-5" style="color: #FFFFFF;">Superbe robe</h2>
                    <button onclick="window.location.href='http://localhost/projet/search.php?searchArea=robe&search=search'" 
                    class="text-uppercase" style="color: #FFFFFF;">Acheter</button>
              </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="img/new/img3.jpg">
                <div class="details">
                    <br><br>
                <h2 class="mt-5" style="color: #FFFFFF;">Montres de luxe</h2>
                <button onclick="window.location.href='http://localhost/projet/search.php?searchArea=montre&search=search'" 
                class="text-uppercase" style="color: #FFFFFF;">Acheter</button>
              </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="img/new/imgg1.jpg">
                <div class="details">
                    <h2 class="mt-5" style="color: #FFFFFF;">Baskets extrêmement rares</h2>
                    <button onclick="window.location.href='http://localhost/projet/search.php?searchArea=baskets&search=search'"
                    class="text-uppercase" style="color: #FFFFFF;">Acheter</button>
            </div>  
          </div>
       </div>
     </section>  

    <!-- Produits de (All_articles) -->
    
    <section id="featured">
       <div class="container text-center mt-2 py-5">
        <h2>Produits tendance</h2>
        <hr class="mx-auto"> 
        <p class="mb-2">“C'est l'élégance simple qui nous charme.”</p>
            </div> 
            <div class="row mx-auto container-fluid">
                <?php
            require_once("login/includes/database.php");
            $req=$db->prepare('SELECT * FROM all_articles');
            $req->execute();
            while ($reponse=$req->fetch(PDO::FETCH_OBJ)) {?>

                <div class="product text-center col-lg-3 col-d col-12">
                    <img class="img-fluid mb-2" src="login/images/<?php echo $reponse->images_name ?>" alt="">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $reponse->marque; ?></h5>
                    <h4 class="p-price"><?php echo $reponse->prix; ?> DT</h4>
                        <a href="p_populaires.php?id=<?php echo $reponse->id_produit ?>" style="color: white;" class="btn buy-btn" role="button">Acheter</a>
                </div>
                     <?php }
                     ?>
            </div>
     </section>

   <!-- banner (2) -->

   <section id="banner" class="my-5 py-5">

    <div class="container">
        <h4>Vente de mi-saison</h4>
        <h1>Découvrez notre<br>Collection Automne</h1>
        <button onclick="window.location.href='http://localhost/projet/search.php?searchArea=automne&search=search'"
        class="text-uppercase">Acheter</button>
     </div>

   </section>

   <!-- Produits de (Arrivals) -->
    
    <section id="featured">
       <div class="container text-center mt-2 py-5">
        <h2>Nouvelles Arrivées</h2>
        <hr class="mx-auto"> 
        <p class="mb-2">“C'est l'élégance simple qui nous charme.”</p>
            </div> 
            <div class="row mx-auto container-fluid">
                <?php
            require_once("login/includes/database.php");
            $req=$db->prepare('SELECT * FROM arrivals');
            $req->execute();
            while ($reponse=$req->fetch(PDO::FETCH_OBJ)) {?>

                <div class="product text-center col-lg-3 col-d col-12">
                    <img class="img-fluid mb-2" src="login/images/<?php echo $reponse->images_name_arrivals ?>" alt="">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $reponse->marque; ?></h5>
                    <h4 class="p-price"><?php echo $reponse->prix; ?> DT</h4>
                        <a href="p_arrivals.php?id=<?php echo $reponse->id_produit ?>" style="color: white;" class="btn buy-btn" role="button">Acheter</a>
                </div>
                     <?php }
                     ?>
            </div>
     </section>

      <!-- Produits de (Robes) -->
    
    <section id="featured">
       <div class="container text-center mt-2 py-5">
        <h2>Superbe Robes</h2>
        <hr class="mx-auto"> 
        <p>“C'est l'élégance simple qui nous charme.”</p>
            </div> 
            <div class="row mx-auto container-fluid">
                <?php
            require_once("login/includes/database.php");
            $req=$db->prepare('SELECT * FROM robes');
            $req->execute();
            while ($reponse=$req->fetch(PDO::FETCH_OBJ)) {?>

                <div class="product text-center col-lg-3 col-d col-12">
                    <img class="img-fluid mb-3" src="login/images/<?php echo $reponse->images_name_robes ?>" alt="">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $reponse->marque; ?></h5>
                    <h4 class="p-price"><?php echo $reponse->prix; ?> DT</h4>
                        <a href="p_robes.php?id=<?php echo $reponse->id_produit ?>" style="color: white;" class="btn buy-btn" role="button">Acheter</a>
                </div>
                     <?php }
                     ?>
            </div>
     </section>

        <!-- Produits de (Dernier Montres ) -->
    
    <section id="featured">
       <div class="container text-center mt-2 py-5">
        <h2>Montres de luxe</h2>
        <hr class="mx-auto"> 
        <p>“C'est l'élégance simple qui nous charme.”</p>
            </div> 
            <div class="row mx-auto container-fluid">
                <?php
            require_once("login/includes/database.php");
            $req=$db->prepare('SELECT * FROM montres');
            $req->execute();
            while ($reponse=$req->fetch(PDO::FETCH_OBJ)) {?>

                <div class="product text-center col-lg-3 col-d col-12">
                    <img class="img-fluid mb-3" src="login/images/<?php echo $reponse->images_name_montres ?>" alt="">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $reponse->marque; ?></h5>
                    <h4 class="p-price"><?php echo $reponse->prix; ?> DT</h4>
                        <a href="p_montres.php?id=<?php echo $reponse->id_produit ?>" style="color: white;" class="btn buy-btn" role="button">Acheter</a>
                </div>
                     <?php }
                     ?>
            </div>
     </section>

     <!-- footer -->

    <section id="foooter" class="mt-5 py-5">

        <div class="row container mx-auto pt-1">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <a class="navbar-brand" href="index.php" style="color: white;"><b>Cara.</b></a>
                <p class="pt-2">Notre website CARA. est un plateforme en ligne spécialisé dans la vente de la plus dernière modes avec la possibilité de livrer sur tout le territoire de la République Tunisiene .</p>
                <a href="#"><i class="fab fa-facebook-square" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <a href="#"><i class="fab fa-linkedin" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <a href="#"><i class="fab fa-twitter" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <br><br>
            </div>

             <div class="footer-one col-lg-3 col-md-6 col-12">

                <h5 class="pb-2">Accés rapide</h5>

                              <?php if (isset($_SESSION['SESSION_PSEUDO'])):?>
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item pt-auto"><a class="nav-link" href="user/profil.php">Mon profil</a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="user/profil.php?order">Mes commandes </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="logout.php">Se déconecter </a></li>
                </ul>   

                                <?php else: ?>
            <ul class="navbar-nav ml-auto">
                  <li class="nav-item pt-auto"><a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#ModalForm">Login</a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="inscription.php">S'inscrire</a></li>
            </ul>     

                                <?php endif ?>

            </div>

         <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Contact</h5>
                <div>
                    <h5 class="text-uppercase">Address</h5>
                    <p>Béja , Medjez el beb , 9070</p>
                </div>
                <div>
                    <h5 class="text-uppercase">Téléphone</h5>
                    <p>+(216) 43 513 874</p>
                </div>
               <div>
                    <h5 class="text-uppercase">Email</h5>
                    <p>CARA@GMAIL.COM</p>
                </div>
         
        </div>
             <div class="footer-one col-lg-3 col-md-6 col-12">
                
                <h5 class="pb-2">Catégories</h5>


                <ul class="navbar-nav ml-auto">
                  <li class="nav-item pt-auto"><a class="nav-link" href="cat.php?cat=1">Homme</a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="cat.php?cat=2">Femme </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="cat.php?cat=3">Enfatns - filles </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="cat.php?cat=4">Enfatns - Garcons </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="cat.php?cat=5">Bébés - Filles </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="cat.php?cat=6">Bébés - Garcons </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="cat.php?cat=7">Accessoires </a></li>
                  </li>
                  </ul>
            </div>
       </div>
        </div>
        <div class="copyright">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-6 col-12">
                </div>
                     <div class="col-lg-4 col-md-6 col-12 text-nowrap">
                        <p class="text-center">CARA Company. © 2022. All Rights Reserved</p>
                 </div>
            </div>
        </div>
    </section>

<!-- Bootsrap JS CDN -->
<script src="Js/popper.min.js"></script>
<script src="Js/bootstrap.min.js"></script>
<!-- My Js -->
<script type="text/javascript" src="Js/scroll.js"></script>
</body>
</html>