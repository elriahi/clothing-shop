<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'articles');

if(isset($_POST['delete']))
{
   
   $id = $_POST['id'];

   $query = "DELETE FROM contact WHERE id = '$id' ";
   $query_run = mysqli_query($connection, $query);
   
   if($query_run) 

   {

       header("location:msgs.php");
   }
   else
   {
       echo '<script> alert("données non supprimées"); </script>';
       header("location:msgs.php");

   }
}

?>