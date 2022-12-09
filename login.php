   <?php
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
                  text: "Vous êtes maintenant connecté !!",
                  icon: "success",
                  button: false,
                  timer: 3500,
                  className: "popup"
                  });
                  });
                  </script>
                  ';
              
                        } 

            else {
                $msg = "<div class='alert alert-info'>Vérifiez d'abord votre compte et réessayez.</div>";
            }
          } else {
                $msg = "<div class='alert alert-danger'>Le pseudo et le mot de passe sont incompatibles</div>";
        }

    }

?>

<!-- Login Form -->
<div class="Container justify-content-md-start" style="margin-top: 100px;"> 
 <div class="modal-content">
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