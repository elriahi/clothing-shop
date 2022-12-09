<head>
<script>
      function confirmAction() {
        let confirmAction = confirm("Voulez-vous vraiment supprimer votre compte ?");
        if (confirmAction) {
          alert("Votre a éte supprimer !");
        } else {
          alert("Opération annuler !");
        }
      }
    </script>
</head>	
	
<?php 

 $connect = mysqli_connect("localhost", "root", "", "articles");
 if(isset($_POST['oui'])) {
 $client_session = $_SESSION['SESSION_PSEUDO'];
 $query_del = "DELETE FROM membre WHERE pseudo = '$client_session' ";
 $run_query = mysqli_query($connect, $query_del);
 if($run_query)
 {
 	    	      echo '
                  <script type="text/javascript">
                  $(document).ready(function() {
                  swal({
                  text: "Votre compte supprimé",
                  icon: "success",
                  button: false,
                  timer: 2500,
                  className: "popup"
                  }).then(function() {
                  window.location = "http://localhost/projet/logout.php";
                  });
                  });
                  </script>
                  ';   
 }
}

?>

<h5 style="font-family: Poppins;  margin-top: 10px; margin-left: 13px;"> Voulez-vous vraiment supprimer votre compte ?</h5>

<br>
<div class="container">
<form action="" method="POST">
	<button onclick="confirmAction()" type="submit" name="oui" class="btn btn-danger">Oui, je veux supprimer</button>
	<button onclick="confirmAction()" type="submit" name="non" class="btn btn-warning">Non, je ne veux pas supprimer</button>
</form>
</div>
