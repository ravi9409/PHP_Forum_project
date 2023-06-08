<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 433px;
        }
    </style>
    <title>Welcome to iDiscuss - Coding Forum</title>
</head>

<body>

<?php include "partials/_header.php" ?>
<?php include "partials/_dbconnect.php" ?>

<?php
$id = $_GET['catid'];
$sql = "SELECT * FROM `categiroes` WHERE category_id=$id";
$results = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($results)) {
    $catname = $row['category_name'];
    $catdesc = $row['category_description'];
}
?>

<?php
$showAlerts=false;
$method=$_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    $th_title=$_POST['title'];
    $th_desc=$_POST['desc'];
    $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', $id, 1, current_timestamp())";
    $result=mysqli_query($connection,$sql);
    $showAlerts=true;
    if($showAlerts){
        echo '<div class="alert alert-success" role="alert">
                  <p><b>Sucess! </b>Your thread has been added!Please wait for community to respond</p>
            </div>';
    }
}
?>

<!--use a for loop to iterate thorugh categories-->
<div class="container my-3">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to <?php echo $catname ?> forums</h1>
        <br>
        <p class="lead"><?php echo $catdesc ?></p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p class="lead">
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </p>
    </div>

    <div class="container">
        <h1 class="py-2">Start a discussion</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                       placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">Keep your title as crisp and short as
                    possible</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Elaborate your concern</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="desc" rows="3"></textarea>
            </div>
            <button class="btn btn-success" type="submit">Submit</button>
        </form>
    </div>


    <div class="container" id="ques">
        <h1>Browse Questions</h1>

        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $results = mysqli_query($connection, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($results)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $time = date_format(date_create($row['timestamp']),"Y-m-d");
            echo '<div class="media my-3" >
            
            <img class="mr-3" src="../forum/images/download.png" width="70px" alt="Generic placeholder image">
            <div class="media-body">
            <p class="font-weight-bold my-0">Anonymous User at '.$time. '</p>
            <br>
                <h5 class="mt-0"><a href="../forum/thread.php?threadid=' . $id . '">' . $title . '</a></h5>
            ' . $desc . '
            <hr>
            </div>
        </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">No Results Found</h1>
            <p class="lead">Be the first person to ask a question</p>
        </div>
        </div>';
        }
        ?>


    </div>


</div>

<?php include "partials/_footer.php" ?>

<br>

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