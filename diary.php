<?php

    session_start();
    
    if(isset($_COOKIE['id'])){
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if(isset($_SESSION['id'])){
        
        include("con.php"); // connection to database
        $query = "SELECT diary FROM users WHERE id = '".$_SESSION['id']."'";
        $row = mysqli_fetch_array(mysqli_query($link,$query));
        $diaryContent = $row['diary'];
    } else {
        header("Location: index.php");
    }

    include("header.php");

    
    ?>
    
    <div class="background-image"></div>
    <nav class="navbar navbar-toggleable-sm navbar-light bg-faded ">

        <a class="navbar-brand" href="#">Secret Diary</a>

        <ul class="navbar-nav mr-auto"></ul>

        <a href='index.php?logout=1'><button class="btn btn-outline-danger " type="submit">Logout</button></a>


    </nav>
    <div class="container-fluid" id="diaryContainer">  
        
        <textarea class="form-control" id="diary" ><?php echo $diaryContent ?></textarea>
        
    </div>



<?php

    include("footer.php");


?>

