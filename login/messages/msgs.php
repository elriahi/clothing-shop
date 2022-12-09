<?php include "../includes/header.php" ?>
     
   <div class="content">

        <h2>Messages / Feedbacks </h2>

        <?php

        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection, 'articles');
        $query = "SELECT * FROM contact";
        $query_run  = mysqli_query($connection, $query);

        ?>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                   <th>ID</th> 
                   <th>Name</th> 
                   <th>E-Mail</th> 
                   <th>Téléphone</th> 
                   <th>Méssage</th> 
                   <th>Date d'envoi</th>
                   <th>Opération</th> 
                </tr>   
            </thead>
        
        <?php 
            while($row = mysqli_fetch_array($query_run)) {

                echo '
                  <tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['name'].'</td>
                  <td>'.$row['email'].'</td>
                  <td>'.$row['phone'].'</td>
                  <td>'.$row['msg'].'</td>
                  <td>'.$row['date_envoi'].'</td>

                 <form action="del.php" method="POST">
                 <input type="hidden" name="id" value="'.$row['id'].'">
                 <td><input type="submit" name="delete" class="btn btn-danger" value="Supprimer"></td>
                 </form>

                 </tr>

                ';
            }
        ?>


       
       </table> 

   </div>

         <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" src="../includes/js/app.js"></script>

    </body>
</html>