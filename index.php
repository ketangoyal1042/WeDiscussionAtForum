<?php include 'partials/_dbconnect.php' ?>


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
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true")
    {
        echo'<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Sign Up Successfully </strong> | You can now login
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    }

    else if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false") {
        echo'<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
      <strong>'.$_GET['show'].'</strong> Try Again!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true")
    {
        echo'<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Login Successfully </strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    else if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false") {
        echo'<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
      <strong>'.$_GET['show'].'</strong> Try Again or Sign In first !
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <!-- crousal here -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1400x300/?youtube" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1400x300/?tech" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1400x300/?network" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end crousal -->


    <div class="container" style="min-height: 533px";>
        <h2 class="text-center my-2">Here is the categories</h2>
        <div class="row my-2">

            <?php
        $sql = "SELECT * FROM `category`";
        $result = mysqli_query($con,$sql);
        while ($row= mysqli_fetch_assoc($result))
        {
            $cat_id = $row["category_id"];
            $desc= $row["category_desc"];
            echo'<div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="https://source.unsplash.com/400x300/?'.$row["category_name"].'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?categoryid='.$cat_id.'">'.$row["category_name"].'</a></h5>
                        <p class="card-text">'.substr($desc,0,101).'....</p>
                        <a href="threadlist.php?categoryid='.$cat_id.'" class="btn btn-primary">Visit Thread</a>
                    </div>
                </div>
            </div>';
        }
            ?>
        </div>
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