<?php include 'partials/_dbconnect.php' ?>


<?php
$inserted=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['add_cmnt'] == 'adding_comment') 
{
    $th_id = $_GET['thread_id'];
    $comment_desc = $_POST["comment_of_thread"];
    $comment_desc = str_replace('>', '&gt;', $comment_desc);// here we are solving the XSS attack for desc
    $comment_desc = str_replace('<', '&lt;', $comment_desc);// here we are solving the XSS attack for desc
    $comment_user = $_POST["hidden_sno"];
    $sql = "INSERT INTO `comment` (`comment_desc`, `comment_thread_id`, `comment_user_id`) VALUES ('$comment_desc', '$th_id', '$comment_user')";
    $result = mysqli_query($con,$sql);
    if ($result===TRUE) {
        $inserted = true;
    }
    else {
        $inserted = false;
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Welcome to KK Goyal's Disccssion Room</title>
</head>

<body>
    <?php include 'partials/_header.php' ?>

    <?php
    if($inserted)
  {
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Comment Added Successfully | Thanks for your Reply on </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

?>

    <?php
        $th_id = $_GET['thread_id'];
        $sql = "SELECT * FROM `thread` WHERE thread_id='$th_id'";
        $result = mysqli_query($con,$sql);
        while ($row= mysqli_fetch_assoc($result))
        {
            $thrd_title = $row["thread_title"];
            $thrd_desc = $row["thread_desc"];
            $thrd_uid = $row["thread_user_id"];

        }
        $sql2 = "SELECT user_name FROM `users` WHERE s_no=$thrd_uid ";
        $result2 = mysqli_query($con,$sql2);
        $row2= mysqli_fetch_assoc($result2);
        $userName = $row2["user_name"];
    ?>





    <div class="jumbotron jumbotron-fluid bg-dark">
        <div class="container text-white ">
            <h1 class="display-4 "><?php echo $thrd_title?></h1>
            <p class="lead my-4"><b><?php echo "Q. ".$thrd_desc?></b></p>
            <hr>
            <h4 class="my-3 text-success">Posted By:<b> <?php echo $userName ?></b></h4><br>
        </div>
    </div>






    <div class="container mt-5">
        <h3>Browse The Disccssion :-</h3>
        <?php
        $sql = "SELECT * FROM `comment` WHERE comment_thread_id=$th_id";
        $result = mysqli_query($con,$sql);
        $noresult=true;
        while ($row= mysqli_fetch_assoc($result))
        {
            $noresult=false;
            $comment_desc= $row["comment_desc"];
            $comment_userid =  $row["comment_user_id"];
            $sql3 = "SELECT user_name FROM `users` WHERE s_no=$comment_userid";
            $result3 = mysqli_query($con,$sql3);
            $row3= mysqli_fetch_assoc($result3);
            $userName = $row3["user_name"];
            echo ' <ul class="list-unstyled">
            <li class="media my-4">
                <img class="mr-3" src="img/userimg.png" width="35px"  alt="Generic placeholder image">
                <b class="text-warning fs-5 ms-3 ">'.$userName .'</b>
                <div class="media-body my-2">
                <h5>  <b class="text-success">  '.$comment_desc.'</b></h5>
                </div><hr>
            </li>
        </ul>';
        }
    ?>

    </div>

    <?php
    if($noresult){
    echo'<div class="container">
        <div class="jumbotron bg-light">
            <div class="container  ">
                <h1 class="display-4 ">There is not such any Comments Yet</h1>
                <p class="lead my-4"><b>Be the one to Post the Comment...</b></p><br>
            </div>
        </div>
    </div>';
    }
    ?>
    </div>

    <div class="container my-5" style="min-height: 433px;">
        <hr>
        <h3><b>Post Your Comment...</b></h3>

        <!-- not adding action here still its working action=<?php $_SERVER['REQUEST_URI']?> -->

        <?php
    if (isset($_SESSION['isloggedin1']) && $_SESSION['isloggedin1'] == true) {
        echo'<form method="POST"> 
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave your Question here" name="comment_of_thread"
                    id="exampleInputThDesc" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Type your Comment ...</label>
                <input type="hidden" name="hidden_sno" value="'.$_SESSION['sno'].'">
            </div>
            <br>
            <button type="submit" name="add_cmnt" value="adding_comment" class="btn btn-primary">Post</button>
        </form>';
    }
        else {
       
            echo'<div class="container" style="min-height: 433px";>
       <div class="jumbotron jumbotron-fluid bg-Light">
        <p class="lead my-5">Please Login for Post <b> Comment </b>to the Discussion</p>
      </div>
    </div>';
        }
        ?>
    </div>


    <?php include 'partials/_footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>