<?php

    session_start();

    if(isset($_POST['content'])){
        
        include("con.php");
        
        $query = "UPDATE users SET diary ='".mysqli_real_escape_string($link,$_POST['content'])."' WHERE id = '".$_SESSION['id']."'";
        
        mysqli_query($link,$query);
         
        
    }



?>