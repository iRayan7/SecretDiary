    <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <title>Secret Diary</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style type="text/css">
        #main{
            text-align: center;
            width: 300px;
            margin-top: 150px;
            z-index: 99;
        }  
        body{
            background: none;
            font-family: 'Open Sans', sans-serif;
            color: white;
        }
        .background-image{
            background: url(bg1.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          -webkit-filter: blur(2px);
          -moz-filter: blur(2px);
          -o-filter: blur(2px);
            -ms-filter: blur(2px);
            filter: blur(2px);
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        #loginForm{
            display: none;
        }
        
        #diary{
            width: 100%;
            height: 90vh;
        }
        
        #diaryContainer{
            margin-top: 20px;
        }
      
    </style>
  </head>
  <body>