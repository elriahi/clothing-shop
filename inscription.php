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

                  <li class="nav-item pt-auto"><a class="nav-link pl-auto pr-auto" href="cart.php" ><i class="far fa-shopping-cart"></i>( <?php echo total_item(); ?> ) <?php total_price(); ?>TD</a></li>

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


<!-- My PHP Config -->

<?php 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; //Load Composer's autoloader

$msg = ""; // Erorr MSG !

if (isset($_POST['save_select'])) {

    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mdp = mysqli_real_escape_string($conn, md5($_POST['mdp']));
    $mdpConf = mysqli_real_escape_string($conn, md5($_POST['mdpConf']));
    $civilite = mysqli_real_escape_string($conn, $_POST['civilite']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $code_postal = mysqli_real_escape_string($conn, $_POST['code_postal']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM membre WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - Cette adresse e-mail existe déjà.</div>";
        } else {
            if ($mdp === $mdpConf) {
                $sql = "INSERT INTO membre (prenom, nom, tel, pseudo, email, mdp, civilite, ville, code_postal, adresse, code) VALUES ('{$prenom}', '{$nom}', '{$tel}', '{$pseudo}', '{$email}', '{$mdp}', '{$civilite}', '{$ville}', '{$code_postal}', '{$adresse}', '{$code}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     //Enable verbose debug output
                        $mail->isSMTP();                                           //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                      //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
                        $mail->Username   = 'caracompany1@gmail.com';              //SMTP username
                        $mail->Password   = 'yrilzhjnxtrcfrfd';                    //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
                        $mail->Port       = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('caracompany1@gmail.com');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'CARA';
                        $mail->Body    = 'Voici le lien de vérification <b><a href="http://localhost/projet/?verif='.$code.'">http://localhost/projet/?verif='.$code.'</a></b>'; 

                        $mail->send();
                        echo 'Le message a été envoyé';
                    } catch (Exception $e) {
                        echo "Le message pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>Nous avons envoyé un lien de vérification sur votre adresse e-mail.</div>";
                } else {
                    $msg = "<div class='alert alert-danger text-center'>Something wrong went.</div>";
                }
                 } else {

                $msg = "<div class='alert alert-danger text-center'>Le deux mot de passe sont incompatibles.</div>";
            }
        }
}

?>

<!-- My inscription form -->

<section class="container sproduct my-5 pt-1">

<div class="row my-5">

<div class="col-lg-5 col-md-12 col-12">

<form class="form-floating pt-2" action="" method="POST">

    <h5 style="text-align: center;">Inscription dans notre magasin</h5> <br>
      <?php echo $msg; ?> <!-- echo message after the process -->
    <div>
        <label for="prenom">Prénom :</label>
        <input class="form-control" type="text" value="<?php if (isset($_POST['save_select'])) { echo $prenom; } ?>" name="prenom" required>
    </div>
    <div>
        <label for="nom">Nom :</label>
        <input class="form-control" type="text" value="<?php if (isset($_POST['save_select'])) { echo $nom; } ?>" name="nom" required>
    </div>
    <div>
        <label for="email">Email :</label>
        <input class="form-control" type="email" value="<?php if (isset($_POST['save_select'])) { echo $email; } ?>" name="email" required>
    </div>
    <div>
        <label for="tel">Numéro de téléphone :</label>
        <input class="form-control" stype="email" value="<?php if (isset($_POST['save_select'])) { echo $tel; } ?>"  name="tel" required>
    </div>
    <div>
        <label for="pseudo">Nom d'utilisateur :</label>
        <input class="form-control" type="text" value="<?php if (isset($_POST['save_select'])) { echo $pseudo; } ?>" name="pseudo" required>
    </div>
    <div>
        <label for="mdp">Mot de passe :</label>
        <input class="form-control" type="password" name="mdp" required>
    </div>
        <div>
        <label for="mdpConf">Répéter mot de passe :</label>
        <input class="form-control" type="password" name="mdpConf" required>
    </div>
   <div class="from-group mb-3">
    <label for="">Genre :</label>
         <select value="<?php echo $civilite; ?>" name="civilite" class="form-control" required>
         <option value="">--Sélectionnez le genre--</option>
         <option value="Homme">Homme</option>
         <option value="Femme">Femme</option>
        </select>
   </div>
   <div>
        <label for="ville">Ville :</label>
        <input class="form-control" type="text" value="<?php if (isset($_POST['save_select'])) { echo $ville; } ?>" name="ville" required>
    </div>
    <div>
        <label for="code_postal">Code Postal :</label>
        <input class="form-control" type="number" value="<?php if (isset($_POST['save_select'])) { echo $code_postal; } ?>" name="code_postal" required>
    </div>
    <div>
        <label for="adresse">Adresse :</label>
        <textarea class="form-control" type="text" value="<?php if (isset($_POST['save_select'])) { echo $adresse; } ?>" name="adresse" rows="1" required></textarea> <br>
    </div>
   <div class="text-center">
         <button type="submit" name="save_select" class="btn btn-warning">S'inscrire Maintenant</button>
    </div>

  
</form>
</div>
<!-- Image -->

<div class="col-lg-6 col-md-12 col-12">

<img  class="img-fluid w-100 pb-1" src="img/sign-up.jpg">

</div>    
</div>
</section>

     <!-- footer -->

       <section id="foooter" class="mt-5 py-5">

        <div class="row container mx-auto pt-1">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <a class="navbar-brand" href="index.php" style="color: white; font-size: 50px;"><b>Cara.</b></a>
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
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=1">Homme</a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=2">Femme </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=3">Enfatns - filles </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=4">Enfatns - Garcons </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=5">Bébés - Filles </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=6">Bébés - Garcons </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=7">Accessoires </a></li>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<!-- My Js -->
<script type="text/javascript" src="Js/scroll.js"></script>
</body>
</html>