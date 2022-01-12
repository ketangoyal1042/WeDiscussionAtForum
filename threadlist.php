<?php include 'partials/_dbconnect.php' ?>

<?php
$inserted=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['add_dtls'] == 'inserting') 
{
    $cate_id = $_GET['categoryid'];
    $thread_title = $_POST["title_of_thread"];
    $thread_desc = $_POST["desc_of_thread"];
    $uname = $_POST['hidden_sno'];

    $thread_title = str_replace('>', '&gt;', $thread_title);// here we are solving the XSS attack for title
    $thread_title = str_replace('<', '&lt;', $thread_title);// here we are solving the XSS attack for title

    $thread_desc = str_replace('>', '&gt;', $thread_desc);// here we are solving the XSS attack for desc
    $thread_desc = str_replace('<', '&lt;', $thread_desc);// here we are solving the XSS attack for desc

    $sql = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_desc', '$cate_id', '$uname')";

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
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Question Added Successfully | Hope You\'ll get reply soon ;) !!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
?>
    <?php
        $cate_id = $_GET['categoryid'];
        $sql = "SELECT * FROM `category` WHERE category_id='$cate_id'";
        $result = mysqli_query($con,$sql);
        while ($row= mysqli_fetch_assoc($result))
        {
            $category_name = $row["category_name"];
            $category_desc = $row["category_desc"];
        }
    ?>





    <div class="row p-0 pb-0 mt-0 pe-lg-0 pt-lg-0 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3 mt-0">
            <h1 class="display-4 fw-bold lh-1"><?php echo $category_name ?> Forum Here | Solve and see the Queries</h1>
            <p class="lead my-3"><?php echo $category_desc ?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <!-- <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Primary</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button> -->
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg ">
            <img class="rounded-lg-3" src="img/laptop_img.jpg" alt="" width="500" height="300">
        </div>
    </div>

    <div class="container mt-5">
        <h3>Browse Questions</h3>
        <?php
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id=$cate_id";
        $result = mysqli_query($con,$sql);
        $noresult=true;
        while ($row= mysqli_fetch_assoc($result))
        {
            $noresult=false;
            $thrd_id = $row["thread_id"];
            $thrd_title = $row["thread_title"];
            $thrd_desc = $row["thread_desc"];
            $thrd_timestamp = $row["thread_timestamp"];
            $thrd_uid = $row["thread_user_id"];
        $sql2 = "SELECT user_name FROM `users` WHERE s_no=$thrd_uid";
        $result2 = mysqli_query($con,$sql2);
        $row2= mysqli_fetch_assoc($result2);
        $userName = $row2["user_name"];
        

            echo ' <ul class="list-unstyled">
            <li class="media my-4">
                <img src="img/userimg.png" width="40px"  alt="Generic placeholder image">
                <b class="text-warning fs-5 ms-3 ">'.$userName .'</b>
                <div class="media-body my-2">
                <h5 class="mt-0 mb-1"><a class="text-success" href="thread.php?thread_id='.$thrd_id.'">'.$thrd_title.'</a></h5>
                '.$thrd_desc.'
                </div>
                </li>
                <h6 class="mt-0 mb-1 text-info"> on '. $thrd_timestamp.'</h6><hr>
        </ul>';
        }
    ?>
    </div>
    <?php
    if($noresult){
    echo'<div class="container">
        <div class="jumbotron bg-light mb-0">
            <div class="container  ">
                <h1 class="display-4 ">No Question Found</h1>
                <p class="lead my-4"><b>Be the one to ask the Question...</b></p><br>
            </div>
        </div>
    </div>';
    }
    ?>


    <hr>
    <?php
    if (isset($_SESSION['isloggedin1']) && $_SESSION['isloggedin1'] == true) {
    echo'<div class="container" style="min-height: 433px;">
        <h3><b>Enter Your Question Here...</b></h3>
        <form method="POST" action="threadlist.php?categoryid='.$cate_id.'">
            <div class="mb-3">
                <label for="exampleInputThTitle" class="form-label">Title</label>
                <input type="text" class="form-control" name="title_of_thread" id="exampleInputThTitle" required
                    aria-describedby="textHelp">
                <div id="emailHelp" class="form-text">Add your Question Title.</div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave your Question here" name="desc_of_thread"
                    id="exampleInputThDesc" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Write Your Problem Statement</label>
            </div>
            <input type="hidden" name="hidden_sno" value="'.$_SESSION['sno'].'">
            <button type="submit" name="add_dtls" value="inserting" class="btn btn-primary mt-4">Submit</button><br>
        </form>
    </div>';
    }
    else {
       
        echo'<div class="container" style="min-height: 433px";>
        <h3 ><b>Enter Your Question Here...</b></h3>
   <div class="jumbotron jumbotron-fluid bg-Light">
    <p class="lead my-5">Please Login for Posting a Question or Create a Thread.</p>
  </div>
</div>';
    }
    ?>

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