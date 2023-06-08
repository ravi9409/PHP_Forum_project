<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Welcome to iDiscuss - Coding Forum</title>
</head>

<body>
<?php include "partials/_header.php" ?>
<?php include "partials/_dbconnect.php" ?>

<?php
$id = $_GET['threadid'];
$sql = "SELECT * FROM `threads` WHERE thread_id=$id";
$results = mysqli_query($connection, $sql);
$noResult = true;
while ($row = mysqli_fetch_assoc($results)) {
    $noResult = true;
    $title = $row['thread_title'];
    $desc = $row['thread_desc'];
}
?>

<!--use a for loop to iterate thorugh categories-->
<div class="container my-3">
    <div class="jumbotron">
        <h1 class="display-4"><?php echo $title ?> forums</h1>
        <hr class="my-4">
        <p class="lead"><?php echo $desc ?></p>
    </div>

    <div class="container">
        <h1 class="py-2">Post your comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button class="btn btn-success" type="submit">Post Comment</button>
        </form>
    </div>

    <div class="container" id="ques">
        <h1>Discussions</h1>
        <?php
        $showAlerts = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $comment = $_POST['comment'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`) VALUES ('$comment', $id,current_timestamp())";
            $result = mysqli_query($connection, $sql);
            $sqlSelect = "SELECT * FROM `comments` WHERE thread_id=$id";
            $resultSelect = mysqli_query($connection, $sqlSelect);
            while ($row = mysqli_fetch_assoc($resultSelect)) {
                $comment_time = date_format(date_create($row['comment_time']),"Y-m-d");
            }
            $showAlerts = true;
            echo '<div class="media my-3" >
            
            <img class="mr-3" src="../forum/images/download.png" width="50px" alt="Generic placeholder image">
            <div class="media-body">
            <p class="font-weight-bold my-0">Anonymous User at '.$comment_time. '</p>
            ' . $comment . '
            </div>
        </div>';
//            if ($showAlerts) {
//                echo '<div class="alert alert-success" role="alert">
//                  <p><b>Sucess! </b>Your comment has been added</p>
//            </div>';
//            }
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