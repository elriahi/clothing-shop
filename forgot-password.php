<?php include 'files/header.php'; ?>

<?php

session_start();

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$msg = "";

if (isset($_POST['rest_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code = mysqli_real_escape_string($conn, md5(rand()));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM membre WHERE email='{$email}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE membre SET code='{$code}' WHERE email='{$email}'");

        if ($query) {        
            echo "<div style='display: none;'>";
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'caracompany1@gmail.com';               //SMTP username
                $mail->Password   = 'yrilzhjnxtrcfrfd';                     //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('caracompany1@gmail.com');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'CARA - REST PASSWORD';
                $mail->Body    = 'Voici votre lien de vérification <b><a href="http://localhost/projet/change-password.php?reset='.$code.'">http://localhost/projet/change-password.php?reset='.$code.'</a></b>';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";        
            $msg = "<div class='alert alert-info'>Nous avons envoyé un lien de vérification sur votre adresse e-mail.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>$email - Cette adresse e-mail est introuvable.</div>";
    }
}

?>


<section class="container sproduct my-5 pt-1">

<div class="row my-5">

<div class="col-lg-5 col-md-12 col-12">
 
<div style="padding-top: 125px;"> 

<div class="shadow p-3 mb-5 bg-white rounded">

<form class="form-floating" action="" method="POST">

    <h5 style="text-align: center;"><strong style="color: #2f3640;">Récupération</strong>&nbsp;de mot de passe</h5> <br>
    <?php echo $msg; ?>
    <p style="text-align: center;"> Entrez s'il vous plait l'email utilisé dans votre compte </p>

    <div class="form-group text-center">

    <input class="form-control" style="text-align: center;" type="email" class="email" name="email" placeholder="Entrez votre adresse e-mail" required> <br>

    <button  name="rest_btn" class="btn btn-success" type="submit">Envoyer le lien de réinitialisation</button>

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