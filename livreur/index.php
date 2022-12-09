
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cara - Magasin de vêtements</title>
    <!-- Main CSS Style -->
<link rel="stylesheet" href="includes/style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<!------ Include the above in your HEAD tag ---------->
<body> 
<div class="sidenav">
         <div class="login-main-text">
            <h2>CARA<br>Livreur CP</h2>
            <p>Livraison</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form" style="margin-top: 170px;">
        	<form action="authenticate.php" method="POST">
                  <div class="form-group">
                     <label>Nom d'utilisateur</label>
                     <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required="required" />
                  </div>
                  <div class="form-group">
                     <label>Mot de passe</label>
                     <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" />
                  </div>
                  <button type="submit" name="login" class="btn btn-black">Login</button>
               </form>
            </div>
         </div>
      </div>
</body>
</html>