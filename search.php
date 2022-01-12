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
    

  
    <div class="container ">
        <h1 class="text-center my-2 mx-3">Here are the Search results for: <b class="text-warning"><?php echo $_GET['asearch'] ?></b></h1><hr><br>
        <?php
        $query_search= $_GET['asearch'];
        $sql = "SELECT * FROM thread WHERE MATCH (thread_title,thread_desc) against ('$query_search')";
        $result = mysqli_query($con,$sql);
        $noresult = true;
        while ($row= mysqli_fetch_assoc($result))
        {
            $noresult=false;
            $thrd_id = $row["thread_id"];
            $thrd_title = $row["thread_title"];
            $thrd_desc = $row["thread_desc"];
            $link= "thread.php?thread_id=".$thrd_id;

            echo '<div class="result my-2">
            <h3 class="text-success my-2">
              <a href='.$link.' class="text-warning">'.$thrd_title.'</a>
            </h3>
            <p  class="text-secondary">'.$thrd_desc.'</p>
        </div>';
        }

        if($noresult){
            echo'<div class="container">
                <div class="jumbotron bg-light mb-0">
                    <div class="container text-center ">
                        <h1 class="display-4 ">No Result Found</h1>
                        <p class="lead my-4"><b></b></p><br>
                    </div>
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