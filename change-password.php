<?php include 'files/header.php'; ?>

<?php

session_start();

$msg = "";

if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM membre WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $mdp = mysqli_real_escape_string($conn, md5($_POST['mdp']));
            $mdpConf = mysqli_real_escape_string($conn, md5($_POST['mdpConf']));

            if ($mdp === $mdpConf) {
                $query = mysqli_query($conn, "UPDATE membre SET mdp='{$mdp}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                  echo '
                  <script type="text/javascript">
                  $(document).ready(function() {
                  swal({
                  text: "Votre mot de passe a été changé !",
                  icon: "success",
                  button: false,
                  timer: 3500,
                  className: "popup"
                  });
                  });
                  </script>
                  ';
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    echo "<script>window.open('forgot-password.php','_self')</script>";
}

?>



<section class="container sproduct my-5 pt-1">

<div class="row my-5">

<div class="col-lg-5 col-md-12 col-12">
 
<div style="padding-top: 125px;"> 
<div class="shadow p-3 mb-5 bg-white rounded">

<form class="form-floating" action="" method="POST">

    <?php echo $msg; ?>
    <h4 style="text-align: center;">Entrez le nouveau mot de passe</h4>
    <p style="text-align: center;">Choisissez un mot de passe fort composé de chiffres et de lettres pour une meilleure sécurité</p>

    <div class="form-group text-center">

    <input type="password" class="form-control" style="text-align: center;" name="mdp" placeholder="Entrez le nouveau mot de passe" required> <br>

    <input type="password" class="form-control" style="text-align: center;" name="mdpConf" placeholder="Entrez votre mot de passe de confirmation" required> <br>

    <button  name="submit" class="btn btn-success" type="submit">Changer le mot de passe</button>

    </div>
    </form>

    </div>
    </div>

</div>
<div class="col-lg-6 col-md-12 col-12">

<img  class="img-fluid" src="img/4419038.jpg">

</div> 
</div>
</section>     

<?php include 'files/footer.php'; ?>