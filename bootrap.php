

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- header -->
<div class="container">
<nav class="navbar navbar-expand-sm bg-secondary text-white navbar-dark d-flex justify-content-around">
  <!-- Brand/logo -->
  <div>
    <a class="navbar-brand" href="#">
        <img src="images/icon.png" alt="logo" style="width:40px;">
    </a>
    <a class="navbar-brand" href="#">
        <h>Micloud</h>
  </a>
    </div>

  <nav class="navbar navbar-expand-sm">
  <form class="form-inline" action="result_search.php" method="post">
    <input class="form-control mr-sm-2" type="text" id="search" name="search" placeholder="Search">
    <button class="btn btn-outline-danger" type="submit" id="submit_search" name="submit_search">Tìm kiếm</button>
    
  </form>
</nav>
<br>
<div>
  <a class="navbar-brand" href="#">
    <img src="images/ring.png" alt="logo" style="width:40px;">
  </a>
  <a class="navbar-brand" href="user.php">
    <img src="images/user.png" alt="logo" style="width:40px;">
  </a>
</div>
</nav>       
</div>

</body>
</html>
