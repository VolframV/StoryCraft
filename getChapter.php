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


    <div class="col-md-12">


<?php

    //session start
    session_start();

    require_once('./db_connect.php');


    class Printer{
        function printChapter($chapterId, $storyId, $chapterQuestion, $chapterChoice1, $chapterChoice2, $chapterChoice3, $chapterChoice4, $chapterReaction1,$chapterReaction2,$chapterReaction3,$chapterReaction4, $chapterAnswer){

            $title = $_SESSION[$chapterId];
            echo '<div> <h1 class="text-center title">Chapter:', $title,'</h1></div> <hr><br>';
            echo '<div><h2> ', $chapterQuestion, '</h2></div>';
            echo '<div class="col-md-12">
                  <form action="" method="post">
                  <div class="col-md-12">
                  <div class="row">
                  <h5>Answer: </h5>
                  <div class="form-group col-md-4">
                  <select id="chapterOption" class="form-control" name="',$chapterId,'">';
            echo '<option value="ChapterChoice1">', $chapterChoice1, '</option>';
            echo '<option value="ChapterChoice2">', $chapterChoice2, '</option>';
            // IF STATEMENT IN CASE IT HAS ONLY 2 or 3 OPTIONS
            if($chapterChoice3!=null){
                echo '<option value="ChapterChoice3">', $chapterChoice3, '</option>';
            }
            if($chapterChoice4!=null){
                echo '<option value="ChapterChoice4">', $chapterChoice4, '</option>';
            }
           echo '<div class="form-group col-md-2">
                    <input type="submit" class="form-control" name="submit" value="GO">
                    </select></div></div></div></form>';
            $userAnswerPost = $_POST[$chapterId] ?? null;

                    switch ($userAnswerPost) {
                        case  'ChapterChoice1':
                            echo '<h3>', $chapterReaction1, '</h3>';
                            break;
                        case  'ChapterChoice2':
                            echo '<h3>', $chapterReaction2, '</h3>';
                            break;
                        case  'ChapterChoice3':
                            echo '<h3>', $chapterReaction3, '</h3>';
                            break;
                        case  'ChapterChoice4':
                            echo '<h3>', $chapterReaction4, '</h3>';
                            break;
                    }


            echo '</div>'; // close col-md-12

        }
    }
    // create an array containng previous answers
    // use JS to change the values

$sql = "SELECT ChapterId, StoryId, ChapterQuestion, ChapterChoice1, ChapterChoice2, ChapterChoice3, ChapterChoice4, ChapterReaction1,ChapterReaction2,ChapterReaction3,ChapterReaction4, ChapterAnswer FROM firststory";
    //$sql = "SELECT StoryId, StoryName, StoryGenre, StoryAuthor, StoryDescription FROM StoryList WHERE StoryGenre = '$s_SESSION[StoryId]'";
$chapters = array();
$response = @mysqli_query($dbconnection, $sql);
if ($response) {
    while ($row = mysqli_fetch_array($response)) {
        $chapters[] = $row;
    }
}else{
    // pass an error if something went from with the database query
    echo "<h4>Could not pass the db query</h4>";
    echo "<br>";
    echo "Error: ", mysqli_error($dbconnection);
}
mysqli_close($dbconnection);

$_SESSION['chaptersCount'] = $add;

        for($i = 0; $i < sizeof($chapters) ; $i++) {

                echo $chapters[$i][11];
                $userResponse = (new Printer)->printChapter($chapters[$i][0], $chapters[$i][1], $chapters[$i][2], $chapters[$i][3], $chapters[$i][4], $chapters[$i][5], $chapters[$i][6], $chapters[$i][7], $chapters[$i][8], $chapters[$i][9], $chapters[$i][10],$chapters[$i][11]);
                print $userResponse;

                if ($_POST['submit']) {
                    if ($_POST[$chapters[$i][0]] == $chapters[$i][11]) {
                         header("Location:getChapter.php");
                         exit;
                    } else {
                        echo 'WRONG';
                    }
                }
//// use session to restart the page and uppend each time to keep track of chapters
        }

    ?>



    <br>
    <br>
    </div>  <!-- /.container -->

    <canvas id="myCanvas" width="1000" height="1000"
            style="border:1px solid #c3c3c3;">
        Your browser does not support the canvas element.
    </canvas>

    <script>

        function draw() {
            var canvas = document.getElementById("myCanvas");
            var ctx = canvas.getContext("2d");

            ctx.fillStyle = "#d6d6d6";

            var q=0;

            while(q<1000){

                var x = Math.floor((Math.random() * 1000) + 1);
                var b = Math.floor((Math.random() * 1000) + 1);

                var y = Math.floor((Math.random() * 4) + 1);
                var i = Math.floor((Math.random() * 4) + 1);


                ctx.fillRect(x,b,i,y);
                ctx.fillRect(b,x,y,i);

                ctx.fillRect(1000-x,1000-b,y,i);
                ctx.fillRect(1000-b,1000-x,i,y);

                q++;
            }
            ctx.clear();
        }
        function draw2() {
            var canvas = document.getElementById("myCanvas");
            var ctx = canvas.getContext("2d");

            ctx.fillStyle = "#d6d6d6";

            var q=0;

            var x = Math.floor((Math.random() * 1000) + 1);
            var b = Math.floor((Math.random() * 1000) + 1);


            while(q<10){
                var y = Math.floor((Math.random() * 60) + 1);
                var i = Math.floor((Math.random() * 30) + 1);

                ctx.fillRect(x,b,i,y);
                ctx.fillRect(b,x,y,i);

                q++;
            }
        }

        setInterval(function() {
            draw();
        }, 1000);



    </script>


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
