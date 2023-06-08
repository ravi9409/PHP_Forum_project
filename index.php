<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        #ques{
            min-height: 433px;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Welcome to iDiscuss - Coding Forum</title>
</head>

<body>
<?php include "partials/_header.php" ?>
<?php include "partials/_dbconnect.php" ?>
<!--Carousal-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="https://source.unsplash.com/collection/1163637/1600x400?coding"
                 alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://source.unsplash.com/collection/1163637/1600x400?apple"
                 alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://source.unsplash.com/collection/1163637/1600x400" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!--use a for loop to iterate thorugh categories-->
<div class="container my-3" id="ques">
    <br>
    <h2 class="text-center">iDiscuss - Categories</h2>
    <br>
    <div class="row">
        <!--        Fetch all categories and use a loop to iterate through them -->
        <?php
        $sql = "SELECT * FROM `categiroes`";
        $results = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($results)) {
            $catId = $row['category_id'];
            $catName = $row['category_name'];
            $catDesc = $row['category_description'];
            echo '<div class="col-md-4">

            <div class="card" style="width: 18rem;">

                <img src="https://source.unsplash.com/collection/1163637/380x380?coding?' . $catName . '" class="card-img-top">

                <div class="card-body">
                    <h5 class="card-title"><a href="threads.php?catid=' .$catId.'">' . $catName . '</a></h5>
                    <br>
                    <p class="card-text">'.substr($catDesc,0,100).'...</p>
                    <a href="threads.php?catid=' .$catId.'" class="card-link">View Threads</a>
                    
                </div>
                
            </div>
            <br>
        </div>';
        }
        ?>
    </div>

</div>

<br>

<?php include "partials/_footer.php" ?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>