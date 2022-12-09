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

<?php  ?>

<?php

   include 'login/includes/function.php';

   $delete_pro = "TRUNCATE TABLE cart";

   $run_delete = mysqli_query($db,$delete_pro);

   session_start();
   session_unset();
   session_destroy();

    echo '
    <script type="text/javascript">
    $(document).ready(function() {
    swal({
    text: "Vous êtes maintenant déconnecté ... ! [ VOTRE PANIER SERA VIDE ] !",
    icon: "warning",
    button: false,
    timer: 1500,
    className: "popup"
    }).then(function() {
    window.location = "http://localhost/projet/index.php";
    });
    });
    </script>
    ';

?>