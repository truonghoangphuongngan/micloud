<!DOCTYPE html>
<html lang="en">
<head>
    <title>Micloud</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- my css -->
    <link rel='stylesheet' type='text/css' href='css/micloud.css'>

    <!-- icon -->
    <link rel="shortcut icon" href="images/cloud.png">   

</head>


<body>


<!-- header -->
<header>
    <div class="container">
        <nav class="navbar alert alert-danger d-flex justify-content-around">
            <!-- Brand/logo -->
            <div>
                <a class="navbar-brand" href="index.php">
                    <img src="images/cloud.png" alt="logo" style="width:40px;">
                </a>
                <a class="navbar-brand" href="index.php">
                    <h class="text-danger text-monospace">Micloud</h>
                </a>
            </div>

            <nav class="navbar navbar-expand-sm">
                <form class="form-inline" action="result_search.php" method="get">
                    <input class="form-control mr-sm-2 text-danger" type="text" id="search" name="search" placeholder="Search...">
                    <button class="btn btn-outline-danger" type="submit" id="submit_search">Tìm kiếm</button>

                </form>
            </nav>
            <br>
            <div>
                <a class="navbar-brand text-danger" href="user.php">
                    <i class="fa fa-user-circle fa-2x " aria-hidden="true"></i>
                </a>
            </div>
        </nav>
    </div>
</header>

<main>
    <div class="container">