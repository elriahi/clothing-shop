<?php 

    $connect = mysqli_connect("localhost", "root", "", "articles");

    if(isset($_POST['update'])) {

    $client_session = $_SESSION['SESSION_PSEUDO'];

    $get_pass = "SELECT * FROM membre where pseudo = '$client_session'";

    $run_get_pass = mysqli_query($connect, $get_pass);

    while($row_membre = mysqli_fetch_array($run_get_pass)) {

    $real_mdp = $row_membre['mdp'];

    $old_pass = mysqli_real_escape_string($connect, md5($_POST['old_pass']));

    $new_pass = mysqli_real_escape_string($connect, md5($_POST['new_pass']));

    $conf_pass = mysqli_real_escape_string($connect, md5($_POST['conf_pass']));

    if ($old_pass == $real_mdp) {

    $query_up = "
    UPDATE membre
    SET mdp = '$new_pass'
    WHERE pseudo = '$client_session'
    ";
    $run_query_up = mysqli_query($connect, $query_up);

    if($run_query_up) {

    	          echo '
                  <script type="text/javascript">
                  $(document).ready(function() {
                  swal({
                  text: "Votre mot de passe changé",
                  icon: "success",
                  button: false,
                  timer: 2500,
                  className: "popup"
                  }).then(function() {
                  window.location = "http://localhost/projet/user/profil.php?change_password";
                  });
                  });
                  </script>
                  ';   
    }

    }

    }

    }	


?>

<div class="col-md-6">

<h3 style="font-family: Poppins;  margin-top: 10px; margin-left: 13px;"> Changer mot de passe</h3>
<hr style="margin-left: 13px;">


<div class="container">


    <form action="" method="POST">  

	<label style="font-family: Poppins;">Entrer votre mot de passe actuel</label> 
	<input type="password" name="old_pass" class="form-control" required> <br>

	<label style="font-family: Poppins;">Entrez un nouveau mot de passe</label>
	<input type="password" name="new_pass" class="form-control" required> <br>

	<label style="font-family: Poppins;">Confirmer le nouveau mot de passe</label> 
	<input type="password" name="conf_pass" class="form-control" required> <br>

    <button class="form-control btn btn-success" name="update">Mise à jour</button>

    </form>

</div>
</div>