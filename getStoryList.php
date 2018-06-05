<?php
// Start the session, must be before all html in the document.
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <title>TEST</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" >
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">
  <!-- Custom styles for this template -->
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">StoryCraft</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="getStoryList.php">Stories <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addChapter.php">Create</a>
            </li>
        </ul>
    </div>
</nav>

<style>
    body{
        background-color: rgb(35, 35, 35);
    }
  .container{
      background-color: rgb(25, 25, 25);
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.7);
  }
    .card{
        margin-bottom: 1em;
    }
    .title{
        font-size: 5em;
    }
  video#bgvid {
      position: fixed;
      top: 50%;
      left: 50%;
      min-width: 100%;
      min-height: 100%;
      width: auto;
      height: auto;
      z-index: -100;
      -ms-transform: translateX(-50%) translateY(-50%);
      -moz-transform: translateX(-50%) translateY(-50%);
      -webkit-transform: translateX(-50%) translateY(-50%);
      transform: translateX(-50%) translateY(-50%);
      background-size: cover;
  }
  .card {
      /* Add shadows to create the "card" effect */
      box-shadow: 0 4px 8px 0 rgb(0, 0, 0);
      background-color: rgb(35, 35, 35);
      transition: 0.3s;
  }

  /* On mouse-over, add a deeper shadow */
  .card:hover {
      box-shadow: 0 4px 8px 0 rgba(255, 255, 255, 0);
      background-color: rgb(25, 25, 25);
      border: 1px solid rgb(10, 10, 10);
      transition: 0.3s;
  }

  /* Add some padding inside the card container */
  .container {
      padding: 2px 16px;
  }

</style>

<video playsinline autoplay muted loop poster="" id="bgvid">
    <source src="video/1.mp4" type="video/mp4">
</video>


<div class="container">
    <h1 class="text-center title">S T O R I E S</h1>
    <hr>
    <br>

<form action="" method="post">
    <div class="col-md-8">
        <div class="row">
            <h5>Genre:</h5>
    <div class="form-group col-md-4">

        <select id="inputState" class="form-control" name="story_filter">
            <option selected value="All">All</option>
            <option value="Adventure">Adventure</option>
            <option value="Exploration">Exploration</option>
            <option value="Science Fiction">Science Fiction</option>
            <option value="Fiction">Fiction</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Development">Development</option>
        </select>
    </div>
        <div class="form-group col-md-2">
            <input type="submit" class="form-control" name="submit" value="GO"></div></div></div>
</form>
  <?php


    require_once('./db_connect.php');

  if (!empty($_POST['story_filter'])){
      $s_filter  =  $_POST['story_filter'];
  }else{

      echo '<div class="jumbotron jumbotron-fluid">
                <div class="container-fluid">
                <h1 class="display-4 text-center">Welcome to StoryCraft</h1>
                <hr class="my-4"> ';
      echo  '<p class="lead"> StoryCraft is a collection of user and developer generated story adventures. Explore a veriety of thrilling and exicting adventures where each of your choices will lead you to victory or defeat. Do be careful, each step you take can be your last in the world of StoryCraft.</p>
        <br>
        <p class="lead text-center text-muted"> To get started select a Genre and press \'Go\'</p></div></div>';
      $s_filter = "";
  }

if($s_filter == "All"){
    $sql = "SELECT StoryId, StoryName, StoryGenre, StoryAuthor, StoryDescription FROM StoryList";
}else{
    $sql = "SELECT StoryId, StoryName, StoryGenre, StoryAuthor, StoryDescription FROM StoryList WHERE StoryGenre = '$s_filter'";
}

$response = @mysqli_query($dbconnection, $sql);

if ($response) {
    echo '<div class="col-md-12">
          <div class="row">';
        while ($row = mysqli_fetch_array($response)) {
            echo '
            <div class="col-md-4 down">
            <div class="card" >
            <div class="card-header">',@$row['StoryGenre'],'</div>
            <div class="card-body">
             <blockquote class="blockquote mb-0">
            <h4 class="card-title text-center">',@$row['StoryName'],"</h4>
             </blockquote>",
            "<hr>
             <p>",@$row['StoryDescription'],'</p>';
              echo '<footer class="blockquote-footer">Written by 
                        <cite title="Source Title">';
              echo @$row['StoryAuthor'],'</cite>
                    </footer>
                      </div>
                 </div> 
            </div>';


               //   $_SESSION['StoryId'] =  $storyId;


  }

    echo "</div></div>";
}else{
    echo "<h4>Could not pass the db query</h4>";
    echo "<br>";
    echo "Error: ", mysqli_error($dbconnection);
}

mysqli_close($dbconnection);


?>
    <br>
    <br>
  <!-- /.container -->
  <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
  <script>

      window.onscroll = function () {
          myFunction()
      };

      function myFunction() {
          if (document.body.scrollTop > 650 || document.documentElement.scrollTop > 650) {
              document.getElementById("myNav").className = "navbar navbar-expand-md navbar-light fixed-top ";
          } else {
              document.getElementById("myNav").className = "navbar navbar-expand-md  fixed-top";
          }
      }

      //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      window.sr = ScrollReveal();

      sr.reveal('.down', {
          duration: 1200,
          origin: 'bottom',
          distance: '100px',
          delay: 300,
          opacity: 0,
          viewFactor: 0.6,
      })

      sr.reveal('.right', {
          duration: 1100,
          origin: 'right',
          distance: '200px',
          delay: 200,
          viewFactor: 0.6,
          mobile: true
      })
      sr.reveal('.left', {
          duration: 1100,
          origin: 'left',
          distance: '200px',
          delay: 200,
          viewFactor: 0.6,
          mobile: true
      })

  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
          integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
          crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
          integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
          crossorigin="anonymous"></script>

</body>

</html>
