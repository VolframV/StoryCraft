<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ADD-STORY</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">
    <!-- Custom styles for this template -->
</head>

<body>

<style>
    .container{
        background-color: rgb(25, 25, 25);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.7);
    }
    .card{
        margin-bottom: 5px;
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

</style>

<video playsinline autoplay muted loop poster="polina.jpg" id="bgvid">
    <source src="video/2.mp4" type="video/mp4">
</video>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">StoryCraft</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="getStoryList.php">Story List </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addStory.php">Add Story <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <br>
<h1 class="text-center">ADD CHAPTER</h1>
    <hr>
<form action="" method="post">

    <div class="row">

        <div class="form-group col-md-12">
            <label for="inputState">Story: </label>
            <select id="inputState" class="form-control" name="story_genre" class="form-control">
                <option selected value="Adventure">Adventure.</option>
                <option value="Exploration">Exploration</option>
        </div>
    <div class="form-group col-md-12">
        <label for="storyName">Chapter Question</label>
        <textarea class="form-control" name="chapter_question" rows="15" id="comment" placeholder="Enter Story Question...max 200 characters" maxlength="230"></textarea>
    </div>
    </div>

    <div class="row">
    <div class="form-group col-md-6">
        <label for="storyAuthor">Chapter Choice 1</label>
        <input type="text" class="form-control" name="chapter_choice1" value="" id="chapterChoice1" size="25" maxlength="60" >
    </div>
        <div class="form-group col-md-6">
            <label for="storyAuthor">Chapter Choice 2</label>
            <input type="text" class="form-control" name="chapter_choice2" value="" id="chapterChoice1" size="25" maxlength="60" >
        </div>
        <div class="form-group col-md-6">
            <label for="storyAuthor">Chapter Choice 3</label>
            <input type="text" class="form-control" name="chapter_choice3" value="" id="chapterChoice1" size="25" maxlength="60" >
        </div>
        <div class="form-group col-md-6">
            <label for="storyAuthor">Chapter Choice 4</label>
            <input type="text" class="form-control" name="chapter_choice4" value="" id="chapterChoice1" size="25" maxlength="60" >
        </div>
        <div class="form-group col-md-6">
            <label for="storyAuthor">Chapter Reaction 1</label>
            <textarea class="form-control" name="chapter_question" rows="7" id="comment" placeholder="...max 200 characters" maxlength="230"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="storyAuthor">Chapter Reaction 2</label>
            <textarea class="form-control" name="chapter_question" rows="7" id="comment" placeholder="...max 200 characters" maxlength="230"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="storyAuthor">Chapter Reaction 3</label>
            <textarea class="form-control" name="chapter_question" rows="7" id="comment" placeholder="...max 200 characters" maxlength="230"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="storyAuthor">Chapter Reaction 4</label>
            <textarea class="form-control" name="chapter_question" rows="7" id="comment" placeholder="...max 200 characters" maxlength="230"></textarea>
        </div>

        <div class="form-group col-md-12">
            <label for="inputState">Correct Answer: </label>
            <select id="inputState" class="form-control" name="story_genre" class="form-control">
                <option selected value="ChapterChoice1">Choice 1</option>
                <option value="ChapterChoice2">Choice 2</option>
                <option value="ChapterChoice3">Choice 3</option>
                <option value="ChapterChoice4">Choice 4</option>
        </div>

    </div>


    <div class="col-md-12">
        <input type="submit" class="form-control" name="submit" value="ADD">
    </div>

    <br>

</form>


<?php

if (isset($_POST['submit'])){

        $s_name   =  str_replace("'","\'",trim($_POST['story_name']));

        $s_genre  =  str_replace("'","\'",trim($_POST['story_genre']));

        $s_author =  str_replace("'","\'",trim($_POST['story_author']));

        $s_desc   =   str_replace("'","\'",trim($_POST['story_description']));

    if (!empty($s_name)){
        require_once('./db_connect.php');

        $sql = "INSERT INTO storylist (StoryId, StoryName, StoryDescription, StoryGenre, StoryAuthor) VALUES ('', '$s_name', '$s_desc', '$s_genre','$s_author')";

        $response = @mysqli_query($dbconnection, $sql);

        if ($response) {
            echo 'SQL WAS A SUCCESS';
        }else{
            echo "<h4>Could not pass the db query</h4>";
            echo "<br>";
            echo "Error: ", mysqli_error($dbconnection);
        }

        mysqli_close($dbconnection);

    }else{
        echo '<br><h1 class="text-center">FIELDS EMPTY, QUERY FAILED!</h1><br><br>';
    }
}


?>
</div>
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
