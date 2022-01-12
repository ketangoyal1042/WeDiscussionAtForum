<?php

session_start();

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand mx-3" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Tech Forum
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

                    $sql = "SELECT * FROM `category`";
                    $result = mysqli_query($con,$sql);
                    while ($row= mysqli_fetch_assoc($result))
                    {
                        $cat_id = $row["category_id"];
                        $desc= $row["category_desc"];

                       echo' <li><a class="dropdown-item" href="/ONLINEFORUM/threadlist.php?categoryid='.$cat_id.'">'.$row["category_name"].'</a></li>';
                        // <li><a class="dropdown-item" href="#">Another action</a></li>
                        
                    }
                        echo '</ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2">Contact Us</a>
                </li>
            </ul>
            <div class="row">';

            if (isset($_SESSION['isloggedin1']) && $_SESSION['isloggedin1'] == true) {
                echo '<form class="d-flex" action="search.php" method="GET">
                    <input class="form-control me-2 mx-2" type="search" name="asearch" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-success  mr-5" type="submit">Search</button>
                    <p class="text-light mx-2 ">'.$_SESSION['username'].'</p>
                    <a href="partials/_handlelogout.php"><button type="button" class="btn btn-warning mx-2">Logout</button></a>
                </form>';
            }
            

        else {
            echo '<form class="d-flex action="search.php" method="GET">
                    <input class="form-control me-2" type="search" name="asearch" placeholder="Search" aria-label="Search">
                    <button type="submit" class="btn btn-outline-success mr-5" type="submit">Search</button>
                    <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Login</button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#signupModal">Signup</button>
                </form>';

        }

        echo '</div>
        </div>
    </div>
</nav>';

?>
<?php include 'partials/_signupmodal.php' ?>
<?php include 'partials/_loginmodal.php' ?>